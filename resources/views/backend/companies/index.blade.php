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
            <div class="col-xl-6 xl-100">
                <div class="card height-equal" style="min-height: 520px;">
                    <div class="card-header">
                        <h5>Companies</h5>
                        <div class="card-header-right">
                            <a href="{{ url('companiess/create') }}" class="badge badge-sm badge-info">Add New Company</a>
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
                        <div class="user-status table-responsive products-table">
                            <table class="table table-bordernone mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">S.No.</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($companies->count())
                                    @foreach($companies as $key => $company)
                                    <tr>
                                        <td class="bd-t-none u-s-tb">
                                            <div class="align-middle image-sm-size">
                                                @if(isset($company->image) and file_exists($company->image))
                                                <img class="" style="max-width: 80px;" src="{{ url($company->image) }}" alt="" data-original-title="" title="{{ isset($company->name)?$company->name:'' }}">
                                                @else
                                                <img class="max-width: 80px;" src="{{ url('assets/images/dashboard/default.png') }}" alt="" data-original-title="" title="">
                                                @endif
                                                <!-- img-radius align-top m-r-15 rounded-circle blur-up lazyloaded -->

                                                <div class="d-inline-block">
                                                    <h6>
                                                        <a href="{{ url($company->website) }}" target="_blank">
                                                            {{ isset($company->name)?$company->name:'' }}
                                                        </a>
                                                        <span class="text-muted digits">

                                                        </span>
                                                    </h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="width: 50px;">
                                            <label for="" class="badge badge-sm badge-info">{{ ++$key }}</label>
                                        </td>
                                        <td class="font-secondary">
                                            {{ $company->is_active?'Active':'In-Active' }}
                                        </td>
                                        <td>
                                            <small>
                                                {{ \Carbon\Carbon::parse($company->updated_at)->format('d-M-Y h:i:s') }}
                                            </small>
                                        </td>
                                        <td class="digits">
                                            <div>
                                                <a href="{{ url('companiess/'.$company->id) }}" class="badge badge-sm badge-success">
                                                    Show
                                                </a>
                                                <a href="{{ url('companiess/'.$company->id.'/edit') }}" class="badge badge-sm badge-info">
                                                    Edit
                                                </a>

                                                <a class="badge badge-sm badge-primary" href="javascript:void(0);" onclick='company_destroy("{{ $company->id }}");'>
                                                    Delete
                                                </a>
                                                <form id="form{{ $company->id }}" action="{{ url('companiess/'.$company->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="badge badge-sm badge-primary">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                        <td style="width: 50px;">

                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<script>
    function company_destroy(id) {
        event.preventDefault();
        if (confirm('Are You Sure, You Want To Delete ??')) {
            document.getElementById('form' +
                id).submit();
        }
    }
</script>
@endsection