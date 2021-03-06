<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;
use App\Utils\FakeDataGenerator;

class PostController extends Controller
{
    protected $fakeDataGenerator;

    public function __construct(FakeDataGenerator $fakeDataGenerator)
    {
    	$this->fakeDataGenerator = $fakeDataGenerator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('updated_at', 'desc')->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|unique:posts|max:100',
            'content' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=200,min_height=150',
            'profile_id' => 'required|integer'
        ]);

        $post = new Post();
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->profile_id = $validatedData['profile_id'];
        $post->save();

        $image = new Image();
        $image->storage_path = $request->file('image')->store('public/images');
        $image->imageable_id = $post->id;
        $image->imageable_type = "App\Models\Post";
        $image->save();

        session()->flash('post created', 'Post created successfully');

        return redirect()->route('posts.index');
    }

    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->user()->cannot('update', Post::find($id))) {
            abort(403);
        }
        $validatedData = $request->validate([
            'title' => 'required|max:100',
            'content' => 'required'
        ]);

        $post = Post::find($id);
        $post->title = $validatedData['title'];
        $post->content = $validatedData['content'];
        $post->save();

        if($request->hasFile('image')){
            $request->validate([
              'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048|dimensions:min_width=200,min_height=150',
            ]);

            Storage::delete($post->image->storge_path);
            $post->image->delete();

            $image = new Image();
            $image->storage_path = $request->file('image')->store('public/images');;
            $image->imageable_id = $post->id;
            $image->imageable_type = "App\Models\Post";
            $image->save();
        }

        session()->flash('post updated', 'Post updated successfully');

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('post deleted', 'Post deleted successfully');

        return redirect()->route('posts.index');
    }

    public function apiGetFake()
    {
	    return $this->fakeDataGenerator->getFakePost();
    }
}
