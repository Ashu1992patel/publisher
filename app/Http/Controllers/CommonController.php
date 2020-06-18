<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobToClickIndia;
use App\MonsterPostedJob;
use App\Shine;
use App\SocialCrendential;
use Carbon\Carbon;
use Exception;
use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommonController extends Controller
{
    public function storeJobs()
    {
        // dd($_REQUEST);
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

        // $job->monster_minimum_experience = request('minimum_experience');
        // $job->monster_maximum_experience = request('maximum_experience');
        // $job->monster_show_company_name = request('show_company_name');
        // $job->monster_show_contact_details = request('show_contact_details');
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

            if ($response->getStatusCode() !== 201) {
                echo 'Error: ' . $response->getLastBody()->errors[0]->message;
            }

            dump('Post is shared on LinkedIn successfully');
        } catch (Exception $e) {
            // echo $e->getMessage() . ' for link ' . $link;
            echo $e->getMessage();
        }
    }

    public function sendToClickIndia($job_position_id)
    {
        $job = Job::find($job_position_id);
        $url = 'https://www.clickindia.com/cron/jobs_business_api.php';

        /* Init cURL resource */
        $ch = curl_init($url);

        /* Array Parameter Data */
        $data = [
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
        ];

        /* pass encoded JSON string to the POST fields */
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

        /* set the content type json */
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

        /* set return type json */
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        /* execute request */
        $responses_json = curl_exec($ch);

        // dd($result);

        /* close cURL resource */
        curl_close($ch);

        dd($responses_json);
        $responses = (json_decode($responses_json));

        try {
            $client = new Client();
            $url = "https://www.clickindia.com/cron/jobs_business_api.php";
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

            // dd($response);
            $clickindia_status = $response->getBody();
            // dd(file_get_contents('https://www.clickindia.com/cron/jobs_business_api.php'));
            // dd(file_get_contents('https://www.clickindia.com/cron/jobs_business_api.php'));

            if ($clickindia_status) {
                $job_to_click_indias = JobToClickIndia::where('job_id', $job->id)->first();
                if (!isset($job_to_click_indias)) {
                    $job_to_click_indias = new JobToClickIndia();
                    $job_to_click_indias->job_id = $job->id;
                    $job_to_click_indias->response = file_get_contents('https://www.clickindia.com/cron/jobs_business_api.php');
                    $job_to_click_indias->is_posted = 1;
                    $job_to_click_indias->save();
                } else {
                    $job_to_click_indias->response = trim(file_get_contents('https://www.clickindia.com/cron/jobs_business_api.php'));
                    $job_to_click_indias->is_posted = 1;
                    $job_to_click_indias->save();
                }
                dump('Job Has Been Posted to Click India');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
        }
    }
    public function sendToShine($job_position_id)
    {
        $job = Job::find($job_position_id);
        $shine = Shine::where('job_id', $job_position_id)->first();


        // $auth = base64_encode("reliancetest:Shine@123");
        // $context = stream_context_create([
        //     "http" => [
        //         "header" => "Authorization: Basic $auth"
        //     ]
        // ]);
        // $homepage = file_get_contents("https://sumosr.shine.com/api/v2/job/", false, $context);


        // $url = 'https://sumosr.shine.com/api/v2/job/';
        // $ch = curl_init($url);
        // $data = [
        //     'uniquerefnum' => $shine->job_id,
        //     'job_id' => $shine->job_id,
        //     'city_grouping_id' => $shine->city_grouping_id,
        //     'location' => $shine->city_id,
        //     'industry' => $shine->industry_id,
        //     'minexperience' => 0,
        //     'maxexperience' => 1,
        //     'salarymin' => $job->minimum_salary,
        //     'salarymax' => $job->maximum_salary,
        //     'hidesalaryfromcandidates' => false,
        //     'experience_lookup_id' => $shine->experience_lookup_id,
        //     'salary_id' => $shine->salary_id,
        //     'study_field_grouping_id' => $shine->study_field_grouping_id,
        //     'qualification_level_1' => $shine->study_id,
        //     'functional_area' => $shine->functional_area_id,
        //     'job_id' => $job->id,
        //     'jobtitle' => $job->job_title,
        //     'designation' => $job->designation,
        //     'publisheddate' => $job->expire_on,
        //     'expirydate' => $job->expire_on,
        //     'job_type' => $job->job_type,
        //     'vacancies' => $job->vacancies,
        //     'description' => $job->job_description,
        //     'recruiter_phone' => $job->person_contact,
        //     'hide_contact_details' => false,
        //     'isanonymouscompany' => false,
        // //     'company' => $job->company->name,
        // //     'company_description' => $job->company_description,
        // //     'externalapplyurl' => $job->apply_button_url,
        // //     'externalapply_check' => true,
        // //     'hiring_process' => $job->click_india_hiring_process,
        // //     'skills' => $job->skills,
        //     'other' => $job->other,
        // ];

        // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        //     'Content-Type:application/json',
        //     'App-Key: reliancetest',
        //     'App-Secret: Shine@123'
        // ));
        // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        // $result = curl_exec($ch);

        // curl_close($ch);
        // dd($result);

        try {
            $client = new Client();
            $url = "https://sumosr.shine.com/api/v2/job/";
            $response = $client->put($url, [
                'headers' => ['Content-type' => 'application/json'],
                'auth' => ['reliancetest', 'Shine@123'],
                'json' => [
                    'uniquerefnum' => $shine->job_id,
                    'job_id' => $shine->job_id,
                    'city_grouping_id' => $shine->city_grouping_id,
                    'location' => $shine->city_id,
                    'industry' => $shine->industry_id,
                    'minexperience' => 0,
                    'maxexperience' => 1,
                    'salarymin' => $job->minimum_salary,
                    'salarymax' => $job->maximum_salary,
                    'hidesalaryfromcandidates' => false,
                    'experience_lookup_id' => $shine->experience_lookup_id,
                    'salary_id' => $shine->salary_id,
                    'study_field_grouping_id' => $shine->study_field_grouping_id,
                    'qualification_level_1' => $shine->study_id,
                    'functional_area' => $shine->functional_area_id,
                    'job_id' => $job->id,
                    'jobtitle' => $job->job_title,
                    'designation' => $job->designation,
                    'publisheddate' => $job->expire_on,
                    'expirydate' => $job->expire_on,
                    'job_type' => $job->job_type,
                    'vacancies' => $job->vacancies,
                    'description' => $job->job_description,
                    'recruiter_phone' => $job->person_contact,
                    'hide_contact_details' => false,
                    'isanonymouscompany' => false,
                    'company' => $job->company->name,
                    'company_description' => $job->company_description,
                    'externalapplyurl' => $job->apply_button_url,
                    'externalapply_check' => true,
                    'hiring_process' => $job->click_india_hiring_process,
                    'skills' => $job->skills,
                    'other' => $job->other,
                ],
            ]);

            // dd($response);
            $shine_status_code = $response->getStatusCode();
            // "200"

            $shine_get_header = $response->getHeader('content-type')[0];
            // 'application/json; charset=utf8'

            $shine_body = $response->getBody();
            // $shine_status = $response->getBody();

            dd($shine_body);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function sendToMonster($job_id)
    {
        // dd($_REQUEST);
        $monster_posted_job = MonsterPostedJob::where('job_id', $job_id)->first();
        $job = Job::find($job_id);
        dump('Job ID: ' . $job->id);

        $job_type = isset($job->job_type) ? $job->job_type : 'Full Time';
        $job_title = isset($job->job_title) ? $job->job_title : '';
        $show_contact_details = $job->show_contact_details ? 'true' : 'false';
        $show_company_name = $job->show_company_name ? 'true' : 'false';
        $contact_person_name = isset($job->contact_person_name) ? $job->contact_person_name : '';
        $person_contact = isset($job->person_contact) ? $job->person_contact : '';
        $person_email = isset($job->person_email) ? $job->person_email : '';

        $xml = '<?xml version="1.0" encoding="UTF-8" ?>';
        $xml .= '<JobPositionPostings xmlns="http://monsterindia.com/schema/Monster/JobPost">';
        $xml .= '<JobFeedVersion version="4" />';
        $xml .= '<CompanyReference CorpId="428003">';
        $xml .= '<Company><![CDATA[White Force]]></Company>';
        $xml .= '<Username><![CDATA[xftwhite032inxftp]]></Username>';
        $xml .= '<Password><![CDATA[Wisdom34]]></Password>';
        $xml .= '</CompanyReference>';
        $xml .= '<Jobs>';
        $xml .= '<Job Language="EN" JobRefId="' . $monster_posted_job->job_id . '" Moderate="1" JobAction="addOrUpdate" Country="IN">';
        $xml .= '<JobType><![CDATA[' . $job_type . ']]></JobType>';
        $xml .= '<JobInformation>';
        $xml .= '<JobTitle><![CDATA[' . $job_title . ']]>';
        $xml .= '</JobTitle>';
        $xml .= '<ContractDetails>';
        $xml .= '<EarlyJoiningDate><![CDATA[' . Carbon::parse($job->created_at)->format('d/m/Y') . ']]></EarlyJoiningDate>';
        $xml .= '<BilingRate><![CDATA[' . $job->salary_type . ']]></BilingRate>';
        $xml .= '</ContractDetails>';
        $xml .= '<Locations>';
        $xml .= '<Location><![CDATA[' . $monster_posted_job->city->location . ']]></Location>';
        $xml .= '</Locations>';
        $xml .= '<Industries>';
        $xml .= '<Industry><![CDATA[' . $monster_posted_job->industry_id . ']]></Industry>';
        $xml .= '</Industries>';
        $xml .= '<Categories>';
        $xml .= '<Category><![CDATA[' . $monster_posted_job->category_function_id . ']]></Category>';
        $xml .= '</Categories>';
        $xml .= '<Roles>';
        $xml .= '<Role><![CDATA[' . $monster_posted_job->category_role_id . ']]></Role>';
        $xml .= '</Roles>';
        $xml .= '<WorkExperience>';
        $xml .= '<MinimumYear><![CDATA[' . $job->minimum_experience . ']]></MinimumYear>';
        $xml .= '<MaximumYear><![CDATA[' . $job->maximum_experience . ']]></MaximumYear>';
        $xml .= '</WorkExperience>';
        $xml .= '<KeySkills><![CDATA[' . $job->skills . ']]>';
        $xml .= '</KeySkills>';
        $xml .= '<JobSummary><![CDATA[<p>' . $job->job_description . '</p>]]>';
        $xml .= '</JobSummary>';
        $xml .= '<JobDescription>';
        $xml .= '<![CDATA[<p>' . $job->job_description . '</p>]]>';
        $xml .= '</JobDescription>';
        $xml .= '<Education>';
        $xml .= '<Level><![CDATA[' . $monster_posted_job->monster_education_level_id . ']]></Level>';
        $xml .= '<Stream><![CDATA[' . $monster_posted_job->monster_education_stream_id . ']]></Stream>';
        $xml .= '</Education>';
        $xml .= '<Salary>';
        $xml .= '<Currency monsterId="1"><![CDATA[INR]]></Currency>';
        $xml .= '<MinimumSalary><![CDATA[' . $job->minimum_salary . ']]></MinimumSalary>';
        $xml .= '<MaximumSalary><![CDATA[' . $job->maximum_salary . ']]></MaximumSalary>';
        $xml .= '</Salary>';
        $xml .= '<AboutCompany><![CDATA[' . $job->company_description . ']]>';
        $xml .= '</AboutCompany>';
        $xml .= '</JobInformation>';
        $xml .= '<Contact showContactDetails="' . $show_contact_details . '" hideCompanyName="true">';
        $xml .= '<Name><![CDATA[' . $contact_person_name . ']]></Name>';
        $xml .= '<Phone><![CDATA[' . $person_contact . ']]></Phone>';
        $xml .= '<Email><![CDATA[' . $person_email . ']]></Email>';
        $xml .= '</Contact>';
        $xml .= '<ApplyOnlineURL><![CDATA[' . $job->apply_button_url . ']]></ApplyOnlineURL>';
        $xml .= '</Job>';
        $xml .= '</Jobs>';
        $xml .= '</JobPositionPostings>';

        try {
            $monster_job_file_name = "monster_jobs/monster_jobs_$job_id.xml";
            $monster_job_server_file_name = "monster_jobs_$job_id.xml";
            $myfile = fopen($monster_job_file_name, "w") or die("Unable to open file!");
            fwrite($myfile, $xml);
            fclose($myfile);

            $monster_posted_job->filepath = $monster_job_file_name;
            $monster_posted_job->save();

            $status = Storage::disk('ftp')->put($monster_job_server_file_name, fopen($monster_job_file_name, 'r+'));

            $monster_posted_job->is_sent = 1;
            $monster_posted_job->filepath = $monster_job_file_name;
            $monster_posted_job->save();

            dump('Monster Job Has Been Posted !!');
            return $status;
        } catch (\Throwable $th) {
            dump('Monster Job is not posted, Exception:  ' . $th);
        }
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
