@component('mail::message')
Hi, {{$user->username}}. Please set a new password for your account.

<p>It happens! Click the link below to set a new password.</p>

@component('mail::button', ['url' => url('set_new_password/' . $user->remember_token)])
Set New Password
@endcomponent

Thank you,<br>
{{ config('app.name') }}
@endcomponent
