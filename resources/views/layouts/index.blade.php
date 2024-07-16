<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <x-navbar />
    <div class="page-content">
        <x-sidebar />
        <div class="content-wrapper">
            <x-pageheader :title="$title" :head="$head" :headUrl="$headUrl" :body="$body" />
            <!-- Content area -->
            <div class="content pt-0">
                @yield('content')
            </div>
            <x-footer />
        </div>
    </div>


    <!-- core JS -->
    <script src="{{asset('assets/js/main/jquery.min.js')}}"></script>
    <script src="{{asset('assets/js/main/bootstrap.bundle.min.js')}}"></script>

    <!-- Theme JS files -->
    <script src="{{asset('assets/js/plugins/ui/moment/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/anytime.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/pickadate/picker.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/pickadate/picker.date.js')}}"></script>
    <script src="{{asset('assets/js/plugins/pickers/daterangepicker.js')}}"></script>
    <script src="{{asset('assets/js/demo/select2.js')}}"></script>
    <script src="{{asset('assets/js/app.js')}}"></script>
    <script src="{{asset('assets/js/demo/picker_date.js')}}"></script>

    @stack('script')
</body>

</html>