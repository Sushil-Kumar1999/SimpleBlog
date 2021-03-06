<x-app-layout>
    <x-slot name="title">View profile - {{ $profile->user->name }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Profile
        </h2>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 px space-y-4">

        <div class="flex flex-row space-x-10 bg-yellow-100 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <img src="{{ Storage::url($profile->image->storage_path) }}" width="200" height="150" alt="profile image" >

            <div class="flex flex-col content-start justify-start text-yellow-600">
                <h3 class="font-bold underline mb-2">User Details</h3>
                <span>
                    Name: <a href={{ route('users.show', $profile->user) }} class="hover:underline"> {{ $profile->user->name }}</a>
                </span>
                <span>Email: {{ $profile->user->email }}</span>
            </div>
        </div>

        <div class="flex flex-col bg-green-100 text-green-600 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <h3 class="font-bold underline mb-2">Last Active</h3>
            <span>{{ date("l, F j, Y g:i a", strtotime($profile->last_active)) }}</span>
        </div>

        <div class="flex flex-col bg-blue-100 text-blue-600 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <h3 class="font-bold underline mb-2">About</h3>
            <p>{{ $profile->about }}</p>
        </div>

        <div class="flex flex-col bg-red-100 text-red-600 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <h3 class="font-bold underline mb-3">Roles</h3>
            <div class="flex flex-row space-x-8">
                @foreach($profile->roles as $role)
                <a href={{ route('roles.show', $role) }}>
                    <span class="inline flex justify-between bg-red-500 text-white rounded-full px-3 py-1 hover:underline">
                        {{ $role->name }}
                    </span>
                </a>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col bg-purple-100 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <h1 class="font-bold underline mb-3 text-purple-600">Posts written by {{ $profile->user->name }}</h1>
            <div class="flex flex-col space-y-6">
                @foreach($profile->posts as $post)
                <div class="inline flex justify-between bg-purple-300 text-purple-700 rounded-md py-3 px-3 shadow-md hover:shadow-xl">
                    <a href={{ route('posts.show', $post) }}>
                        <span class="inline flex hover:underline">{{ $post->title }}</span>
                    </a>
                    <span>{{ date("F j, Y", strtotime($post->updated_at)) }}</span>
                </div>
                @endforeach
            </div>
        </div>

    </div>

</x-app-layout>
