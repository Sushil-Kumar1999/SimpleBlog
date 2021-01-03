<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Comments for <a href={{ route('posts.show', $post) }} class="inline-flex items-center hover:underline">{{ $post->title }}</a>
        </h2>
    </x-slot>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <div class="container mx-auto px-10 py-5">
        <div class="flex flex-col space-y-5">

            <p id="confirmationMessage" class="inline flex px-3 py-3 my-2 mx-2 bg-green-200 text-green-800 rounded-xl hidden">Comment added successfully</p>

            @if(Session::has('comment updated'))
            <p class="inline flex px-3 py-2 mb-6 mx-2 bg-yellow-100 text-yellow-600 rounded-xl">{{ Session::get('comment updated') }}</p>
            @endif

            @foreach($comments as $comment)
            <article class="bg-white pt-6 pb-2 px-6 rounded-2xl shadow hover:shadow-2xl text-lg space-y-5">
                {{ $comment->body }}

                <footer class="flex flex-row items-center justify-between leading-none py-2 mt-3">
                    <div class="flex flex-col content-start justify-start text-gray-500">
                            <span class="text-sm">
                                Posted by {{ $comment->profile->user->name }}
                            </span>

                            <span class="text-sm">
                                Last Updated on {{ date("l, F j, Y g:i a", strtotime($comment->updated_at)) }}
                            </span>
                    </div>

                    @if($comment->profile_id === Auth::user()->profile->id)
                    <button class="inline flex rounded-xl bg-blue-500 text-white text-xm px-3 py-2">
                        <a href={{ route('comments.edit',$comment) }}>
                            Edit
                        </a>
                    </button>
                    @endif
                </footer>
            </article>
            @endforeach

            <div class="mt-5 px-3">{{ $comments->links() }}</div>

            <form name="addCommentForm" id="addCommentForm" class="flex flex-col space-y-5" method="post" action="javascript:void(0)">
                @csrf
                <label for="body">Write a comment <span class="text-red-500">*</span> :</label>
                <textarea id="body" name="body" rows="7" placeholder="Write your comment here"></textarea>

                <input type="hidden" name="profile_id" value="{{ Auth::user()->profile->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="inline flex justify-end mt-2">
                    <button id="submitForm" class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1" type="submit">Post Comment</button>
                </div>
            </form>

        </div>

        <script>
            $("#submitForm").click(function() {
                $.ajax({
                    url: "{{ route('api.comments.store', ['post' => $post]) }}",
                    type: "POST",
                    data: $('#addCommentForm').serialize(),
                    success: function(response) {
                        document.getElementById("addCommentForm").reset();

                        setTimeout(function() {
                            document.location.reload();

                        }, 0);

                        $('#confirmationMessage').show();
                    }
                });
            });
        </script>
    </div>

</x-app-layout>
