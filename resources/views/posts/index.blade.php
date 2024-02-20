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
        <div>
            <form action="/posts/search" method='GET'>
                @csrf
                <input type="text" name="keyword"/>
                <input type="submit" value="検索"/>
            </form>
        </div>
        
        <h1>ログインユーザー:{{Auth::user()->name}}</h1>
        <h1>Blog Name</h1>
        <a href="/posts/create">create</a>
        <div class='posts'>
            @foreach($posts as $post)
            <div class='post'>
                <a href="/posts/{{$post->id}}"><h2 class='title'>{{ $post->title }}</h2></a>
                <a href="/categories/{{$post->category->id}}">{{$post->category->name}}</a>
                <p class='body'>{{ $post->body }}</p>
                <form action="/posts/{{$post->id}}" id="form_{{$post->id}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="deletePost({{$post->id}})">delete</button>
                </form>
            </div>
            @endforeach
            <div>
            @foreach($questions as $question)
            <diV>
              <a href="https://teratail.com/questions/{{$question['id']}}">
                {{$question['title']}}
              </a>
            </diV>
            @endforeach
            </div>
        </div>
        <div class='flex'>
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
