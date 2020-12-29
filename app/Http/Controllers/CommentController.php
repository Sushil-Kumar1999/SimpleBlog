<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function page(Post $post)
    {
        $post_id = $post->id;
        $comments = Comment::where('post_id', $post_id)
                           ->orderBy('updated_at', 'desc')
                           ->paginate(5);
        //dd($comments);
        return view('comments.page', ['comments' => $comments, 'post' => $post]);
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'profile_id' => 'required|integer',
            'post_id' => 'required|integer'
        ]);

        $comment = new Comment();
        //$comment->body = $request
    }
}
