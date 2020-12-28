<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Post
        </h2>
    </x-slot>

    <div class="flex-col mx-8 my-6 px">
        <h3 class="mb-8 text-xl">{{ $post->title }}</h3>

        <h6 class="text-gray-800">
            Posted by {{ $post->profile->user->name }}
        </h6>

        </span>
            Last Updated : {{ $post->updated_at }}
        </span>

        <div class="mt-8 px-4 py-4 rounded-xl overflow-hidden bg-white">
            {{ $post->content }}
        </div>
    </div>

</x-app-layout>
