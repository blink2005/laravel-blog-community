<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Project</title>
</head>
<body>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <h1>{{ $error }}</h1>
        @endforeach
    @else
        <h1>Вход в аккаунт</h1>
    @endif
    <a href="{{ route('welcome') }}">Главная</a>
    <hr>
    <form action="{{ route('login.store') }}", method="POST">
        @csrf
        <p>Username: <input type="text" name="username" required></p>
        <p>Password: <input type="password" name="password" required></p>
        <p><input type="submit" value="Войти"></p>
    </form>

</body>
</html>