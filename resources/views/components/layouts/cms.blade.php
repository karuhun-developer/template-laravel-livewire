<!--
=========================================================
* Material Dashboard 3 - v3.2.0
=========================================================

* Product Page: https://www.creative-tim.com/product/material-dashboard
* Copyright 2024 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('cassets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('cassets/img/apple-icon.png') }}">
    <title>
        APP NAME - {{ $title ?? '' }}
    </title>
    <!-- Vendor CSS Files -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{ $styles ?? '' }}
</head>

<body class="g-sidenav-show bg-gray-100" x-data>
    <x-cms.navigation />
    <main class="main-content position-relative border-radius-lg d-flex flex-column min-vh-100">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-3 shadow-none border-radius-xl" id="navbarBlur"
            data-scroll="true">
            <div class="container-fluid py-1 px-3">
                {{ $breadcrumb ?? '' }}
                <x-cms.header />
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-2">
            {{ $slot ?? '' }}
        </div>
        <x-cms.footer />
    </main>
    <x-cms.plugin-settings />
    @livewireScripts
    {{ $scripts ?? '' }}
</body>
</html>
