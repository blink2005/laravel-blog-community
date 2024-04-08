<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog Project</title>
</head>
<body>
    <h1>Профиль пользователя {{ $username }}</h1>
    @if ($statusAccountIsMain)
        <a href="{{ route('post.create', ['username' => $username]) }}">Создать пост</a>
        <br>
    @endif
        <a href="{{ route('welcome') }}">Главная</a>
        <hr>
    @foreach ($posts as $post)
        <h1>{{ $post->title }}</h1>
        <p>{{ $post->text }}</p>
        @if ($statusAccountIsMain)
            <a href="{{ route('post.destroy', ['username' => $username, 'id' => $post->id]) }}">Удалить пост</a>
            <br>
            <a href="{{ route('post.edit', ['username' => $username, 'id' => $post->id]) }}">Редактировать пост</a>
        @endif
        <hr>
    @endforeach
</body>
</html>