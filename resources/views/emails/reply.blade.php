<div style="text-align: center;">
    <a target="__blank" href="/">
        <img src="{{ asset('storage/' . $setting->logo) }}" alt="Logo" style="width: 100px; height: 100px;">
    </a>
</div>
<h1 style="text-align: center;">الرد من خلال موقع {{ $setting->{'web_name_'. app()->getLocale()} }}</h1>
{{-- <x-mail::panel> --}}
    <p style="font-size: 16px; color: #333;">{{ $data['reply'] }}</p>
{{-- </x-mail::panel> --}}