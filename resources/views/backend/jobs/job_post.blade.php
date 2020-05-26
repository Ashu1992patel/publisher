@extends('backend.master')
@section('title', 'Job Post')
@section('body')

<style>
    * {
        margin: 0;
        padding: 0
    }

    html {
        height: 100%
    }

    #grad1 {
        background-color: : #9C27B0;
        background-image: linear-gradient(120deg, #FF4081, #81D4FA)
    }

    #msform {
        text-align: center;
        position: relative;
        margin-top: 20px
    }

    #msform fieldset .form-card {
        background: white;
        border: 0 none;
        border-radius: 0px;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        padding: 20px 40px 30px 40px;
        box-sizing: border-box;
        width: 94%;
        margin: 0 3% 20px 3%;
        position: relative
    }

    #msform fieldset {
        background: white;
        border: 0 none;
        border-radius: 0.5rem;
        box-sizing: border-box;
        width: 100%;
        margin: 0;
        padding-bottom: 20px;
        position: relative
    }

    #msform fieldset:not(:first-of-type) {
        display: none
    }

    #msform fieldset .form-card {
        text-align: left;
        color: #9E9E9E
    }

    #msform input,
    #msform textarea {
        padding: 0px 8px 4px 8px;
        border: none;
        border-bottom: 1px solid #ccc;
        border-radius: 0px;
        margin-bottom: 25px;
        margin-top: 2px;
        width: 100%;
        box-sizing: border-box;
        font-family: montserrat;
        color: #2C3E50;
        font-size: 16px;
        letter-spacing: 1px
    }

    #msform input:focus,
    #msform textarea:focus {
        -moz-box-shadow: none !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        border: none;
        font-weight: bold;
        border-bottom: 2px solid skyblue;
        outline-width: 0
    }

    #msform .action-button {
        width: 100px;
        background: skyblue;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px
    }

    #msform .action-button:hover,
    #msform .action-button:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px skyblue
    }

    #msform .action-button-previous {
        width: 100px;
        background: #616161;
        font-weight: bold;
        color: white;
        border: 0 none;
        border-radius: 0px;
        cursor: pointer;
        padding: 10px 5px;
        margin: 10px 5px
    }

    #msform .action-button-previous:hover,
    #msform .action-button-previous:focus {
        box-shadow: 0 0 0 2px white, 0 0 0 3px #616161
    }

    select.list-dt {
        border: none;
        outline: 0;
        border-bottom: 1px solid #ccc;
        padding: 2px 5px 3px 5px;
        margin: 2px
    }

    select.list-dt:focus {
        border-bottom: 2px solid skyblue
    }

    .card {
        z-index: 0;
        border: none;
        border-radius: 0.5rem;
        position: relative
    }

    .fs-title {
        font-size: 25px;
        color: #2C3E50;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: left
    }

    #progressbar {
        margin-bottom: 30px;
        overflow: hidden;
        color: lightgrey
    }

    #progressbar .active {
        color: #000000
    }

    #progressbar li {
        list-style-type: none;
        font-size: 12px;
        width: 25%;
        float: left;
        position: relative
    }

    #progressbar #account:before {
        font-family: FontAwesome;
        content: "\f023"
    }

    #progressbar #personal:before {
        font-family: FontAwesome;
        content: "\f007"
    }

    #progressbar #payment:before {
        font-family: FontAwesome;
        content: "\f09d"
    }

    #progressbar #confirm:before {
        font-family: FontAwesome;
        content: "\f00c"
    }

    #progressbar li:before {
        width: 50px;
        height: 50px;
        line-height: 45px;
        display: block;
        font-size: 18px;
        color: #ffffff;
        background: lightgray;
        border-radius: 50%;
        margin: 0 auto 10px auto;
        padding: 2px
    }

    #progressbar li:after {
        content: '';
        width: 100%;
        height: 2px;
        background: lightgray;
        position: absolute;
        left: 0;
        top: 25px;
        z-index: -1
    }

    #progressbar li.active:before,
    #progressbar li.active:after {
        background: skyblue
    }

    .radio-group {
        position: relative;
        margin-bottom: 25px
    }

    .radio {
        display: inline-block;
        width: 204;
        height: 104;
        border-radius: 0;
        background: lightblue;
        box-shadow: 0 2px 2px 2px rgba(0, 0, 0, 0.2);
        box-sizing: border-box;
        cursor: pointer;
        margin: 8px 2px
    }

    .radio:hover {
        box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.3)
    }

    .radio.selected {
        box-shadow: 1px 1px 2px 2px rgba(0, 0, 0, 0.1)
    }

    .fit-image {
        width: 100%;
        object-fit: cover
    }
</style>

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Job Post
                            <small>Publisher Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item">
                            <a href="{{ url('/') }}">
                                <i data-feather="home"></i>
                            </a>
                        </li>
                        <!-- <li class="breadcrumb-item">Social Post</li> -->
                        <li class="breadcrumb-item active">Job Post</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <!-- <div class="card-header">
                        <h5>Job Post</h5>
                    </div> -->
                    <div class="card-body">
                        <div class="row product-adding">
                            <!-- MultiStep Form -->
                            <div class="container-fluid" id="grad1">
                                <div class="row justify-content-center mt-0">
                                    <div class="col-11 col-sm-9 col-md-7 col-lg-10 text-center p-0 mt-3 mb-2">
                                        <div class="card px-0 pt-4 pb-0 mt-3 mb-3">
                                            <h2>
                                                <strong>Position Details to Publish</strong>
                                            </h2>
                                            <p>Fill all form field to go to next step</p>
                                            <div class="row">
                                                <div class="col-md-12 mx-0">
                                                    <form id="msform">
                                                        <!-- progressbar -->
                                                        <ul id="progressbar">
                                                            <li class="active" id="account">
                                                                <strong>Publish To</strong>
                                                            </li>
                                                            <li id="personal">
                                                                <strong>Basic Information</strong>
                                                            </li>
                                                            <li id="payment"><strong>Publisher Customize</strong></li>
                                                            <li id="confirm"><strong>Finish</strong></li>
                                                        </ul> <!-- fieldsets -->

                                                        <form action="{{ route('position.store') }}" method="POST" name="myform" class="needs-validation add-product-form" novalidate="">
                                                            @csrf
                                                            @method('post')
                                                            <fieldset>
                                                                <div class="form-card">
                                                                    <!-- <h2 class="fs-title">Publish To</h2> -->
                                                                    <!-- <input type="email" name="email" placeholder="Email Id" />
                                                                <input type="text" name="uname" placeholder="UserName" />
                                                                <input type="password" name="pwd" placeholder="Password" />
                                                                <input type="password" name="cpwd" placeholder="Confirm Password" /> -->

                                                                    <div class="attribute-blocks center">
                                                                        <h5 class="f-w-600 mb-3">
                                                                            Where to publish this position, please click to check those plateforms:
                                                                        </h5>

                                                                        <div class="row">
                                                                            <div class="col-xl-3 col-sm-4">
                                                                                <label>LinkedIn</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-sm-8">
                                                                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                                                    <label class="d-block" for="edo-ani1">
                                                                                        <input class="radio_animated" id="edo-ani1" type="checkbox" name="linkedin" checked>
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xl-3 col-sm-4">
                                                                                <label>Click India</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-sm-8">
                                                                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                                                    <label class="d-block" for="edo-ani1">
                                                                                        <input class="radio_animated" id="edo-ani1" type="checkbox" name="clickindia">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xl-3 col-sm-4">
                                                                                <label>Monster</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-sm-8">
                                                                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                                                    <label class="d-block" for="edo-ani1">
                                                                                        <input class="radio_animated" id="edo-ani1" type="checkbox" name="monster">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row">
                                                                            <div class="col-xl-3 col-sm-4">
                                                                                <label>Naukri</label>
                                                                            </div>
                                                                            <div class="col-xl-9 col-sm-8">
                                                                                <div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
                                                                                    <label class="d-block" for="edo-ani1">
                                                                                        <input class="radio_animated" id="edo-ani1" type="checkbox" name="naukri">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="button" name="next" class="next action-button" value="Next Step" />
                                                            </fieldset>
                                                            <fieldset>
                                                                <div class="form-card">
                                                                    <h2 class="fs-title">Basic Information</h2>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <label class="pay">Job Title</label>
                                                                            <input type="text" class="form-control" name="job_title" placeholder="Job Title" required="" autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-2">
                                                                            <label class="pay">
                                                                                Designation *
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input type="text" name="designation" class="list-dt" id="designation" required>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <label class="pay">
                                                                                Expire On *
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input type="date" name="expire_on" class="list-dt" id="expire_on" required>
                                                                        </div>

                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Job Type *
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="job_type" class="list-dt" id="job_type" required>
                                                                                <option value="Full time jobs">Full time jobs
                                                                                </option>
                                                                                <option value="Part time jobs">Part time jobs</option>
                                                                                <option value="Work from home jobs">Work from home jobs</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                No. of Openings *
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <input type="number" name="vacancies" />
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Salary Type *
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="salary_type" class="list-dt" id="salary_type" required>
                                                                                <option value="Per Annum">Per Annum</option>
                                                                                <option value="Per Hour">Per Hour</option>
                                                                                <option value="Per Day">Per Day</option>
                                                                                <option value="Per Week">Per Week</option>
                                                                                <option value="Per Month">Per Month</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <label class="pay">
                                                                                Min.
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <input type="text" name="minimum_salary" placeholder="350000" />
                                                                        </div>
                                                                        <div class="col-1">
                                                                            <label class="pay">
                                                                                Max.
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <input type="text" name="maximum_salary" placeholder="500000" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <label class="pay">
                                                                                Job Description *
                                                                            </label>
                                                                            <textarea name="job_description" class="form-control" id="job_description" cols="5" rows="3" required></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                For Company / Client
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="client_id" class="list-dt" id="client_id" required>
                                                                                <option value="">Select Client</option>
                                                                                <option value="Ashish">Ashish</option>
                                                                                <option value="Akram">Akram</option>
                                                                                <option value="Nitesh">Nitesh</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-2">
                                                                            <label class="pay">
                                                                                URL:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-4">
                                                                            <input type="text" name="company_url" placeholder="e.g. white-force.com" />
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-12">
                                                                            <label class="pay">
                                                                                Company / Client Description
                                                                            </label>
                                                                            <textarea type="text" class="form-control" cols="5" rows="3" name="company_description" placeholder="" autocomplete="off"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                                <input type="button" name="next" class="next action-button" value="Next Step" />
                                                            </fieldset>
                                                            <fieldset>
                                                                <div class="form-card">
                                                                    <h2 class="fs-title">Publisher Customize</h2>
                                                                    <h5 class="f-w-600 mb-3">
                                                                        Click India Custom Form
                                                                    </h5>

                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Minimum Qualification:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="minimum_qualification" class="list-dt" id="minimum_qualification" required>
                                                                                <option value="< 10th">Below 10th</option>
                                                                                <option value="10th">10th</option>
                                                                                <option value="12th">12th</option>
                                                                                <option value="Diploma">Diploma</option>
                                                                                <option value="Bachelors" selected>Bachelors</option>
                                                                                <option value="Masters">Masters</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Minimum Experience:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="minimum_experience" class="list-dt" id="minimum_experience" required>
                                                                                <option value="Fresher" selected>Fresher</option>
                                                                                <option value="1 yr">1 yr</option>
                                                                                <option value="2 yrs">2 yrs</option>
                                                                                <option value="3 yrs">3 yrs</option>
                                                                                <option value="4 yrs">4 yrs</option>
                                                                                <option value="5 yrs">5 yrs</option>
                                                                                <option value="6-9 yrs">6-9 yrs</option>
                                                                                <option value="10-15 yrs">10-15 yrs</option>
                                                                                <option value="15 above">15 Above</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>

                                                                    <hr>
                                                                    <div class="row">
                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Working Days:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Mon<input type="checkbox" name="working_days[]" id="working_days" value="Mon" checked>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Tue<input type="checkbox" name="working_days[]" id="working_days" value="Tue" checked>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Wed<input type="checkbox" name="working_days[]" id="working_days" value="Wed" checked>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Thu<input type="checkbox" name="working_days[]" id="working_days" value="Thu" checked>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Fri<input type="checkbox" name="working_days[]" id="working_days" value="Fri" checked>
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Sat<input type="checkbox" name="working_days[]" id="working_days" value="Sat">
                                                                        </div>
                                                                        <div class="col-1">
                                                                            Sun<input type="checkbox" name="working_days[]" id="working_days" value="Sun">
                                                                        </div>

                                                                        <div class="col-3">
                                                                            <label class="pay">
                                                                                Required Candidate:
                                                                            </label>
                                                                        </div>
                                                                        <div class="col-3">
                                                                            <select name="required_candidate" class="list-dt" id="required_candidate" required>
                                                                                <option value="Male / Female" selected>Male / Female</option>
                                                                                <option value="Male only">Male only</option>
                                                                                <option value="Female only">Female only</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <hr>
                                                                    <label class="pay">Hiring Process*</label>
                                                                    <input type="text" name="hiring_process" id="hiring_process" placeholder="Telephonic, Walkin,Written test, Group Discussion, Interview" />
                                                                </div>
                                                                <input type="button" name="previous" class="previous action-button-previous" value="Previous" />
                                                                <!-- <input type="button" name="make_payment" class="next action-button" value="Confirm" /> -->
                                                                <button type="submit" class="next action-button" onclick="submit_button();" value="Submit Now" />Submit</button>
                                                            </fieldset>

                                                            <fieldset>
                                                                <div class="form-card">
                                                                    <h2 class="fs-title text-center">Success !</h2> <br><br>
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-3"> <img src="https://img.icons8.com/color/96/000000/ok--v2.png" class="fit-image"> </div>
                                                                    </div> <br><br>
                                                                    <div class="row justify-content-center">
                                                                        <div class="col-7 text-center">
                                                                            <h5>
                                                                                You Have Successfully Posted a Job
                                                                            </h5>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </fieldset>
                                                        </form>

                                                        <script>
                                                            function submit_button() {
                                                                $('form#myform').submit;
                                                            }
                                                        </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>

<script>
    $(document).ready(function() {

        var current_fs, next_fs, previous_fs; //fieldsets
        var opacity;

        $(".next").click(function() {

            current_fs = $(this).parent();
            next_fs = $(this).parent().next();

            //Add Class Active
            $("#progressbar li").eq($("fieldset").index(next_fs)).addClass("active");

            //show the next fieldset
            next_fs.show();
            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    next_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $(".previous").click(function() {

            current_fs = $(this).parent();
            previous_fs = $(this).parent().prev();

            //Remove class active
            $("#progressbar li").eq($("fieldset").index(current_fs)).removeClass("active");

            //show the previous fieldset
            previous_fs.show();

            //hide the current fieldset with style
            current_fs.animate({
                opacity: 0
            }, {
                step: function(now) {
                    // for making fielset appear animation
                    opacity = 1 - now;

                    current_fs.css({
                        'display': 'none',
                        'position': 'relative'
                    });
                    previous_fs.css({
                        'opacity': opacity
                    });
                },
                duration: 600
            });
        });

        $('.radio-group .radio').click(function() {
            $(this).parent().find('.radio').removeClass('selected');
            $(this).addClass('selected');
        });

        $(".submit").click(function() {
            return false;
        })

    });
</script>
@endsection