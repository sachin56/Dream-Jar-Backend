<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>
        @yield('title') - DREAM JAR
    </title>
    <meta name="description" content="Analytics Dashboard">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts/headerCss') {{-- Presumed to load necessary base CSS --}}
    @yield('headerStyle')
    <style>
        .parsley-errors-list {
            color: red;
            font-size: 0.9em;
            list-style-type: none;
            padding-left: 0;
            margin-top: 5px;
        }

        /* --- Side-notification-popup CSS --- */
        .side-notification-popup {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 350px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            z-index: 10500;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            opacity: 0; /* Initially hidden */
            transform: translateY(20px);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;
            /* pointer-events: none; /* Add this if you want clicks to pass through when hidden */
        }

        .side-notification-popup.show {
            opacity: 1;
            transform: translateY(0);
            /* pointer-events: auto; /* Restore clickability when shown */
        }

        .side-notification-header {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #0056b3;
        }

        .side-notification-title {
            margin: 0;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .close-side-notification {
            background: none;
            border: none;
            color: white;
            font-size: 1.5rem;
            line-height: 1;
            cursor: pointer;
            opacity: 0.7;
            transition: opacity 0.2s;
        }

        .close-side-notification:hover {
            opacity: 1;
        }

        .side-notification-body {
            padding: 15px;
            flex-grow: 1;
            overflow-y: auto;
            max-height: 200px;
        }

        .side-notification-item {
            padding: 10px;
            margin-bottom: 8px;
            border-radius: 5px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        .side-notification-item:last-child {
            margin-bottom: 0;
        }

        .side-notification-item .title {
            font-weight: bold;
            color: #333;
            margin-bottom: 5px;
        }

        .side-notification-item .message {
            font-size: 0.9em;
            color: #555;
        }

        .side-notification-footer {
            padding: 10px 15px;
            background-color: #f1f1f1;
            border-top: 1px solid #e0e0e0;
            text-align: right;
        }

        /* Add these styles to your existing side-notification-popup CSS */

        .side-notification-popup {
            /* ... your other styles like position, bottom, right, etc. ... */
            opacity: 0; /* Initially hidden */
            transform: translateY(20px);
            transition: opacity 0.3s ease-out, transform 0.3s ease-out;

            /* --- ADD THIS LINE --- */
            /* This makes the invisible element not intercept mouse clicks */
            pointer-events: none; 
        }

        .side-notification-popup.show {
            opacity: 1;
            transform: translateY(0);

            /* --- ADD THIS LINE --- */
            /* This restores clickability when the popup is visible */
            pointer-events: auto;
        }
        /* --- End of side-notification-popup CSS --- */
    </style>
</head>
<body class="mod-bg-1 mod-nav-link">
    {{-- Your existing page structure --}}
    @include('layouts/partials/page-setting-script')

    <div class="page-wrapper">
        <div class="page-inner">
            @include('layouts/partials/sidebar')
              <div id="preloader">
                <div class="spinner"></div>
            </div>
            <div class="page-content-wrapper">
                @include('layouts/partials/header') {{-- Ensure header contains #new_order_count and .header-icon --}}
                @yield('content')
                @include('layouts/partials/footer')
                @include('layouts/partials/dialog-modal') {{-- Ensure this contains #allNotificationsModal --}}
                @include('layouts/partials/color-profile')
            </div>
        </div>
    </div>

    @include('layouts/partials/bottom-setting')
    @include('layouts/footerJs') {{-- Ensure jQuery, SweetAlert2, Laravel Echo are loaded here --}}

    @yield('footerScript')

    {{-- The Side Notification Popup HTML (ensure no inline style="display:none;") --}}
    <div id="sideNotificationPopup" class="side-notification-popup">
        <div class="side-notification-header">
            <h5 class="side-notification-title">New Notification!</h5>
            <button type="button" class="close-side-notification" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="side-notification-body">
            {{-- Notification items will be injected here by JavaScript --}}
        </div>
        {{-- <div class="side-notification-footer">
            <a href="#" id="viewAllInPopup" class="btn btn-sm btn-link text-primary">View All</a>
        </div> --}}
    </div>

    {{-- This is where the main script will go --}}


</body>
</html>