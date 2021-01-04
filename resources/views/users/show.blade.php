<x-app-layout>
    <x-slot name="title">View User Details - {{ $user->name }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View User Details - {{ $user->name }}
        </h2>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 space-y-5">
        <div class="flex flex-row space-x-10 bg-indigo-100 rounded-md py-6 px-6 shadow hover:shadow-lg">
            <div class="flex flex-col content-start justify-start text-indigo-600">
                <h3 class="font-bold underline mb-2">User Details</h3>
                <span>Name: {{ $user->name }}</span>
                <span>Email: {{ $user->email }}</span>
                <span>Joined on: {{ date("l, F j, Y g:i a", strtotime($user->created_at)) }}</span>

                <a href={{ route('profiles.show', $user->profile) }} class=" mt-4 font-bold hover:underline">View Profile >></a>
            </div>
        </div>
    </div>

</x-app-layout>
