<span style="color: #718096;">
@component('mail::message')
# Contact Request Received

@if($emailType == 'admin')
A customer has contacted you, requesting you get in touch with them. Please don't forget to respond within 24 business hours to their request!

Thanks,
MSP Automated System

@else
Thank you for your interest in Maine Sky Pixels! We have received your request, and someone will get back to you within 24 business hours.

Thanks,<br>
{{ config('app.name') }}
@endif

## Summary

**Name:** {{ $data->name }}

**eMail Address:** {{ $data->email }}

@if($data->phone != null)
**Phone Number:** {{ $data->phone }}
@endif

@if($data->business_name != null)
**Business Name:** {{ $data->business_name }}
@endif

@if($data->type != null)
**Type of Photo Shoot:** {{ $data->type }}
@endif

@if($data->location != null)
**Location of Photo Shoot:** {{ $data->location }}
@endif

@if($data->date != null)
**Date of Photo Shoot:** {{ $data->date }}
@endif

{{-- @component('mail::button', ['url' => ''])
Button Text
@endcomponent --}}

@endcomponent
</span>