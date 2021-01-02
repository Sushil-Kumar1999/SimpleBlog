<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            View Post
        </h2>

        <div class="flex flex-row space-x-8 items-center">
            @if(in_array('Administrator', Auth::user()->profile->roles->pluck('name')->all()))
            <form method="post" action={{ route('posts.destroy', $post) }}>
                @csrf
                @method('DELETE')
                <button id="deletePost" class="inline flex rounded-xl bg-red-500 text-white text-xm px-2 py-2" type="submit">
                    Delete Post
                </button>
            </form>
            @endif

            @if($post->profile_id === Auth::user()->profile->id)
            <button class="inline flex rounded-xl bg-blue-500 text-white text-xm px-2 py-2">
                <a href={{ route('posts.edit', $post->id) }}>
                    Edit Post
                </a>
            </button>
            @endif
        </div>
    </x-slot>

    <div id="root" class="flex flex-col mx-8 my-6 space-y-5">

        @if(Session::has('comment updated'))
        <p class="inline flex px-3 py-2 bg-yellow-100 text-yellow-600 rounded-xl">{{ Session::get('comment updated') }}</p>
        @endif

        <h3 class="text-xl">{{ $post->title }}</h3>

        <div>
            <div>Written by
                <a class="hover:underline" href={{ route('profiles.show', $post->profile_id) }}>{{ $post->profile->user->name }}</a>
            </div>
            <div>Posted on  {{ date("l, F j, Y g:i a", strtotime($post->created_at)) }}</div>
            <div>Last updated on {{ date("l, F j, Y g:i a", strtotime($post->updated_at)) }}</div>
        </div>

        <article class="mt-8 px-4 py-4 rounded-xl shadow-xl overflow-hidden bg-white">
            <img alt="Image uploaded along with post" width="200" height="150" src="{{ Storage::url($post->image->storage_path) }}">
            <p class="mt-6">{{ $post->content }}</p>
        </article>

        <div class="inline flex justify-end mt-2">
            <button v-on:click="toggleShowCommentSection"
                    class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1">
                @{{ toggleCommentSectionButtonText }}
            </button>

            {{-- <button class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1">
                <a href={{ route('comments.page', $post) }}>
                    View comments
                </a>
            </button> --}}
        </div>

        <div v-if="showCommentSection" class="flex flex-col space-y-5">
            <article v-for="comment in comments" class="bg-white pt-6 pb-2 px-6 rounded-2xl shadow hover:shadow-2xl text-lg space-y-5">
                @{{ comment.body }}

                <footer class="flex flex-row items-center justify-between leading-none py-2 mt-3">
                    <div class="flex flex-col content-start justify-start text-gray-500">
                            <span class="text-sm">
                                Posted by @{{ comment.profile.user.name }}
                            </span>

                            <span class="text-sm">
                                Last Updated on @{{ new Intl.DateTimeFormat('en-GB', { dateStyle: 'full', timeStyle: 'medium' }).format(new Date(comment.updated_at)) }}
                            </span>
                    </div>

                    <button v-if="comment.profile.id === currentUserProfileId" class="inline flex rounded-xl bg-blue-500 text-white text-xm px-3 py-2">
                        <a v-bind:href="getEditCommentLink(comment.id)">
                            Edit
                        </a>
                    </button>
                </footer>
            </article>

            <form name="addCommentForm" id="addCommentForm" class="flex flex-col space-y-5" method="post" action="javascript:void(0)">
                @csrf
                <label for="body">Write a comment <span class="text-red-500">*</span> :</label>
                <textarea v-model="commentBody" id="body" name="body" rows="7" placeholder="Write your comment here"></textarea>

                <input type="hidden" name="profile_id" value="{{ Auth::user()->profile->id }}">
                <input type="hidden" name="post_id" value="{{ $post->id }}">

                <div class="inline flex justify-end mt-2">
                    <button v-on:click="createComment" class="cursor-pointer bg-blue-500 text-white text-md rounded-full px-3 py-1">Post Comment</button>
                </div>
            </form>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>

    <script>
        var profileId = {{ Auth::user()->profile->id }};
        var postId = {{ $post->id }};

        var app = new Vue({
            el: "#root",
            data: {
                currentUserProfileId: profileId,
                currentPostId: postId,
                comments: [],
                showCommentSection: false,
                toggleCommentSectionButtonText: "Show Comments",
                commentBody: ''
            },
            mounted() {
                axios.get("{{ route('api.comments.get', $post->id) }}")
                .then(response => {
                    this.comments = response.data;
                })
                .catch(error => {
                    console.log(response);
                })
            },
            methods: {
                getEditCommentLink: function(id) {
                    return "../comments/" + id + "/edit";
                },
                toggleShowCommentSection: function() {
                    this.showCommentSection = !this.showCommentSection;
                    this.toggleCommentSectionButtonText = this.showCommentSection ? "Hide Comments" : "Show Comments";
                },
                createComment: function() {
                    axios.post("{{ route('api.comments.store') }}", {
                        body: this.commentBody,
                        profile_id: this.currentUserProfileId,
                        post_id: this.currentPostId
                    })
                    .then(response => {
                        console.log(response);
                        this.comments.unshift(response.data);
                        this.commentBody = '';
                    })
                    .catch(error => {
                        console.log(response);
                    });
                }
            }
        });
    </script>

</x-app-layout>
