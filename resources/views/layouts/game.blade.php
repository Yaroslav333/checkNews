<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <meta property="og:url"           content="https://dev-check-news.herokuapp.com" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Check News" />
    <meta property="og:description"   content="You can put whatever text you like here" />
    <meta property="fb:app_id" content="2024479127801150"/>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">



    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CheckNews</title>

    <!-- Styles -->
    <link rel="icon" type="image/png" href="https://scontent.fhrk2-1.fna.fbcdn.net/v/t1.0-1/p50x50/11013362_1819892258235113_4920060360726235962_n.png?oh=60d18a026846a77e356266f8d0ce0d7c&amp;oe=5ABC5DD9" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">

</head>
<body>
<div id="app">
    <nav class="admin-nav">
        <div class="nav-wrapper">
            <a href="/">
                <img class="logo" src="https://scontent.fhrk2-1.fna.fbcdn.net/v/t1.0-1/p50x50/11013362_1819892258235113_4920060360726235962_n.png?oh=60d18a026846a77e356266f8d0ce0d7c&amp;oe=5ABC5DD9" alt="" aria-label="Громадське Харків Hromadske.kh" role="img">
            </a>

            <a href="#" class="brand-logo center game-counter"></a>
            {{--<ul class="right hide-on-med-and-down nav-items">
                <li><a href="/admin/news"><span>Управление новостями</span></a></li>
                <li><a href="/admin/users"><span>Управление пользователями</span></a></li>
                <li>
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        Выход
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>--}}
        </div>
    </nav>

    @yield('content')
</div>


<!-- Scripts -->
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="{{ asset('js/libs/material/materialize.min.js') }}"></script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('js/game.js') }}"></script>
<script src="https://unpkg.com/draggabilly@2/dist/draggabilly.pkgd.min.js"></script>
<script type="text/javascript" src="//connect.facebook.net/en_US/sdk.js"></script>
</body>
</html>