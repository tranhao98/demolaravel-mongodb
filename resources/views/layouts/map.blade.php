<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Map</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        #info {
            display: block;
            position: absolute;
            margin: 0px auto;
            width: 30%;
            padding: 5px;
            top: 0;
            left: 450px;
            border: none;
            border-radius: 3px;
            font-size: 12px;
            text-align: center;
            color: #222;
            background-color: rgba(255, 255, 255, 0.5);
        }

        #back {
            position: absolute;
            top: 0;
            left: 0;
            width: 8%;
            background-color: rgba(255, 255, 255, 0.5);
            color: white;
        }

        body {
            color: #404040;
            font: 400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        h1 {
            font-size: 22px;
            margin: 0;
            font-weight: 400;
            line-height: 20px;
            padding: 20px 2px;
            text-align: center
        }

        a {
            color: #404040;
            text-decoration: none;
        }

        a:hover {
            color: #101010;
        }

        /* The page is split between map and sidebar - the sidebar gets 1/3, map
  gets 2/3 of the page. You can adjust this to your personal liking. */
        .sidebar {
            position: absolute;
            width: 33.3333%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            border-right: 1px solid rgba(0, 0, 0, 0.25);
        }

        .map {
            position: absolute;
            left: 33.3333%;
            width: 66.6666%;
            top: 0;
            bottom: 0;
        }

        .heading {
            background: #fff;
            border-bottom: 1px solid #eee;
            height: 60px;
            line-height: 60px;
            padding: 0 10px;
        }

        .listings {
            height: 100%;
            overflow: auto;
            padding-bottom: 60px;
        }

        .listings .item {
            display: block;
            border-bottom: 1px solid #eee;
            padding: 10px;
            text-decoration: none;
        }

        .listings .item:last-child {
            border-bottom: none;
        }

        .listings .item .title {
            display: block;
            color: #00853e;
            font-weight: 700;
        }

        .listings .item .title small {
            font-weight: 400;
        }

        .listings .item.active .title,
        .listings .item .title:hover {
            color: #8cc63f;
        }

        .listings .item.active {
            background-color: #f8f8f8;
        }

        ::-webkit-scrollbar {
            width: 3px;
            height: 3px;
            border-left: 0;
            background: rgba(0, 0, 0, 0.1);
        }

        ::-webkit-scrollbar-track {
            background: none;
        }

        ::-webkit-scrollbar-thumb {
            background: #00853e;
            border-radius: 0;
        }

        .clearfix {
            display: block;
        }

        .clearfix::after {
            content: '.';
            display: block;
            height: 0;
            clear: both;
            visibility: hidden;
        }

        .mapboxgl-popup-close-button {
            display: none;
        }

        .mapboxgl-popup-content {
            font: 400 15px/22px 'Source Sans Pro', 'Helvetica Neue', Sans-serif;
            padding: 0;
            width: 230px;
        }

        .mapboxgl-popup-content-wrapper {
            padding: 1%;
        }

        .mapboxgl-popup-content h3 {
            background: #dd3f23;
            color: #fff;
            margin: 0;
            display: block;
            padding: 10px;
            border-radius: 3px 3px 0 0;
            font-weight: 700;
            margin-top: -15px;
        }

        .mapboxgl-popup-content h4 {
            margin: 0;
            display: block;
            padding: 10px;
            font-weight: 400;
        }

        .mapboxgl-popup-content div {
            padding: 10px;
        }

        .mapboxgl-container .leaflet-marker-icon {
            cursor: pointer;
        }

        .mapboxgl-popup-anchor-top>.mapboxgl-popup-content {
            margin-top: 15px;
        }

        .mapboxgl-popup-anchor-top>.mapboxgl-popup-tip {
            border-bottom-color: #91c949;
        }

        .marker {
            border: none;
            cursor: pointer;
            height: 56px;
            width: 56px;
            background-image: url('images/marker.png');
            background-color: rgba(0, 0, 0, 0);
        }

        .mapboxgl-popup {
            padding-bottom: 50px;
        }

    </style>
    <div class='sidebar'>
        <div class='heading'>
            <h1>Our branches</h1>
        </div>
        <div id='listings' class='listings'></div>
    </div>
    <div id="app">
        @yield('content')
    </div>
    <pre id="info"></pre>
    <a href="/home" id="back" class="btn"><i class="fa fa-arrow-circle-left"
            style="font-size:24px; color: black;"></i></a>


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.5.1.slim.min.js') }}" defer></script>
</body>

</html>
