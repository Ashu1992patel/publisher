<?php

namespace App\Http\Controllers;

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

            if ($response->getStatusCode() !== 201) {
                echo 'Error: ' . $response->getLastBody()->errors[0]->message;
            }

            dump('Post is shared on LinkedIn successfully');
        } catch (Exception $e) {
            // echo $e->getMessage() . ' for link ' . $link;
            echo $e->getMessage();
        }
    }

    public function sendToClickIndia($job_position_id, $job_category_id, $job_education_qualification)
    {
        dd($_REQUEST);
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
                    'job_id' => $job_position_id,
                    'job_title' => request('positionName'),
                    'job_description' => request('job_description'),
                    'job_category' => 423,
                    'job_city' => request('positionCity'),
                    // 'job_location' => $position->positionState,
                    'job_location' => request('location'),
                    'job_pref_loc' => request('location'),
                    'qualification' => $job_education_qualification,
                    'experience' => request('minYearExp') . '-' . request('maxYearExp'),
                    'job_type' => request('jobType'),
                    'payroll_type' => request('payroll_type'),
                    'salary' => 650000,
                    // 'salary' => $request->minSalary . '-' . $request->maxSalary,
                    'salary_type' => request('salary_type'),
                    'designation' => request('designation'),
                    'working_days' => request('working_days'),
                    'gender' => request('gender'),
                    'hiring_process' => request('hiring_process'),
                    'vacancy' => request('openings'),
                    'skills' => request('skillSet'),
                    'languages' => request('languages'),
                    'listing_url' => request('listing_url'),
                    'company' => request('company'),
                    // 'company_logo' => $company_logo_path,
                    'company_website' => request('company_website'),
                    'company_profile' => request('company_profile'),
                    'other' => request('other'),
                ],
            ]);

            if ($response->getBody()) {
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
