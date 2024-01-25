@component('mail::message')

{!! html_entity_decode($body) !!}


Thanks,<br>
{{ websiteInfo('website_name') }}
@endcomponent
