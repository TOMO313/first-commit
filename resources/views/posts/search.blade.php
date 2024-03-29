<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
       
        <title>Blog</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        
    </head>
    <body class="antialiased">
        @foreach($posts as $post)
        <h1 class = 'title'>
            {{ $post->title }}
        </h1>
        <div class='content'>
            <div class='content_post'>
                <h3>本文</h3>
                <p class='body'>{{ $post->body }}</p>
            </div>
        </div>
        <a href="/categories/{{$post->category->id}}">{{$post->category->name}}</a>
        <div class ='edit'>
            <a href = "/posts/{{$post->id}}/edit">edit</a>
        </div>
        @endforeach
        <div class ='footer'>
            <a href = "/">戻る</a>
        </div>
    </body>
</html>
