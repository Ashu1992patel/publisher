<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.common.head')    
</head>

<body>

    <!-- page-wrapper Start-->
    <div class="page-wrapper">

        <!-- Page Header Start-->
        @include('backend.common.header')
        <!-- Page Header Ends -->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">

            <!-- Page Sidebar Start-->
            @include('backend.common.sidebar')
            <!-- Page Sidebar Ends-->

            @yield('body')

            @include('backend.common.scripts')

</body>

</html>