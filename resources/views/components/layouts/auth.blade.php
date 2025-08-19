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
</head>
<body class="">
    <main class="main-content  mt-0">
        <section>
            <div class="page-header min-vh-100">
                <div class="container">
                    {{ $slot }}
                </div>
            </div>
        </section>
    </main>
</body>
</html>
