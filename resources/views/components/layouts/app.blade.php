<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<title>{{ $title ?? '' }} | CMS</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://unpkg.com/@adminkit/core@latest/dist/css/app.css">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@adminkit/core@latest/dist/js/app.js" data-navigate-once="true"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    {{ $styles ?? '' }}
</head>

<body>
    <div class="wrapper">
        @persist('nav')
            <x-navigation />
        @endpersist

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
