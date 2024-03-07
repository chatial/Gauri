<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>House Of Gauri</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,300;0,400;0,700;1,700&display=swap" rel="stylesheet"/>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>

    <!-- My Style -->
    <link rel="stylesheet" href="/css/style.css" />
</head>

<body>
    @include('sweetalert::alert')

    @include('layouts.partials.navbar')
        <div class="content-container">
            <div class="container-fluid">
                @yield('container')
            </div>
        </div>
    @include('layouts.partials.footer')


    <script>
        feather.replace();
    </script>
    <script src="/js/script.js"></script>
</body>
</html>
