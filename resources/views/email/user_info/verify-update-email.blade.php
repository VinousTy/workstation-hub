@component('mail::layout')

{{-- Header --}}
@slot('header')
@component('mail::header', ['url' => config('app.url')])
{{ config('app.name') }}
@endcomponent
@endslot

{{ trans('mail.verify_update_email.greet') }} <br>
<br>

@isset($actionText)
<?php
switch ($level) {
    case 'success':
    case 'error':
        $color = $level;
        break;
    default:
        $color = 'primary';
}
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
    {{ $actionText }}
@endcomponent
@endisset
<br>
{{ __('mail.verify_email.expire') }}<br>
{{ __('mail.verify_email.expire_guide') }}<br>
<br>
{{ __('mail.verify_email.notice') }}<br>
<br>
{{ config('mail.from.name' )}}

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@component('mail::subcopy')
@lang(
    "もし、\":actionText\"ボタンをクリックできない場合には, 下記URLをコピーして、ブラウザに貼り付けてください。",
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endcomponent
@endslot
@endisset

{{-- Footer --}}
@slot('footer')
@component('mail::footer')
@endcomponent
@endslot

@endcomponent

