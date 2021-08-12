@props(['post'=>$post])

<div class="mb-4">
    <a href="{{ route('user.posts',$post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
    <p class="mb-2">{{ $post->body }}</p>
    
    <div class="flex items-center">
        @auth
            @if(!$post->alreadyLiked(Auth::user()))
                <form action="{{ route('posts.likes',$post->id) }}" method="post" class="mr-1">
                    @csrf
                    <button class="text-blue-500" type="submit">Like</button>
                </form>
            @else
                <form action="{{ route('posts.unlikes',$post->id) }}" method="post" class="mr-1">
                    @csrf
                    <button class="text-blue-500" type="submit">Unlike</button>
                </form>
            @endif
            
        @endauth
        <span>{{ $post->likes->count() }} {{ Str::plural('like', $post->likes->count()) }}</span>
        @auth

            @can('delete',$post)
                <form action="{{ route('posts.destroy',$post) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button  type="submit">🗑️</button>
                </form>
            @endcan
        @endauth
    </div>
</div>