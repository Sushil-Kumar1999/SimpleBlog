<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use App\Utils\FakeDataGenerator;
use App\Mail\UserCommented;
use Illuminate\Support\Facades\Mail;

class CommentController extends Controller
{
    protected $fakeDataGenerator;

    public function __construct(FakeDataGenerator $fakeDataGenerator)
    {
    	$this->fakeDataGenerator = $fakeDataGenerator;
    }

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

        return $comments;
    }

    public function apiStore(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'body' => 'required',
            'profile_id' => 'required|integer'
        ]);

        $comment = new Comment();
        $comment->body = $validatedData['body'];
        $comment->profile_id = $validatedData['profile_id'];
        $comment->post_id = $post->id;
        $comment->save();

        //Mail::to($comment->post->profile->user->email)->send(new UserCommented($comment));

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

    public function apiGetFake()
    {
	    return $this->fakeDataGenerator->getFakeComment();
    }
}
