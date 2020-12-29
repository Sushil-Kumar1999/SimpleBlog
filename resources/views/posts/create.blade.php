<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create New Post
        </h2>
    </x-slot>

    <div class="container px-6 py-6">
        <form class="flex flex-col space-y-5" method="POST" action={{route('posts.store')}}>
            @csrf
            <label for="title">Title <span class="text-red-500">*</span>:</label>
            <input type="text" id="title" name="title" placholder="Title">

            <label for="content">Content <span class="text-red-500">*</span> :</label>
            <textarea id="content" name="content" rows="15">Write your post here</textarea>

            <input type="hidden" name="profile_id" value="{{Auth::user()->profile->id}}">

            <div class="inline flex justify-end mt-2">
                <input class="cursor-pointer bg-blue-500 text-white px-2 py-2 text-md" type="submit">
            </div>
        </form>
    </div>
</x-app-layout>
