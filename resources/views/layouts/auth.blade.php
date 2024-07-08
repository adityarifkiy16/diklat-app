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

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body>
    <div class="page-content">
        <div class="content-wrapper">
            <!-- Content area -->
            <div class="content pt-0 d-flex justify-content-center align-items-center">
                <!-- Inner container -->
                <div class="d-flex align-items-start flex-column flex-md-row">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

    <!-- core JS -->
    <script src="{{asset('assets/js/main/jquery.min.js')}}"></script>t
    <script src="{{asset('assets/js/main/bootstrap.bundle.min.js')}}"></script>
    @stack('script')
</body>

</html>