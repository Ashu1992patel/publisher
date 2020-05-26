<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="index.html">
                <img class="blur-up lazyloaded" src="{{ url('/') }}/assets/images/dashboard/happiest-logo.png" alt="" style="height: 80px;">
                <!-- <img class="blur-up lazyloaded" src="https://happiestresume.com/public/front/jobsearch/images/logo1.png" alt="" style="height: 80px;"> -->
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle lazyloaded blur-up" src="{{ url('/')}}/assets/images/dashboard/man.png" alt="#">
            </div>
            <h6 class="mt-3 f-14">Ashish Patel</h6>
            <p>Laravel Developer.</p>
        </div>
        <ul class="sidebar-menu">
            <li>
                <a class="sidebar-header" href="{{ url('home') }}">
                    <i data-feather="home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header {{ \Request::is('position')?'active':'' }}" href="{{ url('position') }}">
                    <i data-feather="user"></i>
                    <span>Post Jobs Position</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="#">
                    <i data-feather="box"></i>
                    <span>Broadcast</span>
                    <i class="fa fa-angle-right pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li>
                        <a href="{{ url('social-group') }}">
                            <i class="fa fa-circle"></i>
                            <span>Social Group</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="{{ url('social-group') }}">
                                    <i class="fa fa-circle"></i>
                                    Facebook
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('social-group') }}">
                                    <i class="fa fa-circle"></i>
                                    LinkedIn
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('social-group') }}">
                                    <i class="fa fa-circle"></i>
                                    Twitter
                                </a>
                            </li>
                            <li>
                                <a href="{{ url('social-group') }}">
                                    <i class="fa fa-circle"></i>
                                    Instgram
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- <li>
                        <a href="#">
                            <i class="fa fa-circle"></i>
                            <span>Digital</span>
                            <i class="fa fa-angle-right pull-right"></i>
                        </a>
                        <ul class="sidebar-submenu">
                            <li>
                                <a href="category-digital.html">
                                    <i class="fa fa-circle"></i>
                                    Category
                                </a>
                            </li>
                        </ul>
                    </li> -->
                </ul>
            </li>
            <!-- <li><a class="sidebar-header" href="reports.html"><i data-feather="bar-chart"></i><span>Reports</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="settings"></i><span>Settings</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="profile.html"><i class="fa fa-circle"></i>Profile</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href="invoice.html"><i data-feather="archive"></i><span>Invoice</span></a>
            </li> -->
        </ul>
    </div>
</div>