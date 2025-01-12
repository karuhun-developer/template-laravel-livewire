<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<title>{{ $title ?? '' }} | CMS</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <x-styles />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{ $styles ?? '' }}
</head>

<body>
    <div class="wrapper" data-scroll-x="0">
        <x-navigation />

		<div class="main">
            <x-header />

			<main class="content">
                <div class="container-fluid p-0">
                    {{ $slot }}
                </div>
			</main>

			<x-footer />
		</div>
	</div>

    <x-javascript />
    {{ $scripts ?? '' }}
</body>

</html>
