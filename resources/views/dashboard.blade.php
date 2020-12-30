<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="inline flex p-6 mx-6 my-3 bg-white border-b border-gray-200">
            Welcome to Simple Blog
        </div>

        <div class="grid grid-cols-3 gap-x-8 gap-y-4 h-80">
            <div class="p-6 mx-6 bg-white border-b border-gray-200">
                <a href={{ route('profiles.show', Auth::user()->profile->id) }} class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent leading-5 text-gray-500 hover:text-blue-700 hover:border-red-500 transition duration-150 ease-in-out">
                    View your profile
                </a>
            </div>

            <div class="p-6 mx-6 bg-white">
                <a href={{route('posts.index')}} class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent leading-5 text-gray-500 hover:text-blue-700 hover:border-red-500 transition duration-150 ease-in-out">
                    View all posts
                </a>
            </div>

            <div class="p-6 mx-6 bg-white border-b border-gray-200">
                <a href={{route('posts.create')}} class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent leading-5 text-gray-500 hover:text-blue-700 hover:border-red-500 transition duration-150 ease-in-out">
                    Create new post
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
