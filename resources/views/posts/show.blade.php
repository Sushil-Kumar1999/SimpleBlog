<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Post
        </h2>

        <div class="flex flex-row space-x-8 items-center">
            @if(in_array('Administrator', Auth::user()->profile->roles->pluck('name')->all()))
            <button class="inline flex rounded-xl bg-red-500 text-white text-xm px-2 py-2">
                <a href={{ route('posts.edit', $post->id) }}>
                    Delete Post
                </a>
            </button>
            @endif

            <button class="inline flex rounded-xl bg-blue-500 text-white text-xm px-2 py-2">
                <a href={{ route('posts.edit', $post->id) }}>
                    Edit Post
                </a>
            </button>
        </div>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 px">
        <h3 class="mb-8 text-xl">{{ $post->title }}</h3>

        <h6 class="text-gray-800">
            Posted by {{ $post->profile->user->name }}
        </h6>

        </span>
            Last Updated : {{ date("l, F j, Y g:i a", strtotime($post->updated_at)) }}
        </span>

        <div class="mt-8 px-4 py-4 rounded-xl overflow-hidden bg-white">
            {{ $post->content }}
        </div>
    </div>

</x-app-layout>
