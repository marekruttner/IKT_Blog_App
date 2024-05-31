<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'body' => 'required',
            'post_id' => 'required|exists:posts,id',
        ]);

        $comment = new Comment();
        $comment->body = $request->body;
        $comment->user_id = Auth::id();
        $comment->post_id = $request->post_id;
        $comment->save();

        return redirect()->route('posts.show', $request->post_id);
    }
}
