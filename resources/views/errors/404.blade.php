<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
    <title>404 Halaman</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="{{ asset('/assets/css/error.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="cardy">
            <div class="cardy-body text-center">
                <p class="seblak">404</p>
                <p class="cardy-text">
                    <p class="lalalala">Maaf ya! Halaman yang kamu mau tidak bisa kami temukan</p><br>
                    <a href="{{ route('landing.page.index') }}" class="button-selengkapnya">Home</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
