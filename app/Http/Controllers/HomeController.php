<?php

namespace App\Http\Controllers;

use App\Job;
use App\JobPosition;
use App\JobToClickIndia;
use App\SocialCrendential;
use Exception;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite as FacadesSocialite;
use Socialite;
use Facebook;
use GuzzleHttp\Client;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jobPositions = JobPosition::orderBy('id', 'desc')->cursor();
        $jobs = Job::orderBy('id', 'desc')->cursor();
        return view('backend.dashboard', compact('jobPositions', 'jobs'));
        return view('home');
    }

    public function clickindiaresponse()
    {
        // return (file_get_contents('https://www.clickindia.com/cron/ad_response_json.php'));

        try {
            $responses_json = file_get_contents('https://www.clickindia.com/cron/ad_response_json.php');

            $responses = (json_decode($responses_json));

            foreach ($responses as $key => $value) {
                // dd($value);
                if (is_numeric($value->job_id)) {
                    $job_to_clickindia = JobToClickIndia::where('job_id', $value->job_id)->first();
                    // dd($job_to_clickindia);
                    if (isset($job_to_clickindia)) {
                        $job_to_clickindia->views = $value->ad_views;
                        $job_to_clickindia->response = $value->ad_id;
                        $job_to_clickindia->save();
                    }
                }
            }
            return redirect()->back()->with('Synchronization successfull !!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('Synchronization failed, Please Try again later !!');
        }
    }



    public function sendLinkedInPost()
    {
        // $link = 'YOUR_LINK_TO_SHARE';
        $link = LinkedIn_REDIRECT_URI;
        $access_token = session('access_token');
        $linkedin_id = session('linkedin_profile_id');
        $body = new \stdClass();
        $body->content = new \stdClass();
        $body->content->contentEntities[0] = new \stdClass();
        $body->text = new \stdClass();
        $body->content->contentEntities[0]->thumbnails[0] = new \stdClass();
        $body->content->contentEntities[0]->entityLocation = $link;
        $body->content->contentEntities[0]->thumbnails[0]->resolvedUrl = "THUMBNAIL_URL_TO_POST";
        $body->content->title = 'YOUR_POST_TITLE';
        $body->owner = 'urn:li:person:' . $linkedin_id;
        $body->text->text = 'Server Test API Successfull AP ';
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

            echo 'Post is shared on LinkedIn successfully';
        } catch (Exception $e) {
            echo $e->getMessage() . ' for link ' . $link;
        }
    }

    public function redirect($service)
    {
        // dd($service);
        if ($service == 'facebook') {
            return FacadesSocialite::driver($service)->redirect();
            $FBObject = new \Facebook\Facebook([
                'app_id' => '700413484027698',
                'app_secret' => 'c65e5e4208e17a1954132f9df5c49c22',
                'default_graph_version' => 'v2.10'
            ]);

            $handler = $FBObject->getRedirectLoginHelper();

            $redirectTo = "http://localhost/Facebook-Login/callback.php";
            $data = ['email'];

            $fullURL = $handler->getLoginUrl($redirectTo, $data);

            header("Location: " . $fullURL);
            exit();
        }
        // return FacadesSocialite::driver('facebook')->redirect();
    }

    public function callback($service)
    {
        if ($service == 'linkedin') {
            try {
                $client = new Client(['base_uri' => 'https://www.linkedin.com']);
                $response = $client->request('POST', '/oauth/v2/accessToken', [
                    'form_params' => [
                        "grant_type" => "authorization_code",
                        "code" => $_GET['code'],
                        "redirect_uri" => LinkedIn_REDIRECT_URI,
                        "client_id" => LinkedIn_CLIENT_ID,
                        "client_secret" => LinkedIn_CLIENT_SECRET,
                    ],
                ]);

                $data = json_decode($response->getBody()->getContents(), true);

                // dd($data);
                $SocialCrendential = SocialCrendential::where('social_plateform_name', 'linkedin')->first();
                if ($SocialCrendential) {
                    $SocialCrendential->access_token = $data['access_token']; // store this token somewhere
                    $SocialCrendential->expires_in = $data['expires_in']; // store this token somewhere
                    $SocialCrendential->save();
                } else {

                    $SocialCrendential = new SocialCrendential();
                    $SocialCrendential->social_plateform_name = 'linkedin';
                    $SocialCrendential->access_token = $data['access_token']; // store this token somewhere
                    $SocialCrendential->expires_in = $data['expires_in']; // store this token somewhere
                    $SocialCrendential->save();
                }


                // $access_token = $data['access_token']; // store this token somewhere
                // $expires_in = $data['expires_in']; // store this token somewhere


                // session()->put('access_token', $access_token);
                // session()->put('expires_in', $expires_in);

                // dd("Access Token is stored in session, Access token is: " . session('access_token'));
                echo "<script type='text/javascript'>window.close();</script>";

                //Sending code will come here
                //Starts, this code has to be placed somewhere else
                // try {
                //     $client = new Client(['base_uri' => 'https://api.linkedin.com']);
                //     $response = $client->request('GET', '/v2/me', [
                //         'headers' => [
                //             "Authorization" => "Bearer " . session('access_token'),
                //         ],
                //     ]);

                //     $data = json_decode($response->getBody()->getContents(), true);
                //     $linkedin_profile_id = $data['id']; // store this id somewhere

                //     $this->sendLinkedInPost('Ashish Patel API Test....');
                //     session()->put('linkedin_profile_id', $linkedin_profile_id);

                //     return redirect('social-group')->with('success', 'LinkedIn message has been posted successfully !!');
                // } catch (Exception $e) {
                //     return redirect('social-group')->with('LinkedIn message can not be posted !!');
                //     echo $e->getMessage();
                // }
                //Ends, this code has to be placed somewhere else

            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }
        if ($service == 'facebook') {

            // dd($_REQUEST);
            // if (!session_id()) {
            //     session_start();
            // }
            try {
                $FBObject = new \Facebook\Facebook([
                    'app_id' => '700413484027698',
                    'app_secret' => 'c65e5e4208e17a1954132f9df5c49c22',
                    'default_graph_version' => 'v2.10'
                ]);

                $handler = $FBObject->getRedirectLoginHelper();

                if (isset($_GET['state'])) {
                    $handler->getPersistentDataHandler()->set('state', $_GET['state']);
                }
                $accessToken = $handler->getAccessToken();
                session()->put('access_token', (string) $accessToken);


                // dd($data);
                $SocialCrendential = SocialCrendential::where('social_plateform_name', 'facebook')->first();
                if ($SocialCrendential) {
                    $SocialCrendential->access_token = (string) $accessToken; // store this token somewhere
                    // $SocialCrendential->expires_in = $data['expires_in']; // store this token somewhere
                    $SocialCrendential->save();
                } else {
                    $SocialCrendential = new SocialCrendential();
                    $SocialCrendential->social_plateform_name = 'facebook';
                    $SocialCrendential->access_token = (string) $accessToken; // store this token somewhere
                    // $SocialCrendential->expires_in = $data['expires_in']; // store this token somewhere
                    $SocialCrendential->save();
                }

                dump('Access Token Has Been Generated Successfully !!');
                echo "<script>window.close();</script>";
            } catch (\Facebook\Exceptions\FacebookResponseException $e) {
                echo "Response Exception: " . $e->getMessage();
                exit();
            } catch (\Facebook\Exceptions\FacebookSDKException $e) {
                echo "SDK Exception: " . $e->getMessage();
                exit();
            }
        }
    }
}
