<div>

        <div class="mb-4">
            <a href="{{ route('user.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span
                class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
            <p class="mb-2 bg-gray-100 rounded p-2">{{ $post->body }}</p>

            <div class="float-right">
                <p class="bg-green-500 p-1 rounded">{{ $post->likes->count() }} 👍</p>
            </div>
            <br>
            <div class="flex items-center">
                @auth



                    @if (!$post->alreadyLiked(Auth::user()))

                        <button wire:click="like"
                            class="bg-blue-800 hover:bg-blue-500 text-white font-bold py-1 px-6 rounded">Like</button>
                    @else
                        <button wire:click="unlike"
                            class="bg-red-800 hover:bg-red-500 text-white font-bold py-1 px-6 rounded">Unlike</button>
                    @endif

                @endauth



                @auth
                    @can('delete', $post)
                        <button wire:click="delete({{ $post->id }})" type="submit"> &nbsp;🗑️</button>
                    @endcan
                @endauth
            </div>
        </div>
        <hr>

</div>
