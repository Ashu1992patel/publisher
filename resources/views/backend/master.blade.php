<!DOCTYPE html>
<html lang="en">

<head>
    @include('backend.common.head')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

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

            <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

            <script>
                $(document).ready(function() {
                    $('.js-example-basic-single').select2();
                });

                $(document).ready(function() {
                    $('.js-example-basic-multiple').select2();
                });
            </script>

</body>

</html>