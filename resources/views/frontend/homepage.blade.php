@extends('frontend.layouts')
@section('content')
<style>
    :root {
        --v-primary: #0F5132;
        --v-primary-soft: #d1e7dd;
        --v-secondary: #198754;
        --v-accent: #20c997;
        --v-dark: #1F2937;
        --v-light: #F9FAFB;
        --v-glass: rgba(255, 255, 255, 0.7);
        --v-glass-border: rgba(255, 255, 255, 0.4);
    }

    body {
        font-family: 'Inter', system-ui, -apple-system, sans-serif;
        background-color: var(--v-light);
        color: var(--v-dark);
        overflow-x: hidden;
    }

    /* TYPOGRAPHY */
    .title-gradient {
        background: linear-gradient(135deg, var(--v-primary) 0%, var(--v-accent) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 800;
        letter-spacing: -0.02em;
    }

    /* HERO SECTION */
    .hero-wrapper {
        position: relative;
        padding: calc(var(--site-header-offset, 108px) + 88px) 0 130px;
        min-height: 100vh;
        min-height: 100svh;
        display: flex;
        align-items: center;
        background:
            radial-gradient(circle at top left, rgba(255, 255, 255, 0.16), transparent 30%),
            radial-gradient(circle at 82% 18%, rgba(32, 201, 151, 0.26), transparent 24%),
            linear-gradient(135deg, rgba(7, 44, 29, 0.96) 0%, rgba(15, 81, 50, 0.92) 44%, rgba(16, 185, 129, 0.78) 100%),
            url('{{ asset('atkah.jpg') }}') center/cover no-repeat;
        background-blend-mode: screen, screen, multiply, normal;
        overflow: hidden;
    }

    .hero-wrapper::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(8, 35, 23, 0.2) 0%, transparent 58%);
        pointer-events: none;
    }

    .hero-wrapper::after {
        content: '';
        position: absolute;
        right: -10%;
        bottom: -18%;
        width: 360px;
        height: 360px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.16) 0%, rgba(255, 255, 255, 0) 70%);
        filter: blur(18px);
        pointer-events: none;
    }

    .hero-blur-blob {
        position: absolute;
        width: 520px;
        height: 520px;
        background: rgba(32, 201, 151, 0.32);
        opacity: 0.95;
        filter: blur(120px);
        border-radius: 50%;
        top: -160px;
        right: -180px;
        z-index: 0;
        animation: float 12s ease-in-out infinite alternate;
    }

    .hero-content {
        position: relative;
        z-index: 2;
    }

    .hero-content .row {
        --bs-gutter-y: 3rem;
    }

    .hero-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 18px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: #fff;
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        box-shadow: 0 14px 30px rgba(0, 0, 0, 0.12);
    }

    .hero-kicker i {
        color: #b9f6d0;
    }

    .hero-title {
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        font-size: clamp(2.85rem, 5vw, 5.5rem);
        line-height: 0.96;
        letter-spacing: -0.04em;
        color: #fff;
        margin-bottom: 1.25rem;
        text-wrap: balance;
    }

    .hero-title .accent {
        color: #b9f6d0;
    }

    .hero-copy {
        max-width: 640px;
        font-size: 1.08rem;
        line-height: 1.8;
        color: rgba(255, 255, 255, 0.86);
        margin-bottom: 1.75rem;
    }

    .hero-panel {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-bottom: 2rem;
    }

    .hero-panel-chip {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 18px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.14);
        color: #fff;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        font-weight: 600;
    }

    .hero-panel-chip i {
        color: #b9f6d0;
    }

    .hero-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        align-items: center;
        margin-bottom: 2rem;
    }

    .btn-hero-secondary {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        background: rgba(255, 255, 255, 0.14);
        color: #fff;
        border: 1px solid rgba(255, 255, 255, 0.18);
        border-radius: 100px;
        font-weight: 700;
        padding: 14px 32px;
        backdrop-filter: blur(12px);
        -webkit-backdrop-filter: blur(12px);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .btn-hero-secondary:hover {
        background: #fff;
        color: var(--v-primary);
        transform: translateY(-4px);
        box-shadow: 0 16px 30px rgba(0, 0, 0, 0.12);
    }

    .hero-note {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 12px 16px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.92rem;
    }

    .hero-trust {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
    }

    .hero-trust-item {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 14px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.92);
        font-size: 0.88rem;
        font-weight: 600;
    }

    .hero-trust-item i {
        color: #b9f6d0;
    }

    .hero-visual {
        position: relative;
        padding: 22px;
    }

    .hero-carousel-shell {
        position: relative;
        padding: 16px;
        border-radius: 38px;
        background: rgba(255, 255, 255, 0.12);
        border: 1px solid rgba(255, 255, 255, 0.16);
        box-shadow: 0 40px 80px rgba(0, 0, 0, 0.22);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
    }

    .glass-card {
        background: var(--v-glass);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid var(--v-glass-border);
        border-radius: 32px;
        box-shadow: 0 24px 48px rgba(0, 0, 0, 0.05);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
    }

    /* BUTTONS */
    .btn-premium {
        background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));
        color: white;
        border-radius: 100px;
        font-weight: 700;
        padding: 14px 32px;
        border: none;
        box-shadow: 0 10px 20px rgba(15, 81, 50, 0.2);
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: inline-flex;
        align-items: center;
        gap: 12px;
    }

    .btn-premium:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 16px 32px rgba(15, 81, 50, 0.3);
        color: white;
    }

    .btn-glass {
        background: rgba(255, 255, 255, 0.5);
        backdrop-filter: blur(10px);
        color: var(--v-primary);
        border: 1px solid var(--v-primary-soft);
        border-radius: 100px;
        font-weight: 600;
        padding: 14px 32px;
        transition: all 0.3s ease;
    }

    .btn-glass:hover {
        background: white;
        transform: translateY(-4px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.05);
        color: var(--v-primary);
    }

    /* CAROUSEL */
    .hero-carousel {
        border-radius: 30px;
        overflow: hidden;
        box-shadow: none;
        transform: none;
        transition: transform 0.5s ease;
        border: none;
    }

    .hero-carousel:hover {
        transform: translateY(-6px);
    }

    .hero-carousel .carousel-indicators {
        position: absolute;
        right: 24px;
        bottom: 24px;
        left: auto;
        margin: 0;
        z-index: 3;
    }

    .hero-carousel .carousel-indicators [data-bs-target] {
        width: 34px;
        height: 8px;
        border: 0;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.42);
        opacity: 1;
    }

    .hero-carousel .carousel-indicators .active {
        background: #fff;
    }

    .carousel-item img {
        height: 540px;
        object-fit: cover;
    }

    .hero-floating-card {
        position: absolute;
        padding: 16px 18px;
        border-radius: 22px;
        background: rgba(255, 255, 255, 0.95);
        box-shadow: 0 22px 48px rgba(15, 81, 50, 0.16);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        color: var(--v-dark);
        max-width: 260px;
        z-index: 2;
    }

    .hero-floating-card--top {
        top: 40px;
        left: -6px;
    }

    .hero-floating-card--bottom {
        right: -10px;
        bottom: 32px;
    }

    .hero-floating-title {
        display: flex;
        align-items: center;
        gap: 10px;
        font-weight: 800;
        color: var(--v-primary);
        margin-bottom: 6px;
    }

    .hero-floating-title i {
        width: 36px;
        height: 36px;
        border-radius: 12px;
        background: var(--v-primary-soft);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--v-primary);
    }

    .hero-floating-text {
        margin: 0;
        color: #6b7280;
        font-size: 0.9rem;
        line-height: 1.6;
    }

    .hero-floating-chip {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 12px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #ecfdf5;
        color: var(--v-primary);
        font-size: 0.8rem;
        font-weight: 700;
    }

    /* FEATURES */
    .feature-box {
        border-radius: 28px;
        padding: 32px;
        height: 100%;
        background: white;
        transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        border: 1px solid rgba(0,0,0,0.03);
        position: relative;
        overflow: hidden;
        z-index: 1;
    }

    .feature-box::after {
        content: '';
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background: linear-gradient(135deg, var(--v-primary-soft), transparent);
        opacity: 0;
        z-index: -1;
        transition: opacity 0.4s ease;
    }

    .feature-box:hover {
        transform: translateY(-12px);
        box-shadow: 0 24px 48px rgba(15, 81, 50, 0.08);
    }

    .feature-box:hover::after {
        opacity: 0.3;
    }

    .feature-icon-wrapper {
        width: 72px;
        height: 72px;
        background: var(--v-primary-soft);
        border-radius: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        color: var(--v-primary);
        font-size: 28px;
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .feature-box:hover .feature-icon-wrapper {
        transform: scale(1.1) rotate(5deg);
        background: var(--v-primary);
        color: white;
    }

    /* PRODUCTS */
    .product-card {
        background: white;
        border-radius: 32px;
        padding: 16px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 32px 64px rgba(0,0,0,0.08);
    }

    .product-img-wrapper {
        border-radius: 24px;
        overflow: hidden;
        position: relative;
        aspect-ratio: 1;
        margin-bottom: 24px;
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .product-card:hover .product-img-wrapper img {
        transform: scale(1.08);
    }

    .product-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(8px);
        color: var(--v-primary);
        padding: 8px 16px;
        border-radius: 100px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.5px;
    }

    .product-title {
        font-weight: 700;
        font-size: 1.15rem;
        color: var(--v-dark);
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s ease;
    }

    .product-card:hover .product-title {
        color: var(--v-primary);
    }

    .product-desc {
        font-size: 0.9rem;
        color: #6B7280;
        margin-bottom: 20px;
        flex-grow: 1;
    }

    .product-price {
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--v-primary);
    }

    .add-cart-btn {
        width: 48px;
        height: 48px;
        border-radius: 100px;
        background: var(--v-primary-soft);
        color: var(--v-primary);
        display: flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: all 0.3s ease;
    }

    .product-card:hover .add-cart-btn {
        background: var(--v-primary);
        color: white;
        transform: rotate(90deg);
    }

    /* SERVICES SUMMARY */
    .service-banner {
        border-radius: 32px;
        overflow: hidden;
        position: relative;
        height: 300px;
        transition: all 0.5s ease;
    }

    .service-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }

    .service-banner:hover .service-img {
        transform: scale(1.1);
    }

    .service-overlay {
        position: absolute;
        bottom: 0; left: 0; right: 0;
        padding: 40px 32px 32px;
        background: linear-gradient(to top, rgba(0,0,0,0.8), transparent);
        color: white;
    }

    /* INSTAGRAM SECTION */
    .social-section {
        background: var(--v-primary);
        border-radius: 40px;
        padding: 80px 48px;
        margin: 100px 0;
        position: relative;
        overflow: hidden;
        color: white;
    }

    .social-section::before {
        content: '';
        position: absolute;
        top: -50%; right: -20%;
        width: 800px; height: 800px;
        background: radial-gradient(circle, var(--v-secondary) 0%, transparent 60%);
        opacity: 0.5;
        border-radius: 50%;
    }

    .insta-card {
        background: white;
        border-radius: 32px;
        padding: 24px;
        box-shadow: 0 32px 64px rgba(0,0,0,0.2);
        transform: rotate(2deg);
        transition: transform 0.5s ease;
    }

    .insta-card:hover {
        transform: rotate(0deg) scale(1.02);
    }

    /* CATALOGUE & STATS */
    .stat-card {
        background: white;
        border-radius: 32px;
        padding: 40px 24px;
        text-align: center;
        border: 1px solid rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 24px 48px rgba(15, 81, 50, 0.08);
        border-color: var(--v-primary-soft);
    }

    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: var(--v-primary);
        line-height: 1;
        margin-bottom: 8px;
    }

    .catalog-wrapper {
        background: white;
        border-radius: 40px;
        padding: 16px;
        box-shadow: 0 40px 80px rgba(0,0,0,0.05);
    }

    /* LOCATION */
    .location-wrapper {
        background: white;
        border-radius: 40px;
        padding: 48px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.04);
    }

    .map-container {
        border-radius: 32px;
        overflow: hidden;
        border: 8px solid var(--v-light);
        height: 100%;
        min-height: 500px;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-radius: 24px;
        background: var(--v-light);
        margin-bottom: 16px;
        transition: all 0.3s ease;
    }

    .contact-item:hover {
        background: var(--v-primary-soft);
        transform: translateX(8px);
    }

    .contact-icon {
        width: 56px; height: 56px;
        background: white;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: var(--v-primary);
        font-size: 24px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.05);
    }

    /* ANIMATIONS */
    @keyframes float {
        0% { transform: translateY(0) scale(1); }
        100% { transform: translateY(-30px) scale(1.05); }
    }

    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .animate-up {
        animation: fadeUp 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    
    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }

    @media (max-width: 991.98px) {
        .hero-wrapper {
            padding: calc(var(--site-header-offset, 100px) + 64px) 0 110px;
            min-height: auto;
        }

        .hero-visual {
            padding: 0;
        }

        .hero-content .row {
            --bs-gutter-y: 2.5rem;
        }

        .hero-floating-card {
            display: none;
        }

        .hero-carousel-shell {
            padding: 12px;
        }

        .carousel-item img {
            height: 420px;
        }
    }

    @media (max-width: 767.98px) {
        .hero-wrapper {
            padding: calc(var(--site-header-offset, 92px) + 42px) 0 92px;
        }

        .hero-content .row {
            --bs-gutter-y: 2rem;
        }

        .hero-kicker {
            max-width: 100%;
            padding: 11px 15px;
            border-radius: 22px;
            flex-wrap: wrap;
        }

        .hero-copy {
            margin-bottom: 1.5rem;
        }

        .hero-panel {
            gap: 10px;
            margin-bottom: 1.5rem;
        }

        .hero-actions {
            gap: 12px;
            margin-bottom: 1.5rem;
        }

        .hero-note {
            width: 100%;
            justify-content: flex-start;
        }

        .hero-carousel-shell {
            padding: 10px;
            border-radius: 30px;
        }

        .hero-carousel {
            border-radius: 24px;
        }
    }

    @media (max-width: 575.98px) {
        .hero-wrapper {
            padding: calc(var(--site-header-offset, 84px) + 26px) 0 78px;
        }

        .hero-title {
            font-size: clamp(2.3rem, 13vw, 3.2rem);
        }

        .hero-copy {
            font-size: 0.98rem;
            max-width: 100%;
        }

        .hero-panel-chip,
        .hero-trust-item,
        .hero-note {
            width: 100%;
            justify-content: flex-start;
        }

        .hero-actions .btn-premium,
        .hero-actions .btn-hero-secondary {
            width: 100%;
            justify-content: center;
            min-height: 54px;
        }

        .hero-panel-chip,
        .hero-trust-item {
            border-radius: 16px;
        }

        .hero-carousel-shell {
            border-radius: 26px;
        }

        .hero-carousel {
            border-radius: 22px;
        }

        .carousel-item img {
            height: 320px;
        }
    }

    @media (max-width: 479.98px) {
        .hero-wrapper {
            padding: calc(var(--site-header-offset, 84px) + 18px) 0 70px;
        }

        .hero-kicker {
            padding: 10px 14px;
            gap: 8px;
        }

        .hero-title {
            margin-bottom: 1rem;
        }

        .hero-copy {
            margin-bottom: 1.25rem;
            line-height: 1.7;
        }

        .carousel-item img {
            height: 280px;
        }
    }
</style>

<!-- Hero Section -->
<div class="hero-wrapper">
    <div class="hero-blur-blob"></div>
    <div class="container hero-content">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 animate-up">
                <div class="hero-kicker mb-4">
                    <i class="fas fa-print"></i>
                    <span class="fw-bold fs-6">Printshop premium untuk kebutuhan cetak & ATK</span>
                </div>
                <h1 class="hero-title">
                    Cetak lebih rapi,<br>
                    lebih cepat,<br>
                    dan terasa premium
                </h1>
                <p class="hero-copy pe-lg-5">
                    Vivia PrintShop menghadirkan solusi percetakan modern, layanan custom yang fleksibel, dan koleksi produk ATK yang siap mendukung kebutuhan harian maupun bisnis Anda.
                </p>
                <div class="hero-panel">
                    <span class="hero-panel-chip"><i class="fas fa-truck"></i> Pengiriman cepat & rapi</span>
                    <span class="hero-panel-chip"><i class="fas fa-palette"></i> Custom desain fleksibel</span>
                    <span class="hero-panel-chip"><i class="fas fa-store"></i> Belanja produk & cetak</span>
                </div>
                <div class="hero-actions">
                    <a href="{{ route('shop') }}" class="btn-premium border-0 shadow-lg">
                        Lihat Produk <i class="fas fa-arrow-right"></i>
                    </a>
                    <a href="{{ route('shopCetak') }}" class="btn-hero-secondary shadow-lg">
                        Jelajahi Layanan
                    </a>
                    <span class="hero-note">
                        <i class="fas fa-shield-alt text-success"></i>
                        Proses cepat, hasil lebih bersih
                    </span>
                </div>
                <div class="hero-trust">
                    <span class="hero-trust-item"><i class="fas fa-check-circle"></i> Order lebih mudah</span>
                    <span class="hero-trust-item"><i class="fas fa-clock"></i> Support responsif</span>
                </div>
            </div>
            <div class="col-lg-6 animate-up delay-2">
                <div class="hero-visual">
                    <div class="hero-floating-card hero-floating-card--top d-none d-md-block">
                        <div class="hero-floating-title">
                            <i class="fas fa-award"></i>
                            Kualitas unggulan
                        </div>
                        <p class="hero-floating-text">Dipilih untuk hasil yang presisi, warna lebih hidup, dan tampilan yang tetap profesional.</p>
                    </div>
                    <div class="hero-carousel-shell">
                        <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
                            <div class="carousel-indicators">
                                @foreach ($slides as $key)
                                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="Slide {{ $loop->index + 1 }}"></button>
                                @endforeach
                            </div>
                            <div class="carousel-inner">
                                @foreach ($slides as $key => $images)
                                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                        <img src="{{ asset('storage/' . $images->path) }}" class="d-block w-100" alt="Slide {{ $key + 1 }}">
                                        <div class="position-absolute w-100 h-100 top-0 left-0" style="background: linear-gradient(to top, rgba(0,0,0,0.32), transparent);"></div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="hero-floating-card hero-floating-card--bottom d-none d-md-block">
                        <div class="hero-floating-title">
                            <i class="fas fa-bolt"></i>
                            Siap order cepat
                        </div>
                        <p class="hero-floating-text mb-0">Katalog, cetak, dan checkout dalam satu alur yang lebih ringkas.</p>
                        <div class="hero-floating-chip"><i class="fas fa-check"></i> Respons lebih cepat</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Features Section -->
<div class="container py-5 mt-5">
    <div class="row g-4">
        <div class="col-md-6 col-lg-3 animate-up">
            <div class="feature-box">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <h4 class="fw-bold mb-3">Gratis Ongkir</h4>
                <p class="text-muted mb-0">Nikmati pengiriman gratis untuk setiap pembelanjaan minimal Rp 300.000 ke seluruh wilayah.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 animate-up delay-1">
            <div class="feature-box">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h4 class="fw-bold mb-3">Aman & Nyaman</h4>
                <p class="text-muted mb-0">Transaksi terlindungi 100% dengan sistem pembayaran terenkripsi yang canggih.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 animate-up delay-2">
            <div class="feature-box">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-redo-alt"></i>
                </div>
                <h4 class="fw-bold mb-3">Garansi Revisi</h4>
                <p class="text-muted mb-0">Kepuasan Anda prioritas kami. Tersedia garansi revisi desain secara cuma-cuma.</p>
            </div>
        </div>
        <div class="col-md-6 col-lg-3 animate-up delay-3">
            <div class="feature-box">
                <div class="feature-icon-wrapper">
                    <i class="fas fa-headset"></i>
                </div>
                <h4 class="fw-bold mb-3">Support 24/7</h4>
                <p class="text-muted mb-0">Tim customer service kami siap membantu kendala Anda kapanpun dan dimanapun.</p>
            </div>
        </div>
    </div>
</div>

<!-- Services Banner -->
<div class="container py-5">
    <div class="row g-4">
        <div class="col-lg-4">
            <div class="service-banner shadow-lg d-flex align-items-center justify-content-center p-4 border-0" style="background: linear-gradient(135deg, #10B981, #047857); position: relative; overflow: hidden; border-radius: 32px;">
                <i class="fas fa-boxes fa-10x" style="position: absolute; right: -30px; bottom: -30px; color: rgba(255,255,255,0.15); transform: rotate(-15deg);"></i>
                <div class="text-center position-relative z-2">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 80px; height: 80px;">
                        <i class="fas fa-boxes text-success fa-2x"></i>
                    </div>
                    <span class="badge bg-warning text-dark mb-3 px-3 py-2 rounded-pill shadow-sm fs-6">Tersedia</span>
                    <h3 class="fw-bold text-white mb-2">ATK Lengkap</h3>
                    <p class="text-white opacity-75 mb-0">Solusi alat tulis kantor super lengkap</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="service-banner shadow-lg d-flex align-items-center justify-content-center p-4 border-0 mt-lg-5" style="background: linear-gradient(135deg, #F59E0B, #B45309); position: relative; overflow: hidden; border-radius: 32px;">
                <i class="fas fa-image fa-10x" style="position: absolute; left: -20px; top: -10px; color: rgba(255,255,255,0.15); transform: rotate(10deg);"></i>
                <div class="text-center position-relative z-2">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 80px; height: 80px;">
                        <i class="fas fa-image text-warning fa-2x"></i>
                    </div>
                    <span class="badge bg-success text-white mb-3 px-3 py-2 rounded-pill shadow-sm fs-6">Gratis Kirim</span>
                    <h3 class="fw-bold text-white mb-2">Cetak Banner</h3>
                    <p class="text-white opacity-75 mb-0">Kualitas cetak spanduk revolusioner</p>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="service-banner shadow-lg d-flex align-items-center justify-content-center p-4 border-0" style="background: linear-gradient(135deg, #3B82F6, #1D4ED8); position: relative; overflow: hidden; border-radius: 32px;">
                <i class="fas fa-book fa-10x" style="position: absolute; right: -20px; top: -20px; color: rgba(255,255,255,0.15); transform: rotate(-10deg);"></i>
                <div class="text-center position-relative z-2">
                    <div class="bg-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-4 shadow" style="width: 80px; height: 80px;">
                        <i class="fas fa-book text-primary fa-2x"></i>
                    </div>
                    <span class="badge bg-danger text-white mb-3 px-3 py-2 rounded-pill shadow-sm fs-6">Pro Quality</span>
                    <h3 class="fw-bold text-white mb-2">Cetak Buku</h3>
                    <p class="text-white opacity-75 mb-0">Hasil terjilid sempurna & jaminan mutu</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Showcase -->
<div class="container py-5 my-5">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5">
        <div class="mb-4 mb-md-0">
            <span class="text-primary fw-bold text-uppercase tracking-wider" style="letter-spacing: 2px; font-size: 0.9rem;">Koleksi Terbaik</span>
            <h2 class="display-5 fw-bold title-gradient mt-2">Produk Unggulan Kami</h2>
        </div>
        <a href="{{ route('shop') }}" class="btn-glass px-4">
            Eksplor Semua <i class="fas fa-arrow-right ms-2"></i>
        </a>
    </div>

    <div class="row g-4">
        @foreach ($products as $row)
            <div class="col-12 col-md-6 col-lg-3">
                <div class="product-card">
                    <div class="product-img-wrapper">
                        @php
                            $image = !empty($row->products->productImages->first())
                                ? asset('storage/' . $row->products->productImages->first()->path)
                                : asset('images/placeholder.jpg');
                        @endphp
                        <img src="{{ $image }}" alt="{{ $row->products->name }}">
                        <div class="product-badge shadow-sm">
                            <i class="fas fa-tag me-1"></i> {{ $row->categories->name }}
                        </div>
                    </div>
                    
                    <a href="{{ route('shop-detail', $row->products->id) }}" class="text-decoration-none">
                        <h3 class="product-title">{{ $row->products->name }}</h3>
                    </a>
                    <p class="product-desc">{{ Str::limit($row->products->short_description, 60) }}</p>
                    
                    @if ($row->products->productInventory != null)
                        <div class="mt-auto mb-4 d-inline-flex align-items-center bg-light rounded-pill px-3 py-1">
                            <div class="w-2 h-2 rounded-circle bg-success me-2" style="width:8px; height:8px;"></div>
                            <small class="fw-bold text-dark">
                                Stok: {{ $row->products->type == 'configurable' ? $row->products->total_stock : ($row->products->productInventory->qty ?? 0) }}
                            </small>
                        </div>
                    @endif
                    
                    <div class="d-flex justify-content-between align-items-center mt-auto border-top pt-3">
                        <div class="product-price">
                            Rp {{ number_format($row->products->price) }}
                        </div>
                        <button class="add-cart-btn add-to-card"
                            product-id="{{ $row->products->id }}"
                            product-type="{{ $row->products->type }}"
                            product-slug="{{ $row->products->slug }}">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<!-- Interactive Social Banner -->
<div class="container">
    <div class="social-section shadow-lg">
        <div class="row align-items-center position-relative z-2">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="d-inline-flex bg-white bg-opacity-25 rounded-pill px-4 py-2 mb-4">
                    <i class="fab fa-instagram fs-5 me-2"></i> Join Our Community
                </div>
                <h2 class="display-4 fw-bold mb-4 text-white">Ikuti Perjalanan <br>Visual Kami</h2>
                <p class="fs-5 text-white opacity-75 mb-5 pe-lg-5">
                    Dapatkan inspirasi desain terbaru, tips cetak memukau, dan promo eksklusif yang hanya ada di Instagram @vivia_printshop.
                </p>
                <a href="https://www.instagram.com/vivia_printshop/" target="_blank" class="btn btn-light rounded-pill px-5 py-3 fw-bold fs-5 text-primary shadow-lg" style="transition: transform 0.3s;">
                    <i class="fab fa-instagram me-2"></i> Follow @vivia_printshop
                </a>
            </div>
            <div class="col-lg-6 d-flex justify-content-center justify-content-lg-end">
                <div class="insta-card">
                    <blockquote class="instagram-media"
                        data-instgrm-permalink="https://www.instagram.com/vivia_printshop/" data-instgrm-version="12"
                        style="background:#FFF; border:0; margin: 0; max-width:400px; width:100%;">
                    </blockquote>
                    <script async src="https://www.instagram.com/embed.js"></script>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Digital Catalog & Stats -->
<div class="container py-5">
    <div class="row g-5">
        <div class="col-lg-7">
            <div class="catalog-wrapper">
                <div class="d-flex justify-content-between align-items-center mb-4 px-4 pt-4">
                    <div>
                        <h3 class="fw-bold mb-1">Katalog Digital</h3>
                        <p class="text-muted mb-0">Eksplor produk lengkap kami</p>
                    </div>
                    <a href="https://drive.google.com/uc?export=download&id=1G3sq9BUgN4RaRBgVOs6iTSASHrYHB6Ij" target="_blank" class="btn btn-primary rounded-pill px-4 py-2 fw-bold bg-dark border-0">
                        <i class="fas fa-download me-2"></i> Unduh PDF
                    </a>
                </div>
                <div style="border-radius: 24px; overflow: hidden; height: 500px; background: var(--v-light);">
                    <iframe class="w-100 h-100" 
                            src="https://drive.google.com/file/d/1G3sq9BUgN4RaRBgVOs6iTSASHrYHB6Ij/preview?usp=sharing" 
                            style="border: none;">
                    </iframe>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="row g-4">
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="text-primary mb-3"><i class="fas fa-boxes fa-3x"></i></div>
                        <div class="stat-number">500+</div>
                        <div class="text-muted fw-semibold">Produk Berkualitas</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="text-success mb-3"><i class="fas fa-layer-group fa-3x"></i></div>
                        <div class="stat-number">50+</div>
                        <div class="text-muted fw-semibold">Kategori Tersedia</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="text-warning mb-3"><i class="fas fa-face-smile fa-3x"></i></div>
                        <div class="stat-number">1K+</div>
                        <div class="text-muted fw-semibold">Pelanggan Puas</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="text-info mb-3"><i class="fas fa-clock fa-3x"></i></div>
                        <div class="stat-number">24/7</div>
                        <div class="text-muted fw-semibold">Layanan Support</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 p-4 text-white rounded-4 shadow-sm" style="background: linear-gradient(135deg, var(--v-primary), var(--v-secondary)); background-size: 200% 200%; animation: gradient 5s ease infinite;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-motorcycle fa-2x me-3 opacity-75"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Akses Mudah!</h5>
                        <p class="mb-0 small opacity-75">Lokasi nyaman untuk semua kendaraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Location Info -->
<div class="container py-5 my-5">
    <div class="location-wrapper">
        <div class="row g-5">
            <div class="col-lg-5">
                <span class="text-primary fw-bold text-uppercase tracking-wider">Kunjungi Kami</span>
                <h2 class="display-6 fw-bold title-gradient mt-2 mb-4">Temukan VIVIA PrintShop</h2>
                <p class="text-muted fs-5 mb-5">Rasakan langsung kualitas produk kami dengan pelayanan prima dari staf ahli yang siap membantu Anda.</p>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Store</h6>
                        <p class="text-muted mb-0 small">Tebu Ireng IV Nomor 38, Cukir, Diwek, Kab. Jombang, Jawa Timur 61471</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Telepon & WhatsApp</h6>
                        <p class="text-muted mb-0 small">{{ optional($setting)->telepon ?? '+62 812 3456 7890' }}</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Alamat Surat</h6>
                        <p class="text-muted mb-0 small">{{ optional($setting)->email ?? 'info@vivia.com' }}</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1">Jam Buka</h6>
                        <p class="text-muted mb-0 small">Senin - Sabtu: 08:00 - 17:00 WIB</p>
                    </div>
                </div>

                <div class="d-flex gap-3 mt-5">
                    @php
                        $rawPhone = optional($setting)->telepon ?? '081234567890';
                        $waPhone = preg_replace('/^0/', '62', $rawPhone);
                    @endphp
                    <a href="https://wa.me/{{ $waPhone }}" target="_blank" class="btn btn-dark rounded-pill px-4 py-3 fw-bold flex-grow-1 shadow-sm">
                        <i class="fab fa-whatsapp me-2 fs-5"></i> Chat Kami
                    </a>
                    <a href="{{ optional($setting)->maps_url ?? 'https://maps.app.goo.gl/FQkhHuk1vnFZzcHg8?g_st=aw' }}" target="_blank" class="btn btn-outline-dark rounded-pill px-4 py-3 fw-bold flex-grow-1">
                        <i class="fas fa-map me-2"></i> Rute Lokasi
                    </a>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="map-container shadow-sm position-relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3954.6902460456313!2d112.2357296745512!3d-7.608646375209187!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7841556bd5c5bb%3A0x4517452691764b02!2sVIVIA%20PrintShop!5e0!3m2!1sid!2sid!4v1751760890529!5m2!1sid!2sid"
                        width="100%" 
                        height="100%" 
                        style="border:0; position: absolute; top:0; left:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script-alt')
<script>
    $('.change-the-class').click(function(e) {
        var idAddress = $('.class-address').attr('id');
        $('.class-change').attr('id', idAddress);
    });

    // Simple reveal animation
    document.addEventListener("DOMContentLoaded", function() {
        const elements = document.querySelectorAll('.animate-up');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animationPlayState = 'running';
                }
            });
        });
        
        elements.forEach(el => {
            el.style.animationPlayState = 'paused';
            observer.observe(el);
        });
    });
</script>
<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endpush
@endsection
