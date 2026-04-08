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
        text-decoration: none;
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
        text-decoration: none;
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
    .feature-stage {
        position: relative;
        padding: 28px;
        border-radius: 42px;
        background:
            radial-gradient(circle at top right, rgba(32, 201, 151, 0.12), transparent 28%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(244, 249, 246, 0.94));
        border: 1px solid rgba(15, 81, 50, 0.06);
        box-shadow: 0 30px 64px rgba(15, 81, 50, 0.08);
        overflow: hidden;
    }

    .feature-stage::before {
        content: '';
        position: absolute;
        top: -120px;
        right: -120px;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(32, 201, 151, 0.14), rgba(32, 201, 151, 0));
        pointer-events: none;
    }

    .feature-box {
        display: flex;
        flex-direction: column;
        border-radius: 30px;
        padding: 28px;
        height: 100%;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(247, 251, 248, 0.96));
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, border-color 0.4s ease;
        border: 1px solid rgba(15, 81, 50, 0.08);
        position: relative;
        overflow: hidden;
        z-index: 1;
        box-shadow: 0 18px 38px rgba(15, 81, 50, 0.05);
    }

    .feature-box::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, rgba(32, 201, 151, 0.95), rgba(15, 81, 50, 0.55));
        opacity: 0.88;
    }

    .feature-box::after {
        content: '';
        position: absolute;
        right: -52px;
        bottom: -76px;
        width: 180px;
        height: 180px;
        background: radial-gradient(circle, rgba(209, 231, 221, 0.9), rgba(209, 231, 221, 0));
        opacity: 0.58;
        z-index: -1;
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .feature-card-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 18px;
    }

    .feature-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15, 81, 50, 0.08);
        color: var(--v-primary);
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .feature-index {
        font-family: 'Raleway', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        letter-spacing: -0.02em;
        color: rgba(15, 81, 50, 0.34);
    }

    .feature-box:hover {
        transform: translateY(-10px);
        box-shadow: 0 28px 54px rgba(15, 81, 50, 0.12);
        border-color: rgba(15, 81, 50, 0.14);
    }

    .feature-box:hover::after {
        opacity: 0.9;
        transform: scale(1.12);
    }

    .feature-icon-wrapper {
        width: 68px;
        height: 68px;
        background: linear-gradient(135deg, rgba(209, 231, 221, 0.96), rgba(255, 255, 255, 0.98));
        border: 1px solid rgba(15, 81, 50, 0.08);
        border-radius: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        color: var(--v-primary);
        font-size: 28px;
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.72), 0 14px 28px rgba(15, 81, 50, 0.07);
        transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), background 0.3s ease, color 0.3s ease;
    }

    .feature-box:hover .feature-icon-wrapper {
        transform: translateY(-2px) scale(1.06) rotate(4deg);
        background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));
        color: white;
    }

    .feature-title {
        font-size: 1.35rem;
        line-height: 1.1;
        letter-spacing: -0.02em;
        color: #183b2b;
        margin-bottom: 12px;
    }

    .feature-copy {
        color: #60726a;
        line-height: 1.72;
        margin-bottom: 20px;
    }

    .feature-foot {
        margin-top: auto;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }

    .feature-foot span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.92);
        border: 1px solid rgba(15, 81, 50, 0.08);
        box-shadow: 0 10px 18px rgba(15, 81, 50, 0.05);
        color: #234536;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .feature-foot i {
        color: var(--v-secondary);
    }

    /* PRODUCTS */
    .product-stage {
        position: relative;
        padding: 34px;
        border-radius: 44px;
        background:
            radial-gradient(circle at top left, rgba(32, 201, 151, 0.12), transparent 26%),
            radial-gradient(circle at bottom right, rgba(15, 81, 50, 0.08), transparent 34%),
            linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(244, 249, 246, 0.96));
        border: 1px solid rgba(15, 81, 50, 0.06);
        box-shadow: 0 34px 72px rgba(15, 81, 50, 0.08);
        overflow: hidden;
    }

    .product-stage::before {
        content: '';
        position: absolute;
        top: -120px;
        left: -100px;
        width: 280px;
        height: 280px;
        background: radial-gradient(circle, rgba(32, 201, 151, 0.16), rgba(32, 201, 151, 0));
        pointer-events: none;
    }

    .product-stage-header,
    .product-grid {
        position: relative;
        z-index: 1;
    }

    .product-section-copy {
        max-width: 640px;
    }

    .product-section-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        color: #67a90d;
        font-size: 0.92rem;
        font-weight: 800;
        letter-spacing: 0.16em;
        text-transform: uppercase;
    }

    .product-section-title {
        font-family: 'Raleway', sans-serif;
        font-size: clamp(2.4rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 0.98;
        letter-spacing: -0.04em;
        margin-top: 0.75rem;
        margin-bottom: 1rem;
    }

    .product-section-subtitle {
        max-width: 560px;
        margin: 0;
        color: #6c8077;
        font-size: 1rem;
        line-height: 1.75;
    }

    .product-section-cta {
        min-height: 56px;
        padding: 0 24px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        background: rgba(255, 255, 255, 0.9);
        border: 1px solid rgba(15, 81, 50, 0.1);
        box-shadow: 0 16px 28px rgba(15, 81, 50, 0.08);
    }

    .product-grid {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 1.5rem;
    }

    .product-card {
        position: relative;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.98), rgba(247, 251, 248, 0.96));
        border-radius: 34px;
        padding: 18px;
        overflow: hidden;
        border: 1px solid rgba(15, 81, 50, 0.08);
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease, border-color 0.4s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        box-shadow: 0 20px 42px rgba(15, 81, 50, 0.06);
        isolation: isolate;
    }

    .product-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.42), rgba(255, 255, 255, 0));
        pointer-events: none;
    }

    .product-card::after {
        content: '';
        position: absolute;
        right: -58px;
        bottom: -82px;
        width: 220px;
        height: 220px;
        background: radial-gradient(circle, rgba(209, 231, 221, 0.88), rgba(209, 231, 221, 0));
        opacity: 0.54;
        z-index: 0;
        transition: transform 0.4s ease, opacity 0.4s ease;
    }

    .product-card > * {
        position: relative;
        z-index: 1;
    }

    .product-card:hover {
        transform: translateY(-12px);
        box-shadow: 0 34px 64px rgba(15, 81, 50, 0.14);
        border-color: rgba(15, 81, 50, 0.14);
    }

    .product-card:hover::after {
        transform: scale(1.08);
        opacity: 0.92;
    }

    .product-visual-frame {
        position: relative;
        padding: 12px;
        border-radius: 28px;
        background: linear-gradient(180deg, rgba(242, 247, 244, 0.96), rgba(255, 255, 255, 0.94));
        border: 1px solid rgba(15, 81, 50, 0.08);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8), 0 16px 28px rgba(15, 81, 50, 0.05);
        margin-bottom: 20px;
    }

    .product-img-wrapper {
        border-radius: 22px;
        overflow: hidden;
        position: relative;
        aspect-ratio: 1;
        margin-bottom: 0;
        background:
            radial-gradient(circle at top right, rgba(32, 201, 151, 0.14), transparent 32%),
            linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
    }

    .product-img-wrapper::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.05), rgba(15, 81, 50, 0.04));
        pointer-events: none;
        z-index: 1;
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
        z-index: 0;
    }

    .product-card:hover .product-img-wrapper img {
        transform: scale(1.06);
    }

    .product-badge-row {
        position: absolute;
        top: 14px;
        left: 14px;
        right: 14px;
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 10px;
        z-index: 3;
    }

    .product-badge {
        position: static;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        color: var(--v-primary);
        padding: 9px 14px;
        border-radius: 100px;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        border: 1px solid rgba(255, 255, 255, 0.7);
        box-shadow: 0 12px 20px rgba(15, 81, 50, 0.06);
    }

    .product-stock-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 12px;
        border-radius: 999px;
        font-size: 0.74rem;
        font-weight: 800;
        letter-spacing: 0.02em;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.55);
        box-shadow: 0 12px 20px rgba(15, 81, 50, 0.06);
        white-space: nowrap;
    }

    .product-stock-badge i {
        font-size: 0.72rem;
    }

    .product-stock-badge--success {
        background: rgba(236, 253, 245, 0.88);
        color: #0f5132;
    }

    .product-stock-badge--warning {
        background: rgba(255, 251, 235, 0.94);
        color: #92400e;
    }

    .product-stock-badge--muted {
        background: rgba(243, 244, 246, 0.94);
        color: #4b5563;
    }

    .product-stock-badge--neutral {
        background: rgba(239, 246, 255, 0.94);
        color: #1d4ed8;
    }

    .product-quick-link {
        display: none;
    }

    @media (hover: hover) and (pointer: fine) {
        .product-quick-link {
            position: absolute;
            left: 14px;
            right: 14px;
            bottom: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 46px;
            padding: 0 16px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.92);
            color: #163828;
            font-size: 0.9rem;
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 16px 28px rgba(15, 81, 50, 0.08);
            transform: translateY(16px);
            opacity: 0;
            transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.3s ease;
            z-index: 3;
        }

        .product-card:hover .product-quick-link {
            transform: translateY(0);
            opacity: 1;
        }

        .product-quick-link:hover {
            color: var(--v-primary);
            text-decoration: none;
        }
    }

    .product-card-body {
        display: flex;
        flex-direction: column;
        flex: 1;
        min-height: 0;
    }

    .product-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        align-self: flex-start;
        margin-bottom: 12px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15, 81, 50, 0.06);
        color: var(--v-primary);
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .product-title-link {
        text-decoration: none;
        color: inherit;
    }

    .product-title {
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        font-size: 1.34rem;
        color: var(--v-dark);
        line-height: 1.08;
        letter-spacing: -0.02em;
        margin-bottom: 12px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.25s ease;
    }

    .product-card:hover .product-title {
        color: var(--v-primary);
    }

    .product-desc {
        font-size: 0.93rem;
        line-height: 1.72;
        color: #677b72;
        margin-bottom: 18px;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .product-meta-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 18px;
    }

    .product-meta-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 12px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.95);
        border: 1px solid rgba(15, 81, 50, 0.08);
        box-shadow: 0 10px 20px rgba(15, 81, 50, 0.05);
        color: #254636;
        font-size: 0.78rem;
        font-weight: 700;
    }

    .product-meta-pill i {
        color: var(--v-secondary);
    }

    .product-meta-pill--soft {
        background: rgba(209, 231, 221, 0.36);
    }

    .product-footer {
        margin-top: auto;
        padding-top: 18px;
        border-top: 1px solid rgba(15, 81, 50, 0.08);
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .product-price-stack {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        padding: 12px 16px;
        border-radius: 16px;
        background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.8));
        border: 1px solid rgba(15,81,50,0.08);
    }

    .product-price-label {
        font-size: 0.72rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #7b8d85;
    }

    .product-price {
        font-family: 'Raleway', sans-serif;
        font-size: 1.35rem;
        font-weight: 800;
        color: var(--v-primary);
        line-height: 1;
        letter-spacing: -0.03em;
        white-space: nowrap;
    }

    .product-actions {
        display: flex;
        align-items: center;
        gap: 10px;
        width: 100%;
    }

    .product-detail-link {
        min-height: 48px;
        padding: 0 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 999px;
        background: rgba(15, 81, 50, 0.06);
        border: 1px solid rgba(15, 81, 50, 0.08);
        color: #234536;
        font-size: 0.9rem;
        font-weight: 800;
        text-decoration: none;
        transition: transform 0.25s ease, background-color 0.25s ease, color 0.25s ease;
    }

    .product-detail-link:hover {
        color: var(--v-primary);
        background: rgba(209, 231, 221, 0.72);
        text-decoration: none;
        transform: translateY(-2px);
    }

    .add-cart-btn {
        min-width: 116px;
        min-height: 48px;
        padding: 0 18px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        border: none;
        box-shadow: 0 16px 28px rgba(15, 81, 50, 0.18);
        font-size: 0.92rem;
        font-weight: 800;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .add-cart-btn i {
        transition: transform 0.25s ease;
    }

    .product-card:hover .add-cart-btn {
        transform: translateY(-2px);
        box-shadow: 0 22px 34px rgba(15, 81, 50, 0.22);
    }

    .product-card:hover .add-cart-btn i {
        transform: rotate(90deg);
    }

    /* SERVICES SUMMARY */
    .service-stage {
        position: relative;
    }

    .service-banner {
        border-radius: 36px;
        overflow: hidden;
        position: relative;
        height: 100%;
        min-height: 330px;
        padding: 28px;
        transition: transform 0.45s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.45s ease;
        border: 1px solid rgba(255, 255, 255, 0.16);
        box-shadow: 0 28px 56px rgba(17, 24, 39, 0.12);
        isolation: isolate;
    }

    .service-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.16) 0%, rgba(255, 255, 255, 0) 44%, rgba(6, 18, 12, 0.16) 100%);
        z-index: 0;
    }

    .service-banner::after {
        content: '';
        position: absolute;
        left: -26px;
        bottom: -74px;
        width: 230px;
        height: 230px;
        background: radial-gradient(circle, rgba(255, 255, 255, 0.18), rgba(255, 255, 255, 0));
        z-index: 0;
        pointer-events: none;
    }

    .service-banner--emerald {
        background: linear-gradient(145deg, #12b886 0%, #109f76 34%, #0b6b52 100%);
    }

    .service-banner--amber {
        background: linear-gradient(145deg, #f8b238 0%, #eb920a 34%, #b45309 100%);
    }

    .service-banner--blue {
        background: linear-gradient(145deg, #4f8cff 0%, #2f67ed 36%, #1d4ed8 100%);
    }

    .service-banner--offset {
        margin-top: 48px;
    }

    .service-banner-body {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        gap: 24px;
        min-height: 100%;
        text-align: center;
    }

    .service-banner-top {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 18px;
        width: 100%;
    }

    .service-icon-orb {
        width: 84px;
        height: 84px;
        padding: 10px;
        border-radius: 26px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.16);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .service-icon-inner {
        width: 100%;
        height: 100%;
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff;
        box-shadow: 0 14px 28px rgba(0, 0, 0, 0.14);
    }

    .service-icon-inner i {
        font-size: 1.9rem;
    }

    .service-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 14px;
        border-radius: 999px;
        font-size: 0.82rem;
        font-weight: 800;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
    }

    .service-badge--sun {
        background: #facc15;
        color: #4b3c03;
    }

    .service-badge--mint {
        background: #0f8d61;
        color: #fff;
    }

    .service-badge--rose {
        background: #ef4444;
        color: #fff;
    }

    .service-copy {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .service-title {
        font-family: 'Raleway', sans-serif;
        font-size: clamp(2rem, 3vw, 2.5rem);
        font-weight: 800;
        line-height: 0.98;
        letter-spacing: -0.04em;
        color: #fff;
        margin-bottom: 0;
    }

    .service-description {
        max-width: 260px;
        margin: 0;
        font-size: 1rem;
        line-height: 1.7;
        color: rgba(255, 255, 255, 0.84);
    }

    .service-meta {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 10px;
    }

    .service-meta-item {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 10px 13px;
        border-radius: 999px;
        background: rgba(255, 255, 255, 0.14);
        border: 1px solid rgba(255, 255, 255, 0.14);
        color: #fff;
        font-size: 0.8rem;
        font-weight: 700;
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    .service-watermark {
        position: absolute;
        color: rgba(255, 255, 255, 0.12);
        line-height: 1;
        z-index: 0;
        pointer-events: none;
        transition: transform 0.45s ease;
    }

    .service-watermark--bottom-right {
        right: -24px;
        bottom: -34px;
        font-size: 11rem;
        transform: rotate(-14deg);
    }

    .service-watermark--top-left {
        left: -24px;
        top: -18px;
        font-size: 10rem;
        transform: rotate(12deg);
    }

    .service-watermark--top-right {
        right: -18px;
        top: -18px;
        font-size: 10rem;
        transform: rotate(-12deg);
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

    .service-banner:hover {
        transform: translateY(-10px) scale(1.01);
        box-shadow: 0 34px 62px rgba(15, 81, 50, 0.18);
    }

    .service-banner:hover .service-watermark--bottom-right {
        transform: rotate(-10deg) translate(-6px, -8px);
    }

    .service-banner:hover .service-watermark--top-left {
        transform: rotate(8deg) translate(6px, 8px);
    }

    .service-banner:hover .service-watermark--top-right {
        transform: rotate(-8deg) translate(-6px, 8px);
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
        background: linear-gradient(135deg, var(--v-primary) 0%, #145a38 50%, var(--v-secondary) 100%);
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
        background: radial-gradient(circle, rgba(32,201,151,0.3) 0%, transparent 60%);
        opacity: 0.5;
        border-radius: 50%;
    }

    .social-kicker {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        padding: 10px 20px;
        border-radius: 999px;
        background: rgba(255,255,255,0.15);
        border: 1px solid rgba(255,255,255,0.25);
        color: #fff;
        font-size: 0.88rem;
        font-weight: 700;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        margin-bottom: 1.5rem;
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
    .catalog-section-header {
        margin-bottom: 3rem;
    }

    .catalog-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1rem;
        padding: 9px 14px;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
        color: var(--v-primary);
        font-size: 0.74rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

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

    .stat-icon {
        width: 64px;
        height: 64px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
        font-size: 1.6rem;
    }

    .stat-icon--green { background: rgba(15,81,50,0.08); color: var(--v-primary); }
    .stat-icon--teal { background: rgba(32,201,151,0.1); color: #0d9668; }
    .stat-icon--amber { background: rgba(245,158,11,0.1); color: #b45309; }
    .stat-icon--blue { background: rgba(59,130,246,0.1); color: #1d4ed8; }

    .catalog-wrapper {
        background: white;
        border-radius: 40px;
        padding: 16px;
        box-shadow: 0 40px 80px rgba(0,0,0,0.05);
        overflow: hidden;
    }

    .catalog-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 24px 24px 20px;
    }

    .catalog-title {
        font-family: 'Raleway', sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: var(--v-dark);
        margin-bottom: 4px;
    }

    .catalog-subtitle {
        color: #72857d;
        font-size: 0.92rem;
        margin: 0;
    }

    .catalog-download-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        border-radius: 999px;
        background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));
        color: #fff;
        font-weight: 700;
        font-size: 0.92rem;
        text-decoration: none;
        border: none;
        box-shadow: 0 8px 24px rgba(15,81,50,0.2);
        transition: all 0.3s ease;
    }

    .catalog-download-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(15,81,50,0.28);
        color: #fff;
    }

    .catalog-iframe-wrap {
        border-radius: 24px;
        overflow: hidden;
        height: 500px;
        background: var(--v-light);
        border: 1px solid rgba(15,81,50,0.06);
    }

    /* LOCATION */
    .location-section {
        position: relative;
    }

    .location-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 1rem;
        padding: 9px 14px;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
        color: var(--v-primary);
        font-size: 0.74rem;
        font-weight: 800;
        letter-spacing: 0.1em;
        text-transform: uppercase;
    }

    .location-wrapper {
        background: white;
        border-radius: 40px;
        padding: 48px;
        box-shadow: 0 24px 64px rgba(0,0,0,0.04);
        border: 1px solid rgba(15,81,50,0.06);
    }

    .location-map-col {
        position: relative;
    }

    .map-container {
        border-radius: 32px;
        overflow: hidden;
        border: 4px solid var(--v-primary-soft);
        height: 100%;
        min-height: 500px;
        box-shadow: 0 24px 48px rgba(15,81,50,0.1);
    }

    .map-overlay-badge {
        position: absolute;
        top: 24px;
        left: 24px;
        z-index: 2;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,0.95);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        box-shadow: 0 8px 24px rgba(0,0,0,0.12);
        color: var(--v-primary);
        font-weight: 700;
        font-size: 0.85rem;
    }

    .map-overlay-badge i {
        color: #ef4444;
    }

    .contact-item {
        display: flex;
        align-items: center;
        gap: 20px;
        padding: 20px;
        border-radius: 24px;
        background: var(--v-light);
        margin-bottom: 12px;
        transition: all 0.3s ease;
        border: 1px solid transparent;
    }

    .contact-item:hover {
        background: var(--v-primary-soft);
        transform: translateX(8px);
        border-color: rgba(15,81,50,0.1);
    }

    .contact-icon {
        width: 52px; height: 52px;
        background: white;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        color: var(--v-primary);
        font-size: 20px;
        box-shadow: 0 8px 16px rgba(15,81,50,0.08);
        flex-shrink: 0;
    }

    .contact-cta-group {
        display: flex;
        gap: 12px;
        margin-top: 2rem;
    }

    .contact-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        padding: 14px 24px;
        border-radius: 999px;
        font-weight: 700;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        flex: 1;
    }

    .contact-cta--primary {
        background: linear-gradient(135deg, var(--v-primary), var(--v-secondary));
        color: #fff;
        border: none;
        box-shadow: 0 8px 24px rgba(15,81,50,0.2);
    }

    .contact-cta--primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 32px rgba(15,81,50,0.28);
        color: #fff;
    }

    .contact-cta--outline {
        background: transparent;
        color: var(--v-primary);
        border: 2px solid rgba(15,81,50,0.18);
    }

    .contact-cta--outline:hover {
        background: var(--v-primary-soft);
        border-color: var(--v-primary);
        transform: translateY(-2px);
        color: var(--v-primary);
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

        .product-stage {
            padding: 24px;
            border-radius: 36px;
        }

        .product-stage-header {
            margin-bottom: 2rem !important;
        }

        .product-section-subtitle {
            max-width: 100%;
        }

        .product-card {
            border-radius: 30px;
        }

        .product-title {
            font-size: 1.24rem;
        }

        .product-actions {
            width: 100%;
        }

        .feature-stage {
            padding: 22px;
            border-radius: 34px;
        }

        .service-banner--offset {
            margin-top: 0;
        }

        .service-banner {
            min-height: 300px;
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

        .product-stage {
            padding: 18px;
            border-radius: 30px;
        }

        .product-stage-header {
            margin-bottom: 1.75rem !important;
        }

        .product-section-title {
            font-size: clamp(2rem, 9vw, 2.8rem);
        }

        .product-section-subtitle {
            font-size: 0.95rem;
            line-height: 1.68;
        }

        .product-visual-frame {
            padding: 10px;
            border-radius: 24px;
        }

        .product-img-wrapper {
            border-radius: 18px;
        }

        .product-card {
            padding: 16px;
            border-radius: 26px;
        }

        .product-kicker {
            margin-bottom: 10px;
        }

        .product-title {
            font-size: 1.16rem;
            margin-bottom: 10px;
        }

        .product-desc {
            font-size: 0.9rem;
            line-height: 1.64;
            -webkit-line-clamp: 2;
        }

        .product-meta-pill {
            width: 100%;
            justify-content: flex-start;
        }

        .product-footer {
            gap: 12px;
        }

        .product-price-stack {
            padding: 10px 14px;
        }

        .product-actions {
            width: 100%;
        }

        .product-detail-link,
        .add-cart-btn {
            flex: 1 1 0;
        }

        .feature-stage {
            padding: 16px;
            border-radius: 28px;
        }

        .feature-box {
            padding: 22px;
            border-radius: 24px;
        }

        .feature-title {
            font-size: 1.2rem;
        }

        .feature-copy {
            font-size: 0.94rem;
            line-height: 1.66;
        }

        .feature-foot span {
            width: 100%;
            justify-content: flex-start;
        }

        .service-banner {
            min-height: auto;
            padding: 24px;
            border-radius: 28px;
        }

        .service-banner-body {
            gap: 20px;
        }

        .service-title {
            font-size: 1.95rem;
        }

        .service-description {
            max-width: none;
            font-size: 0.95rem;
        }

        .service-icon-orb {
            width: 74px;
            height: 74px;
            border-radius: 22px;
        }

        .service-icon-inner {
            border-radius: 16px;
        }

        .service-icon-inner i {
            font-size: 1.7rem;
        }

        .service-meta-item {
            width: 100%;
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

        .product-stage {
            padding: 14px;
            border-radius: 24px;
        }

        .product-stage-header {
            gap: 1rem !important;
        }

        .product-section-kicker {
            font-size: 0.8rem;
            letter-spacing: 0.12em;
        }

        .product-section-title {
            margin-top: 0.55rem;
            margin-bottom: 0.75rem;
        }

        .product-section-cta {
            width: 100%;
        }

        .product-card {
            padding: 14px;
            border-radius: 22px;
        }

        .product-visual-frame {
            padding: 9px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .product-badge-row {
            top: 10px;
            left: 10px;
            right: 10px;
            gap: 8px;
        }

        .product-badge,
        .product-stock-badge {
            padding: 8px 10px;
            font-size: 0.68rem;
        }

        .product-kicker {
            font-size: 0.68rem;
        }

        .product-price {
            font-size: 1.2rem;
        }

        .product-actions {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .product-detail-link,
        .add-cart-btn {
            min-height: 50px;
        }

        .feature-stage {
            padding: 14px;
            border-radius: 24px;
        }

        .feature-card-top {
            margin-bottom: 14px;
        }

        .feature-tag {
            font-size: 0.68rem;
        }

        .service-banner {
            padding: 20px;
        }

        .service-title {
            font-size: 1.78rem;
        }

        .service-watermark--bottom-right,
        .service-watermark--top-left,
        .service-watermark--top-right {
            font-size: 8rem;
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

        .product-stage {
            padding: 12px;
            border-radius: 22px;
        }

        .product-card {
            border-radius: 20px;
        }

        .product-section-subtitle {
            font-size: 0.9rem;
        }

        .product-badge-row {
            flex-direction: column;
            align-items: flex-start;
        }

        .product-stock-badge {
            max-width: 100%;
            white-space: normal;
        }

        .product-actions {
            grid-template-columns: 1fr;
        }

        .product-detail-link,
        .add-cart-btn {
            width: 100%;
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

    /* RESPONSIVE: Social, Catalog, Location sections */
    @media (max-width: 991.98px) {
        .social-section {
            padding: 60px 32px;
            margin: 60px 0;
            border-radius: 32px;
        }

        .location-wrapper {
            padding: 36px;
            border-radius: 32px;
        }

        .map-container {
            min-height: 380px;
        }

        .catalog-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 16px;
        }
    }

    @media (max-width: 767.98px) {
        .social-section {
            padding: 48px 24px;
            margin: 48px 0;
            border-radius: 28px;
        }

        .social-section .display-4 {
            font-size: 2rem;
        }

        .social-section .fs-5 {
            font-size: 1rem !important;
        }

        .insta-card {
            border-radius: 24px;
            padding: 18px;
        }

        .location-wrapper {
            padding: 28px;
            border-radius: 28px;
        }

        .map-container {
            min-height: 320px;
            border-radius: 24px;
        }

        .contact-cta-group {
            flex-direction: column;
        }

        .stat-number {
            font-size: 2.4rem;
        }

        .stat-card {
            padding: 28px 18px;
            border-radius: 24px;
        }

        .catalog-wrapper {
            border-radius: 28px;
        }

        .catalog-iframe-wrap {
            height: 380px;
        }
    }

    @media (max-width: 575.98px) {
        .social-section {
            padding: 36px 20px;
            border-radius: 24px;
        }

        .social-kicker {
            font-size: 0.8rem;
            padding: 8px 16px;
        }

        .location-wrapper {
            padding: 22px;
            border-radius: 24px;
        }

        .contact-item {
            padding: 16px;
            gap: 14px;
            border-radius: 18px;
        }

        .contact-icon {
            width: 44px;
            height: 44px;
            font-size: 16px;
            border-radius: 14px;
        }

        .map-container {
            min-height: 280px;
            border-radius: 20px;
        }

        .map-overlay-badge {
            top: 14px;
            left: 14px;
            padding: 10px 14px;
            font-size: 0.78rem;
        }

        .catalog-iframe-wrap {
            height: 320px;
        }

        .catalog-download-btn {
            width: 100%;
            justify-content: center;
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
    <div class="feature-stage">
        <div class="row g-4">
            <div class="col-md-6 col-lg-3 animate-up">
                <div class="feature-box">
                    <div class="feature-card-top">
                        <span class="feature-tag">Benefit</span>
                        <span class="feature-index">01</span>
                    </div>
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h4 class="feature-title fw-bold">Gratis Ongkir</h4>
                    <p class="feature-copy mb-0">Nikmati pengiriman gratis untuk setiap pembelanjaan minimal Rp 300.000 ke seluruh wilayah.</p>
                    <div class="feature-foot">
                        <span><i class="fas fa-check-circle"></i> Minimal order tertentu</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-up delay-1">
                <div class="feature-box">
                    <div class="feature-card-top">
                        <span class="feature-tag">Proteksi</span>
                        <span class="feature-index">02</span>
                    </div>
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4 class="feature-title fw-bold">Aman & Nyaman</h4>
                    <p class="feature-copy mb-0">Transaksi terlindungi 100% dengan sistem pembayaran terenkripsi yang canggih.</p>
                    <div class="feature-foot">
                        <span><i class="fas fa-lock"></i> Checkout lebih terlindungi</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-up delay-2">
                <div class="feature-box">
                    <div class="feature-card-top">
                        <span class="feature-tag">Fleksibel</span>
                        <span class="feature-index">03</span>
                    </div>
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-redo-alt"></i>
                    </div>
                    <h4 class="feature-title fw-bold">Garansi Revisi</h4>
                    <p class="feature-copy mb-0">Kepuasan Anda prioritas kami. Tersedia garansi revisi desain secara cuma-cuma.</p>
                    <div class="feature-foot">
                        <span><i class="fas fa-pencil-ruler"></i> Koreksi lebih leluasa</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3 animate-up delay-3">
                <div class="feature-box">
                    <div class="feature-card-top">
                        <span class="feature-tag">Responsif</span>
                        <span class="feature-index">04</span>
                    </div>
                    <div class="feature-icon-wrapper">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h4 class="feature-title fw-bold">Support 24/7</h4>
                    <p class="feature-copy mb-0">Tim customer service kami siap membantu kendala Anda kapanpun dan dimanapun.</p>
                    <div class="feature-foot">
                        <span><i class="fas fa-bolt"></i> Tim siap bantu cepat</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Services Banner -->
<div class="container py-5">
    <div class="service-stage">
        <div class="row g-4 align-items-stretch">
        <div class="col-lg-4">
                <div class="service-banner service-banner--emerald">
                    <i class="fas fa-boxes service-watermark service-watermark--bottom-right"></i>
                    <div class="service-banner-body">
                        <div class="service-banner-top">
                            <div class="service-icon-orb">
                                <div class="service-icon-inner">
                                    <i class="fas fa-boxes text-success"></i>
                                </div>
                            </div>
                            <span class="service-badge service-badge--sun">Tersedia</span>
                        </div>
                        <div class="service-copy">
                            <h3 class="service-title">ATK Lengkap</h3>
                            <p class="service-description">Solusi alat tulis kantor super lengkap</p>
                        </div>
                        <div class="service-meta">
                            <span class="service-meta-item"><i class="fas fa-store"></i> Stok siap pilih</span>
                            <span class="service-meta-item"><i class="fas fa-bolt"></i> Checkout lebih cepat</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-banner service-banner--amber service-banner--offset">
                    <i class="fas fa-image service-watermark service-watermark--top-left"></i>
                    <div class="service-banner-body">
                        <div class="service-banner-top">
                            <div class="service-icon-orb">
                                <div class="service-icon-inner">
                                    <i class="fas fa-image text-warning"></i>
                                </div>
                            </div>
                            <span class="service-badge service-badge--mint">Gratis Kirim</span>
                        </div>
                        <div class="service-copy">
                            <h3 class="service-title">Cetak Banner</h3>
                            <p class="service-description">Kualitas cetak spanduk revolusioner</p>
                        </div>
                        <div class="service-meta">
                            <span class="service-meta-item"><i class="fas fa-ruler-combined"></i> Ukuran fleksibel</span>
                            <span class="service-meta-item"><i class="fas fa-palette"></i> Warna lebih hidup</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="service-banner service-banner--blue">
                    <i class="fas fa-book service-watermark service-watermark--top-right"></i>
                    <div class="service-banner-body">
                        <div class="service-banner-top">
                            <div class="service-icon-orb">
                                <div class="service-icon-inner">
                                    <i class="fas fa-book text-primary"></i>
                                </div>
                            </div>
                            <span class="service-badge service-badge--rose">Pro Quality</span>
                        </div>
                        <div class="service-copy">
                            <h3 class="service-title">Cetak Buku</h3>
                            <p class="service-description">Hasil terjilid sempurna & jaminan mutu</p>
                        </div>
                        <div class="service-meta">
                            <span class="service-meta-item"><i class="fas fa-layer-group"></i> Finishing lebih rapi</span>
                            <span class="service-meta-item"><i class="fas fa-medal"></i> Kualitas konsisten</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Products Showcase -->
<div class="container py-5 my-5">
    <div class="product-stage">
        <div class="product-stage-header d-flex flex-column flex-lg-row justify-content-between align-items-lg-end gap-4 mb-5">
            <div class="product-section-copy">
                <span class="product-section-kicker">Koleksi Terbaik</span>
                <h2 class="product-section-title title-gradient">Produk Unggulan Kami</h2>
                <p class="product-section-subtitle">Temukan produk pilihan untuk kebutuhan cetak dan ATK dengan visual yang lebih jelas, harga yang langsung terbaca, dan alur belanja yang terasa lebih cepat.</p>
            </div>
            <a href="{{ route('shop') }}" class="btn-glass product-section-cta">
                Eksplor Semua <i class="fas fa-arrow-right"></i>
            </a>
        </div>

        <div class="row product-grid">
            @foreach ($products as $row)
                @php
                    $product = $row->products;
                    $image = !empty($product->productImages->first())
                        ? asset('storage/' . $product->productImages->first()->path)
                        : asset('images/placeholder.jpg');
                    $hasInventory = $product->productInventory != null;
                    $stockQuantity = $hasInventory
                        ? ($product->type == 'configurable' ? $product->total_stock : ($product->productInventory->qty ?? 0))
                        : null;
                    $availabilityLabel = is_null($stockQuantity)
                        ? ($product->type == 'configurable' ? 'Pilih varian' : 'Lihat detail')
                        : ($stockQuantity > 10 ? 'Tersedia' : ($stockQuantity > 0 ? 'Stok terbatas' : 'Stok habis'));
                    $availabilityClass = is_null($stockQuantity)
                        ? 'product-stock-badge--neutral'
                        : ($stockQuantity > 10 ? 'product-stock-badge--success' : ($stockQuantity > 0 ? 'product-stock-badge--warning' : 'product-stock-badge--muted'));
                    $availabilityIcon = is_null($stockQuantity)
                        ? 'fas fa-info-circle'
                        : ($stockQuantity > 10 ? 'fas fa-check-circle' : ($stockQuantity > 0 ? 'fas fa-exclamation-circle' : 'fas fa-times-circle'));
                    $productKicker = $product->type == 'configurable' ? 'Pilihan varian' : 'Siap dipesan';
                    $productHighlight = $product->type == 'configurable' ? 'Lebih fleksibel' : 'Checkout cepat';
                @endphp
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="product-card">
                        <div class="product-visual-frame">
                            <div class="product-badge-row">
                                <div class="product-badge shadow-sm">
                                    <i class="fas fa-tag"></i> {{ $row->categories->name }}
                                </div>
                                <div class="product-stock-badge {{ $availabilityClass }}">
                                    <i class="{{ $availabilityIcon }}"></i> {{ $availabilityLabel }}
                                </div>
                            </div>
                            <div class="product-img-wrapper">
                                <img src="{{ $image }}" alt="{{ $product->name }}">
                            </div>
                            <a href="{{ route('shop-detail', $product->id) }}" class="product-quick-link">
                                Lihat detail <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>

                        <div class="product-card-body">
                            <span class="product-kicker">{{ $productKicker }}</span>
                            <a href="{{ route('shop-detail', $product->id) }}" class="product-title-link">
                                <h3 class="product-title">{{ $product->name }}</h3>
                            </a>
                            <p class="product-desc">{{ Str::limit($product->short_description, 84) }}</p>

                            <div class="product-meta-row">
                                @if ($hasInventory)
                                    <span class="product-meta-pill">
                                        <i class="fas fa-box"></i>
                                        Stok {{ $stockQuantity }}
                                    </span>
                                @endif
                                <span class="product-meta-pill product-meta-pill--soft">
                                    <i class="fas fa-bolt"></i>
                                    {{ $productHighlight }}
                                </span>
                            </div>

                            <div class="product-footer">
                                <div class="product-price-stack">
                                    <span class="product-price-label">Harga</span>
                                    <div class="product-price">Rp {{ number_format($product->price) }}</div>
                                </div>
                                <div class="product-actions">
                                    <a href="{{ route('shop-detail', $product->id) }}" class="product-detail-link">Detail</a>
                                    <button class="add-cart-btn add-to-card"
                                        product-id="{{ $product->id }}"
                                        product-type="{{ $product->type }}"
                                        product-slug="{{ $product->slug }}">
                                        <span>Tambah</span>
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Interactive Social Banner -->
<div class="container">
    <div class="social-section shadow-lg">
        <div class="row align-items-center position-relative z-2">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="social-kicker">
                    <i class="fab fa-instagram fs-5"></i> Komunitas Kami
                </div>
                <h2 class="display-4 fw-bold mb-4 text-white">Ikuti Perjalanan <br>Visual Kami</h2>
                <p class="fs-5 mb-5 pe-lg-5" style="color: rgba(255,255,255,0.8);">
                    Dapatkan inspirasi desain terbaru, tips cetak memukau, dan promo eksklusif yang hanya ada di Instagram @vivia_printshop.
                </p>
                <a href="https://www.instagram.com/vivia_printshop/" target="_blank" class="btn btn-light rounded-pill px-5 py-3 fw-bold fs-5 shadow-lg" style="color: var(--v-primary); transition: transform 0.3s;">
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
    <div class="catalog-section-header text-center">
        <span class="catalog-kicker"><i class="fas fa-book-open"></i> Katalog & Statistik</span>
        <h2 class="title-gradient" style="font-size: clamp(2rem, 4vw, 2.8rem);">Katalog Digital</h2>
        <p class="text-muted mx-auto" style="max-width: 540px;">Eksplor produk lengkap kami dengan katalog digital interaktif dan lihat pencapaian kami.</p>
    </div>
    <div class="row g-5">
        <div class="col-lg-7">
            <div class="catalog-wrapper">
                <div class="catalog-header">
                    <div>
                        <h3 class="catalog-title">Katalog Produk</h3>
                        <p class="catalog-subtitle">Lihat semua produk dalam satu dokumen</p>
                    </div>
                    <a href="https://drive.google.com/uc?export=download&id=1G3sq9BUgN4RaRBgVOs6iTSASHrYHB6Ij" target="_blank" class="catalog-download-btn">
                        <i class="fas fa-download"></i> Unduh PDF
                    </a>
                </div>
                <div class="catalog-iframe-wrap">
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
                        <div class="stat-icon stat-icon--green"><i class="fas fa-boxes"></i></div>
                        <div class="stat-number">500+</div>
                        <div class="text-muted fw-semibold">Produk Berkualitas</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--teal"><i class="fas fa-layer-group"></i></div>
                        <div class="stat-number">50+</div>
                        <div class="text-muted fw-semibold">Kategori Tersedia</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--amber"><i class="fas fa-face-smile"></i></div>
                        <div class="stat-number">1K+</div>
                        <div class="text-muted fw-semibold">Pelanggan Puas</div>
                    </div>
                </div>
                <div class="col-sm-6 text-center">
                    <div class="stat-card h-100">
                        <div class="stat-icon stat-icon--blue"><i class="fas fa-clock"></i></div>
                        <div class="stat-number">24/7</div>
                        <div class="text-muted fw-semibold">Layanan Support</div>
                    </div>
                </div>
            </div>
            
            <div class="mt-4 p-4 text-white rounded-4 shadow-sm" style="background: linear-gradient(135deg, var(--v-primary), var(--v-secondary)); background-size: 200% 200%; animation: gradient 5s ease infinite;">
                <div class="d-flex align-items-center">
                    <i class="fas fa-motorcycle fa-2x me-3" style="color: rgba(255,255,255,0.9);"></i>
                    <div>
                        <h5 class="fw-bold mb-1">Akses Mudah!</h5>
                        <p class="mb-0 small" style="color: rgba(255,255,255,0.8);">Lokasi nyaman untuk semua kendaraan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Location Info -->
<div class="container py-5 my-5 location-section">
    <div class="location-wrapper">
        <div class="row g-5">
            <div class="col-lg-5">
                <span class="location-kicker"><i class="fas fa-map-marker-alt"></i> Lokasi Kami</span>
                <h2 class="title-gradient mt-2 mb-3" style="font-size: clamp(1.8rem, 4vw, 2.4rem); font-weight: 800;">Temukan VIVIA PrintShop</h2>
                <p class="text-muted mb-4" style="font-size: 1.05rem; line-height: 1.7;">Rasakan langsung kualitas produk kami dengan pelayanan prima dari staf ahli yang siap membantu Anda.</p>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-map-marker-alt"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: var(--v-dark);">Alamat Store</h6>
                        <p class="text-muted mb-0 small">Tebu Ireng IV Nomor 38, Cukir, Diwek, Kab. Jombang, Jawa Timur 61471</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-phone"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: var(--v-dark);">Telepon & WhatsApp</h6>
                        <p class="text-muted mb-0 small">{{ optional($setting)->telepon ?? '+62 812 3456 7890' }}</p>
                    </div>
                </div>
                
                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-envelope"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: var(--v-dark);">Alamat Surat</h6>
                        <p class="text-muted mb-0 small">{{ optional($setting)->email ?? 'info@vivia.com' }}</p>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-icon"><i class="fas fa-clock"></i></div>
                    <div>
                        <h6 class="fw-bold mb-1" style="color: var(--v-dark);">Jam Buka</h6>
                        <p class="text-muted mb-0 small">Senin - Sabtu: 08:00 - 17:00 WIB</p>
                    </div>
                </div>

                <div class="contact-cta-group">
                    @php
                        $rawPhone = optional($setting)->telepon ?? '081234567890';
                        $waPhone = preg_replace('/^0/', '62', $rawPhone);
                    @endphp
                    <a href="https://wa.me/{{ $waPhone }}" target="_blank" class="contact-cta contact-cta--primary">
                        <i class="fab fa-whatsapp fs-5"></i> Chat Kami
                    </a>
                    <a href="{{ optional($setting)->maps_url ?? 'https://maps.app.goo.gl/FQkhHuk1vnFZzcHg8?g_st=aw' }}" target="_blank" class="contact-cta contact-cta--outline">
                        <i class="fas fa-directions"></i> Rute Lokasi
                    </a>
                </div>
            </div>
            <div class="col-lg-7 location-map-col">
                <div class="map-container shadow-sm position-relative">
                    <div class="map-overlay-badge">
                        <i class="fas fa-map-pin"></i> VIVIA PrintShop
                    </div>
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
