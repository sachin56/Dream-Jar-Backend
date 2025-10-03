<?php
$headerMenuJson =
    '{ "quickShortcutJson":[{"title" : "Services","item1" : "base-2 icon-stack-3x color-primary-600","item2" : "base-3 icon-stack-2x color-primary-700", "item3" : "ni ni-settings icon-stack-1x text-white fs-lg" },{"title" : "Account", "item1" : "base-2 icon-stack-3x color-primary-400","item2" : "base-10 text-white icon-stack-1x", "item3" : "ni md-profile color-primary-800 icon-stack-2x"} ,{"title" : "Security", "item1" : "base-9 icon-stack-3x color-success-400","item2":"base-2 icon-stack-2x color-success-500", "item3" : "ni ni-shield icon-stack-1x text-white" },{ "isSpan" : "true","item1" : "base-18 icon-stack-3x color-info-700", "title" : "Calendar", "spanClass" : "position-absolute pos-top pos-left pos-right color-white fs-md mt-2 fw-400","spanText" : "28" },{"title" : "Stats","item1" : "base-7 icon-stack-3x color-info-500","item2" : "base-7 icon-stack-2x color-info-700", "item3" : "ni ni-graph icon-stack-1x text-white" },{"title" : "Messages","item1" : "base-4 icon-stack-3x color-danger-500","item2" : "base-4 icon-stack-1x color-danger-400", "item3" : "ni ni-envelope icon-stack-1x text-white" },{"title" : "Notes","item1" : "base-4 icon-stack-3x color-fusion-400","item2" : "base-5 icon-stack-2x color-fusion-200", "item3" : "fal fa-keyboard icon-stack-1x color-info-50" },{"title" : "Photos","item1" : "base-16 icon-stack-3x color-fusion-500","item2" : "base-10 icon-stack-1x color-primary-50 opacity-30", "item3" : "fal fa-dot-circle icon-stack-1x text-white opacity-85" },{"title" : "Maps","item1" : "base-19 icon-stack-3x color-primary-400","item2" : "base-7 icon-stack-1x fs-xxl color-primary-200", "item3" : "base-7 icon-stack-1x color-primary-500", "item4" : "fal fa-globe icon-stack-1x text-white opacity-85" },{"title" : "Chat","item1" : "base-5 icon-stack-3x color-success-700 opacity-80","item2" : "base-12 icon-stack-2x color-success-700 opacity-30", "item3" : "fal fa-comment-alt icon-stack-1x text-white" },{"title" : "Phone","item1" : "base-5 icon-stack-3x color-warning-600","item2" : "base-7 icon-stack-2x color-warning-800 opacity-50", "item3" : "fal fa-phone icon-stack-1x text-white" },{"title" : "Projects","item1" : "base-6 icon-stack-3x color-danger-600","item2" : "fal fa-chart-line icon-stack-1x text-white" }] }';

$notificationMenuJson = '{ "notificationJson":[{"liClass" : "unread","avatar" : "/img/demo/avatars/avatar-a.png","title" : "Adison Lee","desc" : "Msed quia non numquam eius","min":"2 minutes ago" },{"liClass" : "","avatar" : "/img/demo/avatars/avatar-b.png","title" : "Oliver Kopyuv","desc" : "Msed quia non numquam eius","min":"3 minutes ago" },{"liClass" : "","avatar" : "/img/demo/avatars/avatar-e.png","title" : "Dr. John Cook PhD","desc" : "Msed quia non numquam eius","min":"2 minutes ago" },{"liClass" : "","avatar" : "/img/demo/avatars/avatar-h.png","title" : "Sarah McBrook","desc" : "Msed quia non numquam eius","min":"3 minutes ago" },{"liClass" : "","avatar" : "/img/demo/avatars/avatar-m.png","title" : "Anothony Bezyeth","desc" : "Msed quia non numquam eius","min":"one minutes ago" },{"liClass" : "","avatar" : "/img/demo/avatars/avatar-j.png","title" : "Lisa Hatchensen","desc" : "Msed quia non numquam eius","min":"one minutes ago" }] }';

$profileJson = '{ "profileList":[{ "isModal" : "true", "dataTarget":".js-modal-settings","i18n" : "drpdwn.settings","icon" : "fal fa-cog","title" : "Settings" },{ "isModal" : "true", "dataTarget":".js-modal-profile","i18n" : "drpdwn.settings","title" : "View Profile" },{ "isDivider" : "true" },{"dataAction":"app-fullscreen","i18n" : "drpdwn.fullscreen","title" : "Fullscreen", "iClass" : "float-right text-muted fw-n", "iText" : "F11" },{"dataAction":"app-print","i18n" : "drpdwn.print","title" : "Print", "iClass" : "float-right text-muted fw-n", "iText" : "Ctrl + P" }] }';
/*$profileJson = '{ "profileList":[{"dataAction":"app-reset","i18n" : "drpdwn.reset_layout","title" : "Reset Layout" },{ "isModal" : "true", "dataTarget":*/
?>
<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative"
            data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ url(env('ASSETS_PATH').'/img/logo.png') }}" alt="CIABOC" aria-roledescription="logo">
            <span class="mr-1 page-logo-text">CIABOC</span>
            <span class="mr-2 text-white opacity-50 position-absolute small pos-top pos-right mt-n2"></span>
            <i class="ml-1 fal fa-angle-down d-inline-block fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    @can('navigation-list')
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden"
            title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify"
                    title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed"
                    title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    @endcan
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu d-block"></i>
        </a>
    </div>
    <div class="ml-auto d-flex">
    <div class="d-flex align-items-center">
        <div class="mr-2 text-dark fw-bold text-right">
            @php
                $roleName = Auth::user()->getRoleNames()->first(); // Assuming only one role
            @endphp

            <div>{{ Auth::user()->name }}</div>
            <small class="text-muted">{{ ucfirst($roleName) }}</small>
        </div>


        <div class="dropdown">
            <a href="#" data-toggle="dropdown" title="{{ Auth::user()->name }}"
                class="header-icon d-flex align-items-center justify-content-center">
                @if (isset(Auth::user()->profile_image))
                    <img src="{{ asset('storage/userprofile/' . Auth::user()->profile_image) }}"
                        class="profile-image rounded-circle"
                        alt="{{ Auth::user()->name }}"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                @else
                    <img src="{{ url(env('ASSETS_PATH') . '/img/profileicon.jpg') }}"
                        class="profile-image rounded-circle"
                        alt="{{ Auth::user()->name }}"
                        style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                @endif
            </a>

            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="flex-row py-4 dropdown-header bg-trans-gradient d-flex rounded-top">
                    <div class="flex-row mt-1 mb-1 d-flex align-items-center color-white">
                        <span class="mr-2">
                            @if (isset(Auth::user()->profile_image))
                                <img src="{{ asset('storage/userprofile/' . Auth::user()->profile_image) }}"
                                    class="profile-image rounded-circle"
                                    alt="{{ Auth::user()->name }}"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @else
                                <img src="{{ url(env('ASSETS_PATH') . '/img/profileicon.jpg') }}"
                                    class="profile-image rounded-circle"
                                    alt="{{ Auth::user()->name }}"
                                    style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%;">
                            @endif
                        </span>
                        <div class="info-card-text">
                            <div class="fs-lg text-truncate text-truncate-lg">
                                {{ ucfirst(Auth::user()->name) }}
                            </div>
                            <span class="text-truncate text-truncate-md opacity-80">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>

                <div class="m-0 dropdown-divider"></div>
                <?php $decodedProfile = json_decode($profileJson);
                    $user = Auth::user();
                    if ($user) {
                        $user->load('role'); 
                    }

                    $newItems = [];

                    if ($user && $user->role) {
                        $role = $user->role;

                        if (!empty($role->user_manual)) {
                            $manualItem = new stdClass();
                            $manualItem->isLink = true;
                            $manualItem->href =  asset('storage/usermanual/' . $role->user_manual);
                            $manualItem->title = 'View User Manual';
                            $newItems[] = $manualItem;
                        }

                        if (!empty($role->video_link)) {
                            $videoItem = new stdClass();
                            $videoItem->isModal = true;
                            $videoItem->dataTarget = '#videoModal';
                            $videoItem->title = 'View Video';
                            $newItems[] = $videoItem;
                        }
                    }

                    if (!empty($newItems)) {
                        array_splice($decodedProfile->profileList, 2, 0, $newItems);
                    }
                ?>
                        
                @foreach ($decodedProfile->profileList as $item)
                    @if (isset($item->isModal) && $item->isModal)
                        <a href="#" class="dropdown-item" data-toggle="modal" data-target="{{ $item->dataTarget }}">
                            <span>{{ $item->title }}</span>
                        </a>
                    @elseif (isset($item->isLink) && $item->isLink)
                        <a href="{{ $item->href }}" class="dropdown-item" target="_blank" rel="noopener noreferrer">
                            <span>{{ $item->title }}</span>
                        </a>
                    @elseif (isset($item->isDivider) && $item->isDivider)
                        <div class="m-0 dropdown-divider"></div>
                    @else
                        <a href="#" class="dropdown-item" data-action="{{ $item->dataAction }}">
                            <span>{{ $item->title }}</span>
                            @if (isset($item->iClass, $item->iText))
                                <i class="{{ $item->iClass }}">{{ $item->iText }}</i>
                            @endif
                        </a>
                    @endif
                @endforeach

                <div class="m-0 dropdown-divider"></div>
                <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </div>
    </div>

        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on"
                data-focus="search-field" title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>
        <div>

            
        </div>
        <!-- app user menu -->
        {{-- The Modal Structure (add this typically at the end of your <body>) --}}
        <div class="modal fade" id="allNotificationsModal" tabindex="-1" aria-labelledby="allNotificationsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="allNotificationsModalLabel">Notification Actions</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p>Choose an action for all your notifications:</p>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary" id="markAllReadBtn">
                                <i class="fal fa-check-double me-2"></i> Mark All As Read
                            </button>
                            <button type="button" class="btn btn-danger" id="deleteAllNotificationsBtn">
                                <i class="fal fa-trash-alt me-2"></i> Delete All Notifications
                            </button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
</header>
<!-- END Page Header -->
