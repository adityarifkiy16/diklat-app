<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- icons -->
    <link rel="stylesheet" href="{{ asset('assets/css/icons/fontawesome/styles.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/icons/icomoon/styles.min.css') }}">

    <!-- Global sheets -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap_limitless.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layout.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/colors.min.css') }}">

    <!-- animate css -->
    <link rel="stylesheet" href="{{ asset('assets/css/extras/animate.min.css') }}">

</head>

<body>
    <x-navbar />
    <div class="page-content">
        <x-sidebar />
        <div class="content-wrapper">
            <x-page-header />
            <!-- Content area -->
            <div class="content pt-0">
                <!-- Inner container -->
                <div class="d-flex align-items-center flex-column flex-md-row">
                    @yield('content')
                </div>
            </div>
            <x-footer />
        </div>
    </div>


    <!-- core JS -->
    <script src="{{asset('assets/js/main/jquery.min.js')}}"></script>t
    <script src="{{asset('assets/js/main/bootstrap.bundle.min.js')}}"></script>t
    @stack('script')
</body>

</html>