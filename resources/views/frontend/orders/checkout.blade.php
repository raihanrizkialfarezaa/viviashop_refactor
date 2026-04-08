@extends('frontend.layouts')
@section('content')
    <style>
        :root {
            --checkout-green-900: #092b1c;
            --checkout-green-800: #0f5132;
            --checkout-green-700: #198754;
            --checkout-green-600: #16a34a;
            --checkout-green-500: #20c997;
            --checkout-ink: #1f2f46;
            --checkout-muted: #667970;
        }

        .checkout-page-header {
            position: relative;
            margin-top: 18px;
            padding: 5.5rem 0 6.35rem;
            border-radius: 0 0 42px 42px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 26%),
                radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
                linear-gradient(135deg, rgba(9,43,28,0.96) 0%, rgba(15,81,50,0.94) 48%, rgba(22,163,74,0.82) 100%);
            overflow: hidden;
        }

        .checkout-page-header::after {
            content: '';
            position: absolute;
            right: -110px;
            top: -90px;
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
            pointer-events: none;
        }

        .checkout-hero-content {
            position: relative;
            z-index: 1;
            max-width: 820px;
            margin: 0 auto;
        }

        .checkout-hero-kicker,
        .checkout-shell-kicker {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 16px;
            border-radius: 999px;
            font-size: 0.8rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        .checkout-hero-kicker {
            margin-bottom: 1rem;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .checkout-page-header .breadcrumb {
            gap: 0.45rem;
        }

        .checkout-page-header .breadcrumb-item,
        .checkout-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.8) !important;
            text-decoration: none;
        }

        .checkout-page-header .breadcrumb-item.active {
            color: #fff !important;
        }

        .checkout-stage {
            position: relative;
            margin-top: -74px;
            padding-top: 0 !important;
        }

        .checkout-surface {
            border-radius: 32px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 28px 56px rgba(15,81,50,0.08);
        }

        .checkout-form-shell,
        .checkout-summary-shell,
        .checkout-payment-shell {
            padding: 22px;
        }

        .checkout-sticky-stack {
            position: sticky;
            top: var(--sticky-safe-top, 124px);
        }

        .checkout-shell-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 1.25rem;
        }

        .checkout-shell-kicker {
            background: rgba(15,81,50,0.06);
            color: var(--checkout-green-800);
            margin-bottom: 0.85rem;
        }

        .checkout-shell-head h2 {
            margin: 0 0 0.4rem;
            font-family: 'Raleway', sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.2rem);
            font-weight: 800;
            line-height: 1.06;
            letter-spacing: -0.03em;
            color: var(--checkout-ink);
        }

        .checkout-shell-head p {
            margin: 0;
            color: var(--checkout-muted);
            line-height: 1.7;
        }

        .checkout-shell-badge,
        .info-badge {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(255,255,255,0.96);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
            color: var(--checkout-green-800);
            font-weight: 800;
            font-size: 0.8rem;
        }

        .checkout-resume-alert {
            border-radius: 20px;
            border: none;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, rgba(209,231,221,0.72), rgba(236,253,245,0.96));
            color: var(--checkout-green-800);
            box-shadow: 0 14px 24px rgba(15,81,50,0.06);
        }

        .checkout-subcard,
        .summary-panel {
            padding: 20px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 16px 28px rgba(15,81,50,0.05);
        }

        .checkout-subcard + .checkout-subcard,
        .checkout-payment-shell,
        .summary-panel,
        .place-order-wrap {
            margin-top: 1rem;
        }

        .checkout-card-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 0.75rem;
            color: #183b2b;
            font-size: 1.02rem;
            font-weight: 800;
        }

        .checkout-card-title i {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.08);
            color: var(--checkout-green-800);
        }

        .checkout-card-copy {
            margin: 0 0 1rem;
            color: var(--checkout-muted);
            line-height: 1.7;
        }

        .form-item {
            margin-bottom: 0;
        }

        .form-item label,
        .form-label {
            display: block;
            margin-bottom: 0.65rem;
            color: #274234;
            font-size: 0.9rem;
            font-weight: 700;
        }

        .required {
            color: #dc3545;
        }

        .form-control,
        .form-select {
            min-height: 54px;
            border-radius: 16px;
            border: 1px solid rgba(15,81,50,0.12);
            background: rgba(255,255,255,0.96);
            color: var(--checkout-ink);
            box-shadow: inset 0 2px 6px rgba(2,6,23,0.03);
            padding-inline: 16px;
        }

        textarea.form-control {
            min-height: 120px;
            padding-top: 14px;
            resize: vertical;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--checkout-green-600);
            box-shadow: 0 10px 20px rgba(16,185,129,0.1);
        }

        .checkout-preview-card {
            padding: 16px;
            border-radius: 20px;
            background: rgba(255,255,255,0.9);
            border: 1px dashed rgba(15,81,50,0.16);
        }

        .img-preview {
            border-radius: 18px;
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 14px 24px rgba(15,81,50,0.06);
        }

        .checkout-option-grid,
        .checkout-payment-list,
        .checkout-order-list {
            display: grid;
            gap: 14px;
        }

        .checkout-option-card {
            position: relative;
            display: block;
            cursor: pointer;
        }

        .checkout-choice-input {
            position: absolute;
            inset: 0;
            opacity: 0;
            pointer-events: none;
        }

        .checkout-option-body {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px;
            border-radius: 22px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 12px 22px rgba(15,81,50,0.05);
            transition: transform 0.25s ease, box-shadow 0.25s ease, border-color 0.25s ease, background 0.25s ease;
        }

        .checkout-choice-input:checked + .checkout-option-body {
            transform: translateY(-2px);
            border-color: rgba(15,81,50,0.16);
            background: linear-gradient(135deg, rgba(209,231,221,0.66), rgba(236,253,245,0.96));
            box-shadow: 0 20px 30px rgba(15,81,50,0.08);
        }

        .checkout-option-icon {
            width: 48px;
            height: 48px;
            border-radius: 16px;
            flex-shrink: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.08);
            color: var(--checkout-green-800);
            font-size: 1.1rem;
        }

        .checkout-choice-input:checked + .checkout-option-body .checkout-option-icon {
            background: rgba(255,255,255,0.88);
        }

        .checkout-option-title {
            display: block;
            margin-bottom: 0.25rem;
            color: var(--checkout-ink);
            font-weight: 800;
        }

        .checkout-option-text {
            display: block;
            color: var(--checkout-muted);
            font-size: 0.92rem;
            line-height: 1.65;
        }

        .checkout-order-item {
            display: grid;
            grid-template-columns: 88px minmax(0, 1fr) auto;
            gap: 14px;
            padding: 16px;
            border-radius: 24px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 14px 22px rgba(15,81,50,0.04);
        }

        .order-thumb {
            width: 88px;
            height: 88px;
            object-fit: cover;
            border-radius: 20px;
            background: radial-gradient(circle at top right, rgba(32,201,151,0.14), transparent 32%), linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
            box-shadow: 0 16px 24px rgba(15,81,50,0.06);
            border: 1px solid rgba(15,81,50,0.08);
        }

        .order-line-name {
            color: var(--checkout-ink);
            font-weight: 800;
            line-height: 1.35;
        }

        .order-line-meta {
            margin-top: 0.35rem;
            color: var(--checkout-muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .order-line-foot {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 0.75rem;
        }

        .order-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.96);
            border: 1px solid rgba(15,81,50,0.08);
            color: #234536;
            font-size: 0.78rem;
            font-weight: 800;
        }

        .order-line-total {
            align-self: center;
            color: var(--checkout-green-800);
            font-size: 1rem;
            font-weight: 800;
            text-align: right;
        }

        .summary-note {
            padding: 16px 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.92));
            color: var(--checkout-green-800);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.56);
            line-height: 1.7;
        }

        .summary-panel .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(15,81,50,0.08);
        }

        .summary-panel .summary-row:last-child {
            border-bottom: 0;
        }

        .summary-panel .summary-row small {
            color: var(--checkout-muted);
            font-weight: 600;
        }

        .summary-row--stack {
            display: block !important;
        }

        .summary-row--stack small {
            display: block;
            margin-bottom: 0.65rem;
        }

        .total-amount {
            font-size: 2rem;
            font-weight: 900;
            color: var(--checkout-green-800);
            line-height: 1;
        }

        .total-amount-note {
            margin: 0.55rem 0 0;
            color: var(--checkout-muted);
            font-size: 0.9rem;
            line-height: 1.6;
        }

        #place-order-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 58px;
            background: linear-gradient(90deg, var(--checkout-green-800), var(--checkout-green-500));
            color: #fff !important;
            border: 0;
            border-radius: 20px;
            font-weight: 800;
            letter-spacing: 0.04em;
            padding: 16px 20px;
            box-shadow: 0 18px 35px rgba(5,150,105,0.18);
            font-size: 16px;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        #place-order-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 24px 42px rgba(5,150,105,0.22);
        }

        #place-order-btn:disabled {
            opacity: 0.6;
        }

        #loading-indicator {
            padding: 18px;
            border-radius: 20px;
            background: rgba(255,255,255,0.94);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 14px 22px rgba(15,81,50,0.04);
        }

        .checkout-empty-state {
            padding: 1rem 0;
            text-align: center;
            color: var(--checkout-muted);
        }

        @media (max-width: 1199px) {
            .checkout-sticky-stack {
                top: var(--sticky-safe-top, 112px);
            }
        }

        @media (max-width: 991px) {
            .checkout-page-header {
                padding: 5rem 0 5.75rem;
            }

            .checkout-sticky-stack {
                position: static;
            }

            .checkout-form-shell,
            .checkout-summary-shell,
            .checkout-payment-shell {
                padding: 18px;
                border-radius: 28px;
            }

            .checkout-shell-head {
                flex-direction: column;
            }

            .checkout-order-item {
                grid-template-columns: 76px minmax(0, 1fr);
            }

            .order-thumb {
                width: 76px;
                height: 76px;
            }

            .order-line-total {
                grid-column: 1 / -1;
                text-align: left;
                padding-top: 0.25rem;
            }
        }

        @media (max-width: 575px) {
            .checkout-page-header {
                border-radius: 0 0 28px 28px;
            }

            .checkout-stage {
                margin-top: -54px;
            }

            .checkout-hero-content h1 {
                font-size: 2rem;
            }

            .checkout-option-body,
            .checkout-order-item,
            .checkout-subcard,
            .summary-panel {
                padding: 16px;
                border-radius: 22px;
            }

            .checkout-option-body {
                flex-direction: column;
            }

            .checkout-shell-badge,
            .info-badge {
                width: 100%;
                justify-content: flex-start;
            }

            .order-line-foot {
                grid-template-columns: 1fr;
            }

            .order-pill {
                width: 100%;
                justify-content: flex-start;
            }

            .total-amount {
                font-size: 1.7rem;
            }
        }
    </style>

    @php
        $subtotal = isset($resumeOrder) && $resumeOrder ? ($resumeOrder->base_total_price ?? 0) : (int)\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,'','');
        $cartLineCount = count($items);
    @endphp

    <div class="container-fluid page-header checkout-page-header py-5">
        <div class="container">
            <div class="checkout-hero-content text-center">
                <span class="checkout-hero-kicker"><i class="fas fa-lock"></i> Checkout</span>
                <h1 class="text-white display-5 fw-bold mb-3">Finalisasi Pesanan Dengan Tampilan Lebih Premium</h1>
                <p class="text-white-50 lead mb-3">Form, pilihan pengiriman, metode pembayaran, dan ringkasan order dirapikan supaya proses checkout terasa lebih jelas tanpa mengubah logic yang sudah berjalan.</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('carts') }}">Cart</a></li>
                    <li class="breadcrumb-item active text-white">Checkout</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid checkout-stage py-5">
        <div class="container pb-5">
            <form action="{{ route('orders.checkout') }}" method="post" enctype="multipart/form-data" id="checkout-form" onsubmit="return handleFormSubmit(event)">
                @csrf
                @if(isset($resumeOrder) && $resumeOrder)
                    <input type="hidden" name="resume_order_id" value="{{ $resumeOrder->id }}">
                @endif

                <div class="row g-4 align-items-start">
                    <div class="col-md-12 col-lg-7 col-xl-7">
                        <div class="checkout-surface checkout-form-shell">
                            <div class="checkout-shell-head">
                                <div>
                                    <span class="checkout-shell-kicker"><i class="fas fa-id-card"></i> Data Pemesan</span>
                                    <h2>Billing Details</h2>
                                    <p>Lengkapi identitas, alamat, dan preferensi pengiriman dengan layout yang lebih rapi agar pengecekan data terasa lebih cepat.</p>
                                </div>
                                <span class="checkout-shell-badge"><i class="fas fa-bag-shopping"></i>{{ $cartLineCount }} baris item</span>
                            </div>

                            @if(isset($resumeOrder) && $resumeOrder)
                                <div class="alert checkout-resume-alert">Resuming previous order #{{ $resumeOrder->code }}. You can complete payment or edit details before placing order.</div>
                            @endif

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fa fa-user"></i><span>Informasi Utama</span></div>
                                <p class="checkout-card-copy">Data ini dipakai untuk konfirmasi pesanan dan komunikasi saat proses pengiriman atau pengambilan di toko.</p>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <div class="form-item w-100">
                                            <label>Nama <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="name" value="{{ old('name', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_first_name : auth()->user()->name) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label>Phone <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="phone" value="{{ old('phone', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_phone : auth()->user()->phone) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label>Email Address</label>
                                            <input type="text" class="form-control" name="email" value="{{ old('email', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_email : auth()->user()->email) }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-item">
                                            <label>Postcode / Zip <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="postcode" value="{{ old('postcode', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_postcode : auth()->user()->postcode) }}">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fa fa-location-dot"></i><span>Alamat & Catatan</span></div>
                                <p class="checkout-card-copy">Alamat utama tetap dipertahankan seperti sebelumnya, hanya tampilannya dibuat lebih bersih agar mudah dibaca.</p>
                                <div class="row g-3">
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label class="form-label">Address <span class="required">*</span></label>
                                            <input type="text" class="form-control" name="address1" value="{{ old('address1', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_address1 : auth()->user()->address1) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label class="form-label">Address Line 2</label>
                                            <input type="text" class="form-control" name="address2" value="{{ old('address2', isset($resumeOrder) && $resumeOrder ? $resumeOrder->customer_address2 : auth()->user()->address2) }}">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label>Order Notes</label>
                                            <textarea class="form-control" name="note" rows="4">{{ old('note') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item">
                                            <label>Order Attachments (if exists)</label>
                                            <input type="file" onchange="" id="image" class="form-control" name="attachments">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item d-none image-item checkout-preview-card">
                                            <label for="">Preview Image</label>
                                            <img src="" class="img-preview img-fluid" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-subcard">
                                <div class="checkout-card-title"><i class="fa fa-truck"></i><span>Pengiriman</span></div>
                                <p class="checkout-card-copy">Pilih ambil di toko atau kirim lewat kurir. Field lanjutan tetap memakai ID dan name yang sama agar AJAX ongkir tetap berjalan normal.</p>

                                <div class="checkout-option-grid">
                                    <label class="checkout-option-card" for="delivery-self">
                                        <input type="radio" class="form-check-input checkout-choice-input" id="delivery-self" name="delivery_method" value="self" checked>
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-store"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Self Pickup</span>
                                                <span class="checkout-option-text">Ambil langsung di toko tanpa ongkir tambahan. Cocok untuk pesanan yang ingin diambil cepat pada hari yang sama.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="delivery-courier">
                                        <input type="radio" class="form-check-input checkout-choice-input" id="delivery-courier" name="delivery_method" value="courier">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-truck-fast"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Courier Delivery</span>
                                                <span class="checkout-option-text">Kirim ke alamat tujuan dengan pilihan layanan ongkir yang tetap dihitung melalui flow existing.</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="row g-3 mt-1">
                                    <div class="col-md-4">
                                        <div class="form-item address-fields" style="display: none;">
                                            <label>Provinsi<span class="required">*</span></label>
                                            <select name="province_id" class="form-control" id="shipping-province">
                                                <option value="">-- Pilih Provinsi --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-item address-fields" style="display: none;">
                                            <label>City<span class="required">*</span></label>
                                            <select name="shipping_city_id" class="form-control" id="shipping-city">
                                                <option value="">-- Pilih Kota --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-item address-fields" style="display: none;">
                                            <label>District<span class="required">*</span></label>
                                            <select name="shipping_district_id" class="form-control" id="shipping-district">
                                                <option value="">-- Pilih Kecamatan --</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-item address-fields" id="shipping-row" style="display: none;">
                                            <label class="form-label">Shipping Service</label>
                                            <select class="form-control" id="shipping-cost-option" name="shipping_service">
                                                <option value="">-- Select Delivery Method First --</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12 col-lg-5 col-xl-5">
                        <div class="checkout-sticky-stack">
                            <div class="checkout-surface checkout-summary-shell">
                                <div class="checkout-shell-head">
                                    <div>
                                        <span class="checkout-shell-kicker"><i class="fas fa-receipt"></i> Order Review</span>
                                        <h2>Ringkasan Pesanan</h2>
                                        <p>Item, subtotal, kode unik, dan total akhir ditempatkan dalam satu panel supaya keputusan bayar lebih cepat.</p>
                                    </div>
                                    <span class="checkout-shell-badge"><i class="fas fa-layer-group"></i>{{ $cartLineCount }} item</span>
                                </div>

                                <div class="summary-note">Verifikasi item dan nominal akhir di bawah ini. Sistem perhitungan dan flow checkout tetap sama, hanya tampilannya yang dirapikan.</div>

                                <div class="checkout-order-list mt-3">
                                    @forelse ($items as $item)
                                        @php
                                            $attributeText = null;
                                            if (isset($item->options['type']) && $item->options['type'] === 'configurable') {
                                                $product = \App\Models\Product::find($item->options['product_id']);
                                                $image = !empty($item->options['image']) ? asset('storage/' . $item->options['image']) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                $displayName = $item->name;
                                                if (isset($item->options['attributes']) && !empty($item->options['attributes'])) {
                                                    $attributes = [];
                                                    foreach ($item->options['attributes'] as $attr => $value) {
                                                        $attributes[] = $attr . ': ' . $value;
                                                    }
                                                    $attributeText = implode(', ', $attributes);
                                                    $displayName .= ' (' . $attributeText . ')';
                                                }
                                            } else {
                                                $product = $item->model;
                                                if (!$product && isset($item->options['product_id'])) {
                                                    $product = \App\Models\Product::find($item->options['product_id']);
                                                }
                                                if (!$product) {
                                                    $product = \App\Models\Product::find($item->id);
                                                }

                                                $image = asset('themes/ezone/assets/img/cart/3.jpg');
                                                if ($product && $product->productImages->isNotEmpty()) {
                                                    $image = asset('storage/'.$product->productImages->first()->path);
                                                } elseif (!empty($item->options['image'])) {
                                                    $image = asset('storage/' . $item->options['image']);
                                                }

                                                $displayName = $product ? $product->name : $item->name;
                                            }
                                        @endphp
                                        <div class="checkout-order-item">
                                            <img src="{{ $image }}" class="order-thumb" alt="{{ $displayName }}">
                                            <div>
                                                <div class="order-line-name">{{ $displayName }}</div>
                                                @if($attributeText)
                                                    <div class="order-line-meta">{{ $attributeText }}</div>
                                                @endif
                                                <div class="order-line-foot">
                                                    <span class="order-pill"><i class="fas fa-tags"></i>Rp. {{ number_format($item->price,0,',','.') }} / item</span>
                                                    <span class="order-pill"><i class="fas fa-box-open"></i>Qty {{ $item->qty }}</span>
                                                </div>
                                            </div>
                                            <div class="order-line-total">Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                                        </div>
                                    @empty
                                        <div class="checkout-empty-state">The cart is empty!</div>
                                    @endforelse
                                </div>

                                <div class="summary-panel">
                                    <div class="summary-row">
                                        <small>Subtotal</small>
                                        <strong>Rp. {{ number_format($subtotal,0,',','.') }}</strong>
                                    </div>
                                    <div class="summary-row">
                                        <small>Default Delivery</small>
                                        <span>Self Pickup</span>
                                    </div>
                                    <div class="summary-row summary-row--stack">
                                        <small>Unique Payment Code</small>
                                        <input type="number" name="unique_code" value="{{ $unique_code }}" class="form-control unique_code" readonly>
                                    </div>
                                    <div class="summary-row summary-row--stack">
                                        <small>Total Pembayaran</small>
                                        <div class="total-amount">{{ number_format((int)$subtotal) }}</div>
                                        <p class="total-amount-note">Harap tunggu nominal berubah sesuai dengan total sebelum checkout.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="checkout-surface checkout-payment-shell">
                                <div class="checkout-card-title"><i class="fa fa-credit-card"></i><span>Metode Pembayaran</span></div>
                                <p class="checkout-card-copy">Pilih metode pembayaran yang paling nyaman. Semua opsi tetap memakai flow backend yang sudah aktif.</p>

                                <div class="checkout-payment-list">
                                    <label class="checkout-option-card" for="Transfer-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Transfer-1" name="payment_method" value="manual" checked>
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-building-columns"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Direct Bank Transfer</span>
                                                <span class="checkout-option-text">Transfer manual ke rekening toko. Bukti pembayaran tetap bisa diunggah setelah order dikonfirmasi.</span>
                                                <span class="info-badge mt-2">BCA : 01401840112 (Ahmad Sambudi)</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="Automatic-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Automatic-1" name="payment_method" value="automatic">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-bolt"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Automatic Payment (Midtrans)</span>
                                                <span class="checkout-option-text">Bayar otomatis menggunakan Credit Card, E-Wallet, Bank Transfer, atau QR Code melalui Midtrans.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="COD-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="COD-1" name="payment_method" value="cod">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-money-bill-wave"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Cash on Delivery (COD)</span>
                                                <span class="checkout-option-text">Bayar tunai saat produk sampai di lokasi Anda, cocok untuk pelanggan yang ingin transaksi lebih langsung.</span>
                                            </span>
                                        </span>
                                    </label>

                                    <label class="checkout-option-card" for="Store-1">
                                        <input type="radio" class="form-check-input payment-option checkout-choice-input" id="Store-1" name="payment_method" value="toko">
                                        <span class="checkout-option-body">
                                            <span class="checkout-option-icon"><i class="fas fa-shop"></i></span>
                                            <span>
                                                <span class="checkout-option-title">Bayar Di Toko</span>
                                                <span class="checkout-option-text">Datang langsung ke toko untuk melakukan pembayaran dan lanjutkan proses sesuai alur yang sudah ada.</span>
                                            </span>
                                        </span>
                                    </label>
                                </div>

                                <div class="place-order-wrap">
                                    <input type="hidden" name="total_amount" class="total-amount-input" value="{{ (int)$subtotal }}">
                                    <button type="submit" id="place-order-btn" class="btn border-secondary py-3 px-4 text-uppercase w-100 text-primary"><i class="fas fa-lock"></i> Place Order</button>
                                    <div id="loading-indicator" style="display: none;" class="text-center mt-3">
                                        <div class="spinner-border text-primary" role="status">
                                            <span class="sr-only">Processing...</span>
                                        </div>
                                        <p class="mt-2 mb-0">Processing your order...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('script-alt')
    <script>
        function loadProvinces() {
            console.log('Loading provinces...');
            console.log('jQuery available:', typeof $ !== 'undefined');
            console.log('CSRF token:', $('meta[name="csrf-token"]').attr('content'));

            var apiUrl = "{{ url('api/provinces') }}" + '?t=' + Date.now();
            console.log('API URL:', apiUrl);

            $.ajax({
                url: apiUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', apiUrl);
                    $('#shipping-province').html('<option value="">Loading provinces...</option>');
                },
                success: function(response) {
                    console.log('Provinces response:', response);
                    var options = '<option value="">-- Pilih Provinsi --</option>';

                    if (Array.isArray(response)) {
                        response.forEach(function(item) {
                            if (item && (item.id !== undefined && item.name !== undefined)) {
                                var selected = item.id == '{{ auth()->user()->province_id }}' ? 'selected' : '';
                                options += '<option value="' + item.id + '" ' + selected + '>' + item.name + '</option>';
                            }
                        });
                    } else if (response && typeof response === 'object') {
                        for (var id in response) {
                            if (response.hasOwnProperty(id)) {
                                var name = response[id];
                                var selected = id == '{{ auth()->user()->province_id }}' ? 'selected' : '';
                                options += '<option value="' + id + '" ' + selected + '>' + name + '</option>';
                            }
                        }
                    } else {
                        console.error('Unexpected provinces response format');
                    }

                    $('#shipping-province').html(options);
                    console.log('Province options updated, total options:', $('#shipping-province option').length);

                    var selectedProvinceId = $('#shipping-province').val();
                    if (selectedProvinceId) {
                        console.log('Auto-loading cities for selected province:', selectedProvinceId);
                        loadCities(selectedProvinceId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading provinces:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    console.error('Status Code:', xhr.status);
                    console.error('Ready State:', xhr.readyState);
                    $('#shipping-province').html('<option value="">Error loading provinces</option>');
                },
                complete: function(xhr, status) {
                    console.log('AJAX request completed with status:', status);
                }
            });
        }

        function loadCities(provinceId) {
            console.log('Loading cities for province:', provinceId);
            var cityUrl = "{{ url('api/cities') }}/" + provinceId + '?t=' + Date.now();
            $.ajax({
                url: cityUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', cityUrl);
                    $('#shipping-city').html('<option value="">Loading cities...</option>');
                },
                success: function(response) {
                    console.log('Cities response received:', response);
                    var options = '<option value="">-- Pilih Kota --</option>';
                    if (response && Array.isArray(response)) {
                        console.log('Processing cities array with', response.length, 'items');
                        $.each(response, function(index, city) {
                            var selected = city.id == '{{ auth()->user()->city_id }}' ? 'selected' : '';
                            options += '<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>';
                        });
                    }
                    $('#shipping-city').html(options);
                    console.log('City options updated, total options:', $('#shipping-city option').length);
                    
                    var selectedCityId = $('#shipping-city').val();
                    if (selectedCityId) {
                        console.log('Auto-loading districts for selected city:', selectedCityId);
                        loadDistricts(selectedCityId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading cities:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    $('#shipping-city').html('<option value="">Error loading cities</option>');
                }
            });
        }

        function loadDistricts(cityId) {
            console.log('Loading districts for city:', cityId);
            var districtUrl = "{{ url('api/districts') }}/" + cityId + '?t=' + Date.now();
            $.ajax({
                url: districtUrl,
                type: 'GET',
                dataType: 'json',
                beforeSend: function() {
                    console.log('Making request to:', districtUrl);
                    $('#shipping-district').html('<option value="">Loading districts...</option>');
                },
                success: function(response) {
                    console.log('Districts response received:', response);
                    var options = '<option value="">-- Pilih Kecamatan --</option>';
                    if (response && Array.isArray(response)) {
                        console.log('Processing districts array with', response.length, 'items');
                        $.each(response, function(index, district) {
                            var selected = district.id == '{{ auth()->user()->district_id }}' ? 'selected' : '';
                            options += '<option value="' + district.id + '" ' + selected + '>' + district.name + '</option>';
                        });
                    }
                    $('#shipping-district').html(options);
                    console.log('District options updated, total options:', $('#shipping-district option').length);
                    
                    var selectedDistrictId = $('#shipping-district').val();
                    if (selectedDistrictId) {
                        console.log('Auto-loading shipping costs for selected district:', selectedDistrictId);
                        var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                        if (deliveryMethod === 'courier') {
                            getShippingCostOptions(selectedDistrictId);
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error loading districts:');
                    console.error('Status:', status);
                    console.error('Error:', error);
                    console.error('Response Text:', xhr.responseText);
                    $('#shipping-district').html('<option value="">Error loading districts</option>');
                }
            });
        }

        function getShippingCostOptions(district_id) {
            console.log('Getting shipping costs for district_id:', district_id);
            $('#shipping-cost-option').html('<option value="">Loading shipping costs...</option>');
            
            $.ajax({
                url: "{{ route('orders.shippingCost') }}",
                type: 'POST',
                data: {
                    district_id: district_id,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log('Shipping API response:', response);
                    var options = '<option value="">-- Select Shipping Service --</option>';
                    
                    if (response.results && response.results.length > 0) {
                        $.each(response.results, function(index, result) {
                            var displayName = result.service + ' - Rp. ' + number_format(result.cost) + ' (' + result.etd + ')';
                            var valueData = {
                                service: result.service,
                                cost: result.cost,
                                etd: result.etd,
                                courier: result.courier
                            };
                            var value = JSON.stringify(valueData).replace(/"/g, '&quot;');
                            options += '<option value="' + value + '">' + displayName + '</option>';
                        });
                    } else {
                        console.warn('No shipping results found in response');
                        options += '<option value="">No shipping options available</option>';
                    }
                    
                    $('#shipping-cost-option').html(options);
                    
                    // Update total amount after shipping options are loaded
                    console.log('📦 Shipping options loaded, updating total...');
                    updateTotalAmount();
                    
                    // Force trigger change event to ensure total updates
                    setTimeout(function() {
                        console.log('🔄 Delayed total update...');
                        updateTotalAmount();
                    }, 100);
                },
                error: function(xhr, status, error) {
                    console.error('Shipping API error:', {
                        status: status,
                        error: error,
                        response: xhr.responseText,
                        statusCode: xhr.status
                    });
                    $('#shipping-cost-option').html('<option value="">Error loading shipping costs</option>');
                }
            });
        }

        function number_format(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        function updateTotalAmount() {
            var subtotal = parseInt("{{ (int)\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,'','') }}");
            var uniqueCode = parseInt($('.unique_code').val()) || 0;
            var shippingCost = 0;
            
            var deliveryMethod = $('input[name="delivery_method"]:checked').val();
            
            console.log('Updating total - Delivery method:', deliveryMethod);
            console.log('Subtotal:', subtotal);
            console.log('Unique code:', uniqueCode);
            
            if (deliveryMethod === 'self') {
                shippingCost = 0;
                console.log('Self pickup - Shipping cost: 0');
            } else if (deliveryMethod === 'courier') {
                var selectedShipping = $('#shipping-cost-option').val();
                console.log('Selected shipping value:', selectedShipping);
                
                if (selectedShipping) {
                    try {
                        var unescapedShipping = selectedShipping.replace(/&quot;/g, '"');
                        console.log('Unescaped shipping value:', unescapedShipping);
                        var shippingData = JSON.parse(unescapedShipping);
                        shippingCost = parseInt(shippingData.cost) || 0;
                        console.log('Parsed shipping cost:', shippingCost);
                        console.log('Shipping data:', shippingData);
                    } catch (e) {
                        console.error('Error parsing shipping data:', e);
                        console.log('Raw shipping value:', selectedShipping);
                        shippingCost = 0;
                    }
                } else {
                    console.log('No shipping option selected');
                }
            }
            
            var total = subtotal + uniqueCode + shippingCost;
            console.log('Final total calculation:', subtotal, '+', uniqueCode, '+', shippingCost, '=', total);
            
            $('.total-amount').text(number_format(total));
            $('.total-amount-input').val(total);
            console.log('Total updated to:', number_format(total));
        }

        $(document).ready(function(){
            console.log('🚀 CHECKOUT PAGE INITIALIZED');
            
            // Setup error handlers
            window.addEventListener('error', function(e) {
                console.error('💥 JavaScript Error:', e.error);
                console.error('Message:', e.message);
                console.error('Filename:', e.filename);
                console.error('Line:', e.lineno);
            });
            
            window.addEventListener('unhandledrejection', function(e) {
                console.error('💥 Unhandled Promise Rejection:', e.reason);
            });
            
            // Setup CSRF token for all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            // Ensure form exists
            if ($('#checkout-form').length === 0) {
                console.error('❌ Checkout form not found!');
                return;
            }
            
            console.log('✅ Checkout form found');
            
            // Initialize form state
            $('#shipping-row').hide();
            $('.address-fields').hide();
            $('#shipping-cost-option').html('<option value="">-- Select Delivery Method First --</option>');
            
            // Disable address dropdowns for self pickup (default)
            $('#shipping-province').prop('disabled', true);
            $('#shipping-city').prop('disabled', true);
            $('#shipping-district').prop('disabled', true);
            
            // Always load provinces on page load if not already loaded
            if ($('#shipping-province option').length <= 1) {
                console.log('Loading provinces on page initialization...');
                loadProvinces();
            }
            
            // Initialize total amount calculation
            updateTotalAmount();
            
            // Debug: Test element accessibility
            console.log('=== CHECKOUT PAGE DEBUG ===');
            console.log('Total amount element exists:', $('.total-amount').length > 0);
            console.log('Total amount current text:', $('.total-amount').text());
            console.log('Unique code element exists:', $('.unique_code').length > 0);
            console.log('Unique code value:', $('.unique_code').val());
            console.log('Shipping cost option element exists:', $('#shipping-cost-option').length > 0);
            console.log('Delivery method elements count:', $('input[name="delivery_method"]').length);
            console.log('Currently selected delivery method:', $('input[name="delivery_method"]:checked').val());
            console.log('Payment method elements count:', $('input[name="payment_method"]').length);
            console.log('Currently selected payment method:', $('input[name="payment_method"]:checked').val());
            console.log('============================');
            
            $('#shipping-province').on('change', function() {
                var province_id = $(this).val();
                console.log('Province changed to:', province_id);
                if (province_id) {
                    loadCities(province_id);
                } else {
                    $('#shipping-city').html('<option value="">-- Pilih Kota --</option>');
                    $('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
                }
            });
            
            $('#shipping-city').on('change', function() {
                var city_id = $(this).val();
                console.log('City changed to:', city_id);
                if (city_id) {
                    loadDistricts(city_id);
                } else {
                    $('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
                }
                
                var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                if (deliveryMethod === 'courier') {
                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });
            
            $('#shipping-district').on('change', function() {
                var district_id = $(this).val();
                var deliveryMethod = $('input[name="delivery_method"]:checked').val();
                
                if (deliveryMethod === 'courier' && district_id) {
                    getShippingCostOptions(district_id);
                } else if (deliveryMethod === 'courier') {
                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });
            
            $('input[name="delivery_method"]').on('change', function() {
                var method = $(this).val();
                if (method === 'self') {
                    $('#shipping-row').hide();
                    $('.address-fields').hide();
                    $('#shipping-cost-option').removeAttr('required');
                    $('#shipping-province').prop('disabled', true).removeAttr('required');
                    $('#shipping-city').prop('disabled', true).removeAttr('required');
                    $('#shipping-district').prop('disabled', true).removeAttr('required');
                    updateTotalAmount();
                } else if (method === 'courier') {
                    $('.address-fields').show();
                    $('#shipping-row').show();
                    $('#shipping-cost-option').attr('required', 'required');
                    $('#shipping-province').prop('disabled', false).attr('required', 'required');
                    $('#shipping-city').prop('disabled', false).attr('required', 'required');
                    $('#shipping-district').prop('disabled', false).attr('required', 'required');

                    if ($('#shipping-province option').length <= 1) {
                        loadProvinces();
                    } else {
                        var selectedProvinceId = $('#shipping-province').val();
                        if (selectedProvinceId) loadCities(selectedProvinceId);
                    }

                    $('#shipping-cost-option').html('<option value="">-- Select District First --</option>');
                    updateTotalAmount();
                }
            });

            $('#shipping-cost-option').on('change', function() {
                console.log('🚢 SHIPPING COST CHANGED!');
                console.log('New value:', $(this).val());
                updateTotalAmount();
            });

            $('.payment-option').on('change', function() {
                var selectedPayment = $(this).val();
                console.log('Payment method selected:', selectedPayment);
                
                $('.payment-option').not(this).prop('checked', false);
                $(this).prop('checked', true);
            });
            
            // Debug test buttons
            $('#test-update-total').on('click', function() {
                console.log('🧪 MANUAL TOTAL UPDATE TEST');
                updateTotalAmount();
            });
            
            $('#show-debug').on('click', function() {
                console.log('🐛 CURRENT STATE DEBUG:');
                console.log('Subtotal (from Cart):', "{{ (int)\Gloudemans\Shoppingcart\Facades\Cart::subtotal(0,'','') }}");
                console.log('Unique code element value:', $('.unique_code').val());
                console.log('Selected delivery method:', $('input[name="delivery_method"]:checked').val());
                console.log('Selected shipping option:', $('#shipping-cost-option').val());
                console.log('Current total text:', $('.total-amount').text());
                
                // Test if elements are accessible
                console.log('Element tests:');
                console.log('- .total-amount exists:', $('.total-amount').length);
                console.log('- .unique_code exists:', $('.unique_code').length);
                console.log('- #shipping-cost-option exists:', $('#shipping-cost-option').length);
                console.log('- delivery_method radio buttons:', $('input[name="delivery_method"]').length);
            });

       });
       
       function handleFormSubmit(event) {
           // Prevent default immediately to avoid browser form submit (defensive)
           event = event || window.event;
           if (event && event.preventDefault) event.preventDefault();
           else window.event.returnValue = false;

           console.log('🔍 FORM SUBMIT STARTED (defensive)');
           console.log('Form action:', $('#checkout-form').attr('action'));

           // Prevent double submission
           var submitButton = $('#place-order-btn');
           if (submitButton.prop('disabled')) {
               console.log('❌ FORM ALREADY SUBMITTING - preventing double submit');
               return false;
           }

           // Validate form first
           if (!validateForm()) {
               console.log('❌ FORM VALIDATION FAILED - preventing submit');
               return false;
           }

           console.log('✅ FORM VALIDATION PASSED');

           // Disable submit button to prevent double submission
           var submitButton = $('#place-order-btn');
           var loadingIndicator = $('#loading-indicator');

           submitButton.prop('disabled', true).hide();
           loadingIndicator.show();

           var deliveryMethod = $('input[name="delivery_method"]:checked').val();
           console.log('Form submit - delivery method:', deliveryMethod);
           
           if (deliveryMethod === 'self') {
               // Remove address field names for self pickup to avoid validation issues
               $('#shipping-province').removeAttr('name');
               $('#shipping-city').removeAttr('name');
               $('#shipping-district').removeAttr('name');
               $('#shipping-cost-option').removeAttr('name');
               console.log('Self pickup - removed address field names');
           }
           
           // Ensure all required hidden fields exist
           if (!$('input[name="unique_code"]').length) {
               $('<input>').attr({
                   type: 'hidden',
                   name: 'unique_code',
                   value: '0'
               }).appendTo('#checkout-form');
               console.log('Added missing unique_code field');
           }
           
           // Prepare form data for AJAX
           var formData = new FormData($('#checkout-form')[0]);
           console.log('📝 FINAL FORM DATA:');
           for (var pair of formData.entries()) {
               console.log(pair[0] + ': ' + pair[1]);
           }

           // AJAX POST helper
           var ajaxUrl = $('#checkout-form').attr('action');
           var csrfToken = $('meta[name="csrf-token"]').attr('content');

           function handleSuccess(resp) {
               console.log('Checkout AJAX success response:', resp);
               if (resp && resp.success) {
                   if (resp.payment_url) {
                       window.location.href = resp.payment_url;
                       return;
                   }
                   if (resp.redirect) {
                       window.location.href = resp.redirect;
                       return;
                   }
                   window.location.reload();
               } else {
                   alert(resp.message || 'There was an error processing your order');
                   submitButton.prop('disabled', false).show();
                   loadingIndicator.hide();
               }
           }

           function handleError(xhrText) {
               console.error('Checkout failed:', xhrText);
               try {
                   var json = typeof xhrText === 'string' ? JSON.parse(xhrText) : xhrText;
                   alert(json.message || 'An error occurred while processing your order');
               } catch (e) {
                   alert('An error occurred while processing your order. Please try again.');
               }
               submitButton.prop('disabled', false).show();
               loadingIndicator.hide();
           }

           // If jQuery is available, use it (we already set CSRF in $.ajaxSetup earlier)
           if (window.jQuery && $.ajax) {
               $.ajax({
                   url: ajaxUrl,
                   method: 'POST',
                   data: formData,
                   processData: false,
                   contentType: false,
                   dataType: 'json',
                   headers: {
                       'X-Requested-With': 'XMLHttpRequest'
                   },
                   success: function(resp) {
                       handleSuccess(resp);
                   },
                   error: function(xhr, status, err) {
                       handleError(xhr.responseText || status);
                   }
               });
           } else {
               // Fallback to fetch
               var fetchHeaders = {
                   'X-Requested-With': 'XMLHttpRequest'
               };
               if (csrfToken) fetchHeaders['X-CSRF-TOKEN'] = csrfToken;

               fetch(ajaxUrl, {
                   method: 'POST',
                   headers: fetchHeaders,
                   body: formData,
                   credentials: 'same-origin'
               }).then(function(response) {
                   return response.text().then(function(text) {
                       try {
                           var json = text ? JSON.parse(text) : {};
                           if (response.ok) {
                               handleSuccess(json);
                           } else {
                               handleError(text);
                           }
                       } catch (e) {
                           handleError(text);
                       }
                   });
               }).catch(function(err) {
                   handleError(err);
               });
           }

           // Safety fallback re-enable after 15s
           setTimeout(function() {
               submitButton.prop('disabled', false).show();
               loadingIndicator.hide();
           }, 15000);

           // Prevent default (we already did earlier) and do not allow normal submit
           return false;
       }

       function validateForm() {
           var deliveryMethod = $('input[name="delivery_method"]:checked').val();
           var paymentMethod = $('input[name="payment_method"]:checked').val();
           
           console.log('🔍 VALIDATING FORM...');
           console.log('Delivery method:', deliveryMethod);
           console.log('Payment method:', paymentMethod);
           
           var name = $('input[name="name"]').val();
           var address1 = $('input[name="address1"]').val();
           var phone = $('input[name="phone"]').val();
           var email = $('input[name="email"]').val();
           var postcode = $('input[name="postcode"]').val();
           
           console.log('Form data:', {
               name: name,
               address1: address1,
               phone: phone,
               email: email,
               postcode: postcode
           });
           
           // Check for empty or whitespace-only values
           if (!name || name.trim() === '') {
               alert('❌ Please enter your name');
               $('input[name="name"]').focus();
               return false;
           }
           
           if (!address1 || address1.trim() === '') {
               alert('❌ Please enter your address');
               $('input[name="address1"]').focus();
               return false;
           }
           
           if (!phone || phone.trim() === '') {
               alert('❌ Please enter your phone number');
               $('input[name="phone"]').focus();
               return false;
           }
           
           if (!email || email.trim() === '') {
               alert('❌ Please enter your email address');
               $('input[name="email"]').focus();
               return false;
           }
           
           // Simple email validation
           var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
           if (!emailRegex.test(email.trim())) {
               alert('❌ Please enter a valid email address');
               $('input[name="email"]').focus();
               return false;
           }
           
           if (!postcode || postcode.trim() === '') {
               alert('❌ Please enter your postcode');
               $('input[name="postcode"]').focus();
               return false;
           }
           
           if (!deliveryMethod) {
               alert('❌ Please select a delivery method');
               return false;
           }
           
           if (!paymentMethod) {
               alert('❌ Please select a payment method');
               return false;
           }
           
           // Validate courier delivery specific fields
           if (deliveryMethod === 'courier') {
               console.log('Validating courier delivery fields...');
               
               var province = $('#shipping-province').val();
               var city = $('#shipping-city').val();
               var district = $('#shipping-district').val();
               var shippingService = $('#shipping-cost-option').val();
               
               console.log('Courier fields:', {
                   province: province,
                   city: city,
                   district: district,
                   shippingService: shippingService
               });
               
               if (!province || province === '') {
                   alert('❌ Please select a province for courier delivery');
                   $('#shipping-province').focus();
                   return false;
               }
               
               if (!city || city === '') {
                   alert('❌ Please select a city for courier delivery');
                   $('#shipping-city').focus();
                   return false;
               }
               
               if (!district || district === '') {
                   alert('❌ Please select a district for courier delivery');
                   $('#shipping-district').focus();
                   return false;
               }
               
               if (!shippingService || shippingService === '') {
                   alert('❌ Please select a shipping service for courier delivery');
                   $('#shipping-cost-option').focus();
                   return false;
               }
           } else {
               console.log('Self pickup selected - skipping address validation');
           }
           
           // Update total amount one final time
           updateTotalAmount();
           
           console.log('✅ FORM VALIDATION PASSED');
           console.log('Final total amount:', $('.total-amount-input').val());
           
           return true;
       }
    </script>

@endpush
