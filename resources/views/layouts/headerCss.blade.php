<link id="vendorsbundle" rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/vendors.bundle.css')}}">
<link id="appbundle" rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/app.bundle.css')}}">
<link id="myskin" rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/skins/skin-master.css')}}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ url(env('ASSETS_PATH').'/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ url(env('ASSETS_PATH').'/img/favicon/favicon-32x32.png') }}">
<link rel="mask-icon" href="{{ url(env('ASSETS_PATH').'/img/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
<link id="mytheme" rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/themes/cust-theme-4.css')}}">

<!-- sweet alert -->
<link href="{{ url(env('ASSETS_PATH').'/libs/sweetalert2/sweetalert2.min.css') }}" type="text/css" rel="stylesheet">

<link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/datagrid/datatables/datatables.bundle.css') }}">

<!-- page select 2 CSS below -->
<link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/formplugins/select2/select2.bundle.css') }}">

<link rel="stylesheet" media="screen, print" href="{{url(env('ASSETS_PATH').'/css/miscellaneous/fullcalendar/fullcalendar.bundle.css') }}">

<!-- page ssummer note CSS below -->
<link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/libs/summernote-0.9.0-dist/summernote.min.css') }}">

<!-- mediaquery CSS below -->
<link rel="stylesheet" media="screen, print" href="{{ url(env('ASSETS_PATH').'/css/mediaquery.css') }}">

<style>
    /* CSS styles for unread notifications */
    .unread {
        background-color: #f9f9f9; /* Light gray background */
        border-left: 4px solid #007bff; /* Blue left border */
        color: #333; /* Dark text color */
    }

    .unread:hover {
        background-color: #e9ecef; /* Slightly darker gray on hover */
    }
</style>
