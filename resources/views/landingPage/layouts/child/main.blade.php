<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
    <title>{{ $title }}</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
	{{-- <link href="../css/style.css" rel="stylesheet"> --}}
	<link href="{{ asset('/assets/css/landingPage/landingPage.css') }}" rel="stylesheet">
</head>
<body>
    <section class="siyongmai">
		<div class="cincau">
			<img class="mangga" src="{{ asset('/assets/images/landingPage/AAA.svg') }}">
		</div>
		<div class="apel">
			<h1 class="kucingggg fs-2 pt-4">{{ $title }}</h1>
			<p class="meonggg fs-6 text-center">{{ $subTitle }}</p>
		</div>
	</section>
    @yield('content')
    {{-- footer --}}
    @include('landingPage.components.footer')
</body>
</html>
