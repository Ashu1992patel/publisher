@extends('backend.master')
@section('title', 'Publisher Admin Dashboard')
@section('body')
<link rel="stylesheet" href="myProjects/webProject/icofont/css/icofont.min.css">
<style>
    .dropbtn {
        background-color: #4CAF50;
        color: white;
        padding: 16px;
        font-size: 16px;
        border: none;
        cursor: pointer;
    }

    .dropdown {
        position: relative;
        display: inline-block;
    }

    .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: #f9f9f9;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown:hover .dropbtn {
        background-color: #3e8e41;
    }
</style>
<!-- <link rel="stylesheet" href="http://thetheme.io/thejobs/assets/css/app.min.css"> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Primer/10.8.1/build.css" />

<style>
    .Box {
        width: 400px;
    }

    /* Basic Layout Stuff */

    html,
    body {
        height: 100%;
        margin: 0;
        font-family: helvetica, arial;
        color: #555E63;
        line-height: 1.4;
    }

    .wrap {
        display: flex;
        justify-content: space-between;
        flex-direction: row-reverse;
        min-height: 100%;
    }

    .posts {
        /* width: calc(100% - 280px); */
    }

    /* Post Listings */

    h1 {
        margin: 40px 40px 10px 40px;
        padding-bottom: 15px;
        font-size: 16px;
        color: #DC366E;
        border-bottom: 1px solid #D7D9DA;
        line-height: 1;
    }

    .post {
        display: block;
        text-decoration: none;
        color: #555E63;
        border-left: 10px solid #C0F20C;
        /* green */
        padding: 30px 40px 30px 30px;
        margin-bottom: 10px;
    }

    .post h2 {
        color: #283866;
        margin: 0 0 15px 0;
        line-height: 1;
        transition: color 400ms ease-in-out;
    }

    .date {
        font-size: 12px;
        color: #aaa;
        margin: 0;
        line-height: 1;
        transition: all 400ms ease-in-out;
    }

    .summary {
        margin: 20px 0 0 0;
    }

    .post.cyan {
        border-color: #0CEAF2;
    }

    .post.blue {
        border-color: #00A1FF;
    }

    .post.pink {
        border-color: #DC366E;
    }

    .post.blue2 {
        border-color: #1377BF;
    }





    /* Sidebar Links */







    /* Hover */

    .post {
        position: relative;
        overflow: hidden;
        transition: color 400ms ease-in-out;
    }

    .post:before {
        content: "";
        width: 10px;
        height: 100%;
        background: #C0F20C;
        border-top-right-radius: 50%;
        border-bottom-right-radius: 50%;
        position: absolute;
        transition: all 400ms ease-in-out;
    }

    .post-inner {
        position: relative;
        z-index: 99999;
    }

    .post:before {
        top: 0;
        left: -10px;
    }

    .post:hover,
    .post:hover h2 {
        color: #ffffff;
    }

    .post:hover .date {
        color: #ffffff;
        opacity: 0.5;
    }

    .post:hover:before {
        width: 100%;
        height: 100%;
        border-radius: 0;
        left: 0;
    }

    .post.cyan:before {
        background: #0CEAF2;
    }

    .post.blue:before {
        background: #00A1FF;
    }

    .post.pink:before {
        background: #DC366E;
    }

    .post.blue2:before {
        background: #1377BF;
    }
</style>

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Dashboard
                            <small>Publisher Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('home') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-warning card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center"><i data-feather="navigation" class="font-warning"></i></div>
                            </div>
                            <div class="media-body col-8"><span class="m-0">Jobs</span>
                                <h3 class="mb-0">
                                    <span class="counter">
                                        {{$jobs->count()}}
                                    </span>
                                    <small> Total Count</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden  widget-cards">
                    <div class="bg-secondary card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                            </div>
                            <div class="media-body col-8"><span class="m-0">Jobs</span>
                                <h3 class="mb-0">
                                    <span class="counter">
                                        {{ $jobs->where('created_at', now())->count() }}
                                    </span>
                                    <small> Today</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-primary card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center"><i data-feather="message-square" class="font-primary"></i></div>
                            </div>
                            <div class="media-body col-8"><span class="m-0">Jobs</span>
                                <h3 class="mb-0">
                                    <span class="counter">
                                        {{ $jobs->where('created_at', now())->count() }}
                                    </span>
                                    <small> This Month</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 xl-50">
                <div class="card o-hidden widget-cards">
                    <div class="bg-danger card-body">
                        <div class="media static-top-widget row">
                            <div class="icons-widgets col-4">
                                <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                            </div>
                            <div class="media-body col-8"><span class="m-0">New Jobs</span>
                                <h3 class="mb-0">
                                    <span class="counter">
                                        {{ $jobs->where('created_at', now())->count() }}
                                    </span>
                                    <small> Today</small>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 xl-100">
                <div class="card height-equal">
                    <div class="card-header">
                        <h5>Empolyee Status

                            <a href="{{ url('clickindiaresponse/')}}" class="badge badge-dark">
                                Sync <small>(click india)</small>
                            </a>
                        </h5>
                        <div class="card-header-right">
                            <div class="float-right">
                                {{ $jobs->links() }}
                            </div>
                            <!-- <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul> -->
                        </div>
                    </div>





                    @if(count($jobs))

                    <div class="row">

                        <div class="col-sm-12">
                            <div class="wrap">

                                <main class="posts">

                                    <!-- <h1>Earlier Job Positions</h1> -->
                                    @php
                                    $color = ['', 'cyan', 'blue', 'pink', 'blue2'];
                                    $index = 0;
                                    @endphp

                                    @foreach($jobs as $key => $jobPosition)
                                    @php
                                    if($index > 4)
                                    {
                                    $index = 0;
                                    }
                                    @endphp
                                    <div class="post {{ $color[$index] }}">
                                        <div class="post-inner">
                                            <h2>
                                                {{ isset($jobPosition->job_title)?$jobPosition->job_title:'' }}

                                                @if(isset($jobPosition->company->name))
                                                <small style="font-size: 12px;" style='color: red !important;'>
                                                    BY
                                                </small>
                                                @php
                                                $url = url('companiess/'.$jobPosition->company_id);
                                                @endphp
                                                <button title='Click to check "{{ isset($jobPosition->company->name)?$jobPosition->company->name:'' }}" company details. ' onclick='location.href = "{{ $url }}"' style="background:none;background:none;border:none;margin:0;padding:0;cursor: pointer;">
                                                    {{ isset($jobPosition->company->name)?$jobPosition->company->name:'' }}
                                                </button>
                                                @endif

                                                <div class="bg-primary b-r-8 float-right" style="font-size: 12px;">
                                                    <div class="dropdown feather feather-briefcase">
                                                        <button class="dropbtn btn-sm">
                                                            Action ({{ ++$key }})
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="{{ url('position/').'/'.$jobPosition->id }}">
                                                                Post Now
                                                            </a>
                                                            <a href="javascript: void(0);" onclick='getConfirmed("{{$jobPosition->job_title}}", "{{$jobPosition->id}}", "form{{$jobPosition->id}}");'>
                                                                Delete
                                                            </a>
                                                            <form action="{{ url('position/').'/'.$jobPosition->id }}" method="post" id="form{{$jobPosition->id}}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" style="display: none;" class="btn btn-sm btn-warning hide">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </h2>
                                            <p class="date">
                                                <!-- <time datetime="2019-07-07">
                                                    7th July 2019
                                                </time>
                                                by Dean -->
                                                @if(isset($jobPosition->click_india_city->city_name))
                                                <small class="font-bold smallClass badge badge-sm badge-info">
                                                    {{ $jobPosition->click_india_city->city_name }}
                                                </small>
                                                @endif
                                                <small class="font-bold smallClass badge badge-sm badge-success">
                                                    Exp. : {{ isset($jobPosition->click_india_minimum_experience)?$jobPosition->click_india_minimum_experience:'' }}
                                                </small>

                                                <small class="font-bold smallClass badge badge-sm badge-info">
                                                    Opening : {{ isset($jobPosition->vacancies)?$jobPosition->vacancies:'' }}
                                                </small>
                                                <small class="font-bold smallClass badge badge-sm badge-warning">
                                                    Salary : {{ isset($jobPosition->minimum_salary)?$jobPosition->minimum_salary:'' }} -
                                                    {{ isset($jobPosition->maximum_salary)?$jobPosition->maximum_salary:'' }}
                                                </small>
                                                <small class="font-bold smallClass badge badge-sm badge-danger">
                                                    Expires On : {{ Carbon\Carbon::parse($jobPosition->expire_on)->format('d-M-Y') }}
                                                </small>
                                                <small class="font-bold smallClass badge badge-sm badge-info">
                                                    Skills: {{ isset($jobPosition->skills)?$jobPosition->skills:'' }}
                                                </small>
                                                <small class="font-bold smallClass badge badge-sm badge-success">
                                                    {{ isset($jobPosition->job_type)?'Job Type: '.$jobPosition->job_type:'' }}
                                                </small>
                                            </p>
                                            <p class="summary" title="Job Summery">
                                                {{ substr($jobPosition->job_description, 0, 144) }}
                                            </p>
                                            <p class="summary">
                                                @php
                                                $job_to_click_india = App\JobToClickIndia::where('job_id',$jobPosition->id)->first();
                                                @endphp

                                                @if(isset($job_to_click_india))
                                                <a href="https://www.clickindia.com/detail.php?id={{$job_to_click_india->response}}" target="_blank">
                                                    Click India View:
                                                </a>
                                                <small class="badge badge-sm badge-info">
                                                    {{ $job_to_click_india->views }}
                                                </small>
                                                <span>
                                                    <i class="fa fa-angle-up"></i>
                                                </span>

                                                @endif

                                                Monster View: <small class="badge badge-sm badge-info">100</small>
                                                <span>
                                                    <i class="fa fa-angle-up"></i>
                                                </span>

                                                Shine View: <small class="badge badge-sm badge-info">100</small>
                                                <span>
                                                    <i class="fa fa-angle-up"></i>
                                                </span>

                                            </p>
                                        </div>
                                    </div>
                                    @php ++$index; @endphp
                                    @endforeach
                                    {{ $jobs->links() }}
                                </main>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="row">
                        @foreach($jobs as $key=>$jobPosition)
                        <div class="col-sm-6">
                            <div class="row">
                                <div class="col-sm-1">
                                    <div class="card order-graph sales-carousel">
                                        <div class="card-body card order-graph sales-carousel">
                                            <label for="">
                                                {{ ++$key }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-11">
                                    <div class="card order-graph sales-carousel">
                                        <div class="card-body card order-graph sales-carousel">
                                            <div class="media">
                                                <div class="media-body">
                                                    <span>
                                                        {{ isset($jobPosition->company->name)?$jobPosition->company->name:'' }}
                                                    </span>

                                                    @if(isset($jobPosition->click_india_city->city_name))
                                                    <small>
                                                        ({{ $jobPosition->click_india_city->city_name }})
                                                    </small>
                                                    @endif

                                                    <br>
                                                    <small class="font-bold smallClass badge badge-sm badge-success">
                                                        Exp. : {{ isset($jobPosition->click_india_minimum_experience)?$jobPosition->click_india_minimum_experience:'' }}
                                                    </small>
                                                    <small class="font-bold smallClass badge badge-sm badge-info">
                                                        Opening : {{ isset($jobPosition->vacancies)?$jobPosition->vacancies:'' }}
                                                    </small>
                                                    <small class="font-bold smallClass badge badge-sm badge-warning">
                                                        Salary : {{ isset($jobPosition->minimum_salary)?$jobPosition->minimum_salary:'' }} -
                                                        {{ isset($jobPosition->maximum_salary)?$jobPosition->maximum_salary:'' }}
                                                    </small>
                                                    <small class="font-bold smallClass badge badge-sm badge-danger">
                                                        Expires On : {{ Carbon\Carbon::parse($jobPosition->expire_on)->format('d-M-Y') }}
                                                    </small>
                                                    <small class="font-bold smallClass badge badge-sm badge-info">
                                                        Skills: {{ isset($jobPosition->skills)?$jobPosition->skills:'' }}
                                                    </small>

                                                    <h2 class="mb-0">
                                                        <a href="{{ isset($jobPosition->apply_button_url)?$jobPosition->apply_button_url:'' }}" target="_blank" style="font-size: 20px;">
                                                            {{ isset($jobPosition->job_title)?$jobPosition->job_title:'' }}
                                                        </a>
                                                    </h2>
                                                    <p>
                                                        @php
                                                        $job_to_click_india = App\JobToClickIndia::where('job_id',$jobPosition->id)->first();
                                                        @endphp

                                                        @if(isset($job_to_click_india))
                                                        <a href="https://www.clickindia.com/detail.php?id={{$job_to_click_india->response}}" target="_blank">
                                                            Click India View:
                                                        </a>
                                                        <small class="badge badge-sm badge-info">
                                                            {{ $job_to_click_india->views }}
                                                        </small>
                                                        <span>
                                                            <i class="fa fa-angle-up"></i>
                                                        </span>

                                                        @endif

                                                        Monster View: <small class="badge badge-sm badge-info">100</small>
                                                        <span>
                                                            <i class="fa fa-angle-up"></i>
                                                        </span>

                                                        Shine View: <small class="badge badge-sm badge-info">100</small>
                                                        <span>
                                                            <i class="fa fa-angle-up"></i>
                                                        </span>
                                                    </p>
                                                    <h5 class="f-w-600">
                                                        <small>
                                                            {{ isset($jobPosition->job_type)?'Job Type: '.$jobPosition->job_type:'' }}
                                                        </small>
                                                    </h5>
                                                    <p style="text-overflow: ellipsis; overflow: hidden;text-overflow: ellipsis;display: -webkit-box;-webkit-line-clamp: 2;-webkit-box-orient: vertical;">
                                                        {{ isset($jobPosition->job_description)?$jobPosition->job_description:'' }}

                                                    </p>

                                                </div>
                                                <div class="bg-primary b-r-8">
                                                    <div class="dropdown feather feather-briefcase">
                                                        <button class="dropbtn btn-sm">Action
                                                            <i class="fa fa-caret-down"></i>
                                                        </button>
                                                        <div class="dropdown-content">
                                                            <a href="{{ url('position/').'/'.$jobPosition->id }}">
                                                                Post Now
                                                            </a>

                                                            <a href="javascript: void(0);" onclick='getConfirmed("{{$jobPosition->job_title}}", "{{$jobPosition->id}}", "form{{$jobPosition->id}}");'>
                                                                Delete
                                                            </a>

                                                            <form action="{{ url('position/').'/'.$jobPosition->id }}" method="post" id="form{{$jobPosition->id}}">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" style="display: none;" class="btn btn-sm btn-warning hide">Delete</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach

                    </div> -->
                    <hr>
                    @endif

                    <div class="card-body">
                        <!-- <div class="user-status table-responsive products-table">
                            <table class="table table-bordernone mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Action</th>
                                        <th>S.No</th>
                                        <th scope="col">Company</th>
                                        <th scope="col">Company City</th>
                                        <th scope="col">Job Title</th>
                                        <th scope="col">Close Date</th>
                                        <th scope="col">Openings</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Skills</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Min. Year Exp</th>
                                        <th scope="col">Education Qualification</th>
                                        <th scope="col">Min. Salary</th>
                                        <th scope="col">Max. Salary</th>
                                        <th scope="col">Job Type</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @if(count($jobs))
                                    @foreach($jobs as $key=>$jobPosition)
                                    <tr>
                                        <td>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <a href="{{ url('position/').'/'.$jobPosition->id }}" class="btn btn-sm btn-info">
                                                        Post Now
                                                    </a>
                                                </div>
                                                <div class="col-sm-2">
                                                    <form action="{{ url('position/').'/'.$jobPosition->id }}" method="post" id="form{{$jobPosition->id}}">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-warning" onclick='getConfirmed("{{$jobPosition->job_title}}, {{$jobPosition->id}}");'>Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ ++$key }}</td>
                                        <td>{{ isset($jobPosition->company->name)?$jobPosition->company->name:'' }}</td>
                                        <td>{{ isset($jobPosition->click_india_city->city_name)?$jobPosition->click_india_city->city_name:'' }}</td>
                                        <td>{{ isset($jobPosition->job_title)?$jobPosition->job_title:'' }}</td>
                                        <td>{{ Carbon\Carbon::parse($jobPosition->expire_on)->format('d-M-Y') }}</td>
                                        <td>{{ isset($jobPosition->vacancies)?$jobPosition->vacancies:'' }}</td>
                                        <td>{{ isset($jobPosition->company_location)?$jobPosition->company_location:'' }}</td>
                                        <td>{{ isset($jobPosition->skills)?$jobPosition->skills:'' }}</td>
                                        <td>{{ isset($jobPosition->job_description)?$jobPosition->job_description:'' }}</td>
                                        <td>{{ isset($jobPosition->click_india_minimum_experience)?$jobPosition->click_india_minimum_experience:'' }}</td>
                                        <td>{{ isset($jobPosition->click_india_minimum_qualification)?$jobPosition->click_india_minimum_qualification:'' }}</td>
                                        <td>{{ isset($jobPosition->minimum_salary)?$jobPosition->minimum_salary:'' }}</td>
                                        <td>{{ isset($jobPosition->maximum_salary)?$jobPosition->maximum_salary:'' }}</td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div> -->
                        <div class="code-box-copy">
                            <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head5" title="" data-original-title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                            <pre class=" language-html"><code class=" language-html" id="example-head5">
&lt;div class="user-status table-responsive products-table"&gt;
&lt;table class="table table-bordernone mb-0"&gt;
    &lt;thead&gt;
        &lt;tr&gt;
            &lt;th scope="col"&gt;Name&lt;/th&gt;
            &lt;th scope="col"&gt;Designation&lt;/th&gt;
            &lt;th scope="col"&gt;Skill Level&lt;/th&gt;
            &lt;th scope="col"&gt;Experience&lt;/th&gt;
        &lt;/tr&gt;
    &lt;/thead&gt;
    &lt;tbody&gt;
            &lt;tr&gt;
                &lt;td class="bd-t-none u-s-tb"&gt;
                    &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="../assets/images/dashboard/user2.jpg" alt="" data-original-title="" title=""&gt;
                    &lt;div class="d-inline-block"&gt;
                    &lt;h6&gt;John Deo &lt;span class="text-muted digits"&gt;(14+ Online)&lt;/span&gt;&lt;/h6&gt;
                    &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/td&gt;
                &lt;td&gt;Designer&lt;/td&gt;
                &lt;td&gt;
                    &lt;div class="progress-showcase"&gt;
                    &lt;div class="progress" style="height: 8px;"&gt;
                    &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
                    &lt;/div&gt;
                    &lt;/div&gt;
                &lt;/td&gt;
                &lt;td class="digits"&gt;2 Year&lt;/td&gt;
            &lt;/tr&gt;
        &lt;tr&gt;
            &lt;td class="bd-t-none u-s-tb"&gt;
                &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="../assets/images/dashboard/user1.jpg" alt="" data-original-title="" title=""&gt;
                &lt;div class="d-inline-block"&gt;
                &lt;h6&gt;Holio Mako &lt;span class="text-muted digits"&gt;(250+ Online)&lt;/span&gt;&lt;/h6&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;Developer&lt;/td&gt;
            &lt;td&gt;
                &lt;div class="progress-showcase"&gt;
                &lt;div class="progress" style="height: 8px;"&gt;
                &lt;div class="progress-bar bg-secondary" role="progressbar" style="width: 70%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td class="digits"&gt;3 Year&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;td class="bd-t-none u-s-tb"&gt;
                &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="../assets/images/dashboard/man.png" alt="" data-original-title="" title=""&gt;
                &lt;div class="d-inline-block"&gt;
                &lt;h6&gt;Mohsib lara&lt;span class="text-muted digits"&gt;(99+ Online)&lt;/span&gt;&lt;/h6&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;Tester&lt;/td&gt;
            &lt;td&gt;
                &lt;div class="progress-showcase"&gt;
                &lt;div class="progress" style="height: 8px;"&gt;
                &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 60%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td class="digits"&gt;5 Month&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;td class="bd-t-none u-s-tb"&gt;
                &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="../assets/images/dashboard/user.png" alt="" data-original-title="" title=""&gt;
                &lt;div class="d-inline-block"&gt;
                &lt;h6&gt;Hileri Soli &lt;span class="text-muted digits"&gt;(150+ Online)&lt;/span&gt;&lt;/h6&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;Designer&lt;/td&gt;
            &lt;td&gt;
                &lt;div class="progress-showcase"&gt;
                &lt;div class="progress" style="height: 8px;"&gt;
                &lt;div class="progress-bar bg-secondary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td class="digits"&gt;3 Month&lt;/td&gt;
        &lt;/tr&gt;
        &lt;tr&gt;
            &lt;td class="bd-t-none u-s-tb"&gt;
                &lt;div class="align-middle image-sm-size"&gt;&lt;img class="img-radius align-top m-r-15 rounded-circle blur-up lazyloaded" src="../assets/images/dashboard/designer.jpg" alt="" data-original-title="" title=""&gt;
                &lt;div class="d-inline-block"&gt;
                &lt;h6&gt;Pusiz bia &lt;span class="text-muted digits"&gt;(14+ Online)&lt;/span&gt;&lt;/h6&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td&gt;Designer&lt;/td&gt;
            &lt;td&gt;
                &lt;div class="progress-showcase"&gt;
                &lt;div class="progress" style="height: 8px;"&gt;
                &lt;div class="progress-bar bg-primary" role="progressbar" style="width: 90%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"&gt;&lt;/div&gt;
                &lt;/div&gt;
                &lt;/div&gt;
            &lt;/td&gt;
            &lt;td class="digits"&gt;5 Year&lt;/td&gt;
        &lt;/tr&gt;
    &lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
                                </code></pre>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <!-- footer start-->
        @include('backend.common.footer')
        <!-- footer end-->
    </div>
    <script>
        function getConfirmed(job_title, id, form_id) {
            if (confirm('Are you want to delete this position for ' + job_title + '???')) {
                event.preventDefault();
                // console.log(form_id);
                document.getElementById(form_id).submit();
            } else {

            }
        }
    </script>


</div>

@endsection