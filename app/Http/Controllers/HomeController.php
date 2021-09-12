<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());
        if($user->hasRole('Admin'))
            return view('admin');
        $userPosts = (new PostController())->index();
        $postComments = (new CommentController())->index();
        return view('dashboard',compact('userPosts','postComments'));
    }
}
