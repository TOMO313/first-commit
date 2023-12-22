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
        <x-app-layout>
            <x-slot name="header">
                
            </x-slot>
        <h1>Blog Name</h1>
        <a href="/posts/create">create</a>
        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <a href="/posts/{{$post->id}}"><h2 class='title'>{{ $post->title }}</h2></a>
                <a href="">{{$post->category->name}}</a>
                <p class='body'>{{ $post->body }}</p>
                <form action="/posts/{{$post->id}}" id="form_{{$post->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{$post->id}})">delete</button>
                </form>
            </div>
            @endforeach
        </div>
        <div class='footer'>
            <a href="/">戻る</a>
        </div>
        <div class='Paginate'>
            {{ $posts->links() }}
        </div> 
        <script>
            function deletePost(id)
            {
                'use strict'
                
                if(confirm('削除すると復元できません。\n本当に削除しますか?')){
                    document.getElementById(`form_${id}`).submit();
                }
            }
        </script>
        </x-app-layout>
    </body>
</html>
