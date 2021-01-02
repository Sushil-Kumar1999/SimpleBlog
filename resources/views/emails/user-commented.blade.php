@component('mail::message')
# A user commented on your post

{{ $user_name }} has commented on your post - {{ $post_title }}

@component('mail::panel')
{{ $body }}
@endcomponent

@component('mail::button', ['url' => $view_post_url, 'color' => 'success'])
View Comment
@endcomponent

Regards,<br>
{{ config('app.name') }}
@endcomponent
