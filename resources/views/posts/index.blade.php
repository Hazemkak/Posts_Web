@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
        @auth
            <form class="mb-4" action="{{ route('posts') }}" method="post">
            @csrf
                <div>
                    <p class="p-2">Post something!</p>
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" 
                    class="bg-gray-100 w-full p-4 rounded-lg @error('body') border-red-500  @enderror" 
                    placeholder="Post something!">
                    </textarea>
                

                @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Post</button>
                </div>

            </form>
        @endauth
            @if($posts->count())
                @foreach($posts as $post)
                   <x-post :post="$post"/>

                @endforeach

                {{ $posts->links() }}
            @else
                <p>No Posts Found</p>
            @endif
        </div>
    </div>
@endsection