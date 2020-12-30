<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Profile
        </h2>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 px space-y-4">

        <div class="flex flex-col bg-yellow-100 text-yellow-600 rounded-md py-6 px-6">
            <h3 class="font-bold underline mb-2">User Details</h3>
            <span>Name: {{ $profile->user->name }}</span>
            <span>Email: {{ $profile->user->email }}</span>
        </div>

        <div class="flex flex-col bg-green-100 text-green-600 rounded-md py-6 px-6">
            <h3 class="font-bold underline mb-2">Last Active: </h3>
            <span>{{ date("l, F j, Y g:i a", strtotime($profile->last_active)) }}</spam>
        </div>


        <div class="flex flex-col bg-red-100 text-red-600 rounded-md py-6 px-6">
            <h3 class="font-bold underline mb-3">Roles:</h3>
            <div class="flex flex-row space-x-8">
                @foreach($profile->roles as $role)
                <span class="inline flex justify-between bg-red-500 text-white rounded-full px-3 py-1">{{ $role->name }}</span>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col bg-blue-100 text-blue-600 rounded-md py-6 px-6">
            <h3 class="font-bold underline mb-2">About</h3>
            <p>{{ $profile->about }}</p>
        </div>

    </div>

</x-app-layout>
