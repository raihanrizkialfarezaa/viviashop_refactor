@extends('frontend.layouts')
@section('content')
    <style>
        /* Variant option visuals (keep classes intact for JS) */
        .variant-option {
            min-width: 60px;
            border-radius: 8px;
            transition: all 0.18s ease;
            padding: .4rem .6rem;
        }

        .variant-option:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .variant-option:disabled {
            opacity: 0.45;
            cursor: not-allowed;
        }

        .variant-option.btn-outline-danger {
            position: relative;
        }

        .variant-option.btn-outline-danger:after {
            content: '';
            position: absolute;
            top: 50%;
            left: 10%;
            right: 10%;
            height: 1px;
            background: #dc3545;
            transform: rotate(-15deg);
        }

        .price-range h5, #price-display {
            font-weight: 700;
            font-size: 1.75rem;
            color: #e63946; /* a warm primary tint */
            letter-spacing: .2px;
        }

        .variant-group {
            border-bottom: 1px solid #f1f1f1;
            padding-bottom: 1rem;
        }

        .variant-group:last-child {
            border-bottom: none;
        }

        /* Page hero */
        .page-header { background: linear-gradient(90deg,#1e3a8a, #0ea5a0); }

        /* Product area */
        .product-image-frame { padding: .5rem; background: #fff; box-shadow: 0 6px 20px rgba(18,24,32,0.06); }

        .product-name { font-size: 1.3rem; color: #0f172a; }

        .badge-stock { font-size: .8rem; padding: .35rem .6rem; border-radius: 999px; }

        /* Right summary card - Enhanced */
        .summary-card { 
            background: linear-gradient(145deg, #ffffff, #f8fafc); 
            border-radius: .75rem; 
            padding: 1.5rem; 
            box-shadow: 0 20px 50px rgba(0,0,0,0.08), 0 4px 20px rgba(0,0,0,0.04);
            border: 1px solid rgba(255,255,255,0.8);
            backdrop-filter: blur(10px);
        }

        .summary-card .product-thumb { 
            width: 90px; 
            height: 90px; 
            object-fit: cover; 
            border-radius: .6rem; 
            box-shadow: 0 8px 25px rgba(0,0,0,0.12);
            border: 2px solid rgba(255,255,255,0.9);
        }

        .sticky-card { position: sticky; top: var(--sticky-safe-top, 100px); }
        
        /* Enhanced visual elements */
        .product-info-header {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.3);
        }
        
        .info-badge {
            background: linear-gradient(45deg, #48bb78 0%, #38a169 100%);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 50px;
            font-size: 0.8rem;
            font-weight: 600;
            display: inline-block;
            margin: 0.2rem;
            box-shadow: 0 3px 10px rgba(72, 187, 120, 0.3);
        }
        
        .pricing-section {
            background: linear-gradient(135deg, #e6fffa 0%, #b2f5ea 100%);
            padding: 1rem;
            border-radius: 0.6rem;
            margin: 0.5rem 0;
            border: 1px solid rgba(72, 187, 120, 0.2);
        }

        .share-actions i { font-size: 1.05rem; }

        /* CTA gradient style - Enhanced */
        .btn-gradient {
            background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
            border: none;
            color: #fff;
            font-weight: 700;
            padding: 0.75rem 1.5rem;
            border-radius: 0.6rem;
            box-shadow: 0 8px 25px rgba(72, 187, 120, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(72, 187, 120, 0.5);
            background: linear-gradient(135deg, #38a169 0%, #2f855a 100%);
        }

        .btn-gradient:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.5s;
        }

        .btn-gradient:hover:before {
            left: 100%;
        }

        .btn-gradient:disabled {
            opacity: 0.6;
            transform: none;
            box-shadow: 0 4px 15px rgba(72, 187, 120, 0.2);
        }

        .btn-gradient:disabled:hover {
            transform: none;
        }

        .product-thumb { border-radius: 8px; }

        .text-decoration-line-through { opacity: .7; }

        .fw-semibold { font-weight: 600; }
        
        /* Quantity input enhancement */
        .quantity-wrapper {
            background: linear-gradient(145deg, #f7fafc, #edf2f7);
            border-radius: 0.5rem;
            padding: 0.5rem;
            border: 1px solid #e2e8f0;
        }
        
        .quantity-wrapper input {
            border: none;
            background: white;
            border-radius: 0.4rem;
            box-shadow: inset 0 2px 4px rgba(0,0,0,0.06);
        }
        
        /* Badge enhancements */
        .badge-stock.bg-success {
            background: linear-gradient(45deg, #48bb78, #38a169) !important;
            box-shadow: 0 3px 10px rgba(72, 187, 120, 0.3);
        }
        
        /* Share icons enhancement */
        .share-actions i {
            transition: all 0.3s ease;
            padding: 0.4rem;
            border-radius: 50%;
            margin: 0 0.2rem;
        }
        
        .share-actions i:hover {
            background: linear-gradient(45deg, #48bb78, #38a169);
            color: white !important;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(72, 187, 120, 0.3);
        }
        
        /* Sticky panel for the entire summary card */
        .cta-wrapper {
            position: sticky;
            bottom: 20px; /* small gap for visual breathing when card is not fixed */
            width: 100%;
            padding-top: .5rem;
            background: transparent;
        }

        /* On larger screens make the whole summary card a fixed panel on the right */
        @media(min-width: 992px) {
            /* Use pure sticky positioning that follows scroll naturally */
            .summary-card.sticky-card {
                position: sticky;
                top: var(--sticky-safe-top, 120px); /* Safe distance below navbar */
                width: 320px;
                z-index: 500; /* Below navbar but above content */
                box-shadow: 0 18px 40px rgba(2,6,23,0.12);
                border-radius: .6rem;
                background: #fff;
                margin-left: auto;
                transition: box-shadow .15s ease;
                /* Ensure it follows scroll naturally without fixed behavior */
                transform: translateZ(0);
                will-change: auto;
            }

            /* Remove fixed panel behavior completely */
            .summary-card.fixed-panel {
                /* Disable fixed positioning completely */
                position: sticky !important;
                top: var(--sticky-safe-top, 120px) !important;
                right: auto !important;
                width: 320px !important;
                z-index: 500 !important;
                margin-left: auto;
            }

            /* Remove forced padding on content; layout will remain stable because sticky element stays in column */
            .col-xl-9 { padding-right: 0; }
        }

        @media(max-width: 991px) {
            .summary-card.sticky-card { 
                position: static !important; 
                width: 100% !important; 
                box-shadow: none !important; 
                top: auto !important;
                z-index: auto !important;
                margin-left: 0 !important;
            }
            .col-xl-9 { padding-right: 0; }
            .cta-wrapper { position: static; }
        }

        /* Tab styling */
        .nav-tabs .nav-link { color: #334155; background: transparent; border: 0; padding: .5rem 1rem; }
        .nav-tabs .nav-link.active { border-bottom: 3px solid #48bb78; color: #111827; }

        @media (max-width: 991px) {
            .sticky-card { 
                position: static !important; 
                top: auto !important;
                width: 100% !important;
            }
        }

        /* Premium detail page overrides */
        .detail-page-header {
            position: relative;
            margin-top: 18px;
            padding: 4rem 0 5.5rem;
            border-radius: 0 0 42px 42px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 26%),
                radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
                linear-gradient(135deg, rgba(9,43,28,0.95) 0%, rgba(15,81,50,0.92) 48%, rgba(22,163,74,0.82) 100%);
            box-shadow: inset 0 -1px 0 rgba(255,255,255,0.12);
            overflow: hidden;
        }

        .detail-page-header::after {
            content: '';
            position: absolute;
            right: -110px;
            top: -90px;
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(255,255,255,0.16), rgba(255,255,255,0));
            pointer-events: none;
        }

        .detail-hero-content {
            position: relative;
            z-index: 1;
        }

        .detail-hero-kicker {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-bottom: 1rem;
            padding: 10px 16px;
            border-radius: 999px;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.16);
            color: #ffffff;
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .detail-page-header .breadcrumb {
            gap: 0.5rem;
        }

        .detail-page-header .breadcrumb-item,
        .detail-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.78) !important;
            text-decoration: none;
        }

        .detail-page-header .breadcrumb-item.active {
            color: #fff !important;
        }

        .detail-page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.5);
        }

        .detail-page-header h1 {
            font-family: 'Raleway', sans-serif;
            letter-spacing: -0.02em;
        }

        .detail-stage {
            position: relative;
            margin-top: -74px;
            padding-top: 0 !important;
        }

        .detail-layout {
            --bs-gutter-x: 1.75rem;
            --bs-gutter-y: 1.75rem;
        }

        .detail-main-column {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .detail-surface {
            border-radius: 34px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 28px 56px rgba(15,81,50,0.08);
        }

        .detail-gallery-card {
            position: relative;
            padding: 18px;
            overflow: hidden;
        }

        .detail-gallery-card::after {
            content: '';
            position: absolute;
            right: -60px;
            bottom: -80px;
            width: 230px;
            height: 230px;
            background: radial-gradient(circle, rgba(209,231,221,0.86), rgba(209,231,221,0));
            opacity: 0.6;
            pointer-events: none;
        }

        .detail-gallery-shell {
            position: relative;
            padding: 14px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(242,247,244,0.96), rgba(255,255,255,0.95));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.82), 0 16px 28px rgba(15,81,50,0.05);
            z-index: 1;
        }

        .detail-gallery-frame {
            position: relative;
            overflow: hidden;
            border-radius: 24px;
            background: radial-gradient(circle at top right, rgba(32,201,151,0.14), transparent 30%), linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
        }

        .detail-gallery-frame img {
            width: 100%;
            object-fit: cover;
        }

        .detail-gallery-frame .carousel-item img {
            aspect-ratio: 1;
        }

        .detail-gallery-frame .carousel-indicators {
            margin-bottom: 1rem;
            gap: 8px;
        }

        .detail-gallery-frame .carousel-indicators [data-bs-target] {
            width: 34px;
            height: 8px;
            border-radius: 999px;
            border: 0;
            background: rgba(255,255,255,0.58);
            opacity: 1;
        }

        .detail-gallery-frame .carousel-indicators .active {
            background: #ffffff;
        }

        .detail-gallery-control {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92);
            box-shadow: 0 14px 28px rgba(15,81,50,0.12);
            background-size: 42% 42%;
        }

        .detail-gallery-meta {
            position: absolute;
            top: 14px;
            left: 14px;
            right: 14px;
            display: flex;
            justify-content: space-between;
            gap: 10px;
            z-index: 4;
        }

        .detail-badge,
        .detail-status-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.64);
            box-shadow: 0 12px 20px rgba(15,81,50,0.08);
        }

        .detail-badge {
            background: rgba(255,255,255,0.92);
            color: #0f5132;
        }

        .detail-status-chip {
            background: rgba(236,253,245,0.9);
            color: #0f5132;
        }

        .detail-status-chip--warning {
            background: rgba(255,251,235,0.94);
            color: #92400e;
        }

        .detail-status-chip--muted {
            background: rgba(243,244,246,0.94);
            color: #4b5563;
        }

        .detail-overview-card {
            padding: 24px;
        }

        .detail-section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 12px;
            padding: 9px 14px;
            border-radius: 999px;
            background: rgba(15,81,50,0.06);
            color: #0f5132;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .detail-product-name {
            font-family: 'Raleway', sans-serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 800;
            line-height: 1.02;
            letter-spacing: -0.04em;
            color: #1f2f46;
            margin-bottom: 1rem;
        }

        .detail-meta-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-bottom: 1.25rem;
        }

        .detail-meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.94);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 10px 20px rgba(15,81,50,0.05);
            color: #234536;
            font-size: 0.82rem;
            font-weight: 700;
        }

        .detail-meta-chip i {
            color: #198754;
        }

        .detail-card {
            padding: 20px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 16px 28px rgba(15,81,50,0.05);
        }

        .detail-card + .detail-card {
            margin-top: 1rem;
        }

        .detail-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 14px;
            font-size: 1.05rem;
            font-weight: 800;
            color: #183b2b;
        }

        .detail-card-title i {
            width: 36px;
            height: 36px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.08);
            color: #0f5132;
        }

        .detail-card-content {
            color: #647870;
            line-height: 1.8;
        }

        .variant-panel {
            padding: 20px;
            border-radius: 26px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(244,249,246,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 16px 28px rgba(15,81,50,0.06);
        }

        .variant-panel-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1rem;
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(135deg, #0f5132, #198754);
            color: #fff;
            box-shadow: 0 16px 30px rgba(15,81,50,0.18);
        }

        .variant-panel-head h6 {
            margin: 0;
            color: #fff;
            font-weight: 800;
        }

        .variant-group {
            padding: 0 0 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(15,81,50,0.08);
        }

        .variant-option {
            min-width: 84px;
            min-height: 46px;
            border-radius: 14px;
            border-color: rgba(15,81,50,0.14);
            background: rgba(255,255,255,0.94);
            color: #234536;
            font-weight: 700;
            box-shadow: 0 10px 18px rgba(15,81,50,0.04);
        }

        .variant-option.btn-primary,
        .variant-option.btn-primary:hover {
            background: linear-gradient(135deg, #0f5132, #198754);
            border-color: transparent;
            color: #fff;
            box-shadow: 0 16px 24px rgba(15,81,50,0.18);
        }

        .variant-option.btn-outline-secondary:hover {
            color: #0f5132;
            border-color: rgba(15,81,50,0.18);
            background: rgba(209,231,221,0.36);
        }

        .variant-option.btn-outline-danger {
            background: rgba(255,245,245,0.96);
            color: #b42318;
            border-color: rgba(220,53,69,0.28);
        }

        .detail-price-preview {
            padding: 16px 18px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(209,231,221,0.62), rgba(236,253,245,0.92));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.56);
        }

        .detail-price-preview-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #0f5132;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .detail-price-preview h5 {
            margin: 0;
            color: #0f5132;
        }

        #variant-info {
            margin-top: 1rem;
        }

        .variant-selected-card {
            background: linear-gradient(135deg, #0f5132, #198754) !important;
            border: none !important;
            color: #fff !important;
            border-radius: 18px !important;
            box-shadow: 0 18px 30px rgba(15,81,50,0.16);
        }

        #selection-message {
            border: none !important;
            border-radius: 16px !important;
            background: linear-gradient(135deg, rgba(255,244,214,0.98), rgba(243,250,242,0.98)) !important;
            color: #6f5d16 !important;
            box-shadow: 0 12px 24px rgba(15,81,50,0.06);
        }

        .detail-tabs-shell {
            padding: 24px;
        }

        .detail-tabs-shell .nav-tabs {
            gap: 10px;
            border-bottom: 0 !important;
            margin-bottom: 1.5rem !important;
        }

        .detail-tabs-shell .nav-tabs .nav-link {
            padding: 0.95rem 1.25rem;
            border-radius: 18px;
            background: rgba(255,255,255,0.96) !important;
            border: 1px solid rgba(15,81,50,0.08) !important;
            color: #334155 !important;
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        .detail-tabs-shell .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, #0f5132, #198754) !important;
            color: #fff !important;
            box-shadow: 0 18px 30px rgba(15,81,50,0.16);
        }

        .detail-tab-card {
            padding: 24px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 18px 30px rgba(15,81,50,0.05);
        }

        .stock-info-card,
        .spec-card,
        .link-item {
            border-radius: 18px !important;
            border: 1px solid rgba(15,81,50,0.08) !important;
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        .stock-info-card {
            background: linear-gradient(135deg, #0f5132, #198754) !important;
        }

        .spec-card {
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(236,253,245,0.96)) !important;
        }

        .link-item {
            background: linear-gradient(135deg, #0f5132, #198754) !important;
        }

        .summary-card {
            border-radius: 30px;
            padding: 20px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 28px 56px rgba(15,81,50,0.1);
        }

        .summary-card.sticky-card {
            top: var(--sticky-safe-top, 124px) !important;
            width: auto !important;
            max-width: 360px;
        }

        .summary-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-bottom: 1rem;
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(135deg, #0f5132, #198754);
            color: #fff;
            box-shadow: 0 18px 30px rgba(15,81,50,0.16);
        }

        .summary-topbar h6 {
            margin: 0;
            color: #fff;
            font-weight: 800;
        }

        .summary-topbar .info-badge {
            margin: 0;
            padding: 0.38rem 0.78rem;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.18);
            box-shadow: none;
            color: #fff;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .summary-header {
            display: flex;
            gap: 14px;
            margin-bottom: 1.2rem;
            align-items: flex-start;
        }

        .summary-card .product-thumb {
            width: 96px;
            height: 96px;
            border-radius: 22px;
            border: 1px solid rgba(15,81,50,0.08);
            background: linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
        }

        .summary-product-name {
            font-family: 'Raleway', sans-serif;
            font-size: 1.18rem;
            font-weight: 800;
            line-height: 1.12;
            letter-spacing: -0.02em;
            color: #1f2f46;
        }

        .summary-rating {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 8px;
        }

        .pricing-section.summary-price-box {
            padding: 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(209,231,221,0.64), rgba(236,253,245,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.58);
        }

        .summary-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 8px;
            color: #0f5132;
            font-size: 0.78rem;
            font-weight: 800;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        #price-display {
            color: #0f5132;
            font-family: 'Raleway', sans-serif;
            font-size: 1.9rem;
            letter-spacing: -0.03em;
        }

        .summary-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 1rem;
        }

        .summary-info-item {
            padding: 14px 16px;
            border-radius: 18px;
            background: rgba(255,255,255,0.94);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        .summary-info-item small {
            display: block;
            margin-bottom: 6px;
            color: #72857d;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .summary-stock-value {
            font-weight: 800;
            color: #163828;
            line-height: 1.4;
        }

        .summary-ship-card {
            padding: 16px;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(236,253,245,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        .summary-ship-title {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #0f5132;
            font-size: 0.82rem;
            font-weight: 800;
            letter-spacing: 0.06em;
            text-transform: uppercase;
        }

        .quantity-wrapper {
            padding: 0.7rem;
            border-radius: 18px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        .quantity-wrapper input {
            min-height: 48px;
            border-radius: 14px;
            border: 1px solid rgba(15,81,50,0.08);
        }

        .add-to-cart-btn {
            min-height: 58px;
            border-radius: 18px;
            font-size: 1rem;
            font-weight: 800;
            box-shadow: 0 18px 32px rgba(15,81,50,0.22);
        }

        .add-to-cart-btn.btn-secondary,
        .add-to-cart-btn:disabled {
            background: linear-gradient(135deg, #94a3b8, #64748b);
            box-shadow: 0 12px 24px rgba(100,116,139,0.16);
        }

        .share-actions {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.96);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
        }

        @media (max-width: 1199.98px) {
            .detail-layout {
                --bs-gutter-x: 1.35rem;
            }

            .summary-card.sticky-card {
                max-width: none;
            }
        }

        @media (max-width: 991.98px) {
            .detail-page-header {
                padding: 3.5rem 0 4.5rem;
                border-radius: 0 0 32px 32px;
            }

            .detail-stage {
                margin-top: -54px;
            }

            .detail-overview-card,
            .detail-gallery-card,
            .detail-tabs-shell,
            .summary-card {
                padding: 18px;
            }

            .summary-card.sticky-card {
                top: auto !important;
                max-width: none;
            }
        }

        @media (max-width: 767.98px) {
            .detail-page-header {
                margin-top: 14px;
                padding: 3rem 0 4rem;
                border-radius: 0 0 26px 26px;
            }

            .detail-stage {
                margin-top: -40px;
            }

            .detail-product-name {
                font-size: 1.8rem;
            }

            .detail-gallery-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-info-grid {
                grid-template-columns: 1fr;
            }

			.detail-tabs-shell .nav-tabs {
				flex-direction: column;
			}

            .detail-tabs-shell .nav-tabs .nav-link {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            .detail-hero-kicker {
                font-size: 0.74rem;
                letter-spacing: 0.1em;
            }

            .detail-product-name {
                font-size: 1.6rem;
            }

            .variant-option {
                min-width: calc(50% - 0.5rem);
            }

            .summary-header {
                flex-direction: column;
            }

			.summary-topbar {
				flex-direction: column;
				align-items: flex-start;
			}

			.summary-topbar .info-badge {
				align-self: flex-start;
			}

            .summary-card .product-thumb {
                width: 88px;
                height: 88px;
            }

            .add-to-cart-btn {
                min-height: 54px;
            }
        }

        @media (max-width: 419.98px) {
            .variant-option {
                width: 100%;
                min-width: 100%;
            }
        }
    </style>
    
    <div class="container-fluid page-header detail-page-header py-5">
        <div class="container">
            <div class="detail-hero-content text-center">
                <span class="detail-hero-kicker"><i class="fas fa-gem"></i> Detail Produk</span>
                <h1 class="text-white display-5 fw-bold mb-3">{{ $parentProduct->name }}</h1>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('shop') }}">Products</a></li>
                    <li class="breadcrumb-item active text-white">{{ Str::limit($parentProduct->name, 36) }}</li>
                </ol>
            </div>
        </div>
    </div>

    @php
        $thumb = $parentProduct->productImages->first() ? asset('storage/'.$parentProduct->productImages->first()->path) : asset('images/placeholder.jpg');
        $stockQty = $parentProduct->type == 'configurable' ? $parentProduct->total_stock : ($parentProduct->productInventory->qty ?? 0);
        $detailStatusLabel = $stockQty > 10 ? 'Tersedia' : ($stockQty > 0 ? 'Stok terbatas' : 'Out of stock');
        $detailStatusClass = $stockQty > 10 ? '' : ($stockQty > 0 ? 'detail-status-chip--warning' : 'detail-status-chip--muted');
        $detailStatusIcon = $stockQty > 10 ? 'fas fa-check-circle' : ($stockQty > 0 ? 'fas fa-exclamation-circle' : 'fas fa-times-circle');
        $reviewCount = $parentProduct->reviews_count ?? rand(5,50);
        $ratingValue = $parentProduct->rating ?? 4;
    @endphp

    <div class="container-fluid detail-stage py-5">
        <div class="container pb-5">
            <div class="row detail-layout mb-5">
                <div class="col-lg-8 col-xl-9 detail-main-column">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="detail-surface detail-gallery-card">
                                <div class="detail-gallery-shell">
                                    <div class="detail-gallery-frame">
                                        <div class="detail-gallery-meta">
                                            @if($productCategory)
                                                <span class="detail-badge">
                                                    <i class="fa fa-tag"></i>{{ $productCategory->categories->name }}
                                                </span>
                                            @endif
                                            <span class="detail-status-chip {{ $detailStatusClass }}">
                                                <i class="{{ $detailStatusIcon }}"></i>{{ $detailStatusLabel }}
                                            </span>
                                        </div>

                                        @if ($parentProduct->productImages->count() > 0)
                                            @if ($parentProduct->productImages->count() > 1)
                                                <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                                                    <div class="carousel-indicators">
                                                        @foreach ($parentProduct->productImages as $key)
                                                            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $loop->index }}" class="{{ $loop->first ? 'active' : '' }}" aria-label="Image {{ $loop->index + 1 }}"></button>
                                                        @endforeach
                                                    </div>
                                                    <div class="carousel-inner">
                                                        @foreach($parentProduct->productImages as $key => $images)
                                                            <div class="carousel-item {{$key == 0 ? 'active' : '' }}">
                                                                <img src="{{ asset('storage/'. $images->path) }}" class="d-block w-100" alt="Product Image">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                                        <span class="carousel-control-prev-icon detail-gallery-control" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Previous</span>
                                                    </button>
                                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                                        <span class="carousel-control-next-icon detail-gallery-control" aria-hidden="true"></span>
                                                        <span class="visually-hidden">Next</span>
                                                    </button>
                                                </div>
                                            @else
                                                <img src="{{ asset('storage/'. $parentProduct->productImages->first()->path) }}" class="img-fluid d-block w-100" alt="Product Image">
                                            @endif
                                        @else
                                            <img src="{{ asset('images/placeholder.jpg') }}" class="img-fluid d-block w-100" alt="Product Image">
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="detail-surface detail-overview-card">
                                <span class="detail-section-kicker">{{ $parentProduct->type == 'configurable' ? 'Produk konfigurasi' : 'Siap dipesan' }}</span>
                                <h2 class="detail-product-name">{{ $parentProduct->name }}</h2>

                                <div class="detail-meta-chips">
                                    @if($productCategory)
                                        <span class="detail-meta-chip"><i class="fa fa-tag"></i>{{ $productCategory->categories->name }}</span>
                                    @endif
                                    <span class="detail-meta-chip"><i class="fa fa-star"></i>{{ $reviewCount }} ulasan visual</span>
                                    <span class="detail-meta-chip"><i class="fa fa-weight-hanging"></i>{{ $parentProduct->weight ?? 0 }} gram</span>
                                </div>

                                <div class="detail-card">
                                    <div class="detail-card-title">
                                        <i class="fa fa-align-left"></i>
                                        <span>Deskripsi Singkat</span>
                                    </div>
                                    <div class="detail-card-content">{{ $parentProduct->short_description }}</div>
                                </div>

                                @if($parentProduct->type == 'configurable' && $variants->count() > 0)
                                    <div class="variant-panel mt-4">
                                        <div class="variant-panel-head">
                                            <i class="fa fa-cogs"></i>
                                            <h6>Pilih Varian Produk</h6>
                                        </div>

                                        @foreach($variantOptions as $attributeName => $options)
                                            <div class="variant-group">
                                                <label class="form-label fw-bold text-dark mb-2">{{ ucfirst($attributeName) }}:</label>
                                                <div class="variant-options d-flex flex-wrap gap-2" data-attribute="{{ $attributeName }}">
                                                    @foreach($options as $option)
                                                        <button type="button"
                                                                class="btn btn-outline-secondary variant-option"
                                                                data-attribute="{{ $attributeName }}"
                                                                data-value="{{ $option }}">
                                                            {{ $option }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach

                                        <div class="price-range mb-3">
                                            <div class="detail-price-preview">
                                                <div class="detail-price-preview-label"><i class="fa fa-wallet"></i> Rentang Harga</div>
                                                <h5>
                                                    @if($priceRange && !$priceRange['same'])
                                                        Rp {{ number_format($priceRange['min'], 0, ',', '.') }} - Rp {{ number_format($priceRange['max'], 0, ',', '.') }}
                                                    @elseif($priceRange)
                                                        Rp {{ number_format($priceRange['min'], 0, ',', '.') }}
                                                    @else
                                                        Rp {{ number_format($parentProduct->price, 0, ',', '.') }}
                                                    @endif
                                                </h5>
                                            </div>
                                        </div>

                                        <div id="variant-info" class="mt-3" style="display: none;">
                                            <div class="alert variant-selected-card">
                                                <h6 class="mb-2"><i class="fas fa-check-circle me-2"></i><strong>Varian Terpilih:</strong></h6>
                                                <div class="variant-name mb-2">
                                                    <strong>Nama:</strong> <span id="variant-name" class="text-white">-</span>
                                                </div>
                                                <div class="variant-attributes mb-2">
                                                    <strong>Spesifikasi:</strong> <span id="variant-attributes" class="text-white">-</span>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-sm-4">
                                                        <small><strong>SKU:</strong> <span id="variant-sku">-</span></small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small><strong>Stok:</strong> <span id="variant-stock">-</span></small>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <small><strong>Berat:</strong> <span id="variant-weight">-</span>g</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="selection-message" class="alert mt-2">
                                            <i class="fas fa-info-circle me-2"></i>Pilih varian untuk melanjutkan
                                        </div>
                                    </div>
                                @else
                                    <div id="variant-info" class="mt-3" style="display: none;"></div>
                                    <div id="selection-message" class="alert mt-3" style="display: none;"></div>
                                @endif

                                <div class="detail-card mt-4">
                                    <div class="detail-card-title">
                                        <i class="fa fa-file-alt"></i>
                                        <span>Deskripsi Lengkap</span>
                                    </div>
                                    <div class="detail-card-content">{!! $parentProduct->description !!}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="detail-surface detail-tabs-shell mt-2">
                                <nav>
                                    <div class="nav nav-tabs" role="tablist">
                                        <button class="nav-link active fw-bold" type="button" role="tab"
                                            id="nav-about-tab" data-bs-toggle="tab" data-bs-target="#nav-about"
                                            aria-controls="nav-about" aria-selected="true">
                                            <i class="fa fa-info-circle me-2"></i>Description
                                        </button>
                                        <button class="nav-link fw-bold" type="button" role="tab"
                                            id="nav-links-tab" data-bs-toggle="tab" data-bs-target="#nav-links"
                                            aria-controls="nav-links" aria-selected="false">
                                            <i class="fa fa-link me-2"></i>Link Product
                                        </button>
                                    </div>
                                </nav>
                                <div class="tab-content mb-0">
                                    <div class="tab-pane active" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
                                        <div class="detail-tab-card">
                                            <h5 class="fw-bold text-dark mb-3">{{ $parentProduct->short_description }}</h5>
                                            @if ($parentProduct->productInventory && $parentProduct->productInventory->qty)
                                                <div class="stock-info-card mb-3 p-3 text-white">
                                                    <i class="fa fa-box me-2"></i>Stok : {{ $parentProduct->productInventory->qty }} unit tersedia
                                                </div>
                                            @endif
                                            <div class="description-content text-dark" style="line-height: 1.8;">
                                                {!! $parentProduct->description !!}
                                            </div>
                                            <div class="px-2 mt-4">
                                                <div class="row g-4">
                                                    <div class="col-sm-6">
                                                        <div class="spec-card p-3 text-center">
                                                            <div class="spec-label text-success fw-semibold mb-1">
                                                                <i class="fa fa-weight-hanging me-2"></i>Weight
                                                            </div>
                                                            <div class="spec-value fw-bold text-dark">{{ $parentProduct->weight }} gram</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="nav-links" role="tabpanel" aria-labelledby="nav-links-tab">
                                        <div class="detail-tab-card">
                                            <h5 class="fw-bold text-dark mb-4">Related Product Links</h5>
                                            @if($parentProduct->link1)
                                                <div class="link-item mb-3 p-3">
                                                    <a href="{{ $parentProduct->link1 }}" class="text-white text-decoration-none fw-semibold" target="_blank">
                                                        <i class="fa fa-external-link-alt me-2"></i>Product Link 1 : {{ Str::limit($parentProduct->link1, 50) }}
                                                    </a>
                                                </div>
                                            @endif
                                            @if($parentProduct->link2)
                                                <div class="link-item mb-3 p-3">
                                                    <a href="{{ $parentProduct->link2 }}" class="text-white text-decoration-none fw-semibold" target="_blank">
                                                        <i class="fa fa-external-link-alt me-2"></i>Product Link 2 : {{ Str::limit($parentProduct->link2, 50) }}
                                                    </a>
                                                </div>
                                            @endif
                                            @if($parentProduct->link3)
                                                <div class="link-item mb-3 p-3">
                                                    <a href="{{ $parentProduct->link3 }}" class="text-white text-decoration-none fw-semibold" target="_blank">
                                                        <i class="fa fa-external-link-alt me-2"></i>Product Link 3 : {{ Str::limit($parentProduct->link3, 50) }}
                                                    </a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4 fruite">
                        <div class="col-lg-12">
                            <div class="summary-card sticky-card">
                                <div class="summary-topbar">
                                    <h6>Ringkasan Produk</h6>
                                    @if($parentProduct->is_featured ?? false)
                                        <span class="info-badge">Featured</span>
                                    @endif
                                </div>

                                <div class="summary-header">
                                    <img src="{{ $thumb }}" alt="thumb" class="product-thumb">
                                    <div class="flex-grow-1">
                                        <div class="summary-product-name">{{ Str::limit($parentProduct->name, 70) }}</div>
                                        <div class="summary-rating">
                                            <div class="text-warning">
                                                @for($i=0;$i<5;$i++)
                                                    <i class="fa fa-star{{ $i < $ratingValue ? '' : '-o' }}"></i>
                                                @endfor
                                            </div>
                                            <small class="text-muted">({{ $reviewCount }})</small>
                                        </div>
                                    </div>
                                </div>

                                <div class="pricing-section summary-price-box">
                                    <div class="summary-label"><i class="fa fa-wallet"></i> Harga</div>
                                    <div class="d-flex align-items-baseline gap-2 flex-wrap">
                                        <div class="fw-bold text-dark" id="price-display">
                                            @if($priceRange && !$priceRange['same'])
                                                Rp {{ number_format($priceRange['min'], 0, ',', '.') }} - Rp {{ number_format($priceRange['max'], 0, ',', '.') }}
                                            @elseif($priceRange)
                                                Rp {{ number_format($priceRange['min'], 0, ',', '.') }}
                                            @else
                                                Rp {{ number_format($parentProduct->price, 0, ',', '.') }}
                                            @endif
                                        </div>
                                        @if($parentProduct->original_price && $parentProduct->original_price > $parentProduct->price)
                                            <div class="text-muted text-decoration-line-through">Rp {{ number_format($parentProduct->original_price,0,',','.') }}</div>
                                            <div class="info-badge ms-auto">{{ round((($parentProduct->original_price-$parentProduct->price)/$parentProduct->original_price)*100) }}% off</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="summary-info-grid">
                                    <div class="summary-info-item">
                                        <small>SKU</small>
                                        <div class="fw-semibold text-dark">{{ $parentProduct->sku ?? 'N/A' }}</div>
                                    </div>
                                    <div class="summary-info-item">
                                        <small>Status</small>
                                        <div class="summary-stock-value" id="stock-info">
                                            @if ($stockQty)
                                                Stok : {{ $stockQty }} unit tersedia
                                            @else
                                                Out of Stock
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="summary-ship-card mb-3">
                                    <div class="d-flex align-items-center justify-content-between gap-3">
                                        <div>
                                            <div class="summary-ship-title"><i class="fas fa-truck"></i> Estimasi Pengiriman</div>
                                            <div class="fw-semibold text-dark mt-2">3-5 hari kerja</div>
                                        </div>
                                        <small class="text-muted text-end">JNE / Tiki / Gojek</small>
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label mb-2 fw-semibold text-dark">Kuantitas</label>
                                    <div class="quantity-wrapper">
                                        <div class="input-group" style="max-width: 160px;">
                                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" id="selected-variant-id" value="">

                                <div class="cta-wrapper">
                                    <div class="d-grid mb-2">
                                        <button class="btn btn-gradient btn-lg add-to-cart-btn"
                                                data-product-id="{{ $parentProduct->id }}"
                                                data-product-type="{{ $parentProduct->type }}"
                                                data-product-slug="{{ $parentProduct->slug }}"
                                                @if($parentProduct->type == 'configurable' && $variants->count() > 0) disabled @endif>
                                            <i class="fa fa-shopping-bag me-2"></i>
                                            <span class="cta-text">
                                                @if($parentProduct->type == 'configurable' && $variants->count() > 0)
                                                    Pilih varian terlebih dahulu
                                                @else
                                                    Tambah ke Keranjang
                                                @endif
                                            </span>
                                        </button>
                                    </div>
                                </div>

                                <div class="mt-3 text-center">
                                    <div class="share-actions">
                                        <small class="text-muted me-1">Share:</small>
                                        <i class="fab fa-facebook text-primary" style="cursor: pointer;"></i>
                                        <i class="fab fa-twitter text-info" style="cursor: pointer;"></i>
                                        <i class="fab fa-whatsapp text-success" style="cursor: pointer;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const variantButtons = document.querySelectorAll('.variant-option');
            const addToCartBtn = document.querySelector('.add-to-cart-btn');
            const priceDisplay = document.getElementById('price-display');
            const stockElement = document.getElementById('stock-info');
            const variantInfo = document.getElementById('variant-info');
            const selectionMessage = document.getElementById('selection-message');
            const variantName = document.getElementById('variant-name');
            const variantAttributes = document.getElementById('variant-attributes');
            const variantSku = document.getElementById('variant-sku');
            const variantStock = document.getElementById('variant-stock');
            const variantWeight = document.getElementById('variant-weight');
            const selectedVariantId = document.getElementById('selected-variant-id');
            const quantityInput = document.getElementById('quantity');
            
            let selectedAttributes = {};
            let allVariants = @json($variants && $variants->count() > 0 ? $variants->values() : []);
            let availableOptions = @json($variantOptions ?? []);
            
            function initializeVariantSystem() {
                if (@json($parentProduct->type) === 'simple') {
                    addToCartBtn.disabled = false;
                    selectionMessage.style.display = 'none';
                    return;
                }
                
                updateAvailableOptions();
            }
            
            function updateAvailableOptions() {
                const possibleVariants = filterPossibleVariants();
                const newAvailableOptions = extractAvailableOptions(possibleVariants);
                
                Object.keys(availableOptions).forEach(attributeName => {
                    const buttons = document.querySelectorAll(`[data-attribute="${attributeName}"]`);
                    buttons.forEach(button => {
                        if (button.classList.contains('variant-option')) {
                            const value = button.dataset.value;
                            const isAvailable = newAvailableOptions[attributeName]?.includes(value);
                            const isSelected = selectedAttributes[attributeName] === value;
                            
                            button.disabled = !isAvailable && !isSelected;
                            button.classList.toggle('btn-outline-secondary', !isSelected && isAvailable);
                            button.classList.toggle('btn-primary', isSelected);
                            button.classList.toggle('btn-outline-danger', !isAvailable && !isSelected);
                            
                            if (!isAvailable && !isSelected) {
                                button.title = 'Tidak tersedia untuk kombinasi yang dipilih';
                            } else {
                                button.title = '';
                            }
                        }
                    });
                });
                
                updatePriceRange(possibleVariants);
                updateCartButton();
            }
            
            function filterPossibleVariants() {
                return allVariants.filter(variant => {
                    return Object.entries(selectedAttributes).every(([attrName, attrValue]) => {
                        return variant.variant_attributes.some(attr => 
                            attr.attribute_name === attrName && attr.attribute_value === attrValue
                        );
                    });
                });
            }
            
            function extractAvailableOptions(variants) {
                const options = {};
                Object.keys(availableOptions).forEach(attributeName => {
                    options[attributeName] = [...new Set(
                        variants.flatMap(variant => 
                            variant.variant_attributes
                                .filter(attr => attr.attribute_name === attributeName)
                                .map(attr => attr.attribute_value)
                        )
                    )];
                });
                return options;
            }
            
            function updatePriceRange(variants) {
                if (variants.length === 0) {
                    priceDisplay.textContent = 'Kombinasi tidak tersedia';
                    resetVariantDisplay();
                    return;
                }
                
                const exactVariant = findExactVariant();
                
                if (exactVariant) {
                    priceDisplay.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(exactVariant.price)}`;
                    updateVariantDisplay(exactVariant);
                } else if (variants.length === 1) {
                    const variant = variants[0];
                    priceDisplay.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(variant.price)}`;
                    updateVariantDisplay(variant);
                } else {
                    const minPrice = Math.min(...variants.map(v => v.price));
                    const maxPrice = Math.max(...variants.map(v => v.price));
                    
                    if (minPrice === maxPrice) {
                        priceDisplay.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(minPrice)}`;
                    } else {
                        priceDisplay.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(minPrice)} - Rp ${new Intl.NumberFormat('id-ID').format(maxPrice)}`;
                    }
                    
                    resetVariantDisplay();
                }
            }
            
            function updateVariantDisplay(variant) {
                variantName.textContent = variant.name;
                variantSku.textContent = variant.sku;
                variantStock.textContent = variant.stock;
                variantWeight.textContent = variant.weight || 0;
                
                const attributesList = variant.variant_attributes
                    .map(attr => `${attr.attribute_name}: ${attr.attribute_value}`)
                    .join(', ');
                variantAttributes.textContent = attributesList;
                
                selectedVariantId.value = variant.id;
                quantityInput.max = variant.stock;
                
                variantInfo.style.display = 'block';
                selectionMessage.style.display = 'none';
                
                if (stockElement) {
                    stockElement.textContent = `Stok: ${variant.stock}`;
                    stockElement.style.display = 'block';
                }
            }
            
            function resetVariantDisplay() {
                selectedVariantId.value = '';
                variantInfo.style.display = 'none';
                selectionMessage.style.display = 'block';
                
                if (stockElement && @json($parentProduct->productInventory)) {
                    stockElement.textContent = `Stok: ${@json($parentProduct->productInventory ? $parentProduct->productInventory->qty : 0)}`;
                }
            }
            
            function updateCartButton() {
                const hasVariants = @json($parentProduct->type) === 'configurable' && @json($variants->count()) > 0;
                
                if (hasVariants) {
                    const selectedCount = Object.keys(selectedAttributes).length;
                    const exactVariant = findExactVariant();
                    const isComplete = exactVariant !== null;
                    
                    addToCartBtn.disabled = !isComplete;
                    
                    if (isComplete) {
                        addToCartBtn.innerHTML = '<i class="fa fa-shopping-bag me-2"></i>Tambah ke Keranjang';
                        addToCartBtn.classList.remove('btn-secondary');
                        addToCartBtn.classList.add('btn-primary');
                    } else if (selectedCount === 0) {
                        addToCartBtn.innerHTML = '<i class="fa fa-info-circle me-2"></i>Pilih varian untuk melanjutkan';
                        addToCartBtn.classList.remove('btn-primary');
                        addToCartBtn.classList.add('btn-secondary');
                    } else {
                        addToCartBtn.innerHTML = '<i class="fa fa-info-circle me-2"></i>Kombinasi varian tidak tersedia';
                        addToCartBtn.classList.remove('btn-primary');
                        addToCartBtn.classList.add('btn-secondary');
                    }
                }
            }
            
            function findExactVariant() {
                if (Object.keys(selectedAttributes).length === 0) {
                    return null;
                }
                
                return allVariants.find(variant => {
                    return Object.entries(selectedAttributes).every(([attrName, attrValue]) => {
                        return variant.variant_attributes.some(attr => 
                            attr.attribute_name === attrName && attr.attribute_value === attrValue
                        );
                    });
                });
            }
            
            variantButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const attributeName = this.dataset.attribute;
                    const value = this.dataset.value;
                    
                    if (this.disabled) return;
                    
                    if (selectedAttributes[attributeName] === value) {
                        delete selectedAttributes[attributeName];
                    } else {
                        selectedAttributes[attributeName] = value;
                    }
                    
                    updateAvailableOptions();
                });
            });
            
            addToCartBtn.addEventListener('click', function(e) {
                if (this.disabled) {
                    e.preventDefault();
                    return;
                }
                
                if (@json($parentProduct->type) === 'configurable' && @json($variants->count()) > 0) {
                    const exactVariant = findExactVariant();
                    if (!exactVariant) {
                        alert('Varian tidak ditemukan');
                        return;
                    }
                    
                    if (exactVariant.stock < 1) {
                        alert('Stok habis');
                        return;
                    }
                }
                
                const formData = {
                    product_id: @json($parentProduct->id),
                    qty: quantityInput.value,
                    variant_id: selectedVariantId.value || null,
                    _token: '{{ csrf_token() }}'
                };
                
                fetch('{{ route("carts.store") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        alert('Produk berhasil ditambahkan ke keranjang');
                        location.reload();
                    } else {
                        alert(data.message || 'Gagal menambahkan ke keranjang');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan');
                });
            });
            
            initializeVariantSystem();

            // --- Simple sticky positioning with dynamic navbar detection ---
            function adjustStickySummaryTop() {
                try {
                    const summary = document.querySelector('.summary-card.sticky-card');
                    if (!summary) return;

                    if (window.innerWidth <= 991) {
                        summary.style.top = '';
                        summary.style.position = '';
                        summary.style.zIndex = '';
                        return;
                    }

                    const siteHeader = document.querySelector('[data-site-header]') || document.querySelector('.site-header') || document.querySelector('.navbar') || document.querySelector('header');
                    let offset = 116;

                    if (siteHeader) {
                        const navRect = siteHeader.getBoundingClientRect();
                        offset = Math.max(108, Math.round(navRect.bottom + 14));
                    }

                    summary.style.top = offset + 'px';
                    summary.style.position = 'sticky';
                    summary.style.zIndex = '500';
                    summary.classList.remove('fixed-panel');
                    summary.classList.add('sticky-card');
                } catch (e) {
                    console.warn('adjustStickySummaryTop failed', e);
                }
            }

            // Simple initialization - just set sticky positioning correctly
            function initializeStickyBehavior() {
                adjustStickySummaryTop();
            }

            // Event listeners for responsive behavior
            window.addEventListener('load', initializeStickyBehavior);
            window.addEventListener('resize', () => {
                setTimeout(adjustStickySummaryTop, 100);
            });
            
            // Re-adjust after potential layout changes
            setTimeout(initializeStickyBehavior, 300);
            setTimeout(initializeStickyBehavior, 600);
            setTimeout(initializeStickyBehavior, 1000);
        });
    </script>
@endsection
