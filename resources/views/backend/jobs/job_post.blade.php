@extends('backend.master')
@section('title', 'Job Post')
@section('body')

{{-- <style>
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
</style> --}}


<style>
    /* Mark input boxes that gets an error on validation: */

    /* Hide all steps by default: */
    .tab {
        display: none;
    }

    button {
        background-color: #4CAF50;
        color: #ffffff;
        border: none;
        padding: 10px 20px;
        font-size: 17px;
        font-family: Raleway;
        cursor: pointer;
    }

    #prevBtn {
        background-color: #bbbbbb;
    }

    /* Make circles that indicate the steps of the form: */
    .step {
        height: 15px;
        width: 15px;
        margin: 0 2px;
        background-color: #bbbbbb;
        border: none;
        border-radius: 50%;
        display: inline-block;
        opacity: 0.5;
    }

    .step.active {
        opacity: 1;
    }

    /* Mark the steps that are finished and valid: */
    .step.finish {
        background-color: #4CAF50;
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
                        <form id="regForm" action="{{ route('position.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- One "tab" for each step in the form: -->

                            <div class="tab">
                                <h2>Basic Details:</h2>
                                <hr>
                                <div class="form-group">

                                    <input class="radio_animated" id="edo-ani1" type="checkbox" name="linkedin" checked>Linkiden

                                </div>
                                <div class="form-group">

                                    <input class="radio_animated" id="edo-ani1" type="checkbox" name="clickindia">Clickindia
                                </div>
                                <div class="form-group">

                                    <input class="radio_animated" id="edo-ani1" type="checkbox" name="monster">Monster

                                </div>
                                <div class="form-group">

                                    <input class="radio_animated" id="edo-ani1" type="checkbox" name="naukri">Naukri

                                </div>
                            </div>
                            <div class="tab">
                                <h2>Basic Information:</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Job Title</label>
                                            <input type="text" class="form-control" name="job_title" placeholder="Job Title" autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Designation</label>
                                            <input type="text" name="designation" class="list-dt form-control" id="designation">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="pay">Expire On</label>
                                            <input type="date" name="expire_on" class="list-dt form-control" id="expire_on">
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="pay">No Of Openings</label>
                                            <input type="number" name="vacancies" class="list-dt form-control" />
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="pay">Salary Min</label>
                                            <input type="number" name="minimum_salary" class="form-control" placeholder="350000" />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="pay">Salary Max</label>
                                            <input type="number" name="maximum_salary" class="form-control" placeholder="500000" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="pay">Job Description</label>
                                            <textarea name="job_description" class="form-control" id="job_description" cols="5" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="skills">Required Skills</label>
                                            <input type="text" class="list-dt form-control" name="skills" placeholder="e.g. Angular, Laravel, Java etc." />
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Company</label>
                                            <select name="company_id" class="list-dt form-control" id="company_id">
                                                <option value="">Select Client</option>
                                                @if(count($companies))
                                                @foreach($companies as $company)
                                                <option value="{{$company->id}}">
                                                    {{ isset($company->name)?$company->name:'' }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Company Url</label>
                                            <input type="text" class="list-dt form-control" name="company_url" placeholder="e.g. white-force.com" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Job Apply URL</label>
                                            <input type="text" class="list-dt form-control" name="apply_button_url" placeholder="e.g. white-force.com/job-description/MjM0" />
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Company Location</label>
                                            <input type="text" class="list-dt form-control" name="company_location" placeholder="" />
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="pay">Company Description</label>
                                            <textarea type="text" class="form-control" cols="5" rows="3" name="company_description" placeholder="" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="pay">Other Details</label>
                                            <textarea type="text" class="form-control" cols="5" rows="2" name="other" placeholder="" autocomplete="off"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab">
                                <h2>Publisher Customize</h2>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Job Category</label>
                                            <select name="click_india_job_category" class="list-dt form-control" id="click_india_job_category">
                                                @if(count($clickIndiaJobCategory))
                                                @foreach($clickIndiaJobCategory as $jobcategory)
                                                <option value="{{ $jobcategory->id }}">
                                                    {{ isset($jobcategory->category_name)?$jobcategory->category_name:'' }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Job City</label>
                                            <select name="click_india_city_id" class="list-dt form-control" id="click_india_city_id">
                                                @if(count($clickIndiaCity))
                                                @foreach($clickIndiaCity as $jobcity)
                                                <option value="{{ $jobcity->id }}">
                                                    {{ isset($jobcity->city_name)?$jobcity->city_name:'' }}
                                                </option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Qualification</label>
                                            <select name="click_india_minimum_qualification" class="list-dt form-control" id="click_india_minimum_qualification">
                                                <option value="< 10th">Below 10th</option>
                                                <option value="10th">10th</option>
                                                <option value="12th">12th</option>
                                                <option value="Diploma">Diploma</option>
                                                <option value="Bachelors" selected>Bachelors</option>
                                                <option value="Masters">Masters</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Minimum Experience:</label>
                                            <select name="click_india_minimum_experience" class="list-dt form-control" id="click_india_minimum_experience">
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
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Job Type</label>
                                            <select name="job_type" class="list-dt form-control" id="job_type">
                                                <option value="Full time jobs">Full time jobs
                                                </option>
                                                <option value="Part time jobs">Part time jobs</option>
                                                <option value="Work from home jobs">Work from home jobs</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="pay">Salary Type</label>
                                            <select name="salary_type" class="list-dt form-control" id="salary_type">
                                                <option value="Per Annum">Per Annum</option>
                                                <option value="Per Hour">Per Hour</option>
                                                <option value="Per Day">Per Day</option>
                                                <option value="Per Week">Per Week</option>
                                                <option value="Per Month">Per Month</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="pay">Working Day</label>
                                            <div class="row">
                                                <div class="col-1">
                                                    Mon <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Mon" checked>
                                                </div>
                                                <div class="col-1">
                                                    Tue <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Tue" checked>
                                                </div>
                                                <div class="col-1">
                                                    Wed <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Wed" checked>
                                                </div>
                                                <div class="col-1">
                                                    Thu <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Thu" checked>
                                                </div>
                                                <div class="col-1">
                                                    Fri <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Fri" checked>
                                                </div>
                                                <div class="col-1">
                                                    Sat <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Sat">
                                                </div>
                                                <div class="col-1">
                                                    Sun <input type="checkbox" name="click_india_working_days[]" id="click_india_working_days" value="Sun">
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Required Candidate:</label>
                                            <select name="click_india_required_candidate" class="list-dt form-control" id="click_india_required_candidate">
                                                <option value="Male / Female" selected>Male / Female</option>
                                                <option value="Male only">Male only</option>
                                                <option value="Female only">Female only</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="pay">Hiring Process:</label>
                                            <input type="text" class="form-control" name="click_india_hiring_process" id="click_india_hiring_process" placeholder="Telephonic, Walkin,Written test, Group Discussion, Interview" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="overflow:auto;">
                                <div style="float:right;">
                                    <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                                    <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
                                </div>
                            </div>
                            <!-- Circles which indicates the steps of the form: -->
                            <div style="text-align:center;margin-top:40px;">
                                <span class="step"></span>
                                <span class="step"></span>
                                <span class="step"></span>
                            </div>
                        </form>

                        <script>
                            var currentTab = 0; // Current tab is set to be the first tab (0)
                            showTab(currentTab); // Display the current tab

                            function showTab(n) {
                                // This function will display the specified tab of the form...
                                var x = document.getElementsByClassName("tab");
                                x[n].style.display = "block";
                                //... and fix the Previous/Next buttons:
                                if (n == 0) {
                                    document.getElementById("prevBtn").style.display = "none";
                                } else {
                                    document.getElementById("prevBtn").style.display = "inline";
                                }
                                if (n == (x.length - 1)) {
                                    document.getElementById("nextBtn").innerHTML = "Submit";
                                } else {
                                    document.getElementById("nextBtn").innerHTML = "Next";
                                }
                                //... and run a function that will display the correct step indicator:
                                fixStepIndicator(n)
                            }

                            function nextPrev(n) {
                                // This function will figure out which tab to display
                                var x = document.getElementsByClassName("tab");
                                // Exit the function if any field in the current tab is invalid:
                                if (n == 1 && !validateForm()) return false;
                                // Hide the current tab:
                                x[currentTab].style.display = "none";
                                // Increase or decrease the current tab by 1:
                                currentTab = currentTab + n;
                                // if you have reached the end of the form...
                                if (currentTab >= x.length) {
                                    // ... the form gets submitted:
                                    document.getElementById("regForm").submit();
                                    return false;
                                }
                                // Otherwise, display the correct tab:
                                showTab(currentTab);
                            }

                            function validateForm() {
                                // This function deals with validation of the form fields
                                var x, y, i, valid = true;
                                x = document.getElementsByClassName("tab");
                                y = x[currentTab].getElementsByTagName("input");
                                // A loop that checks every input field in the current tab:
                                for (i = 0; i < y.length; i++) {
                                    // If a field is empty...
                                    if (y[i].value == "") {
                                        // add an "invalid" class to the field:
                                        y[i].className += " invalid";
                                        // and set the current valid status to false
                                        valid = false;
                                    }
                                }
                                // If the valid status is true, mark the step as finished and valid:
                                if (valid) {
                                    document.getElementsByClassName("step")[currentTab].className += " finish";
                                }
                                return valid; // return the valid status
                            }

                            function fixStepIndicator(n) {
                                // This function removes the "active" class of all steps...
                                var i, x = document.getElementsByClassName("step");
                                for (i = 0; i < x.length; i++) {
                                    x[i].className = x[i].className.replace(" active", "");
                                }
                                //... and adds the "active" class on the current step:
                                x[n].className += " active";
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection