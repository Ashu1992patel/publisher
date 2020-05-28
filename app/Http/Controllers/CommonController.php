<?php

namespace App\Http\Controllers;

use App\Job;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class CommonController extends Controller
{
    public function sendLinkedInPost($message, $access_token)
    {
        // $link = 'YOUR_LINK_TO_SHARE';
        // $link = LinkedIn_REDIRECT_URI;
        $link = "http://white-force.com/";
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
        $body->content->title = 'White-Force Jobs';
        $body->owner = 'urn:li:person:' . $linkedin_id;
        $body->text->text = $message;   //any message to be posted
        $body_json = json_encode($body, true);


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
                    'job_description' => $job->job_description,
                    'company_name' => $job->company->name,
                    'company_url' => $job->company_url,
                    'company_location' => $job->company_location,
                    'apply_button_url' => $job->apply_button_url,
                    'company_description' => $job->company_description,
                    'job_category' => $job->click_india_job_category_id,
                    'job_city' => $job->click_india_city->city_name,
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
            if ($response->getBody()) {
                dump('Post sent to Click India');
                return 1;
            } else {
                return 0;
            }
        } catch (Exception $e) {
            return 0;
            // return back()->with('error', 'Job can not be posted to click india job board !!');
        }
    }
}
