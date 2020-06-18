@extends('backend.master')
@section('title', 'Companies')
@section('body')

<style>
    small {
        color: red;
    }
</style>
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
                        <h3>Companies
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
                        <li class="breadcrumb-item active">
                            <a href="{{ url('/companiess') }}">
                                Companies
                            </a>
                        </li>
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
                    <div class="card-header">
                        <h5>Add Company</h5>
                        <div class="card-header-right">
                            <a href="{{ url('companiess/') }}" class="badge badge-sm badge-info">Companies</a>
                            <!-- <ul class="list-unstyled card-option">
                                <li>
                                    <i class="icofont icofont-simple-left"></i>
                                </li>
                                <li>
                                    <i class="view-html fa fa-code"></i>
                                </li>
                                <li>
                                    <i class="icofont icofont-maximize full-card"></i>
                                </li>
                                <li>
                                    <i class="icofont icofont-minus minimize-card"></i>
                                </li>
                                <li>
                                    <i class="icofont icofont-refresh reload-card"></i>
                                </li>
                                <li>
                                    <i class="icofont icofont-error close-card"></i>
                                </li>
                            </ul> -->
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="regForm" action="{{ route('companiess.store') }}" method="post" enctype="multipart/form-data">
                            @csrf

                            <!-- One "tab" for each step in the form: -->

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pay">Company Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Company Name" autocomplete="off" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pay">Website URL</label>
                                        <input type="url" name="website" class="list-dt form-control" id="website" placeholder="e.g. white-force.com" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pay">Type</label>
                                        <input type="text" class="list-dt form-control" name="type" />
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="pay">Upload Company Logo</label>
                                        <input type="file" class="list-dt form-control" name="image" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="pay">Company Address</label>
                                        <input type="text" class="list-dt form-control" name="address" required id="address" />
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="pay">About Company</label>
                                        <textarea name="about" class="form-control" id="about" cols="5" rows="3" required></textarea>
                                    </div>
                                </div>

                                <div class="col-sm-6 offset-5">
                                    <div class="form-group">
                                        <label class="pay">&nbsp;</label>
                                        <button type="submit" class="btn btn-primary">Save Comapny Details</button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
@endsection