@component('mail::message')
# Your post was liked

{{ $liker->name }} Liked your post

@component('mail::button', ['url' => route('posts.show',$post)])
    View Post
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
