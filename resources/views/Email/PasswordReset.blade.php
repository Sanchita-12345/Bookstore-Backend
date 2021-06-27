@component('mail::message')
# Introduction

Hello
Your token is

{{$token}}t

Thanks,<br>
{{ config('app.name') }}
@endcomponent
