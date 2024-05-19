<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header>
        <h1>Atte</h1>
        @yield('link')
    </header>
    <main>
        <div class="content">
            @yield('content')
        </div>
    </main>
    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>

</html>
