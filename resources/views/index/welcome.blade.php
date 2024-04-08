<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Project</title>
</head>
<body>
    <h1>Добро пожаловать!</h1>
    @auth
        <a href="{{ route('user.profile', ['username' => Auth::user()->username]) }}">Профиль</a>
        <br>
        <a href="{{ route('user.logout', ['username' => Auth::user()->username]) }}">Выйти</a>
    @endauth
    @guest
        <a href="{{ route('login') }}">Вход</a>
        <br>
        <a href="{{ route('register') }}">Регистрация</a>
    @endguest
    <hr>

</body>
</html>