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
        <h1>Создание поста</h1>
    @endif
    <a href="{{ route('welcome') }}">Главная</a>
    <hr>
    <form action="{{ route('post.store', ['username' => $username]) }}", method="POST">
        @csrf
        <p>Заголовок: <input type="text" name="title" required></p>
        <p>Текст: <input type="test" name="text" required></p>
        <p><input type="submit" value="Опубликовать"></p>
    </form>
</body>
</html>