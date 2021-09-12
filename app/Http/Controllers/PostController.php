<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $userPosts = collect();
        $friends = Auth::user()->friends()->wherePivot('status', USER::FRIEND_REQUEST_STATUS['C'])->get();
        if(!empty($friends)):
          $userPosts =  $friends->map(function ($user) {
                return $user->posts()->with('user')->get();
            });
        endif;
        return $userPosts;
    }

    public function myPosts()
    {
        $userPosts = Auth::user()->posts()->with('user')->get();
        $postComments = (new CommentController())->index();
        return view('my-posts',compact('userPosts','postComments'));
    }

    public function createPost(Request $request)
    {
        $request->validate([
            'post_content' => 'required|max:255',
        ]);

        $content = $request->post_content;

        Post::create([
            'user_id' => Auth::id(),
            'content' => $content,
        ]);

        return redirect()->back();
    }
}
