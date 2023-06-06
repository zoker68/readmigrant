<x-mail::message>
Здравствуйте, {{ $userNotificate->firstname }}!

На сайте {{ config('app.name') }} В запросе на книгу "{{ $book->title }}" появилось новое сообщение.

<x-mail::button :url="$url">
Перейти к запросу
</x-mail::button>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
