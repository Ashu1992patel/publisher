<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobToClickIndia;
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
                    $job_to_click_indias = new JobToClickIndia();
                    $job_to_click_indias->job_id = $job->id;
                    $job_to_click_indias->save();
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

    public function sendToMonster($job_position_id)
    {
        // dd($_REQUEST);
        $job = Job::find($job_position_id);
        // dd($job);
        $client = new Client();
        $xml = '<?xml version="1.0" encoding="UTF-8" ?>
        <JobPositionPostings>
        <JobFeedVersion version="4"/>
        <CompanyReference CorpId="1234">
        <Company>Monster Services India</Company>
        <Username>loginftp01</Username>
        <Password>P455w0rd</Password>
         </CompanyReference>
        
        <Jobs>
        <Job JobRefId="16067"   JobAction="addOrUpdate"    PostingType="WalkinJP" >
        <JobInformation>
        <Channel monsterId="X"/>
        <JobTitle><![CDATA[Project Manager (IT)]]></JobTitle>
        
        <WalkinDetails NumberOfOpenings="1">
        <VenueAddress HideVenueDetails="No"><![CDATA[1654 , A Block , 6th Street, Knowledge Tower, Sector 10, Pin 24xx12]]></VenueAddress>
        <VenueCity id="1">XXXXX</VenueCity>
        <Date From="01/06/2013" To="02/06/2013" />
        <Timing From="01:00 PM" To="02:30 PM" />
         </WalkinDetails>
         
         <ContractDetails>
        <EarlyJoiningDate>01/06/2013</EarlyJoiningDate>
        <Tenure>Upto 6 month</Tenure>
        <BilingRate>Per Year</BilingRate>
        </ContractDetails>
        
        <Locations>
        <Location>1111</Location>
        <Location>2222</Location>
        </Locations>
        
        <Industries>
        <Industry>32</Industry>
        <Industry>30</Industry>
        </Industries>
        
        <Categories>
        <Category>22</Category>
        <Category>15</Category>
        </Categories>
        
        <Roles>
        <Role>738</Role>
        <Role>735</Role>
        <Role>89</Role>
        </Roles>
        
        <WorkExperience>
        <MinimumYear>6</MinimumYear>
        <MaximumYear>10</MaximumYear>
        </WorkExperience>
        
        <KeySkills><![CDATA[Java Knowledge on Architect Level, Project Management / Planning, Project Planning, Project Execution, Project Monitoring, Project Scheduling]]></KeySkills>
        
        <JobSummary><![CDATA[Will be responsible for managing and successfully completing IT system integration projects.]]></JobSummary>
        <JobDescription><![CDATA[<p>Definition, documentation and successful completion of projects directly.<br> Single point of contact for customer.<br> Agreeing to escalation paths and to manage expectations for all stakeholders.<br> Maintaining effective financial & project progress forecasting and reports.<br> Tracking of deadlines and costs, monitoring of progress and measurement of successful<br> accomplishment of the defined objectives and, if required, coordinated modification of the<br> objectives and planning<br> - Risk management<br> - Regular reporting, presentation of the project status<br> - Final analysis of the project<br> - Assure the quality of the deployed solutions and final acceptance<br></p>]]></JobDescription>
        
        <Education>
        <Level>1111</Level>
        <Level>2222</Level>
        <Stream>333</Stream>
        <Stream>444</Stream>
        </Education>
        
        <Salary>
        <Currency monsterId="2">USD</Currency>
        <MinimumSalary>200000</MinimumSalary>
        <MaximumSalary>350000</MaximumSalary>
        </Salary>
        
        <JobType>fulltime</JobType>
        <AboutCompany>About the company.. About the company..</AboutCompany>
        
        </JobInformation>
        <Contact hideCompanyName="false" showContactDetails="false">
        <Name>HR Name</Name>
        <Phone>889800000</Phone>
        <Email>jobs@domain.com</Email>
        </Contact>
        <ApplyOnlineURL>http://www.your-domain.com/sample.html?feild1=value1</ApplyOnlineURL>
        
        </Job>
        </Jobs>
        </JobPositionPostings>
        ';

        $create = $client->request('POST', 'http://127.0.0.1:5111/admin/hotel', [
            'headers' => [
                'Content-Type' => 'text/xml; charset=UTF8',
            ],
            'body' => $xml
        ]);

        echo $create->getStatusCode();
        echo $create->getHeader('content-type');
        echo $create->getBody();
        $response = $client->send($create);

        $xml_string = preg_replace('/(<\?xml[^?]+?)utf-16/i', '$1utf-8', $create->getBody());
        $xml_string = $create->getBody();
        //dd($xml_string);
        $hotels = simplexml_load_string($xml_string);

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
                    $job_to_click_indias = new JobToClickIndia();
                    $job_to_click_indias->job_id = $job->id;
                    $job_to_click_indias->save();
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
