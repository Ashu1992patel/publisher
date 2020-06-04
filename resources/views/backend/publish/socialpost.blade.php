@extends('backend.master')
@section('title', 'Publisher')
@section('body')

<div class="page-body">

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3>Add Message
                            <small>Publisher Admin panel</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right">
                        <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item">Social Post</li>
                        <li class="breadcrumb-item active">Add Message</li>
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
                        <h5>Add Message</h5>
                    </div>
                    <div class="card-body">
                        <div class="row product-adding">

                            <div class="col-xl-7">
                                <form class="needs-validation add-product-form" novalidate="" action="{{ url('social-group') }}" method="post" enctype="multipart/form-data">
                                    @method('post')
                                    @csrf
                                    <!-- <div class="form">
                                    <div class="form-group mb-3 row">
                                        <label for="validationCustom01" class="col-xl-3 col-sm-4 mb-0">Title :</label>
                                        <input class="form-control col-xl-8 col-sm-7" id="validationCustom01" type="text" required="">
                                        <div class="valid-feedback">Looks good!</div>
                                    </div>
                            </div> -->

                                    <div class="form">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4">Add Description :</label>
                                            <div class="col-xl-8 col-sm-7 pl-0 description-sm">
                                                <textarea class="form-control" id="validationCustom01" name="message" cols="95" rows="4" required="">{{ session('token') }}</textarea>
                                                <!-- id="editor1" -->
                                            </div>
                                            <div class="valid-feedback">Looks good!</div>
                                        </div>
                                    </div>
                                    <div class="form">
                                        <div class="form-group row">
                                            <label class="col-xl-3 col-sm-4">Select Social Media :</label>
                                            <div class="col-sm-2 pl-0 description-sm">
                                                <label class="d-block" for="chk-ani1">
                                                    <input class="checkbox_animated" name="media[]" id="chk-ani1" type="checkbox" value="facebook" checked>

                                                    <!-- <a href="{{ url('redirect/facebook') }}" target="_blank">
                                                        Facebook
                                                    </a> -->
                                                    <a href="{{ $facebook_url }}" target="_blank">
                                                        <!-- <a href="{{ url('redirect/facebook') }}" target="_blank"> -->
                                                        Facebook
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 pl-0 description-sm">
                                                <label class="d-block mb-0" for="chk-ani3">
                                                    <input class="checkbox_animated" name="media[]" id="chk-ani3" value="linkedin" type="checkbox">
                                                    <a href="{{ $linkedin_url }}" target="_blank">
                                                        LinkedIn
                                                    </a>
                                                </label>
                                            </div>
                                            <div class="col-sm-2 pl-0 description-sm">
                                                <label class="d-block" for="chk-ani2">
                                                    <input class="checkbox_animated" name="media[]" id="chk-ani2" value="instagram" type="checkbox">
                                                    Instagram
                                                </label>
                                            </div>
                                            <div class="col-sm-2 pl-0 description-sm">
                                                <label class="d-block" for="chk-ani">
                                                    <input class="checkbox_animated" name="media[]" id="chk-ani" value="twitter" type="checkbox">
                                                    Twitter
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="offset-xl-3 offset-sm-4">
                                        <button type="submit" class="btn btn-primary">
                                            Send
                                        </button>
                                        <button type="button" class="btn btn-light">
                                            Discard
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>

@endsection