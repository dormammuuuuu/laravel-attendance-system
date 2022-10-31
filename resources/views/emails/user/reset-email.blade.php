<x-mail::message>
# Password Reset

Click the button below to reset your password.

@component('mail::button', ['url' => $url])
Reset Password
@endcomponent

<p>Please do not forward this link to anyone. If this is not you, please disregard this email.</p>

Thanks,<br>
{{ config('app.name') }}

</x-mail::message>