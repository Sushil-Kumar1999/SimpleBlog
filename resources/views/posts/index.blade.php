<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Posts
        </h2>

        <button class="inline flex rounded-md bg-blue-500 text-white text-xm px-2 py-2">
            <a href={{route('posts.create')}}>
                Create New Post
            </a>
        </button>
    </x-slot>

    <div class="container mx-auto px-10 py-10">

        @if(Session::has('post created'))
        <p class="inline flex px-3 py-2 mb-6 mx-2 bg-green-100 text-green-600 rounded-xl">{{ Session::get('post created') }}</p>
        @endif

        @if(Session::has('post updated'))
        <p class="inline flex px-3 py-2 mb-6 mx-2 bg-yellow-100 text-yellow-600 rounded-xl">{{ Session::get('post updated') }}</p>
        @endif

        @if(Session::has('post deleted'))
        <p class="inline flex px-3 py-2 mb-6 mx-2 bg-red-100 text-red-600 rounded-xl">{{ Session::get('post deleted') }}</p>
        @endif

        <div class="flex flex-wrap ">
            @foreach($posts as $post)
            <div class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3">
                <article class="overflow-hidden rounded-lg shadow-lg">
                    <a href="#">
                        <img alt="Placeholder" class="block h-auto w-full" src="https://picsum.photos/600/400/?random">
                    </a>

                    <header class="flex-wrap items-center justify-between leading-tight p-2 md:p-4">
                        <p class="text-lg overflow-hidden">
                            <a class="truncate max-h-full no-underline hover:underline text-black" href="{{ route('posts.show', ['post' => $post]) }}">
                                {{ $post->title }}
                            </a>
                        </p>


                    </header>

                    <footer class="flex items-center justify-between leading-none p-2 md:p-4">
                        <span class="flex items-center no-underline text-black" href="#">
                            <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                            <p class="ml-2 text-sm">
                                <a href={{ route('profiles.show', $post->profile->id) }}>
                                    {{ $post->profile->user->name }}
                                </a>
                            </p>
                        </span>
                        <p class="text-grey-darker text-sm">
                            {{ date("F j, Y", strtotime($post->updated_at)) }}
                        </p>
                    </footer>
                </article>
            </div>

             @endforeach
        </div>

        <div class="mt-3 px-3">{{ $posts->links() }}</div>
    </div>

</x-app-layout>
