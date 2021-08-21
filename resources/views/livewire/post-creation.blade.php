@auth
    <form class="mb-4" action="{{ route('posts') }}" method="post">
        @csrf
        <div>
            <label for="body" class="sr-only">Body</label>
            <textarea name="body" id="body" cols="30" rows="4" class="bg-gray-100 w-full p-4 rounded-lg @error('body') border-red-500  @enderror" placeholder="Post something!" required></textarea>

            @error('body')
                <div class="text-red-500 mt-2 text-sm">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div>
            <button wire:submit.prevent="store" type="submit"
                class="bg-green-500 text-white px-14 py-2 rounded font-medium float-right">Post</button>
        </div>

    </form>

@endauth
<br>
<br>
<hr>
@if ($posts->count())
    @foreach ($posts as $post)
        <div class="p-4">
            <livewire:update-likes :post="$post" />
            
        </div>

    @endforeach

    {{ $posts->links() }}
@else
    <p class="center-items">No Posts Found</p>
@endif
