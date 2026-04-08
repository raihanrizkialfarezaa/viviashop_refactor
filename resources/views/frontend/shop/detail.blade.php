@extends('frontend.layouts')
@section('content')
    <style>
        /* =====================================================================
           VIVIA – DETAIL PAGE  |  Clean premium design system
           All JS-critical selectors (classes/ids) are preserved intact.
           ===================================================================== */

        /* ---- CUSTOM PROPERTIES ------------------------------------------- */
        :root {
            --dp: #0f5132;          /* primary green */
            --dp-mid: #198754;
            --dp-accent: #20c997;
            --dp-soft: rgba(209,231,221,0.55);
            --dp-border: rgba(15,81,50,0.09);
            --dp-shadow: rgba(15,81,50,0.07);
            --dp-text: #1c2e24;
            --dp-muted: #5a7266;
            --dp-light: #f5faf7;
        }

        /* ---- PAGE HEADER -------------------------------------------------- */
        .detail-page-header {
            position: relative;
            margin-top: 18px;
            padding: 3.6rem 0 5.2rem;
            border-radius: 0 0 46px 46px;
            background:
                radial-gradient(ellipse at 10% 60%, rgba(32,201,151,0.22), transparent 38%),
                radial-gradient(ellipse at 88% 15%, rgba(255,255,255,0.1), transparent 30%),
                linear-gradient(148deg, #061c0e 0%, #0f5132 42%, #1a7a48 78%, #20c99766 100%);
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(6,28,14,0.28);
        }

        .detail-page-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg width='80' height='80' viewBox='0 0 80 80' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.028'%3E%3Cpath d='M0 0h40v40H0zm40 40h40v40H40z'/%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        .detail-page-header::after {
            content: '';
            position: absolute;
            right: -80px;
            top: -60px;
            width: 380px;
            height: 380px;
            background: radial-gradient(circle, rgba(32,201,151,0.22) 0%, transparent 68%);
            pointer-events: none;
        }

        .detail-hero-content {
            position: relative;
            z-index: 2;
        }

        .detail-hero-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-bottom: 1rem;
            padding: 9px 18px;
            border-radius: 999px;
            background: rgba(255,255,255,0.11);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
        }

        .detail-page-header h1 {
            font-family: 'Raleway', sans-serif;
            letter-spacing: -0.025em;
            text-shadow: 0 4px 24px rgba(0,0,0,0.22);
            margin-bottom: 0.75rem;
        }

        .detail-page-header .breadcrumb {
            gap: 0.35rem;
            margin-top: 0.25rem;
        }

        .detail-page-header .breadcrumb-item,
        .detail-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.68) !important;
            text-decoration: none;
            font-size: 0.88rem;
        }

        .detail-page-header .breadcrumb-item.active {
            color: rgba(255,255,255,0.95) !important;
            font-weight: 600;
        }

        .detail-page-header .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255,255,255,0.36);
        }

        /* ---- STAGE LIFT --------------------------------------------------- */
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

        /* ---- SHARED SURFACE ------------------------------------------------ */
        .detail-surface {
            border-radius: 36px;
            background: #fff;
            border: 1px solid var(--dp-border);
            box-shadow:
                0 1px 3px rgba(15,81,50,0.04),
                0 8px 24px rgba(15,81,50,0.05),
                0 24px 56px rgba(15,81,50,0.06);
        }

        /* ---- GALLERY CARD -------------------------------------------------- */
        .detail-gallery-card {
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .detail-gallery-card::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 220px;
            height: 220px;
            background: radial-gradient(circle, rgba(32,201,151,0.1), transparent 70%);
            pointer-events: none;
        }

        .detail-gallery-shell {
            position: relative;
            padding: 12px;
            border-radius: 28px;
            background: linear-gradient(180deg, var(--dp-light) 0%, #f8fcfa 100%);
            border: 1px solid var(--dp-border);
            z-index: 1;
        }

        .detail-gallery-frame {
            position: relative;
            overflow: hidden;
            border-radius: 22px;
            background: linear-gradient(180deg, #eef5f1 0%, #f8fcfa 100%);
            min-height: 260px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .detail-gallery-frame img {
            width: 100%;
            object-fit: cover;
            display: block;
        }

        .detail-gallery-frame .carousel-item img {
            aspect-ratio: 1;
            object-fit: contain;
            padding: 10px;
        }

        .detail-gallery-frame .carousel-indicators {
            margin-bottom: 1rem;
            gap: 8px;
        }

        .detail-gallery-frame .carousel-indicators [data-bs-target] {
            width: 28px;
            height: 6px;
            border-radius: 999px;
            border: 0;
            background: rgba(255,255,255,0.5);
            opacity: 1;
            transition: width 0.3s ease, background 0.3s ease;
        }

        .detail-gallery-frame .carousel-indicators .active {
            background: #fff;
            width: 44px;
        }

        .detail-gallery-control {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: rgba(255,255,255,0.92) !important;
            box-shadow: 0 8px 24px rgba(15,81,50,0.14);
            background-size: 40% 40%;
            opacity: 1;
        }

        .detail-gallery-meta {
            position: absolute;
            top: 12px;
            left: 12px;
            right: 12px;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 8px;
            z-index: 4;
        }

        .detail-badge,
        .detail-status-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.02em;
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255,255,255,0.62);
            box-shadow: 0 6px 18px rgba(0,0,0,0.09);
        }

        .detail-badge {
            background: rgba(255,255,255,0.93);
            color: var(--dp);
        }

        .detail-status-chip {
            background: rgba(240,253,248,0.94);
            color: var(--dp);
        }

        .detail-status-chip--warning {
            background: rgba(255,251,235,0.94);
            color: #92400e;
        }

        .detail-status-chip--muted {
            background: rgba(243,244,246,0.94);
            color: #4b5563;
        }

        /* ---- PRODUCT OVERVIEW CARD ---------------------------------------- */
        .detail-overview-card {
            padding: 28px;
        }

        .detail-section-kicker {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 12px;
            padding: 8px 14px;
            border-radius: 999px;
            background: rgba(15,81,50,0.06);
            color: var(--dp);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .detail-product-name {
            font-family: 'Raleway', sans-serif;
            font-size: clamp(1.8rem, 3.5vw, 2.7rem);
            font-weight: 800;
            line-height: 1.04;
            letter-spacing: -0.04em;
            color: var(--dp-text);
            margin-bottom: 1rem;
        }

        .detail-meta-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 1.25rem;
        }

        .detail-meta-chip {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--dp-border);
            box-shadow: 0 2px 8px rgba(15,81,50,0.04);
            color: #2d5040;
            font-size: 0.82rem;
            font-weight: 700;
            transition: all 0.2s ease;
        }

        .detail-meta-chip:hover {
            border-color: rgba(15,81,50,0.2);
            background: rgba(209,231,221,0.35);
        }

        .detail-meta-chip i {
            color: var(--dp-mid);
        }

        .detail-card {
            padding: 20px 22px;
            border-radius: 22px;
            background: linear-gradient(180deg, #fff 0%, #f8fbf9 100%);
            border: 1px solid var(--dp-border);
        }

        .detail-card + .detail-card {
            margin-top: 1rem;
        }

        .detail-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
            font-size: 0.96rem;
            font-weight: 800;
            color: #163828;
        }

        .detail-card-title i {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.07);
            color: var(--dp);
            font-size: 0.88rem;
            flex-shrink: 0;
        }

        .detail-card-content {
            color: var(--dp-muted);
            font-size: 0.95rem;
            line-height: 1.8;
        }

        /* ---- VARIANT PANEL ------------------------------------------------- */
        .variant-panel {
            padding: 22px;
            border-radius: 28px;
            background: linear-gradient(180deg, #fff 0%, var(--dp-light) 100%);
            border: 1px solid var(--dp-border);
            margin-top: 1rem;
        }

        .variant-panel-head {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 1.25rem;
            padding: 14px 18px;
            border-radius: 18px;
            background: linear-gradient(135deg, var(--dp) 0%, #1a7a48 55%, var(--dp-mid) 100%);
            color: #fff;
            box-shadow: 0 12px 30px rgba(15,81,50,0.22);
        }

        .variant-panel-head h6 {
            margin: 0;
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
        }

        /* variant-group: keep border-bottom for JS last-child logic, but refine style */
        .variant-group {
            padding: 0 0 1rem;
            margin-bottom: 1rem;
            border-bottom: 1px solid rgba(15,81,50,0.07);
        }

        .variant-group:last-of-type {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        /* ---- VARIANT OPTION BUTTONS (JS managed — keep selectors) --------- */
        .variant-option {
            min-width: 80px;
            min-height: 44px;
            border-radius: 14px;
            border: 1.5px solid rgba(15,81,50,0.14) !important;
            background: #fff !important;
            color: #234536;
            font-weight: 700;
            font-size: 0.88rem;
            transition: all 0.18s ease;
            padding: .45rem .7rem;
        }

        .variant-option:hover:not(:disabled) {
            transform: translateY(-2px);
            border-color: rgba(15,81,50,0.28) !important;
            background: rgba(209,231,221,0.32) !important;
            color: var(--dp);
            box-shadow: 0 8px 20px rgba(15,81,50,0.1);
        }

        .variant-option:disabled {
            opacity: 0.38;
            cursor: not-allowed;
        }

        .variant-option.btn-primary,
        .variant-option.btn-primary:hover {
            background: linear-gradient(135deg, var(--dp), var(--dp-mid)) !important;
            border-color: transparent !important;
            color: #fff !important;
            box-shadow: 0 10px 24px rgba(15,81,50,0.24);
            transform: translateY(-1px);
        }

        .variant-option.btn-outline-secondary {
            background: #fff !important;
            color: #234536 !important;
            border-color: rgba(15,81,50,0.14) !important;
        }

        .variant-option.btn-outline-secondary:hover {
            background: rgba(209,231,221,0.32) !important;
            border-color: rgba(15,81,50,0.28) !important;
            color: var(--dp) !important;
        }

        .variant-option.btn-outline-danger {
            background: rgba(255,245,245,0.92) !important;
            color: #b42318 !important;
            border-color: rgba(220,53,69,0.22) !important;
            position: relative;
        }

        .variant-option.btn-outline-danger::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 12%;
            right: 12%;
            height: 1.5px;
            background: #dc3545;
            transform: rotate(-12deg);
            opacity: 0.5;
        }

        /* ---- PRICE PREVIEW (inside variant panel) -------------------------- */
        .price-range h5 {
            font-family: 'Raleway', sans-serif;
            font-weight: 800;
            font-size: 1.6rem;
            color: var(--dp);
            letter-spacing: -0.02em;
        }

        .detail-price-preview {
            padding: 16px 18px;
            border-radius: 18px;
            background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.88));
            border: 1px solid rgba(15,81,50,0.08);
        }

        .detail-price-preview-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 8px;
            color: var(--dp);
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        .detail-price-preview h5 {
            margin: 0;
            color: var(--dp);
        }

        /* ---- VARIANT SELECTION STATE CARDS (JS shown/hidden) -------------- */
        #variant-info {
            margin-top: 1rem;
        }

        .variant-selected-card {
            background: linear-gradient(135deg, var(--dp), var(--dp-mid)) !important;
            border: none !important;
            color: #fff !important;
            border-radius: 18px !important;
            box-shadow: 0 14px 28px rgba(15,81,50,0.2);
        }

        #selection-message {
            border: none !important;
            border-radius: 16px !important;
            background: linear-gradient(135deg, rgba(255,248,220,0.96), rgba(243,250,243,0.96)) !important;
            color: #735c14 !important;
            font-size: 0.9rem;
            font-weight: 600;
            box-shadow: 0 8px 20px rgba(15,81,50,0.05);
        }

        /* ---- TABS SECTION -------------------------------------------------- */
        .detail-tabs-shell {
            padding: 26px;
        }

        .detail-tabs-shell .nav-tabs {
            gap: 8px;
            border-bottom: 0 !important;
            margin-bottom: 1.5rem !important;
            flex-wrap: wrap;
        }

        .detail-tabs-shell .nav-tabs .nav-link {
            padding: 0.85rem 1.25rem;
            border-radius: 16px;
            background: #fff !important;
            border: 1px solid var(--dp-border) !important;
            color: #4a6258 !important;
            font-weight: 700;
            font-size: 0.9rem;
            transition: all 0.22s ease;
        }

        .detail-tabs-shell .nav-tabs .nav-link:hover {
            background: rgba(209,231,221,0.36) !important;
            border-color: rgba(15,81,50,0.18) !important;
            color: var(--dp) !important;
        }

        .detail-tabs-shell .nav-tabs .nav-link.active {
            background: linear-gradient(135deg, var(--dp), var(--dp-mid)) !important;
            color: #fff !important;
            border-color: transparent !important;
            box-shadow: 0 10px 28px rgba(15,81,50,0.2);
        }

        .detail-tab-card {
            padding: 24px;
            border-radius: 22px;
            background: linear-gradient(180deg, #fff 0%, #f8fbf9 100%);
            border: 1px solid var(--dp-border);
        }

        .stock-info-card {
            border-radius: 16px !important;
            background: linear-gradient(135deg, var(--dp), var(--dp-mid)) !important;
            border: none !important;
        }

        .spec-card {
            border-radius: 18px !important;
            background: linear-gradient(180deg, #fff, rgba(236,253,245,0.7)) !important;
            border: 1px solid var(--dp-border) !important;
        }

        .link-item {
            border-radius: 16px !important;
            background: linear-gradient(135deg, var(--dp), var(--dp-mid)) !important;
            border: none !important;
        }

        /* ---- SUMMARY / RIGHT SIDEBAR CARD ---------------------------------- */
        .summary-card {
            border-radius: 34px;
            padding: 22px;
            background: #fff;
            border: 1px solid var(--dp-border);
            box-shadow:
                0 2px 4px rgba(15,81,50,0.04),
                0 12px 30px rgba(15,81,50,0.06),
                0 32px 64px rgba(15,81,50,0.07);
        }

        .summary-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 1.25rem;
            padding: 15px 18px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--dp) 0%, #1a7a48 55%, var(--dp-mid) 100%);
            color: #fff;
            box-shadow: 0 14px 32px rgba(15,81,50,0.24);
            position: relative;
            overflow: hidden;
        }

        .summary-topbar::before {
            content: '';
            position: absolute;
            right: -20px;
            top: -20px;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(255,255,255,0.12), transparent 70%);
            pointer-events: none;
        }

        .summary-topbar h6 {
            margin: 0;
            color: #fff;
            font-weight: 800;
            font-size: 1rem;
            letter-spacing: -0.01em;
        }

        .info-badge {
            display: inline-flex;
            align-items: center;
            padding: 5px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.16);
            border: 1px solid rgba(255,255,255,0.22);
            color: #fff;
            font-size: 0.76rem;
            font-weight: 700;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .summary-header {
            display: flex;
            gap: 14px;
            margin-bottom: 1.25rem;
            align-items: flex-start;
            padding: 14px;
            border-radius: 20px;
            background: linear-gradient(180deg, var(--dp-light), #fff);
            border: 1px solid var(--dp-border);
        }

        .summary-card .product-thumb {
            width: 84px;
            height: 84px;
            border-radius: 18px;
            object-fit: cover;
            border: 1px solid var(--dp-border);
            background: #f0f6f3;
            flex-shrink: 0;
        }

        .summary-product-name {
            font-family: 'Raleway', sans-serif;
            font-size: 1.05rem;
            font-weight: 800;
            line-height: 1.2;
            letter-spacing: -0.02em;
            color: var(--dp-text);
        }

        .summary-rating {
            display: flex;
            align-items: center;
            gap: 6px;
            margin-top: 6px;
        }

        /* price box */
        .pricing-section,
        .pricing-section.summary-price-box {
            padding: 18px 20px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(209,231,221,0.48), rgba(236,253,245,0.9));
            border: 1px solid rgba(15,81,50,0.09);
            margin-bottom: 1rem;
        }

        .summary-label {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            margin-bottom: 6px;
            color: var(--dp);
            font-size: 0.72rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* #price-display: updated by JS — keep ID, refine style */
        #price-display {
            color: var(--dp);
            font-family: 'Raleway', sans-serif;
            font-size: 2rem;
            font-weight: 800;
            letter-spacing: -0.03em;
            line-height: 1.1;
        }

        /* info grid (SKU / Status) */
        .summary-info-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 10px;
            margin-bottom: 1rem;
        }

        .summary-info-item {
            padding: 13px 14px;
            border-radius: 16px;
            background: var(--dp-light);
            border: 1px solid var(--dp-border);
        }

        .summary-info-item small {
            display: block;
            margin-bottom: 4px;
            color: #7a9080;
            font-weight: 700;
            font-size: 0.68rem;
            text-transform: uppercase;
            letter-spacing: 0.09em;
        }

        .summary-stock-value {
            font-weight: 800;
            color: #163828;
            font-size: 0.88rem;
            line-height: 1.4;
        }

        .summary-ship-card {
            padding: 14px 16px;
            border-radius: 18px;
            background: linear-gradient(180deg, #f9fcfa, rgba(236,253,245,0.7));
            border: 1px solid var(--dp-border);
            margin-bottom: 1rem;
        }

        .summary-ship-title {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            color: var(--dp);
            font-size: 0.76rem;
            font-weight: 800;
            letter-spacing: 0.07em;
            text-transform: uppercase;
            margin-bottom: 6px;
            display: flex;
        }

        /* ---- QUANTITY CONTROLS --------------------------------------------- */
        .quantity-wrapper {
            padding: 6px;
            border-radius: 18px;
            background: var(--dp-light);
            border: 1px solid var(--dp-border);
            margin-bottom: 1rem;
        }

        .quantity-wrapper input {
            min-height: 46px;
            border-radius: 12px;
            border: 1px solid var(--dp-border);
            font-weight: 700;
            font-size: 1rem;
            color: var(--dp-text);
            background: #fff;
        }

        .quantity-wrapper input:focus {
            outline: none;
            box-shadow: 0 0 0 3px rgba(15,81,50,0.1);
            border-color: rgba(15,81,50,0.3);
        }

        /* ---- ADD TO CART BUTTON (btn-gradient / btn-primary / btn-secondary JS) */
        .btn-gradient {
            background: linear-gradient(135deg, var(--dp) 0%, #1a7a48 50%, var(--dp-mid) 100%);
            border: none;
            color: #fff;
            font-weight: 800;
            font-size: 1.02rem;
            padding: 0.9rem 1.5rem;
            border-radius: 20px;
            box-shadow: 0 14px 34px rgba(15,81,50,0.26);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
            letter-spacing: -0.01em;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1), transparent 55%);
            pointer-events: none;
        }

        .btn-gradient::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.16), transparent);
            transition: left 0.55s ease;
        }

        .btn-gradient:hover:not(:disabled) {
            transform: translateY(-2px);
            box-shadow: 0 20px 44px rgba(15,81,50,0.32);
            color: #fff;
        }

        .btn-gradient:hover:not(:disabled)::after {
            left: 100%;
        }

        .btn-gradient:disabled,
        .btn-gradient.btn-secondary {
            background: linear-gradient(135deg, #94a3b8, #64748b) !important;
            box-shadow: 0 8px 20px rgba(100,116,139,0.15) !important;
            opacity: 0.82;
            transform: none !important;
        }

        .add-to-cart-btn {
            min-height: 58px;
            border-radius: 20px;
            font-size: 1.02rem;
            font-weight: 800;
            width: 100%;
        }

        /* ---- SHARE BAR ----------------------------------------------------- */
        .share-actions {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 4px;
            padding: 8px 16px;
            border-radius: 999px;
            background: #fff;
            border: 1px solid var(--dp-border);
            box-shadow: 0 4px 14px rgba(15,81,50,0.05);
        }

        .share-actions i {
            font-size: 1.1rem;
            padding: 6px;
            border-radius: 50%;
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.22s ease;
        }

        .share-actions i:hover {
            background: rgba(15,81,50,0.08);
            transform: translateY(-2px);
        }

        /* ---- STICKY CARD (handled by JS + CSS) ----------------------------- */
        .cta-wrapper {
            padding-top: 0.5rem;
        }

        @media (min-width: 992px) {
            .summary-card.sticky-card {
                position: sticky;
                top: var(--sticky-safe-top, 120px);
                width: auto;
                max-width: 360px;
                z-index: 100;
                transform: translateZ(0);
                transition: box-shadow 0.2s ease;
            }

            .summary-card.fixed-panel {
                position: sticky !important;
                top: var(--sticky-safe-top, 120px) !important;
                width: auto !important;
                z-index: 100 !important;
            }

            .col-xl-9 { padding-right: 0; }
        }

        @media (max-width: 991.98px) {
            .summary-card.sticky-card,
            .summary-card.fixed-panel {
                position: static !important;
                top: auto !important;
                width: 100% !important;
                max-width: none !important;
            }

            .col-xl-9 { padding-right: 0; }
            .cta-wrapper { position: static; }
        }

        /* ---- BREAKPOINTS --------------------------------------------------- */
        @media (max-width: 1199.98px) {
            .detail-layout { --bs-gutter-x: 1.4rem; }
            .summary-card.sticky-card { max-width: none; }
            #price-display { font-size: 1.75rem; }
        }

        @media (max-width: 991.98px) {
            .detail-page-header {
                padding: 3.4rem 0 4.6rem;
                border-radius: 0 0 34px 34px;
            }

            .detail-stage { margin-top: -56px; }

            .detail-overview-card,
            .detail-gallery-card,
            .detail-tabs-shell {
                padding: 18px;
            }

            .summary-card { padding: 18px; }
        }

        @media (max-width: 767.98px) {
            .detail-page-header {
                margin-top: 14px;
                padding: 3rem 0 4.2rem;
                border-radius: 0 0 28px 28px;
            }

            .detail-stage { margin-top: -42px; }
            .detail-product-name { font-size: 1.75rem; }

            .detail-gallery-meta {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-info-grid { grid-template-columns: 1fr 1fr; }

            .detail-tabs-shell .nav-tabs { flex-direction: column; }
            .detail-tabs-shell .nav-tabs .nav-link { width: 100%; }
        }

        @media (max-width: 575.98px) {
            .detail-hero-kicker { font-size: 0.72rem; }
            .detail-product-name { font-size: 1.55rem; }

            .detail-overview-card,
            .detail-gallery-card,
            .detail-tabs-shell,
            .summary-card { padding: 16px; }

            .variant-option { min-width: calc(50% - 0.5rem); }

            .summary-header { flex-direction: column; }
            .summary-card .product-thumb { width: 80px; height: 80px; }

            .summary-topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .summary-topbar .info-badge { align-self: flex-start; }
            .add-to-cart-btn { min-height: 54px; }
            #price-display { font-size: 1.55rem; }
            .summary-info-grid { grid-template-columns: 1fr; }
        }

        @media (max-width: 419.98px) {
            .variant-option {
                width: 100%;
                min-width: 100%;
            }

            .detail-page-header h1 { font-size: 1.65rem; }
        }

        /* ---- QUANTITY COUNTER --------------------------------------------- */
        .qty-counter {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .qty-btn {
            width: 44px;
            height: 44px;
            border-radius: 13px;
            border: 1.5px solid var(--dp-border);
            background: #fff;
            color: var(--dp);
            font-size: 0.78rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.22s ease;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(15,81,50,0.04);
            padding: 0;
            line-height: 1;
        }

        .qty-btn:hover {
            background: var(--dp);
            color: #fff;
            border-color: var(--dp);
            box-shadow: 0 8px 18px rgba(15,81,50,0.18);
            transform: translateY(-1px);
        }

        .qty-btn:active { transform: scale(0.94); }

        .qty-counter .form-control {
            text-align: center;
            width: 72px;
            flex-shrink: 0;
            padding-left: 8px;
            padding-right: 8px;
        }

        .qty-counter input::-webkit-outer-spin-button,
        .qty-counter input::-webkit-inner-spin-button { -webkit-appearance: none; margin: 0; }
        .qty-counter input[type=number] { -moz-appearance: textfield; }

        /* ---- SHARE ICON BUTTONS ------------------------------------------- */
        .share-icon-btn {
            width: 36px;
            height: 36px;
            border-radius: 10px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.88rem;
            text-decoration: none;
            transition: all 0.22s ease;
            border: 1px solid transparent;
        }

        .share-icon-fb { background: rgba(24,119,242,0.09); color: #1877F2; border-color: rgba(24,119,242,0.14); }
        .share-icon-fb:hover { background: #1877F2; color: #fff; transform: translateY(-2px); }
        .share-icon-tw { background: rgba(29,161,242,0.09); color: #1DA1F2; border-color: rgba(29,161,242,0.14); }
        .share-icon-tw:hover { background: #1DA1F2; color: #fff; transform: translateY(-2px); }
        .share-icon-wa { background: rgba(37,211,102,0.09); color: #25D366; border-color: rgba(37,211,102,0.14); }
        .share-icon-wa:hover { background: #25D366; color: #fff; transform: translateY(-2px); }

        /* ---- TRUST STRIP --------------------------------------------------- */
        .summary-trust-strip {
            display: flex;
            align-items: center;
            justify-content: space-around;
            gap: 6px;
            padding: 14px 8px;
            border-radius: 18px;
            background: linear-gradient(180deg, #f8fbf9, rgba(236,253,245,0.6));
            border: 1px solid var(--dp-border);
            margin-top: 1rem;
        }

        .trust-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 5px;
            font-size: 0.68rem;
            font-weight: 700;
            color: #467060;
            text-align: center;
            line-height: 1.3;
        }

        .trust-item i {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.07);
            color: var(--dp);
            font-size: 0.82rem;
        }

        /* ---- DETAIL CARD ICON ACCENT VARIANTS ----------------------------- */
        .detail-card-title i.icon-orange { background: rgba(249,115,22,0.1); color: #ea580c; }
        .detail-card-title i.icon-blue   { background: rgba(59,130,246,0.1); color: #2563eb; }

        /* ---- SUMMARY CATEGORY CHIP ---------------------------------------- */
        .summary-product-category {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-top: 5px;
            padding: 3px 9px;
            border-radius: 999px;
            background: rgba(15,81,50,0.07);
            color: var(--dp);
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        /* ---- GALLERY THUMBNAIL STRIP -------------------------------------- */
        .gallery-thumb-strip {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
            padding: 12px 0 0;
        }

        .gallery-thumb {
            width: 56px;
            height: 56px;
            border-radius: 12px;
            object-fit: cover;
            border: 2px solid transparent;
            cursor: pointer;
            transition: all 0.18s ease;
            opacity: 0.65;
        }

        .gallery-thumb:hover { opacity: 0.88; border-color: rgba(15,81,50,0.25); }
        .gallery-thumb.active { opacity: 1; border-color: var(--dp-mid); box-shadow: 0 4px 14px rgba(15,81,50,0.18); }

        /* ---- SUMMARY THUMBNAIL RING --------------------------------------- */
        .summary-card .product-thumb {
            box-shadow: 0 0 0 3px rgba(15,81,50,0.06), 0 8px 20px rgba(15,81,50,0.1);
        }

        @media (max-width: 575.98px) {
            .summary-trust-strip { flex-wrap: wrap; gap: 8px; }
            .trust-item { min-width: calc(33% - 8px); }
            .qty-counter .form-control { width: 60px; }
            .qty-btn { width: 40px; height: 40px; }
            .gallery-thumb { width: 46px; height: 46px; }
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
                                @if ($parentProduct->productImages->count() > 1)
                                    <div class="gallery-thumb-strip">
                                        @foreach($parentProduct->productImages as $key => $images)
                                            <img src="{{ asset('storage/'.$images->path) }}"
                                                 class="gallery-thumb {{ $key == 0 ? 'active' : '' }}"
                                                 onclick="(function(idx,el){var c=bootstrap.Carousel.getOrCreateInstance(document.getElementById('carouselExampleIndicators'));c.to(idx);el.closest('.gallery-thumb-strip').querySelectorAll('.gallery-thumb').forEach(function(t,i){t.classList.toggle('active',i===idx)});})({{ $key }},this)"
                                                 alt="Thumbnail {{ $key + 1 }}">
                                        @endforeach
                                    </div>
                                @endif
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
                                        <i class="fa fa-align-left icon-orange"></i>
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
                                        <i class="fa fa-file-alt icon-blue"></i>
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
                                        @if($productCategory)
                                            <div class="summary-product-category"><i class="fa fa-tag"></i>{{ $productCategory->categories->name }}</div>
                                        @endif
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
                                        <small><i class="fas fa-barcode me-1"></i>SKU</small>
                                        <div class="fw-semibold text-dark">{{ $parentProduct->sku ?? 'N/A' }}</div>
                                    </div>
                                    <div class="summary-info-item">
                                        <small><i class="fas fa-cube me-1"></i>Status</small>
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
                                    <label class="form-label mb-2 fw-semibold text-dark"><i class="fas fa-layer-group me-1 opacity-75"></i>Kuantitas</label>
                                    <div class="quantity-wrapper">
                                        <div class="qty-counter">
                                            <button type="button" class="qty-btn"
                                                    onclick="var q=document.getElementById('quantity'),v=parseInt(q.value)||1,m=parseInt(q.min)||1;if(v>m)q.value=v-1;"
                                                    aria-label="Kurangi jumlah">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" class="form-control" id="quantity" value="1" min="1">
                                            <button type="button" class="qty-btn"
                                                    onclick="var q=document.getElementById('quantity'),v=parseInt(q.value)||1,mx=parseInt(q.max)||9999;if(v<mx)q.value=v+1;"
                                                    aria-label="Tambah jumlah">
                                                <i class="fas fa-plus"></i>
                                            </button>
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
                                        <small class="text-muted me-2 fw-semibold">Bagikan:</small>
                                        <a href="https://www.facebook.com/sharer.php?u={{ urlencode(url()->current()) }}"
                                           target="_blank" rel="noopener"
                                           class="share-icon-btn share-icon-fb" title="Share di Facebook">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($parentProduct->name) }}"
                                           target="_blank" rel="noopener"
                                           class="share-icon-btn share-icon-tw" title="Share di Twitter">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="https://wa.me/?text={{ urlencode($parentProduct->name . ' - ' . url()->current()) }}"
                                           target="_blank" rel="noopener"
                                           class="share-icon-btn share-icon-wa" title="Share di WhatsApp">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="summary-trust-strip">
                                    <div class="trust-item">
                                        <i class="fas fa-shield-alt"></i>
                                        <span>Bayar Aman</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-truck"></i>
                                        <span>Kirim Cepat</span>
                                    </div>
                                    <div class="trust-item">
                                        <i class="fas fa-headset"></i>
                                        <span>CS 24/7</span>
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

            // Sync gallery thumbnail strip when carousel slides via prev/next controls
            var carouselEl = document.getElementById('carouselExampleIndicators');
            if (carouselEl) {
                carouselEl.addEventListener('slid.bs.carousel', function(e) {
                    document.querySelectorAll('.gallery-thumb').forEach(function(t, i) {
                        t.classList.toggle('active', i === e.to);
                    });
                });
            }

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
