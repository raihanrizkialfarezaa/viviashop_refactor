<head>
    <meta charset="utf-8">
    <title>ViviaShop – Percetakan & ATK</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="percetakan, ATK, cetak, vivia, viviashop" name="keywords">
    <meta content="ViviaShop – Percetakan & ATK terpercaya di Jombang" name="description">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ── Favicon: inline SVG data URI, crisp at any size, no upload needed ──
         Design: rounded dark-green square + white "V" lettermark                --}}
    <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230f5132'/%3E%3Crect width='64' height='64' rx='14' fill='url(%23g)'/%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%231a7a48'/%3E%3Cstop offset='1' stop-color='%230a3321'/%3E%3C/linearGradient%3E%3C/defs%3E%3Ctext x='32' y='46' font-family='Georgia,serif' font-weight='700' font-size='38' fill='%2320c997' text-anchor='middle' letter-spacing='-1'%3EV%3C/text%3E%3Ctext x='32' y='46' font-family='Georgia,serif' font-weight='700' font-size='38' fill='white' text-anchor='middle' letter-spacing='-1' opacity='0.92'%3EV%3C/text%3E%3C/svg%3E">

    {{-- PNG fallback for older browsers / iOS home screen --}}
    <link rel="shortcut icon" type="image/x-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='14' fill='%230f5132'/%3E%3Ctext x='32' y='46' font-family='Georgia,serif' font-weight='700' font-size='38' fill='%2320c997' text-anchor='middle'%3EV%3C/text%3E%3C/svg%3E">

    {{-- Apple touch icon (bookmark on iOS) --}}
    <link rel="apple-touch-icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 180 180'%3E%3Crect width='180' height='180' rx='40' fill='%230f5132'/%3E%3Cdefs%3E%3ClinearGradient id='g' x1='0' y1='0' x2='1' y2='1'%3E%3Cstop offset='0' stop-color='%231a7a48'/%3E%3Cstop offset='1' stop-color='%230a3321'/%3E%3C/linearGradient%3E%3C/defs%3E%3Crect width='180' height='180' rx='40' fill='url(%23g)'/%3E%3Ctext x='90' y='130' font-family='Georgia,serif' font-weight='700' font-size='108' fill='%2320c997' text-anchor='middle'%3EV%3C/text%3E%3C/svg%3E">

    {{-- Theme color for Chrome/Android address bar --}}
    <meta name="theme-color" content="#0f5132">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@600;800&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('frontend/lib/lightbox/css/lightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
</head>