<?php

namespace App\Http\Controllers;

use App\JobPosition;
use App\SocialCrendential;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class JobPositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('backend.client.clickindia');
        return view('backend.jobs.job_post');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd($_REQUEST);
        $eduQualification = '';
        foreach ($request->eduQualification as $key => $value) {

            if (++$key == $request->eduQualification)
                $eduQualification .= $value;
            else
                $eduQualification .= $value . ', ';
        }

        $commonController = new CommonController();

        $JobPosition = new JobPosition();
        $JobPosition->clientId = request('clientId');
        $JobPosition->positionState = request('positionState');
        $JobPosition->positionCity = request('positionCity');
        $JobPosition->positionName = request('positionName');
        $JobPosition->closeDate = Carbon::parse(request('closeDate'))->format('Y-m-d 12:59:59');
        $JobPosition->openings = request('openings');
        $JobPosition->location = request('location');
        $JobPosition->skillSet = request('skillSet');
        $JobPosition->job_description = request('job_description');
        $JobPosition->minYearExp = request('minYearExp');
        $JobPosition->maxYearExp = request('maxYearExp');
        $JobPosition->eduQualification = $eduQualification;
        $JobPosition->minSalary = request('minSalary');
        $JobPosition->maxSalary = request('maxSalary');
        $JobPosition->jobType = request('jobType');
        $JobPosition->industry = request('industry');
        $JobPosition->level = request('level');
        $JobPosition->gender = request('gender');
        $JobPosition->save();


        $click_india_job_status = $commonController->sendToClickIndia($JobPosition->id, 423, $eduQualification);

        dd($click_india_job_status);

        $message = 'clientId: ' . $JobPosition->clientId . 'positionState: ' . $JobPosition->positionState . 'positionCity: ' . $JobPosition->positionCity . 'positionName: ' . $JobPosition->positionName . 'closeDate: ' . $JobPosition->closeDate . 'openings: ' . $JobPosition->openings . 'location: ' . $JobPosition->location . 'skillSet: ' . $JobPosition->skillSet . 'job_description: ' . $JobPosition->job_description . 'minYearExp: ' . $JobPosition->minYearExp . 'maxYearExp: ' . $JobPosition->maxYearExp . 'eduQualification: ' . $JobPosition->eduQualification . 'minSalary: ' . $JobPosition->minSalary . 'maxSalary: ' . $JobPosition->maxSalary . 'jobType: ' . $JobPosition->jobType . 'industry: ' . $JobPosition->industry . 'level: ' . $JobPosition->level . 'gender: ' . $JobPosition->gender;


        $SocialCrendential = SocialCrendential::where('social_plateform_name', $value)->first();

        try {
            $client = new Client(['base_uri' => 'https://api.linkedin.com']);
            $response = $client->request('GET', '/v2/me', [
                'headers' => [
                    "Authorization" => "Bearer " . $SocialCrendential->access_token,
                ],
            ]);

            $data = json_decode($response->getBody()->getContents(), true);
            $linkedin_profile_id = $data['id']; // store this id somewhere



            $commonController->sendLinkedInPost($message, $SocialCrendential->access_token);

            session()->put('linkedin_profile_id', $linkedin_profile_id);

            return redirect('social-group')->with('success', 'LinkedIn message has been posted successfully !!');
        } catch (Exception $e) {
            // return redirect('social-group')->with('error', 'LinkedIn message can not be posted !!');
            echo $e->getMessage();
        }

        return redirect('position')->with('success', 'Job position has been saved & posted to linkedin successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosition $jobPosition, $id)
    {
        $JobPosition = JobPosition::find($id);
        $position = JobPosition::find($id);
        // dd($jobPosition);
        try {
            $client = new Client();
            $url = "https://www.clickindia.com/cron/jobs_business_api.php";

            // dd($url);
            $response = $client->put($url, [
                'headers' => ['Content-type' => 'application/json'],
                // 'auth' => [
                //     'testing',
                //     'testing123'
                // ],
                'json' => [
                    'job_id' => $position->id,
                    'job_title' => $position->positionName,
                    'job_description' => $position->job_description,
                    'job_category' => $position->job_category,
                    'job_city' => $position->positionCity,
                    // 'job_location' => $position->positionState,
                    'job_location' => $position->location,
                    'job_pref_loc' => $position->location,
                    'qualification' => $position->eduQualification,
                    'experience' => $position->minYearExp . '-' . $position->maxYearExp,
                    'job_type' => $position->jobType,
                    'payroll_type' => $position->payroll_type,
                    'salary' => $position->minSalary . '-' . $position->maxSalary,
                    'salary_type' => $position->salary_type,
                    'designation' => $position->designation,
                    'working_days' => $position->working_days,
                    'gender' => $position->gender,
                    'hiring_process' => $position->hiring_process,
                    'vacancy' => $position->openings,
                    'skills' => $position->skillSet,
                    'languages' => $position->languages,
                    'listing_url' => $position->listing_url,
                    'company' => $position->company,
                    // 'company_logo' => $company_logo_path,
                    'company_website' => $position->company_website,
                    'company_profile' => $position->company_profile,
                    'other' => $position->other,
                ],
            ]);

            if ($response->getBody()) {
                $msg = " Click India Job Posted!! ";
                dd($msg);
                // return back()->with('success', 'Job position has been posted successfully !!');
            } else {
                $msg = " Click India Job Posting Error!! ";
                // return back()->with('error', 'Job can not be posted to click india job board !!');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Job can not be posted to click india job board !!');
        }

        $message = '
        Client: ' . $JobPosition->clientId . '
        ';
        $message .= 'State: ' . $JobPosition->positionState . '
        ';
        $message .= 'City: ' . $JobPosition->positionCity . '
        ';
        $message .= 'Position Name: ' . $JobPosition->positionName . '
        ';
        $message .= 'Close Date: ' . Carbon::parse(
            $JobPosition->closeDate
        )->format('d-m-Y') . ' ';
        $message .= 'Openings: ' . $JobPosition->openings . '
        ';
        $message .= 'Location: ' . $JobPosition->location . '
        ';
        $message .= 'Skill Set: ' . $JobPosition->skillSet . '
        ';
        $message .= 'Min. Year Exp: ' . $JobPosition->minYearExp . '
        ';
        $message .= 'Max. Year Exp: ' . $JobPosition->maxYearExp . '
        ';
        $message .= 'Min. Salary: ' . $JobPosition->minSalary . '
        ';
        $message .= 'Max. Salary: ' . $JobPosition->maxSalary . '
        ';
        $message .= 'Job Type: ' . $JobPosition->jobType . '
        ';
        $message .= 'Industry: ' . $JobPosition->industry . '
        ';
        $message .= 'Level: ' . $JobPosition->level . '
        ';
        $message .= 'Gender Required: ' . $JobPosition->gender . '
        ';
        $message .= 'Job Description: ' . $JobPosition->job_description . '
        ';
        $message .= 'Education Qualification: ' . $JobPosition->eduQualification . '
        ';

        $SocialCrendential = SocialCrendential::where('social_plateform_name', 'linkedin')->first();

        try {
            $client = new Client(['base_uri' => 'https://api.linkedin.com']);
            $response = $client->request('GET', '/v2/me', [
                'headers' => [
                    "Authorization" => "Bearer " . $SocialCrendential->access_token,
                ],
            ]);
            $data = json_decode($response->getBody()->getContents(), true);

            $linkedin_profile_id = $data['id']; // store this id somewhere


            $commonController = new CommonController();
            $commonController->sendLinkedInPost($message, $SocialCrendential->access_token);

            session()->put('linkedin_profile_id', $linkedin_profile_id);

            return redirect()->back()->with('success', 'LinkedIn message has been posted successfully !!');
        } catch (Exception $e) {
            // return redirect('social-group')->with('error', 'LinkedIn message can not be posted !!');
            echo $e->getMessage();
        }

        return redirect()->back()->with('success', 'Job position has been posted to linkedin successfully !!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function edit(JobPosition $jobPosition)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobPosition $jobPosition)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobPosition $jobPosition)
    {
        //
    }
}
