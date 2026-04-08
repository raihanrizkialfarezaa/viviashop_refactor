@extends('frontend.layouts')
@section('content')
    <style>
        :root {
            --cart-green-900: #092b1c;
            --cart-green-800: #0f5132;
            --cart-green-700: #198754;
            --cart-green-600: #16a34a;
            --cart-green-500: #20c997;
            --cart-ink: #1f2f46;
            --cart-muted: #62756d;
        }

        .cart-page-header {
            position: relative;
            margin-top: 18px;
            padding: 5.5rem 0 6.25rem;
            border-radius: 0 0 42px 42px;
            background:
                radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 26%),
                radial-gradient(circle at 84% 18%, rgba(32,201,151,0.16), transparent 24%),
                linear-gradient(135deg, rgba(9,43,28,0.96) 0%, rgba(15,81,50,0.94) 48%, rgba(22,163,74,0.82) 100%);
            overflow: hidden;
        }

        .cart-page-header::after {
            content: '';
            position: absolute;
            right: -110px;
            top: -90px;
            width: 340px;
            height: 340px;
            background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
            pointer-events: none;
        }

        .cart-hero-content {
            position: relative;
            z-index: 1;
            max-width: 780px;
            margin: 0 auto;
        }

        .cart-hero-kicker,
        .cart-panel-kicker {
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

        .cart-hero-kicker {
            margin-bottom: 1rem;
            background: rgba(255,255,255,0.14);
            border: 1px solid rgba(255,255,255,0.18);
            color: #fff;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .cart-page-header .breadcrumb {
            gap: 0.45rem;
        }

        .cart-page-header .breadcrumb-item,
        .cart-page-header .breadcrumb-item a {
            color: rgba(255,255,255,0.8) !important;
            text-decoration: none;
        }

        .cart-page-header .breadcrumb-item.active {
            color: #fff !important;
        }

        .cart-stage {
            position: relative;
            margin-top: -74px;
            padding-top: 0 !important;
        }

        .cart-surface,
        .cart-summary {
            border-radius: 32px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 28px 56px rgba(15,81,50,0.08);
        }

        .cart-alert-shell {
            padding: 14px;
        }

        .cart-alert-shell .alert {
            border-radius: 18px;
            border: none;
            margin: 0;
        }

        .cart-list-panel {
            padding: 22px;
        }

        .cart-panel-head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 16px;
            margin-bottom: 1.5rem;
        }

        .cart-panel-kicker {
            background: rgba(15,81,50,0.06);
            color: var(--cart-green-800);
            margin-bottom: 0.85rem;
        }

        .cart-panel-head h2,
        .cart-summary-head h2 {
            margin: 0 0 0.4rem;
            font-family: 'Raleway', sans-serif;
            font-size: clamp(1.65rem, 3vw, 2.2rem);
            font-weight: 800;
            line-height: 1.06;
            letter-spacing: -0.03em;
            color: var(--cart-ink);
        }

        .cart-panel-head p,
        .cart-summary-head p {
            margin: 0;
            color: var(--cart-muted);
            line-height: 1.7;
        }

        .cart-head-link,
        .btn-outline-soft {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 50px;
            padding: 0 18px;
            border-radius: 999px;
            border: 1px solid rgba(15,81,50,0.12);
            background: rgba(255,255,255,0.96);
            color: var(--cart-green-800);
            font-weight: 800;
            text-decoration: none;
            box-shadow: 0 12px 22px rgba(15,81,50,0.06);
            transition: transform 0.25s ease, box-shadow 0.25s ease, color 0.25s ease;
        }

        .cart-head-link:hover,
        .btn-outline-soft:hover {
            transform: translateY(-2px);
            color: var(--cart-green-800);
            box-shadow: 0 18px 30px rgba(15,81,50,0.1);
        }

        .cart-table {
            border-collapse: separate;
            border-spacing: 0 18px;
            width: 100%;
            margin-bottom: 1.25rem;
        }

        .cart-table thead th {
            border: 0;
            background: transparent;
            color: #6b7280;
            font-size: 0.74rem;
            font-weight: 800;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            padding: 0 1rem 0.25rem;
        }

        .cart-table tbody tr {
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.82), 0 18px 32px rgba(15,81,50,0.06);
            border-radius: 24px;
        }

        .cart-table tbody td,
        .cart-table tbody th {
            vertical-align: middle;
            padding: 1.1rem 1rem;
            border-top: 0;
            background: transparent;
        }

        .cart-table tbody th:first-child {
            border-radius: 24px 0 0 24px;
        }

        .cart-table tbody td:last-child {
            border-radius: 0 24px 24px 0;
        }

        .cart-line {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .product-thumb-sm {
            width: 102px;
            height: 102px;
            object-fit: cover;
            border-radius: 22px;
            background: radial-gradient(circle at top right, rgba(32,201,151,0.14), transparent 32%), linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
            box-shadow: 0 18px 30px rgba(15,81,50,0.08);
            border: 1px solid rgba(15,81,50,0.08);
        }

        .product-line-name {
            font-size: 1.06rem;
            color: var(--cart-ink);
            font-weight: 800;
            line-height: 1.3;
            margin-bottom: 0.45rem;
        }

        .product-line-meta {
            font-size: 0.9rem;
            color: var(--cart-muted);
            line-height: 1.6;
        }

        .line-pill-row {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .line-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 12px;
            border-radius: 999px;
            background: rgba(255,255,255,0.96);
            border: 1px solid rgba(15,81,50,0.08);
            color: #234536;
            font-size: 0.78rem;
            font-weight: 800;
            box-shadow: 0 10px 18px rgba(15,81,50,0.04);
        }

        .line-pill--accent {
            background: rgba(209,231,221,0.54);
            color: var(--cart-green-800);
        }

        .qty-input {
            max-width: 138px;
        }

        .qty-input input.form-control {
            min-height: 52px;
            border-radius: 16px;
            border: 1px solid rgba(15,81,50,0.12);
            box-shadow: inset 0 2px 6px rgba(2,6,23,0.03);
            padding-inline: 16px;
            font-weight: 700;
        }

        .qty-input input.form-control:focus {
            border-color: var(--cart-green-600);
            box-shadow: 0 10px 20px rgba(16,185,129,0.1);
        }

        .price-amount {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 800;
            color: var(--cart-green-800);
            font-size: 1rem;
        }

        .btn.delete {
            width: 46px;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 16px !important;
            background: rgba(255,255,255,0.96) !important;
            border: 1px solid rgba(239,68,68,0.12) !important;
            box-shadow: 0 12px 20px rgba(239,68,68,0.08);
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .btn.delete:hover {
            transform: translateY(-2px);
            box-shadow: 0 18px 28px rgba(239,68,68,0.12);
        }

        .cart-helper-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 14px;
            margin-top: 1rem;
        }

        .cart-helper-card {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            padding: 16px 18px;
            border-radius: 20px;
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(244,249,246,0.94));
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: 0 14px 22px rgba(15,81,50,0.04);
        }

        .cart-helper-card i {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            border-radius: 14px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15,81,50,0.08);
            color: var(--cart-green-800);
        }

        .cart-helper-card strong {
            display: block;
            color: var(--cart-ink);
            margin-bottom: 0.2rem;
        }

        .cart-helper-card span {
            display: block;
            color: var(--cart-muted);
            font-size: 0.92rem;
            line-height: 1.6;
        }

        .cart-summary {
            padding: 24px;
            position: sticky;
            top: var(--sticky-safe-top, 124px);
        }

        .cart-summary-head {
            margin-bottom: 1.25rem;
        }

        .summary-note {
            padding: 16px 18px;
            border-radius: 20px;
            background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.92));
            color: var(--cart-green-800);
            border: 1px solid rgba(15,81,50,0.08);
            box-shadow: inset 0 1px 0 rgba(255,255,255,0.56);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .cart-summary .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 12px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(15,81,50,0.08);
        }

        .cart-summary .summary-row small {
            color: #62756d;
            font-weight: 600;
        }

        .cart-summary .summary-row strong,
        .cart-summary .summary-row span {
            color: var(--cart-ink);
            font-weight: 800;
        }

        .summary-total-row {
            padding-top: 1.05rem !important;
            margin-top: 0.25rem;
            border-bottom: 0 !important;
        }

        .summary-total-row .summary-total {
            font-size: 1.28rem;
            color: var(--cart-green-800);
        }

        .btn-gradient {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            min-height: 56px;
            background: linear-gradient(90deg, var(--cart-green-800) 0%, var(--cart-green-500) 100%);
            border: none;
            color: #fff;
            font-weight: 800;
            padding: 0.95rem 1.35rem;
            border-radius: 20px;
            width: 100%;
            letter-spacing: 0.03em;
            box-shadow: 0 18px 35px rgba(6,95,70,0.16);
            transition: transform 0.25s ease, box-shadow 0.25s ease;
        }

        .btn-gradient:hover {
            color: #fff;
            transform: translateY(-3px);
            box-shadow: 0 24px 44px rgba(6,95,70,0.2);
        }

        .cart-summary-actions {
            display: grid;
            gap: 12px;
            margin-top: 1.25rem;
        }

        .empty-cart {
            text-align: center;
            padding: 3.5rem 1rem 3rem;
        }

        .empty-cart-icon {
            width: 84px;
            height: 84px;
            margin: 0 auto 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 28px;
            background: linear-gradient(135deg, rgba(209,231,221,0.72), rgba(236,253,245,0.96));
            color: var(--cart-green-800);
            font-size: 1.7rem;
            box-shadow: 0 18px 30px rgba(15,81,50,0.08);
        }

        .empty-cart h4 {
            margin-bottom: 0.6rem;
            color: var(--cart-ink);
            font-weight: 800;
        }

        .empty-cart p {
            max-width: 440px;
            margin: 0 auto 1.15rem;
            color: var(--cart-muted);
            line-height: 1.7;
        }

        @media (max-width: 1199px) {
            .cart-summary {
                top: var(--sticky-safe-top, 112px);
            }
        }

        @media (max-width: 991px) {
            .cart-page-header {
                padding: 5rem 0 5.75rem;
            }

            .cart-list-panel,
            .cart-summary {
                padding: 18px;
                border-radius: 28px;
            }

            .cart-panel-head {
                flex-direction: column;
            }

            .cart-table thead {
                display: none;
            }

            .cart-table,
            .cart-table tbody,
            .cart-table tr,
            .cart-table td,
            .cart-table th {
                display: block;
                width: 100%;
            }

            .cart-table tbody tr {
                padding: 1rem;
                border-radius: 24px;
            }

            .cart-table tbody th,
            .cart-table tbody td {
                padding: 0.7rem 0;
                border-radius: 0 !important;
            }

            .cart-table tbody td::before {
                content: attr(data-label);
                display: block;
                margin-bottom: 0.35rem;
                color: #6b7280;
                font-size: 0.74rem;
                font-weight: 800;
                letter-spacing: 0.08em;
                text-transform: uppercase;
            }

            .cart-line {
                align-items: flex-start;
            }

            .cart-helper-grid {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
                margin-top: 0;
            }
        }

        @media (max-width: 575px) {
            .cart-page-header {
                border-radius: 0 0 28px 28px;
            }

            .cart-stage {
                margin-top: -54px;
            }

            .cart-hero-content h1 {
                font-size: 2rem;
            }

			.cart-panel-head {
				align-items: stretch;
			}

			.cart-head-link {
				width: 100%;
			}

            .cart-line {
                flex-direction: column;
            }

            .product-thumb-sm {
                width: 100%;
                max-width: 150px;
                height: auto;
                aspect-ratio: 1;
            }

            .qty-input {
                max-width: 100%;
            }

            .cart-table tbody td:last-child {
                padding-top: 0.95rem;
            }

            .btn.delete {
                width: 100%;
                min-height: 50px;
                gap: 10px;
                border-radius: 18px !important;
            }

            .btn.delete::after {
                content: 'Hapus Item';
                color: #b42318;
                font-size: 0.9rem;
                font-weight: 800;
            }
        }
    </style>
    @php
        $cartLineCount = count($items);
    @endphp

    <div class="container-fluid page-header cart-page-header py-5">
        <div class="container">
            <div class="cart-hero-content text-center">
                <span class="cart-hero-kicker"><i class="fas fa-shopping-bag"></i> Keranjang Belanja</span>
                <h1 class="text-white display-5 fw-bold mb-3">Semua Item Anda Siap Checkout</h1>
                <p class="text-white-50 lead mb-3">Tampilan keranjang dibuat lebih fokus agar edit jumlah, cek total, dan lanjut ke pembayaran terasa lebih cepat di desktop maupun mobile.</p>
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('shop') }}">Shop</a></li>
                    <li class="breadcrumb-item active text-white">Cart</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="container-fluid cart-stage py-5">
        <div class="container pb-5">
            @if(session()->has('message'))
                <div class="cart-surface cart-alert-shell mb-4">
                    <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('message') }}</strong>
                    </div>
                </div>
            @endif

            <div class="row g-4 align-items-start">
                <div class="col-lg-8 col-xl-8">
                    <div class="cart-surface cart-list-panel">
                        <div class="cart-panel-head">
                            <div>
                                <span class="cart-panel-kicker"><i class="fas fa-layer-group"></i> Ringkasan Item</span>
                                <h2>Keranjang Anda</h2>
                                <p>{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }} item siap ditinjau sebelum lanjut ke checkout. Semua elemen dibuat lebih ringkas tanpa mengubah alur update jumlah dan hapus produk.</p>
                            </div>
                            <a href="{{ url('shop') }}" class="cart-head-link"><i class="fas fa-plus"></i> Tambah Produk</a>
                        </div>

                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                <tr>
                                    <th scope="col">Produk</th>
                                    <th scope="col">Info</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @forelse ($items as $item)
                                        @php
                                            $attributeText = null;
                                            if (isset($item->options['type']) && $item->options['type'] === 'configurable') {
                                                $product = \App\Models\Product::find($item->options['product_id']);
                                                $image = !empty($item->options['image']) ? asset('storage/' . $item->options['image']) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                $variant = \App\Models\ProductVariant::find($item->options['variant_id']);
                                                $maxQty = $variant->stock ?? 1;
                                                $displayName = $item->name;
                                                $typeLabel = 'Varian aktif';
                                                if (isset($item->options['attributes']) && !empty($item->options['attributes'])) {
                                                    $attributes = [];
                                                    foreach ($item->options['attributes'] as $attr => $value) {
                                                        $attributes[] = $attr . ': ' . $value;
                                                    }
                                                    $attributeText = implode(', ', $attributes);
                                                    $displayName .= ' (' . $attributeText . ')';
                                                }
                                            } else {
                                                $product = \App\Models\Product::find($item->options['product_id']);
                                                $image = !empty($product && $product->productImages->first()) ? asset('storage/'.$product->productImages->first()->path) : asset('themes/ezone/assets/img/cart/3.jpg');
                                                $maxQty = $product && $product->productInventory ? $product->productInventory->qty : 1;
                                                $displayName = $product ? $product->name : $item->name;
                                                $typeLabel = 'Produk siap beli';
                                            }
                                            $stockLabel = $maxQty > 10 ? 'Stok aman' : ($maxQty > 0 ? 'Stok terbatas' : 'Stok habis');
                                        @endphp
                                        <tr>
                                            <th scope="row">
                                                <div class="cart-line">
                                                    <img src="{{ $image }}" class="product-thumb-sm" alt="{{ $displayName }}">
                                                    <div>
                                                        <div class="product-line-name">{{ Str::limit($displayName, 88) }}</div>
                                                        <div class="product-line-meta">SKU: {{ $item->options['sku'] ?? ($product->sku ?? 'N/A') }}</div>
                                                        @if($attributeText)
                                                            <div class="product-line-meta">{{ $attributeText }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </th>
                                            <td data-label="Info">
                                                <div class="line-pill-row">
                                                    <span class="line-pill line-pill--accent"><i class="fas fa-tag"></i>{{ $typeLabel }}</span>
                                                    <span class="line-pill"><i class="fas fa-box"></i>{{ $stockLabel }}</span>
                                                </div>
                                            </td>
                                            <td data-label="Harga">
                                                <div class="price-amount">Rp. {{ number_format($item->price,0,',','.') }}</div>
                                            </td>
                                            <td data-label="Jumlah">
                                                <div class="qty-input">
                                                    <input type="number" class="form-control" id="change-qty" value="{{ $item->qty }}" data-productId="{{ $item->rowId }}" min="1" max="{{ $maxQty }}">
                                                </div>
                                            </td>
                                            <td data-label="Total">
                                                <div class="price-amount">Rp. {{ number_format($item->price * $item->qty, 0, ',', '.') }}</div>
                                            </td>
                                            <td data-label="Aksi">
                                                <a href="{{ url('carts/remove/'. $item->rowId)}}" class="btn delete btn-md rounded-circle bg-light border" aria-label="Hapus {{ $displayName }} dari keranjang">
                                                    <i class="fa fa-times text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6">
                                                <div class="empty-cart">
                                                    <span class="empty-cart-icon"><i class="fas fa-basket-shopping"></i></span>
                                                    <h4>Keranjang masih kosong</h4>
                                                    <p>Belum ada produk yang masuk ke keranjang. Mulai dari katalog yang sudah dipoles agar proses pilih produk dan checkout terasa lebih menyenangkan.</p>
                                                    <a href="{{ url('shop') }}" class="btn btn-outline-soft">Lihat Produk</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="cart-helper-grid">
                            <div class="cart-helper-card">
                                <i class="fas fa-shield-heart"></i>
                                <div>
                                    <strong>Checkout lebih aman</strong>
                                    <span>Ringkasan pesanan dan total dibuat lebih jelas sebelum masuk ke tahap pembayaran.</span>
                                </div>
                            </div>
                            <div class="cart-helper-card">
                                <i class="fas fa-truck-fast"></i>
                                <div>
                                    <strong>Siap kirim lebih cepat</strong>
                                    <span>Jumlah item dapat diperbarui langsung dari halaman ini tanpa mengubah alur backend yang sudah stabil.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-4">
                    <div class="cart-summary">
                        <div class="cart-summary-head">
                            <span class="cart-panel-kicker"><i class="fas fa-receipt"></i> Order Summary</span>
                            <h2>Checkout Lebih Cepat</h2>
                            <p>Total, estimasi, dan jalur aksi utama ditempatkan lebih dekat agar keputusan belanja terasa lebih ringan.</p>
                        </div>

                        <div class="summary-note">
                            Pesanan Anda tetap memakai flow yang sama. Perubahan ini hanya merapikan presentasi visual supaya lebih nyaman dipakai di layar besar maupun mobile.
                        </div>

                        <div class="summary-row">
                            <small>Jumlah baris item</small>
                            <strong>{{ $cartLineCount }}</strong>
                        </div>
                        <div class="summary-row">
                            <small>Total item di keranjang</small>
                            <strong>{{ \Gloudemans\Shoppingcart\Facades\Cart::count() }}</strong>
                        </div>
                        <div class="summary-row">
                            <small>Subtotal</small>
                            <span>Rp. {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal(0, ",", ".") }}</span>
                        </div>
                        <div class="summary-row">
                            <small>Estimasi pengiriman</small>
                            <span>3-5 hari kerja</span>
                        </div>
                        <div class="summary-row summary-total-row">
                            <small>Total checkout</small>
                            <span class="summary-total">Rp. {{ \Gloudemans\Shoppingcart\Facades\Cart::subtotal(0, ",", ".") }}</span>
                        </div>

                        <div class="cart-summary-actions">
                            @if($cartLineCount > 0)
                                <a href="{{ url('orders/checkout') }}" class="btn btn-gradient" type="button"><i class="fas fa-lock"></i> Lanjut ke Checkout</a>
                            @else
                                <a href="{{ url('shop') }}" class="btn btn-gradient" type="button"><i class="fas fa-store"></i> Mulai Belanja</a>
                            @endif
                            <a href="{{ url('shop') }}" class="btn-outline-soft"><i class="fas fa-arrow-left"></i> Kembali ke Katalog</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script-alt')
<script>
	$(document).on("change", function (e) {
		var qty = e.target.value;
		var productId = e.target.attributes['data-productid'].value;

        $.ajax({
            type: "POST",
            url: "/carts/update",
            data: {
                _token: $('meta[name="csrf-token"]').attr("content"),
                productId,
                qty
            },
            success: function (response) {
				location.reload(true);
				Swal.fire({
                        title: "Jumlah Produk",
                        text: "Berhasil di ganti !",
                        icon: "success",
                        confirmButtonText: "Close",
                    });
            },
        });
    });
</script>
@endpush