<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="#">
            <img src="{{ asset('cassets/img/logo-ct-dark.png') }}" class="navbar-brand-img" width="26" height="26"
                alt="main_logo" />
            <span class="ms-1 text-sm text-dark">
                App Name
            </span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark" href="../pages/dashboard.html">
                    <i class="material-symbols-rounded opacity-5">dashboard</i>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active bg-gradient-dark text-white" href="../pages/tables.html">
                    <i class="material-symbols-rounded opacity-5">table_view</i>
                    <span class="nav-link-text ms-1">Tables</span>
                </a>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link text-dark"
                    aria-controls="pagesExamples" role="button" aria-expanded="true">
                    <i class="material-symbols-rounded opacity-5">contract</i>
                    <span class="nav-link-text ms-1 ps-1">Pages</span>
                </a>
                <div class="collapse show" id="pagesExamples">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="collapse" aria-expanded="false"
                                href="#vrExamples">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Virtual Reality <b class="caret"></b></span>
                            </a>
                            <div class="collapse" id="vrExamples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="../../pages/pages/vr/vr-default.html">
                                            <span class="sidenav-mini-icon"> V </span>
                                            <span class="sidenav-normal  ms-1  ps-1"> VR Default </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-dark" href="../../pages/pages/vr/vr-info.html">
                                            <span class="sidenav-mini-icon"> V </span>
                                            <span class="sidenav-normal  ms-1  ps-1"> VR Info </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/pricing-page.html">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Pricing Page </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/rtl-page.html">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  ms-1  ps-1"> RTL </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/widgets.html">
                                <span class="sidenav-mini-icon"> W </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Widgets </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/charts.html">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Charts </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/sweet-alerts.html">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Sweet Alerts </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="../../pages/pages/notifications.html">
                                <span class="sidenav-mini-icon"> N </span>
                                <span class="sidenav-normal  ms-1  ps-1"> Notifications </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        @role('superadmin')
            <div class="mx-3">
                <a class="btn btn-outline-dark mt-4 w-100" href="{{ route('pulse') }}" target="_blank">
                    <i class="fas fa-external-link-alt me-2"></i>
                    Laravel Pulse
                </a>
                <a class="btn bg-gradient-dark w-100" href="{{ route('cms.logs') }}" target="_blank">
                    <i class="fas fa-clipboard-list me-2"></i>
                    Laravel Log
                </a>
            </div>
        @endrole
    </div>
</aside>
