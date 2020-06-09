<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobToClickIndia;
use App\MonsterPostedJob;
use App\SocialCrendential;
use Carbon\Carbon;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function storeJobs()
    {
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
        $job->fix_salary = request('fix_salary');
        $job->job_description = request('job_description');
        $job->company_id = request('company_id');
        $job->company_url = request('company_url');
        $job->company_location = request('company_location');
        $job->apply_button_url = request('apply_button_url');
        $job->other = request('other');
        $job->skills = request('skills');
        $job->company_description = request('company_description');

        $job->monster_minimum_experience = request('minimum_experience');
        $job->monster_maximum_experience = request('maximum_experience');
        $job->monster_show_company_name = request('show_company_name');
        $job->monster_show_contact_details = request('show_contact_details');
        $job->contact_person_name = request('contact_person_name');
        $job->person_contact = request('person_contact');
        $job->person_email = request('person_email');

        $job->click_india_job_category_id = request('click_india_job_category');
        $job->click_india_city_id = request('click_india_city_id');
        $job->click_india_city_name = request('click_india_city_name');
        $job->click_india_minimum_qualification = request('click_india_minimum_qualification');
        $job->click_india_minimum_experience = request('click_india_minimum_experience');
        $job->click_india_working_days = json_encode(request('click_india_working_days'));
        $job->click_india_required_candidate = request('click_india_required_candidate');
        $job->click_india_hiring_process = request('click_india_hiring_process');
        $job->is_active = request('is_active');
        $job->save();

        session()->put('job', $job);

        return $job;
    }

    public function sendLinkedInPost($message, $access_token)
    {
        // $link = 'YOUR_LINK_TO_SHARE';
        // $link = LinkedIn_REDIRECT_URI;
        if (session()->has('job')) {
            $link = session('job')->apply_button_url;
            $access_token = $access_token;
            $linkedin_id = session('linkedin_profile_id');
            $body = new \stdClass();
            $body->content = new \stdClass();
            $body->content->contentEntities[0] = new \stdClass();
            $body->text = new \stdClass();
            $body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
            $body->content->contentEntities[0]->entityLocation = $link;
            // $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "THUMBNAIL_URL_TO_POST";
            $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "https://media-exp1.licdn.com/dms/image/C5103AQF1Hi-J3wfHQA/profile-displayphoto-shrink_100_100/0?e=1594857600&v=beta&t=NrrVRvit5hTxm5QpiPg4q_JBU0PXsYdn1JPT5dVCfxI";
            $body->content->title = session('job')->job_title;
            $body->owner = 'urn:li:person:' . $linkedin_id;
            $body->text->text = $message;   //any message to be posted
            $body_json = json_encode($body, true);
        } else {
            $link = 'http://white-force.com';
            $access_token = $access_token;
            $linkedin_id = session('linkedin_profile_id');
            $body = new \stdClass();
            $body->content = new \stdClass();
            $body->content->contentEntities[0] = new \stdClass();
            $body->text = new \stdClass();
            $body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
            $body->content->contentEntities[0]->entityLocation = $link;
            // $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "THUMBNAIL_URL_TO_POST";
            $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "https://media-exp1.licdn.com/dms/image/C5103AQF1Hi-J3wfHQA/profile-displayphoto-shrink_100_100/0?e=1594857600&v=beta&t=NrrVRvit5hTxm5QpiPg4q_JBU0PXsYdn1JPT5dVCfxI";
            $body->content->title = 'White-Force';
            $body->owner = 'urn:li:person:' . $linkedin_id;
            $body->text->text = $message;   //any message to be posted
            $body_json = json_encode($body, true);
        }

        try {
            $client = new Client(['base_uri' => 'https://api.linkedin.com']);

            $response = $client->request('POST', '/v2/shares', [
                'headers' => [
                    "Authorization" => "Bearer " . $access_token,
                    "Content-Type"  => "application/json",
                    "x-li-format"   => "json"
                ],
                'body' => $body_json,
            ]);
            // dd($response);

            if ($response->getStatusCode() !== 201) {
                echo 'Error: ' . $response->getLastBody()->errors[0]->message;
            }

            dump('Post is shared on LinkedIn successfully');
        } catch (Exception $e) {
            // echo $e->getMessage() . ' for link ' . $link;
            // dd($e);
            echo $e->getMessage();
        }
    }

    public function sendToClickIndia($job_position_id)
    {
        // dd($_REQUEST);
        $job = Job::find($job_position_id);
        // dd($job);
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
                    'job_id' => $job->id,
                    'job_title' => $job->job_title,
                    'designation' => $job->designation,
                    'job_roles' => $job->roles,
                    'expire_on' => $job->expire_on,
                    'job_type' => $job->job_type,
                    'vacancies' => $job->vacancies,
                    'salary_type' => $job->salary_type,
                    'minimum_salary' => $job->minimum_salary,
                    'maximum_salary' => $job->maximum_salary,
                    'fix_salary' => $job->fix_salary,
                    'job_description' => $job->job_description,
                    'company_name' => $job->company->name,
                    'company_url' => $job->company_url,
                    'company_location' => $job->company_location,
                    'apply_button_url' => $job->apply_button_url,
                    'company_description' => $job->company_description,
                    'job_category' => $job->click_india_job_category_id,
                    'job_city_id' => $job->click_india_city_id,
                    'job_city_name' => $job->click_india_city_name,
                    'minimum_qualification' => $job->click_india_minimum_qualification,
                    'minimum_experience' => $job->click_india_minimum_experience,
                    'minimum_qualification' => $job->click_india_minimum_qualification,
                    'click_india_working_days' => $job->click_india_working_days,
                    'required_candidate' => $job->click_india_required_candidate,
                    'hiring_process' => $job->click_india_hiring_process,
                    'skills' => $job->skills,
                    'other' => $job->other,
                ],
            ]);
            // 'job_city' => $job->click_india_city->city_name,

            // dd($response);


            if ($response->getBody()) {
                $job_to_click_indias = JobToClickIndia::where('job_id', $job->id)->first();
                if (!isset($job_to_click_indias)) {
                    // $job_to_click_indias = new JobToClickIndia();
                    $job_to_click_indias->job_id = $job->id;
                    $job_to_click_indias->response = $job_to_click_indias;
                    $job_to_click_indias->is_posted = 1;
                    $job_to_click_indias->save();
                    // update_count
                }

                dump('Job Has Been Posted to Click India');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
            // return back()->with('error', 'Job can not be posted to click india job board !!');
        }
    }

    public function sendToMonster($monster_posted_id)
    {
        // dd($_REQUEST);
        $monster_posted_job = MonsterPostedJob::find($monster_posted_id);
        $job = Job::find($monster_posted_job->job_id);

        // $category_role_id = "734"
        // $monster_education_level_id =  "8"

        // dd($job);



        $client = new Client();
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml += '<JobPositionPostings xmlns="http://monsterindia.com/schema/Monster/JobPost">';
        $xml += '<JobFeedVersion version="4" />';
        $xml += '<CompanyReference CorpId="428003">';
        $xml += '<Company>Monster Services India</Company>';
        $xml += '<Username>xftwhite032inxftp</Username>';
        $xml += '<Password>xftrthm9c</Password>';
        $xml += '</CompanyReference>';
        $xml += '<Jobs>';
        $xml += '<Job Language="EN" JobRefId="' . isset($monster_posted_job->job_id) ? $monster_posted_job->job_id : '' . '" Moderate="1" JobAction="addOrUpdate" Country="IN">';
        // Add / Update / Delete
        // JobAction="addOrUpdate"
        // $xml += '<JobAction>Add</JobAction>';
        // Walkin / Contract / Full Time
        $xml += '<PostingType>' . isset($job->job_type) ? $job->job_type : 'Full Time' . '</PostingType>';
        $xml += '<JobInformation>';
        $xml += '<JobTitle>';
        $xml += '<![CDATA[' . isset($job->job_title) ? $job->job_title : '' . ']]>';
        $xml += '</JobTitle>';

        // <!-- If contract -->
        $xml += '<ContractDetails>';
        $xml += '<EarlyJoiningDate>' . Carbon::parse($job->created_at)->format('d/m/Y') . '</EarlyJoiningDate>';
        // $xml += '<Tenure>Upto 12 month</Tenure>';
        $xml += '<BilingRate>' . isset($job->salary_type) ? $job->salary_type : '' . '</BilingRate>';
        $xml += '</ContractDetails>';

        // <!-- If walkin -->
        // $xml += '<WalkinDetails>';
        // $xml += '<NumberOfOpenings>' . $job->vacancies . '</NumberOfOpenings>';
        // $xml += '<HideVenueDetails>No</HideVenueDetails>';
        // $xml += '<VenueAddress>';
        // $xml += '<![CDATA[' . $job->company_location . ']]>';
        // $xml += '</VenueAddress>';
        // $xml += '<VenueCity id="' . $monster_posted_job->monster_location_id . '">' . $monster_posted_job->city->location . '</VenueCity>';
        // $xml += '<DateFrom>01/06/2020</DateFrom>';
        // $xml += '<DateTo>05/06/2020</DateTo>';
        // $xml += '<TimeFrom>10:00 AM</TimeFrom>';
        // $xml += '<TimeFrom>02:30 PM</TimeFrom>';
        // $xml += '</WalkinDetails>';

        $xml += '<Locations>';
        $xml += '<Location>' . isset($monster_posted_job->city->location) ? $monster_posted_job->city->location : '' . '</Location>';
        // $xml += '<Location>Bhopal</Location>';
        $xml += '</Locations>';
        $xml += '<Industries>';
        $xml += '<Industry>' . isset($monster_posted_job->industry_id) ? $monster_posted_job->industry_id : '' . '</Industry>';
        // <!--32 for IT-Software / Software Services -->
        $xml += '</Industries>';
        $xml += '<Categories>';
        $xml += '<Category>' . isset($monster_posted_job->category_function_id) ? $monster_posted_job->category_function_id : '' . '</Category>';
        // <!-- 734 for Software Engineer/ Programmer -->
        $xml += '</Categories>';
        $xml += '<Roles>';
        $xml += '<Role>' . isset($monster_posted_job->category_role_id) ? $monster_posted_job->category_role_id : '' . '</Role>';
        // <!-- Team Lead-->
        // $xml += '<Role>735</Role>';
        // <!-- Scrum Master-->
        $xml += '</Roles>';
        $xml += '<WorkExperience>';
        $xml += '<MinimumYear>' . isset($job->minimum_experience) ? $job->minimum_experience : '0' . '</MinimumYear>';
        $xml += '<MaximumYear>' . isset($job->maximum_experience) ? $job->maximum_experience : '0' . '</MaximumYear>';
        $xml += '</WorkExperience>';
        $xml += '<KeySkills>';
        $xml += '<![CDATA[' . isset($job->skills) ? $job->skills : '' . ']]>';
        $xml += '</KeySkills>';
        $xml += '<JobSummary>';
        $xml += '<![CDATA[' . isset($job->job_description) ? $job->job_description : '' . ']]>';
        $xml += '</JobSummary>';
        $xml += '<JobDescription>';
        $xml += '<![CDATA[<p>' . isset($job->job_description) ? $job->job_description : '' . '</p>]]>';
        $xml += '</JobDescription>';
        $xml += '<Education>';
        $xml += '<Level>' . isset($monster_posted_job->monster_education_level_id) ? $monster_posted_job->monster_education_level_id : '' . '</Level>';
        $xml += '<Stream>' . isset($monster_posted_job->monster_education_stream_id) ? $monster_posted_job->monster_education_stream_id : '' . '</Stream>';
        $xml += '</Education>';
        $xml += '<Salary>';
        $xml += '<Currency>Rupee</Currency>';
        $xml += '<MinimumSalary>' . isset($job->minimum_salary) ? $job->minimum_salary : '' . '</MinimumSalary>';
        $xml += '<MaximumSalary>' . isset($job->maximum_salary) ? $job->maximum_salary : '' . '</MaximumSalary>';
        $xml += '</Salary>';
        $xml += '<AboutCompany>' . isset($job->company_description) ? $job->company_description : '' . '</AboutCompany>';
        $xml += '</JobInformation>';

        $show_contact_details = $job->show_contact_details ? 'true' : 'false';
        $show_company_name = $job->show_company_name ? 'true' : 'false';

        $xml += '<Contact showContactDetails="' . $show_contact_details . '" hideCompanyName="' . $show_company_name . '">';
        $xml += '<Name>' . isset($job->contact_person_name) ? $job->contact_person_name : '' . '</Name>';
        $xml += '<Phone>' . isset($job->person_contact) ? $job->person_contact : '' . '</Phone>';
        $xml += '<Email>' . isset($job->person_email) ? $job->person_email : '' . '</Email>';
        $xml += '</Contact>';
        $xml += '<ApplyOnlineURL>' . isset($job->apply_button_url) ? $job->apply_button_url : '' . '</ApplyOnlineURL>';
        $xml += '</Job>';
        $xml += '</Jobs>';
        $xml += '</JobPositionPostings>>';

        $create = $client->request('POST', 'http://monsterindia.com/schema/Monster/JobPost', [
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF8',
            ],
            'body' => $xml
        ]);

        dump($create);
        echo $create->getStatusCode();
        echo $create->getHeader('content-type');
        echo $create->getBody();
        $response = $client->send($create);

        dump($response);

        $xml_string = preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $create->getBody());
        $xml_string = $create->getBody();
        //dd($xml_string);
        $hotels = simplexml_load_string($xml_string);
        dd($hotels);


        $monster_posted_job->is_sent = 1;
        $monster_posted_job->save();
    }

    public function sendToFacebookGroup($job_position_id, $message)
    {
        $social_crendential = SocialCrendential::where('social_plateform_name', 'facebook')->first();
        if (!is_null($social_crendential->access_token)) {
            $group_id = '539352470304280';

            // $message = 'Ashish Group API Test';
            $FBObject = new \Facebook\Facebook([
                'app_id' => '700413484027698',
                'app_secret' => 'c65e5e4208e17a1954132f9df5c49c22',
                'default_graph_version' => 'v2.10'
            ]);

            $handler = $FBObject->getRedirectLoginHelper();
            try {
                // Returns a `Facebook\FacebookResponse` object
                $response = $FBObject->post('/' . $group_id . '/feed', array('message' => $message,), $social_crendential->access_token);

                $graphNode = $response->getGraphNode();
                dump('Job Hasb Been Posted in Facebook Group Successfully !!');
                return 1;
            } catch (FacebookResponseException $e) {
                dump($e->getMessage());
                // echo 'Graph returned an error: ' . $e->getMessage();
                // exit;
            } catch (FacebookSDKException $e) {
                dump($e->getMessage());
                // echo 'Facebook SDK returned an error: ' . $e->getMessage();
                // exit;
            }
        } else {
            return 0;
        }
    }

    public function jobformat()
    {
        $file = file_get_contents('assets/indeed_job.xml');

        return view('backend.jobs.indeed_job', compact('file'));
    }
}
