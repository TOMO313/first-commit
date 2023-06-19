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
       <h1>Blog Name</h1
       <form action="/posts" method="POST">
         @csrf
         <div class="title">
             <h2>Title</h2>
             <input type="text" name="post[title]" placeholder="タイトル"/>
         </div>
         <div class="body">
             <h2>Body</h2>
             <textarea name="post[body]" placeholder="今日も一日お疲れ様でした。"></textarea>
         </div>
         <input type="submit" value="store"/>
       </form>
        <div class ='footer'>
            <a href = "/">戻る</a>
        </div>
    </body>
</html>
