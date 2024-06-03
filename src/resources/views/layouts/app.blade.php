<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Atte</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">

    @yield('css')
</head>

<body>
    <div class="wrapper">
        <header>
            <h1 class="header-ttl">Atte</h1>
            @if (Auth::check())
                <nav class="header-nav">
                    <ul class="header-nav-list">
                        <li class="header-nav-item">
                            <a href="/">ホーム</a>
                        </li>
                        <li class="header-nav-item">
                            <a href="/attendance">日付一覧</a>

                        </li>
                        <li class="header-nav-item">
                            <form action="/logout" method="POST">
                                @csrf
                                <button>ログアウト</button>
                            </form>
                        </li>
                    </ul>
                </nav>
            @endif
        </header>
        <main>
            <div class="content">
                @yield('content')
            </div>
        </main>
    </div>
    <footer>
        <p>Atte, inc.</p>
    </footer>
</body>

</html>
