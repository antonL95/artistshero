<x-mail::message>
# Message form {{ $name }} {{ $from }}

Subject **{{ $subject }}**

Message:

{{ $message }}

{{ config('app.name') }}
</x-mail::message>
