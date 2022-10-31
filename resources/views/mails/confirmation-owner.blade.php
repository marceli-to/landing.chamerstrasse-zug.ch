@component('mail::message')
# Interessent

Interessiert an: {{ $client->interest }}<br>
Name: {{ $client->firstname }} {{ $client->name }}<br>
Strasse/Nr.: {{ $client->street }}<br>
Ort: {{ $client->city }}<br>
E-Mail: {{ $client->email }}<br>
Telefon: {{ $client->phone }}<br>
Mitteilung:<br>
{{ $client->remarks }}<br><br>


Freundliche Grüsse<br>

APLEONA REAL ESTATE AG<br>
Industriestrasse 21<br>
8304 Wallisellen<br>
mieten@apleona.com
@endcomponent
