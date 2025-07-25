<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AtlasBulletinBoard</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300&family=Oswald:wght@200&display=swap" rel="stylesheet">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body class="all_content">
        <div class="d-flex">
            <div class="sidebar">
                <p></p>
                <a href="{{ route('top.show') }}" class="sidebar_items">
                    <img src="{{ asset('image/home_icon.png') }}" alt="">
                    <span>トップ</span>
                </a>
                <a href="/logout" class="sidebar_items">
                    <img src="{{ asset('image/logout_icon.png') }}" alt="">
                    <span>ログアウト</span>
                </a>
                <a href="{{ route('calendar.general.show',['user_id' => Auth::id()]) }}" class="sidebar_items">
                    <img src="{{ asset('image/calendar_icon.png') }}" alt="">
                    <span>スクール予約</span>
                </a>
                @if(in_array(Auth::user()->role, [1, 2, 3]))
                <a href="{{ route('calendar.admin.show',['user_id' => Auth::id()]) }}" class="sidebar_items">
                    <img src="{{ asset('image/calendar_check_icon.png') }}" alt="">
                    <span>スクール予約確認</span>
                </a>
                <a href="{{ route('calendar.admin.setting',['user_id' => Auth::id()]) }}" class="sidebar_items">
                    <img src="{{ asset('image/calendar_new_icon.png') }}" alt="">
                    <span>スクール枠登録</span>
                </a>
                @endif
                <a href="{{ route('post.show') }}" class="sidebar_items">
                    <img src="{{ asset('image/message_icon.png') }}" alt="">
                    <span>掲示板</span>
                </a>
                <a href="{{ route('user.show') }}" class="sidebar_items">
                    <img src="{{ asset('image/user_icon.png') }}" alt="">
                    <span>ユーザー検索</span>
                </a>
            </div>
            <div class="main-container">
                {{ $slot }}
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="{{ asset('js/bulletin.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/user_search.js') }}" rel="stylesheet"></script>
        <script src="{{ asset('js/calendar.js') }}" rel="stylesheet"></script>
    </body>
</html>
