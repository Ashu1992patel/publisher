<?php

namespace App\Http\Controllers;

use App\JobPosition;
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
        $jobPositions = JobPosition::get();
        return view('backend.dashboard', compact('jobPositions'));
        return view('home');
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
            $fb = new Facebook\Facebook([
                'app_id' => '933267967093222',
                'app_secret' => '7e71cc291d69cb7ef859da081e8b309e',
                'default_graph_version' => 'v2.10',
            ]);

            $helper = $fb->getRedirectLoginHelper();

            try {
                $accessToken = $helper->getAccessToken();
                // dd($accessToken);
                session()->put('token', $accessToken);
                return redirect('social-group');
            } catch (Facebook\Exception\ResponseException $e) {
                // When Graph returns an error
                echo 'Graph returned an error: ' . $e->getMessage();
                exit;
            } catch (Facebook\Exception\SDKException $e) {
                // When validation fails or other local issues
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                exit;
            }

            if (!isset($accessToken)) {
                if ($helper->getError()) {
                    header('HTTP/1.0 401 Unauthorized');
                    echo "Error: " . $helper->getError() . "\n";
                    echo "Error Code: " . $helper->getErrorCode() . "\n";
                    echo "Error Reason: " . $helper->getErrorReason() . "\n";
                    echo "Error Description: " . $helper->getErrorDescription() . "\n";
                } else {
                    header('HTTP/1.0 400 Bad Request');
                    echo 'Bad request';
                }
                exit;
            }

            // Logged in
            echo '<h3>Access Token</h3>';
            var_dump($accessToken->getValue());

            // The OAuth 2.0 client handler helps us manage access tokens
            $oAuth2Client = $fb->getOAuth2Client();

            // Get the access token metadata from /debug_token
            $tokenMetadata = $oAuth2Client->debugToken($accessToken);
            echo '<h3>Metadata</h3>';
            var_dump($tokenMetadata);

            // Validation (these will throw FacebookSDKException's when they fail)
            $tokenMetadata->validateAppId($config['app_id']);
            // If you know the user ID this access token belongs to, you can validate it here
            //$tokenMetadata->validateUserId('123');
            $tokenMetadata->validateExpiration();

            if (!$accessToken->isLongLived()) {
                // Exchanges a short-lived access token for a long-lived one
                try {
                    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
                } catch (Facebook\Exception\SDKException $e) {
                    echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
                    exit;
                }

                echo '<h3>Long-lived</h3>';
                var_dump($accessToken->getValue());
            }

            $_SESSION['fb_access_token'] = (string) $accessToken;



            // $user = FacadesSocialite::driver($service)->user();

            // if ($user) {
            //     session()->put('token', $user->token);
            // }
            return redirect('social-group');
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
        return FacadesSocialite::driver('facebook')->redirect();
    }
}
