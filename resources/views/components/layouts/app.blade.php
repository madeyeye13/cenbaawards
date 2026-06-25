<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $description ?? 'CenBa Africa Business Excellence Awards — Celebrating Outstanding Achievement Across Africa' }}">
    <title>{{ $title ?? 'CenBa Africa Business Excellence Awards' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">

  
@verbatim
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "Organization",
    "@id": "https://cenbabusinessaward.com/#organization",
    "name": "CenBa Africa Business Excellence Awards",
    "alternateName": "CABEA",
    "url": "https://cenbabusinessaward.com",
    "logo": {
        "@type": "ImageObject",
        "url": "https://cenbabusinessaward.com/images/logo.png",
        "width": 200,
        "height": 60
    },
    "description": "The CenBa Africa Business Excellence Awards celebrate outstanding achievements in the African business landscape, backed by the Award Trust Mark (Independent Award Standard Council, UK).",
    "foundingDate": "2016",
    "email": "info@cenbabusinessaward.com",
    "address": {
        "@type": "PostalAddress",
        "streetAddress": "Top Martins Complex, Asokwa",
        "addressLocality": "Kumasi",
        "addressRegion": "Ashanti",
        "postalCode": "AK-240-2707",
        "addressCountry": "GH"
    },
    "areaServed": { "@type": "Place", "name": "Africa" },
    "sameAs": [
        "https://www.cenbabusinessaward.com",
        "https://www.cenbagraduate.com"
    ],
    "knowsAbout": [
        "Business Excellence", "African Business Awards",
        "Innovation", "Leadership",
        "Entrepreneurship", "Sustainable Development"
    ]
}
</script>


<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebSite",
    "@id": "https://cenbabusinessaward.com/#website",
    "url": "https://cenbabusinessaward.com",
    "name": "CenBa Africa Business Excellence Awards",
    "description": "Celebrating Africa's finest businesses and entrepreneurs since 2016.",
    "publisher": { "@id": "https://cenbabusinessaward.com/#organization" },
    "inLanguage": "en"
}
</script>
@endverbatim

    {{-- Page-specific schemas injected via named slot --}}
    {!! $schema ?? '' !!}
</head>
<body class="antialiased" style="background: #0D0D0D; color: #FAFAF9; font-family: 'Spline Sans', sans-serif;">

    @include('partials.header')

    <main id="main-content">
        {{ $slot }}
    </main>

    @include('partials.footer')

    @livewireScripts
</body>
</html>