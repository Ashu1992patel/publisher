<?php

namespace App\Http\Controllers;

use App\ClickIndiaCity;
use App\ClickIndiaJobCategory;
use App\Company;
use App\Job;
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
        // return view('backend.jobs.job_post_gull');
        $clickIndiaCity = ClickIndiaCity::get();
        $clickIndiaJobCategory = ClickIndiaJobCategory::get();
        $companies = Company::get();
        return view('backend.jobs.job_post', compact('clickIndiaCity', 'clickIndiaJobCategory', 'companies'));
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
        // $eduQualification = '';
        // foreach ($request->eduQualification as $key => $value) {

        //     if (++$key == $request->eduQualification)
        //         $eduQualification .= $value;
        //     else
        //         $eduQualification .= $value . ', ';
        // }

        // dd($_REQUEST);

        // dd(json_encode(request('click_india_working_days')));

        $commonController = new CommonController();

        $job = new Job();
        $job->job_title = request('job_title');
        $job->designation = request('designation');
        $job->expire_on = Carbon::parse(request('expire_on'))->format('Y-m-d');
        // $job->expire_on = Carbon::parse('2021-01-31')->format('Y-m-d');
        $job->job_type = request('job_type');
        $job->vacancies = request('vacancies');
        $job->salary_type = request('salary_type');
        $job->minimum_salary = request('minimum_salary');
        $job->maximum_salary = request('maximum_salary');
        $job->job_description = request('job_description');
        $job->company_id = request('company_id');
        $job->company_url = request('company_url');
        $job->company_location = request('company_location');
        $job->apply_button_url = request('apply_button_url');
        $job->other = request('other');
        $job->skills = request('skills');
        $job->company_description = request('company_description');
        $job->click_india_job_category_id = request('click_india_job_category_id');
        $job->click_india_city_id = request('click_india_city_id');
        $job->click_india_minimum_qualification = request('click_india_minimum_qualification');
        $job->click_india_minimum_experience = request('click_india_minimum_experience');
        $job->click_india_working_days = json_encode(request('click_india_working_days'));
        $job->click_india_required_candidate = request('click_india_required_candidate');
        $job->click_india_hiring_process = request('click_india_hiring_process');
        $job->is_active = request('is_active');
        $job->save();


        if (!is_null(request('clickindia'))) {
            // dd($job->click_india_minimum_qualification);
            $click_india_job_status = $commonController->sendToClickIndia($job->id);

            // dd('CI Status: ' . $click_india_job_status);
        }
        // dd(!is_null(request('linkedin')));

        if (!is_null(request('linkedin'))) {
            $message = 'Company Name: ' . $job->company->name . 'City: ' . $job->click_india_city->city_name . 'Position Name: ' . $job->designation . 'Job Expire Date: ' . $job->expire_on . 'openings: ' . $job->vacancies . 'Company Location: ' . $job->company_location . 'Required Skills: ' . $job->skills . 'Job Description: ' . $job->job_description . 'Min Experience: ' . $job->click_india_minimum_experience . 'Qualification: ' . $job->click_india_minimum_qualification . 'Min Salary: ' . $job->minimum_salary . 'Max Salary: ' . $job->maximum_salary . 'Job Type: ' . $job->job_type;

            // dd($message);

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

                $commonController->sendLinkedInPost($message, $SocialCrendential->access_token);

                session()->put('linkedin_profile_id', $linkedin_profile_id);

                dd(session('linkedin_profile_id'));
                return redirect()->back()->with('success', 'LinkedIn message has been posted successfully !!');
            } catch (Exception $e) {
                // return redirect('social-group')->with('error', 'LinkedIn message can not be posted !!');
                echo $e->getMessage();
            }
        }
        dd('AP');

        return redirect()->back()->with('success', 'Job position has been saved & posted to linkedin successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function show(JobPosition $jobPosition, $id)
    {
        // $JobPosition = JobPosition::find($id);
        // $position = JobPosition::find($id);
        $job = Job::find($id);

        $commonController  = new CommonController();
        $click_india_job_status = $commonController->sendToClickIndia($job->id);

        $message = '
        Company Name: ' . $job->company->name . '
        City: ' . $job->click_india_city->city_name . '
        Position Name: ' . $job->designation . '
        Job Expire Date: ' . $job->expire_on . '
        openings: ' . $job->vacancies . '
        Company Location: ' . $job->company_location . '
        Required Skills: ' . $job->skills . '
        Job Description: ' . $job->job_description . '
        Min Experience: ' . $job->click_india_minimum_experience . '
        Max Salary: ' . $job->maximum_salary . '
        Job Type: ' . $job->job_type;

        // $message = '
        // Client: ' . $JobPosition->clientId . '
        // ';
        // $message .= 'State: ' . $JobPosition->positionState . '
        // ';
        // $message .= 'City: ' . $JobPosition->positionCity . '
        // ';
        // $message .= 'Position Name: ' . $JobPosition->positionName . '
        // ';
        // $message .= 'Close Date: ' . Carbon::parse(
        //     $JobPosition->closeDate
        // )->format('d-m-Y') . ' ';
        // $message .= 'Openings: ' . $JobPosition->openings . '
        // ';
        // $message .= 'Location: ' . $JobPosition->location . '
        // ';
        // $message .= 'Skill Set: ' . $JobPosition->skillSet . '
        // ';
        // $message .= 'Min. Year Exp: ' . $JobPosition->minYearExp . '
        // ';
        // $message .= 'Max. Year Exp: ' . $JobPosition->maxYearExp . '
        // ';
        // $message .= 'Min. Salary: ' . $JobPosition->minSalary . '
        // ';
        // $message .= 'Max. Salary: ' . $JobPosition->maxSalary . '
        // ';
        // $message .= 'Job Type: ' . $JobPosition->jobType . '
        // ';
        // $message .= 'Industry: ' . $JobPosition->industry . '
        // ';
        // $message .= 'Level: ' . $JobPosition->level . '
        // ';
        // $message .= 'Gender Required: ' . $JobPosition->gender . '
        // ';
        // $message .= 'Job Description: ' . $JobPosition->job_description . '
        // ';
        // $message .= 'Education Qualification: ' . $JobPosition->eduQualification . '
        // ';

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
