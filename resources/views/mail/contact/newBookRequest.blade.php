<x-mail::message>
Здравствуйте, {{ $book->user->firstname }}!

На сайте {{ config('app.name') }} Вам был отправлен новый запрос на Вашу книгу "{{ $book->title }}"

<x-mail::button :url="$url">
Перейти к запросу
</x-mail::button>

Спасибо,<br>
{{ config('app.name') }}
</x-mail::message>
