<x-app-layout>
    <x-slot name="title">Edit post - {{ $post->title }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Post - {{ $post->title }}
        </h2>
    </x-slot>

    <div class="container px-6 py-6">
        <form class="flex flex-col space-y-5" method="post" action={{ route('posts.update', $post->id) }} enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter a title" value="{{ $post->title }}">

            <label for="content">Content</label>
            <textarea id="content" name="content" rows="15" placeholder="Write your post here">{{ $post->content }}</textarea>

            <label for="image">Upload new image for your post (minimum dimensions 200 x 150 pixels)</label>
            <input id="image" type="file" name="image" placeholder="Upload image">

            <img width="200" height="150" alt="Image uploaded along with post" src="{{ Storage::url($post->image->storage_path) }}">

            <div class="inline flex justify-end mt-2">
                <button id="submitForm" class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1" type="submit">Update Post</button>
            </div>
        </form>
    </div>

</x-app-layout>
