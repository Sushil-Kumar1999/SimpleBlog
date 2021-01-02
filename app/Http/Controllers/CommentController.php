<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function page(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)
                           ->orderBy('updated_at', 'desc')
                           ->paginate(5);

        return view('comments.page', ['comments' => $comments, 'post' => $post]);
    }

    public function apiGet(Post $post)
    {
        $comments = Comment::with('profile.user')
                           ->where('post_id', $post->id)
                           ->orderBy('updated_at', 'desc')->get();
                           //->paginate(5);

        return $comments;
    }

    public function apiStore(Request $request)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'profile_id' => 'required|integer',
            'post_id' => 'required|integer'
        ]);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->profile_id =$validatedData['profile_id'];
        $comment->post_id = $validatedData['post_id'];
        $comment->save();

        $new_comment = Comment::with('profile.user')->find($comment->id);
        return $new_comment;
    }

    public function edit(Comment $comment)
    {
        return view('comments.edit', ['comment' => $comment]);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'body' => 'required',
        ]);

        $comment = Comment::find($id);
        $comment->body = $validatedData['body'];
        $comment->save();

        session()->flash('comment updated', 'Comment updated successfully');

        return redirect()->route('posts.show', $comment->post_id);
    }
}
