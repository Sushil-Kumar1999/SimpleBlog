<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Comments for <a href={{ route('posts.show', $post) }} class="inline-flex items-center hover:underline">{{ $post->title }}</a>
        </h2>
    </x-slot>

    {{-- <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script> --}}

    <div class="container mx-auto px-10 py-10">
        <div id="root">
            <div class="flex flex-col space-y-5">
                <div class="inline flex justify-end mt-2">
                    <button class="cursor-pointer bg-blue-500 text-white text-md rounded-2xl px-3 py-2">Add Comment</button>
                </div>

                @foreach($comments as $comment)
                <article class="bg-white pt-6 pb-2 px-6 rounded-2xl text-lg">
                    {{ $comment->body }}

                    <footer class="flex items-center justify-between leading-none md:p-4">
                        <span class="flex items-center no-underline text-black" href="#">
                            <img alt="Placeholder" class="block rounded-full" src="https://picsum.photos/32/32/?random">
                            <p class="ml-2 text-sm">
                                {{ $comment->profile->user->name }}
                            </p>
                        </span>
                        <p class="text-grey-darker text-sm">
                            {{ date("F j, Y", strtotime($comment->updated_at)) }}
                        </p>
                    </footer>
                </article>
                @endforeach
            </div>
        </div>

        {{-- <script>
            var app = new Vue({
                el: "#root",
                data: {
                    comments: ["Hello", "Mello"]
                }
            });
        </script> --}}
        <div class="mt-5 px-3">{{ $comments->links() }}</div>
    </div>
</x-app-layout>
