<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use App\Models\Review;

class PostController extends Controller
{
 public function index(Post $post)
  {
     $client=new \GuzzleHttp\Client();
     
     $url='https://teratail.com/api/v1/questions';
     
     $response=$client->request(
          'GET',
           $url,
           ['Bearer'=>config('servises.teratail.token')]
      );
      
      $questions=json_decode($response->getBody(), true);
     
      return view('posts/index')->with([
          'posts' => $post->getPaginateByLimit(3),
          'questions' =>$questions['questions'],
      ]);
  }
  
  public function search(Request $request)
  {
   if(isset($request->keyword)){
    $posts = Post::where('title', 'LIKE', "%$request->keyword%")->get();
   }
   return view('posts/search')->with(['posts' => $posts]);
  }
  
  public function show(Post $post)
  {
     return view('posts/show')->with(['post' => $post]);
  }
  
  public function create(Category $category)
  {
    return view('posts/create')-> with(['categories'=>$category->get()]);
  }
  
  public function store(PostRequest $request, Post $post)
  {
     $input = $request['post'];
     $post->fill($input)->save();
     return redirect('/posts/'. $post->id);
  }
  
  public function edit(Post $post)
  {
     return view('posts/edit')->with(['post'=>$post]);
  }
  
  public function update(PostRequest $request, Post $post)
  {
     $input_post = $request['post'];
     $post->fill($input_post)->save();
     return redirect('/posts/'. $post->id);
  }
  
  public function delete(Post $post)
  {
     $post->delete();
     return redirect('/');
  }
  
  /*public function list()
  {
     return Post::with('reviews.user')->get();
  }
  
  public function review(Request $request){
     $result = false;
     $request->validate([
      'post_id'=>[
       'required',
       'exists:posts,id',
       function($attribute, $value, $fail) use($request){
        if(!auth()->check()){
         $fail('レビューするにはログインしてください。');
         return;
        }
        
        $exists = Review::where('user_id', $request->user()->id)
        ->where('post_id', $request->post_id)
        ->exists();
        if($exists){
         $fail('すでにレビューは投稿済みです。');
         return;
        }
       }
       ],
       'stars'=>'required|integer|min:1|max:5',
      ]);
      
      $review = new Review();
      $review->post_id = $request->post_id;
      $review->user_id = $request->user()->id;
      $review->stars = $request->stars;
      $result = $review->save();
      return view('posts/index')->with(['result'=>$result]);
  }*/
}
