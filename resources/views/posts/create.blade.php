<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Post
        </h2>
    </x-slot>

    <div class="container px-6 py-6">
        <form class="flex flex-col space-y-5" method="POST" action={{route('posts.store')}} enctype="multipart/form-data">
            @csrf
            <label for="title">Title <span class="text-red-500">*</span></label>
            <input id="title" type="text" name="title" placeholder="Enter a title" value="{{ old('title') }}">

            <label for="content">Content <span class="text-red-500">*</span></label>
            <textarea id="content" name="content" rows="15" placeholder="Write your post here">{{ old('content') }}</textarea>

            <label for="image">Upload image for your post (minimum dimensions 200 x 150 pixels)<span class="text-red-500">*</span></label>
            <input id="image" type="file" name="image" placeholder="Upload image">

            <input type="hidden" name="profile_id" value="{{ Auth::user()->profile->id }}">

            <div class="inline flex justify-end mt-2">
                <button class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1" type="submit">Create Post</button>
            </div>
        </form>
    </div>
</x-app-layout>
