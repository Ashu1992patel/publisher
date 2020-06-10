<?php

namespace App\Http\Controllers;

use App\ClickIndiaCity;
use App\ClickIndiaJobCategory;
use App\Company;
use App\Job;
use App\JobPosition;
use App\JobToClickIndia;
use App\MonsterEducationLevel;
use App\MonsterIndustryCategoryMapping;
use App\MonsterLocation;
use App\MonsterPostedJob;
use App\ShineCity;
use App\ShineDegreeLevel;
use App\ShineExperienceLookup;
use App\ShineFunctionalArea;
use App\ShineIndustry;
use App\ShineSalaryRange;
use App\SocialCrendential;
use Carbon\Carbon;
use DOMDocument;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
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
        $clickIndiaCity = ClickIndiaCity::cursor();
        $clickIndiaJobCategory = ClickIndiaJobCategory::cursor();
        $companies = Company::cursor();

        $monster_industrycategorymappings = MonsterIndustryCategoryMapping::cursor();
        $monster_locations = MonsterLocation::cursor();
        $monster_education_levels = MonsterEducationLevel::cursor();
        $collection = new Collection($monster_industrycategorymappings);

        // Get all unique items.
        $monster_industries = $collection->unique('industry_id');
        $monster_categoryfuntion = $collection->unique('category_function_id');
        // dd($monster_industrycategorymappings->count());

        $shine_cities_collection = new Collection(ShineCity::orderBy('city_grouping_desc')->cursor());
        $shine_cities_groups = $shine_cities_collection->unique('city_grouping_desc');
        $shine_industries = ShineIndustry::orderBy('industry_desc')->cursor();
        $shine_experience_lookups = ShineExperienceLookup::cursor();
        $shine_salary_ranges = ShineSalaryRange::cursor();

        $shine_degree_levels_collection = new Collection(ShineDegreeLevel::orderBy('study_field_grouping_id')->cursor());
        $study_field_groupings = $shine_degree_levels_collection->unique('study_field_grouping_id');
        $shine_functional_areas = ShineFunctionalArea::cursor();


        return view('backend.jobs.job_post', compact('clickIndiaCity', 'clickIndiaJobCategory', 'companies', 'monster_industries', 'monster_categoryfuntion', 'monster_locations', 'monster_education_levels', 'shine_cities_groups', 'shine_industries', 'shine_experience_lookups', 'shine_salary_ranges', 'study_field_groupings', 'shine_functional_areas'));
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


        // dd(json_encode(request('click_india_working_days')));
        $commonController = new CommonController();

        $job = $commonController->storeJobs();
        if (!$job->id) {
            return redirect()->back()->with('success', 'Oops!! something went wrong, please try again later !!');
        }


        if (!is_null(request('shine'))) {
        }


        if (!is_null(request('monster'))) {
            $monster_posted_jobs = new MonsterPostedJob();
            $monster_posted_jobs->job_id = $job->id;
            $monster_posted_jobs->industry_id = request('monster_industry_id');
            $monster_posted_jobs->category_function_id = request('category_function_id');
            $monster_posted_jobs->category_role_id = request('category_role_id');
            $monster_posted_jobs->monster_education_level_id = request('monster_education_level_id');
            $monster_posted_jobs->monster_education_stream_id = request('monster_education_stream_id');
            $monster_posted_jobs->monster_location_id = request('monster_location_id');
            $monster_posted_jobs->is_sent = 0;
            $monster_posted_jobs->expire_on = Carbon::parse(request('expire_on'))->format('Y-m-d');
            $monster_posted_jobs->save();

            dd($_REQUEST);
            $monster_job_status = $commonController->sendToMonster($job->id);
        }

        if (!is_null(request('clickindia'))) {
            $job_to_click_india = new JobToClickIndia();
            $job_to_click_india->job_id = $job->id;
            $job_to_click_india->is_posted = 0;
            $job_to_click_india->save();

            $click_india_job_status = $commonController->sendToClickIndia($job->id);
        }

        if (!is_null(request('linkedin'))) {
            if (!is_null($job->click_india_city_name)) {
                $message = '
                Company Name: ' . $job->company->name . '
                City: ' . $job->click_india_city_name . '
                Job Title: ' . $job->job_title . '
                Position Name: ' . $job->designation . '
                Skills Required: ' . $job->skills . '
                Job Expire Date: ' . $job->expire_on . '
                Openings: ' . $job->vacancies . '
                Company Location: ' . $job->company_location . '
                Required Skills: ' . $job->skills . '
                Job Description: ' . $job->job_description . '
                Min Experience: ' . $job->click_india_minimum_experience . '
                Fix Salary: ' . $job->fix_salary . '
                Min. Salary: ' . $job->minimum_salary . '
                Max. Salary: ' . $job->maximum_salary . '
                Job Type: ' . $job->job_type . '
                Apply Now: ' . $job->apply_button_url . '
                Company URL: ' . $job->company_url;
            } else {
                $message = '
                Company Name: ' . $job->company->name . '
                City: ' . $job->click_india_city->city_name . '
                Job Title: ' . $job->job_title . '
                Position Name: ' . $job->designation . '
                Skills Required: ' . $job->skills . '
                Job Expire Date: ' . $job->expire_on . '
                openings: ' . $job->vacancies . '
                Company Location: ' . $job->company_location . '
                Required Skills: ' . $job->skills . '
                Job Description: ' . $job->job_description . '
                Min Experience: ' . $job->click_india_minimum_experience . '
                Fix Salary: ' . $job->fix_salary . '
                Min. Salary: ' . $job->minimum_salary . '
                Max. Salary: ' . $job->maximum_salary . '
                Job Type: ' . $job->job_type . '
                Apply Now: ' . $job->apply_button_url . '
                Company URL: ' . $job->company_url;
            }

            // if (!is_null(request('click_india_city_name'))) {
            //     $message = 'Company Name: ' . $job->company->name . 'City: ' . $job->click_india_city_name . 'Position Name: ' . $job->designation . 'Job Expire Date: ' . $job->expire_on . 'openings: ' . $job->vacancies . 'Company Location: ' . $job->company_location . 'Required Skills: ' . $job->skills . 'Job Description: ' . $job->job_description . 'Min Experience: ' . $job->click_india_minimum_experience . 'Qualification: ' . $job->click_india_minimum_qualification . 'Min Salary: ' . $job->minimum_salary . 'Max Salary: ' . $job->maximum_salary . 'Job Type: ' . $job->job_type;
            // } else {
            //     $message = 'Company Name: ' . $job->company->name . 'City: ' . $job->click_india_city->city_name . 'Position Name: ' . $job->designation . 'Job Expire Date: ' . $job->expire_on . 'openings: ' . $job->vacancies . 'Company Location: ' . $job->company_location . 'Required Skills: ' . $job->skills . 'Job Description: ' . $job->job_description . 'Min Experience: ' . $job->click_india_minimum_experience . 'Qualification: ' . $job->click_india_minimum_qualification . 'Min Salary: ' . $job->minimum_salary . 'Max Salary: ' . $job->maximum_salary . 'Job Type: ' . $job->job_type;
            // }

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

                return redirect()->back()->with('success', 'LinkedIn message has been posted successfully !!');
            } catch (Exception $e) {
                // return redirect('social-group')->with('error', 'LinkedIn message can not be posted !!');
                echo $e->getMessage();
            }
        }

        return redirect()->back()->with('success', 'Job position has been saved & posted to linkedin successfully !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\JobPosition  $jobPosition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd($id);
        // $JobPosition = JobPosition::find($id);
        // $position = JobPosition::find($id);
        $job = Job::find($id);
        session()->put('job', $job);

        $commonController  = new CommonController();

        $xml = new DOMDocument();
        $xml_album = $xml->createElement("Album");
        $xml_track = $xml->createElement("Track");
        $xml_album->appendChild($xml_track);
        $xml->appendChild($xml_album);

        $xml->save("/tmp/test.xml");
        dd($xml);
        
        $monster_job_status = $commonController->sendToMonster($job->id);
        $click_india_job_status = $commonController->sendToClickIndia($job->id);

        if (!is_null($job->click_india_city_name)) {
            $message = '
            Company Name: ' . $job->company->name . '
            City: ' . $job->click_india_city_name . '
            Job Title: ' . $job->job_title . '
            Position Name: ' . $job->designation . '
            Skills Required: ' . $job->skills . '
            Job Expire Date: ' . $job->expire_on . '
            openings: ' . $job->vacancies . '
            Company Location: ' . $job->company_location . '
            Required Skills: ' . $job->skills . '
            Job Description: ' . $job->job_description . '
            Min Experience: ' . $job->click_india_minimum_experience . '
            Fix Salary: ' . $job->fix_salary . '
            Min. Salary: ' . $job->minimum_salary . '
            Max. Salary: ' . $job->maximum_salary . '
            Job Type: ' . $job->job_type . '
            Apply Now: ' . $job->apply_button_url . '
            Company URL: ' . $job->company_url;
        } else {
            $message = '
            Company Name: ' . $job->company->name . '
            City: ' . $job->click_india_city->city_name . '
            Job Title: ' . $job->job_title . '
            Position Name: ' . $job->designation . '
            Skills Required: ' . $job->skills . '
            Job Expire Date: ' . $job->expire_on . '
            openings: ' . $job->vacancies . '
            Company Location: ' . $job->company_location . '
            Required Skills: ' . $job->skills . '
            Job Description: ' . $job->job_description . '
            Min Experience: ' . $job->click_india_minimum_experience . '
            Fix Salary: ' . $job->fix_salary . '
            Min. Salary: ' . $job->minimum_salary . '
            Max. Salary: ' . $job->maximum_salary . '
            Job Type: ' . $job->job_type . '
            Apply Now: ' . $job->apply_button_url . '
            Company URL: ' . $job->company_url;
        }

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
    public function destroy(JobPosition $jobPosition, $id)
    {
        $job = Job::find($id);
        if ($job->delete()) {
            return redirect()->back()->with('success', 'Job has been deleted from the server');
        }
        return redirect()->back()->with('error', 'Something went wrong !!');
    }
}
