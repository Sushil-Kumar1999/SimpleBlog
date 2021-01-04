<x-app-layout>
    <x-slot name="title">Edit Comment for post - {{ $comment->post->title }}</x-slot>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Comment for post - {{ $comment->post->title }}
        </h2>
    </x-slot>

    <div class="container px-6 py-6">
        <form class="flex flex-col space-y-5" method="post" action={{ route('comments.update', $comment->id) }}>
            @csrf
            @method('PATCH')

            <label for="body">Edit your comment <span class="text-red-500">*</span> :</label>
            <textarea id="body" name="body" rows="7" placeholder="Write your comment here"> {{ $comment->body }}</textarea>

            <div class="inline flex justify-end mt-2">
                <button id="submitForm" class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1" type="submit">Update Comment</button>
            </div>
        </form>
    </div>

</x-app-layout>
