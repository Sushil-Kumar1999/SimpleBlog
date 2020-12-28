<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto px-10 py-10">
        <ul>
            @foreach($posts as $post)
            <li>
                <a href="{{ route('posts.show', ['post' => $post]) }}">{{$post->title}}</a>
            </li>
             @endforeach
        </ul>

        <div>{{$posts->links()}}</div>
    </div>

</x-app-layout>
