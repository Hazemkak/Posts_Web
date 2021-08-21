@extends('layouts.app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-medium mb-1">{{ $user->name }}</h1>
                <p>Posted {{ $posts->count() }} {{ Str::plural('post',$posts->count()) }} and recieved {{ $user->recievedLikes->count() }} {{ Str::plural('like',$user->recievedLikes->count()) }} </p>
            </div>
            <br>
            <hr>
            <div class="bg-white p-6 rounded-lg">
                @if($posts->count())
                    @foreach($posts as $post)
                    <livewire:update-likes :post="$post"/>
                    <hr>

                    @endforeach

                    {{ $posts->links() }}
                @else
                    <p class="center-items">No Posts Found</p>
                @endif
            </div>
        </div>
    </div>
@endsection