<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::with('user','post')->get();
    }

    public function addComment(Request $request)
    {
        $request->validate([
            'post_id' => 'required',
            'comment' => 'required|max:255',
        ]);

        $userID = Auth::id();
        $postID = $request->post_id;
        $comment = $request->comment;

        Comment::create([
            'user_id' => $userID,
            'post_id' => $postID,
            'content' => $comment,
        ]);

        return true;
    }
}
