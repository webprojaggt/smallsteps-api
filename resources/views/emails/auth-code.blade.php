<x-mail::message>
    # Authentication Code

    Hello,

    Your authentication code for the app is:

    # {{ $code }}

    This code will expire in 50 minutes.

    Thank you for using our app.

    Best regards,
    {{ config('app.name') }}
</x-mail::message>