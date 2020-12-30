<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Role - {{ $role->name }}
        </h2>
    </x-slot>

    <div class="flex flex-col mx-8 my-6 space-y-6">
        <h1 class="text-xl text-purple-700 font-bold mb-3">Profiles with role {{ $role->name }}</h1>

        <div class="flex flex-col bg-purple-100 rounded-md space-y-6 px-5 py-5">
            @foreach($role->profiles as $profile)
            <a href={{ route('profiles.show', $profile) }}>
                <span class="inline flex bg-purple-300 text-purple-700 rounded-md py-6 px-6 hover:underline">{{ $profile->user->name }}</span>
            </a>
            @endforeach
        <div>
    </div>

</x-app-layout>
