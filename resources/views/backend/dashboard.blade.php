@extends('backend.master')
@section('title', 'Publisher Admin Dashboard')
@section('body')

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
                        <h5>Empolyee Status</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="icofont icofont-simple-left"></i></li>
                                <li><i class="view-html fa fa-code"></i></li>
                                <li><i class="icofont icofont-maximize full-card"></i></li>
                                <li><i class="icofont icofont-minus minimize-card"></i></li>
                                <li><i class="icofont icofont-refresh reload-card"></i></li>
                                <li><i class="icofont icofont-error close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-status table-responsive products-table">
                            <table class="table table-bordernone mb-0">
                                <thead>
                                    <tr>
                                        <!-- <th scope="col">Name</th>
                                        <th scope="col">Designation</th>
                                        <th scope="col">Skill Level</th>
                                        <th scope="col">Experience</th> -->
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
                        </div>
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
        function getConfirmed(job_title, id) {
            if (confirm('Are you want to delete this position ??')) {
                $('.form'.id).submit();
            } else {

            }
        }
    </script>


</div>

@endsection