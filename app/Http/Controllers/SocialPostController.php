<?php

namespace App\Http\Controllers;

use App\SocialCrendential;
use App\SocialPost;
use Exception;
use Facebook;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class SocialPostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fb = new Facebook\Facebook([
            'app_id' => '933267967093222',
            'app_secret' => '7e71cc291d69cb7ef859da081e8b309e',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email', 'manage_pages']; // Optional permissions
        $loginUrl = $helper->getLoginUrl('http://localhost:1234/callback/facebook', $permissions);
        // $loginUrl = $helper->getLoginUrl('https://example.com/fb-callback.php', $permissions);

        $state = substr(str_shuffle("0123456789abcHGFRlki"), 0, 10);
        $linkedin_url = "https://www.linkedin.com/oauth/v2/authorization?response_type=code&client_id=" . LinkedIn_CLIENT_ID . "&redirect_uri=" . LinkedIn_REDIRECT_URI . "&scope=" . LinkedIn_SCOPES . "&state=" . $state;


        // dd($url);
        return view('backend.publish.socialpost', compact('loginUrl', 'linkedin_url'));
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
        foreach ($request->media as $key => $value) {
            if ($value == 'linkedin') {
                $SocialCrendential = SocialCrendential::where('social_plateform_name', $value)->first();
                //Starts, this code has to be placed somewhere else
                try {
                    $client = new Client(['base_uri' => 'https://api.linkedin.com']);
                    $response = $client->request('GET', '/v2/me', [
                        'headers' => [
                            "Authorization" => "Bearer " . $SocialCrendential->access_token,
                        ],
                    ]);

                    $data = json_decode($response->getBody()->getContents(), true);
                    $linkedin_profile_id = $data['id']; // store this id somewhere

                    $this->sendLinkedInPost($request->message, $SocialCrendential->access_token);
                    session()->put('linkedin_profile_id', $linkedin_profile_id);

                    return redirect('social-group')->with('success', 'LinkedIn message has been posted successfully !!');
                } catch (Exception $e) {
                    // return redirect('social-group')->with('error', 'LinkedIn message can not be posted !!');
                    echo $e->getMessage();
                }
                //Ends, this code has to be placed somewhere else
            }
            // dd('bahar hai');
            return redirect('social-group')->with('error', 'Message can not be posted !!');
        }
        $fb = new Facebook\Facebook([
            'app_id' => '933267967093222',
            'app_secret' => '7e71cc291d69cb7ef859da081e8b309e',
            'default_graph_version' => 'v2.10',
        ]);

        $linkData = [
            'link' => 'http://www.example.com',
            'message' => 'User provided message',
        ];

        try {
            // Returns a `Facebook\Response` object
            // $response = $fb->post('/me/feed', $linkData, 'EAAEJCsDE0hgBAKtUDfZBHZA3a0Eiz7ZA6TDEiAJTGBuxUrcNM82StruZCbbVW5QG8yr7ra2VNT8I0bRp8al80MOWxidOVdHTQS1ZAqx24aFAKba6iVE1aGtxuqiQCOhk1dpGrnRct1Na6nxwS9LSXvOt51ciLGU5k9tdvZCWHiL0HFgC0IEQl7Cp4yN2qRPAZAVx9xF80PVuegHh3RyZCbYXCoZB3JuBCIdw0NJL4WSLTsAZDZD');
            dd(session('token'));
            $response = $fb->post('/me/feed', $linkData, session('token'));
        } catch (Facebook\Exception\ResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch (Facebook\Exception\SDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $graphNode = $response->getGraphNode();

        echo 'Posted with id: ' . $graphNode['id'];
    }

    public function sendLinkedInPost($message, $access_token)
    {
        // $link = 'YOUR_LINK_TO_SHARE';
        // $link = LinkedIn_REDIRECT_URI;
        $link = "https://www.linkedin.com/in/happiestresume/detail/recent-activity/";
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
        $body->content->title = 'Whiteforce Jobs';
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

    /**
     * Display the specified resource.
     *
     * @param  \App\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function show(SocialPost $socialPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function edit(SocialPost $socialPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SocialPost $socialPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\SocialPost  $socialPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(SocialPost $socialPost)
    {
        //
    }
}
