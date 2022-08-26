<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Preskool - Dashboard</title>
    <link rel="shortcut icon" href="{{asset('img/favicon.png')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/fontawesome/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body>
    <div class="main-wrapper">
        @include('layouts.client.header')
        @include('layouts.client.sidebar')
        <div class="page-wrapper">
            <div class="content container-fluid">
                @yield('content')
            </div>
            @include('layouts.client.footer')
        </div>
    </div>
    <script src="{{asset('js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('plugins/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('plugins/apexchart/apexcharts.min.js')}}"></script>
    <script src="{{asset('plugins/apexchart/chart-data.js')}}"></script>
    <script src="{{asset('js/script.js')}}"></script>
</body>

</html>