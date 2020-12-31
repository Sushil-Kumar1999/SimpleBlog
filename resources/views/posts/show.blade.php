<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Post
        </h2>

        <div class="flex flex-row space-x-8 items-center">
            @if(in_array('Administrator', Auth::user()->profile->roles->pluck('name')->all()))
            <form method="post" action={{ route('posts.destroy', $post) }}>
                @csrf
                @method('DELETE')
                <button id="deletePost" class="inline flex rounded-xl bg-red-500 text-white text-xm px-2 py-2" type="submit">
                    Delete Post
                </button>
            </form>
            @endif

            @if($post->profile_id === Auth::user()->profile->id)
            <button class="inline flex rounded-xl bg-blue-500 text-white text-xm px-2 py-2">
                <a href={{ route('posts.edit', $post->id) }}>
                    Edit Post
                </a>
            </button>
            @endif
        </div>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 space-y-5">
        <h3 class="text-xl">{{ $post->title }}</h3>

        <div>
            <div>Written by {{ $post->profile->user->name }}</div>
            <div>Posted on  {{ date("l, F j, Y g:i a", strtotime($post->created_at)) }}</div>
            <div>Last updated on {{ date("l, F j, Y g:i a", strtotime($post->updated_at)) }}</div>
        </div>

        <article class="mt-8 px-4 py-4 rounded-xl shadow-xl overflow-hidden bg-white">
            <img alt="Image uploaded along with post" width="200" height="150" src="{{ Storage::url($post->image_path) }}">
            <p class="mt-6">{{ $post->content }}</p>
        </article>

        <div class="inline flex justify-end mt-2">
            <button class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1" type="submit">
                <a href={{ route('comments.page', $post) }}>
                    View comments
                </a>
            </button>
        </div>
    </div>

</x-app-layout>
