@extends('frontend.layouts')

@section('content')
	<style>
		:root {
			--order-green-900: #092b1c;
			--order-green-800: #0f5132;
			--order-green-700: #198754;
			--order-green-500: #20c997;
			--order-ink: #1f2f46;
			--order-muted: #647870;
		}

		.order-page-header {
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

		.order-page-header::after {
			content: '';
			position: absolute;
			right: -110px;
			top: -90px;
			width: 340px;
			height: 340px;
			background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
			pointer-events: none;
		}

		.order-hero-content {
			position: relative;
			z-index: 1;
			max-width: 820px;
			margin: 0 auto;
		}

		.order-hero-kicker,
		.order-section-kicker {
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

		.order-hero-kicker {
			margin-bottom: 1rem;
			background: rgba(255,255,255,0.14);
			border: 1px solid rgba(255,255,255,0.18);
			color: #fff;
			backdrop-filter: blur(10px);
			-webkit-backdrop-filter: blur(10px);
		}

		.order-page-header .breadcrumb {
			gap: 0.45rem;
		}

		.order-page-header .breadcrumb-item,
		.order-page-header .breadcrumb-item a {
			color: rgba(255,255,255,0.8) !important;
			text-decoration: none;
		}

		.order-page-header .breadcrumb-item.active {
			color: #fff !important;
		}

		.order-stage {
			position: relative;
			margin-top: -74px;
			padding-top: 0 !important;
		}

		.order-sidebar-shell,
		.order-surface,
		.order-summary-card,
		.order-item-card,
		.order-info-card {
			border-radius: 32px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 28px 56px rgba(15,81,50,0.08);
		}

		.order-sidebar-shell {
			padding: 6px;
		}

		.order-sidebar-shell .user-sidebar {
			margin: 0 !important;
			max-width: 100%;
			padding: 0 !important;
		}

		.order-sidebar-shell .user-sidebar .card {
			border-radius: 26px;
			box-shadow: none !important;
			border: none !important;
			background: transparent;
		}

		.order-sidebar-shell .user-sidebar .card-body {
			padding: 1rem 1rem 1.1rem !important;
		}

		.order-shell {
			padding: 22px;
		}

		.order-section-head {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 16px;
			margin-bottom: 1.4rem;
		}

		.order-section-kicker {
			margin-bottom: 0.85rem;
			background: rgba(15,81,50,0.06);
			color: var(--order-green-800);
		}

		.order-section-head h2,
		.order-summary-title {
			margin: 0 0 0.4rem;
			font-family: 'Raleway', sans-serif;
			font-size: clamp(1.6rem, 3vw, 2.2rem);
			font-weight: 800;
			line-height: 1.06;
			letter-spacing: -0.03em;
			color: var(--order-ink);
		}

		.order-section-head p,
		.order-summary-copy {
			margin: 0;
			color: var(--order-muted);
			line-height: 1.7;
		}

		.order-chip-row,
		.order-meta-grid,
		.order-address-grid,
		.order-action-stack {
			display: grid;
			gap: 14px;
		}

		.order-chip-row {
			grid-template-columns: repeat(3, minmax(0, 1fr));
			margin-bottom: 1.25rem;
		}

		.order-chip-card {
			padding: 18px;
			border-radius: 24px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 16px 28px rgba(15,81,50,0.05);
		}

		.order-chip-card small {
			display: block;
			margin-bottom: 0.5rem;
			color: var(--order-muted);
			font-size: 0.78rem;
			font-weight: 800;
			letter-spacing: 0.08em;
			text-transform: uppercase;
		}

		.order-chip-card strong {
			display: block;
			color: var(--order-green-800);
			font-size: 1.2rem;
			font-weight: 900;
		}

		.order-meta-grid,
		.order-address-grid {
			grid-template-columns: repeat(3, minmax(0, 1fr));
			margin-bottom: 1.25rem;
		}

		.order-info-card {
			padding: 20px;
			box-shadow: 0 18px 30px rgba(15,81,50,0.05);
		}

		.order-card-title {
			display: flex;
			align-items: center;
			gap: 10px;
			margin-bottom: 1rem;
			font-size: 1.02rem;
			font-weight: 800;
			color: #183b2b;
		}

		.order-card-title i {
			width: 38px;
			height: 38px;
			border-radius: 12px;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			background: rgba(15,81,50,0.08);
			color: var(--order-green-800);
		}

		.order-address-card address,
		.order-meta-list {
			margin: 0;
			color: var(--order-muted);
			line-height: 1.75;
		}

		.order-meta-list strong {
			color: var(--order-ink);
		}

		.status-pill,
		.payment-pill,
		.meta-pill {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			padding: 8px 12px;
			border-radius: 999px;
			font-size: 0.76rem;
			font-weight: 800;
			letter-spacing: 0.03em;
		}

		.status-pill--success,
		.payment-pill--success,
		.meta-pill--success {
			background: rgba(209,231,221,0.72);
			color: var(--order-green-800);
		}

		.status-pill--warning,
		.payment-pill--warning {
			background: rgba(255,244,214,0.92);
			color: #8a6c12;
		}

		.status-pill--danger,
		.payment-pill--danger {
			background: rgba(255,229,231,0.92);
			color: #b42318;
		}

		.status-pill--neutral,
		.payment-pill--neutral,
		.meta-pill--neutral {
			background: rgba(243,244,246,0.96);
			color: #4b5563;
		}

		.order-items-stack {
			display: grid;
			gap: 14px;
		}

		.order-item-card {
			padding: 18px;
			box-shadow: 0 18px 30px rgba(15,81,50,0.05);
		}

		.order-item-grid {
			display: grid;
			grid-template-columns: minmax(0, 1fr) auto;
			gap: 14px;
			align-items: start;
		}

		.order-item-name {
			margin-bottom: 0.3rem;
			color: var(--order-ink);
			font-size: 1.02rem;
			font-weight: 800;
		}

		.order-item-sku,
		.order-item-attrs,
		.order-note {
			color: var(--order-muted);
			font-size: 0.92rem;
			line-height: 1.7;
		}

		.order-item-attrs ul {
			list-style: none;
			padding: 0;
			margin: 0.35rem 0 0;
		}

		.order-item-attrs li + li {
			margin-top: 0.2rem;
		}

		.order-item-price {
			min-width: 170px;
			text-align: right;
		}

		.order-item-price strong {
			display: block;
			color: var(--order-green-800);
			font-size: 1.02rem;
		}

		.order-item-price span {
			display: block;
			margin-top: 0.35rem;
			color: var(--order-muted);
			font-size: 0.88rem;
		}

		.order-summary-card {
			padding: 22px;
			position: sticky;
			top: var(--sticky-safe-top, 124px);
		}

		.summary-note {
			padding: 16px 18px;
			border-radius: 20px;
			background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.92));
			color: var(--order-green-800);
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: inset 0 1px 0 rgba(255,255,255,0.56);
			line-height: 1.7;
			margin-bottom: 1rem;
		}

		.order-summary-list {
			display: grid;
			gap: 12px;
			margin-bottom: 1rem;
		}

		.order-summary-row {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 12px;
			padding-bottom: 12px;
			border-bottom: 1px solid rgba(15,81,50,0.08);
			color: var(--order-muted);
		}

		.order-summary-row strong,
		.order-summary-row span {
			color: var(--order-ink);
			font-weight: 800;
			text-align: right;
		}

		.order-summary-total {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 12px;
			padding: 16px 0 0;
		}

		.order-summary-total strong {
			color: var(--order-ink);
		}

		.order-summary-total span {
			color: var(--order-green-800);
			font-size: 1.35rem;
			font-weight: 900;
		}

		.action-button,
		.action-secondary {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 10px;
			min-height: 52px;
			border-radius: 18px;
			font-weight: 800;
			text-decoration: none;
			transition: transform 0.22s ease, box-shadow 0.22s ease;
		}

		.action-button:hover,
		.action-secondary:hover {
			text-decoration: none;
			transform: translateY(-2px);
		}

		.action-button:hover {
			color: #fff;
			box-shadow: 0 22px 34px rgba(15,81,50,0.18);
		}

		.action-secondary:hover {
			color: var(--order-green-800);
			box-shadow: 0 18px 28px rgba(15,81,50,0.1);
		}

		.action-button {
			background: linear-gradient(90deg, var(--order-green-800), var(--order-green-500));
			color: #fff;
			border: 0;
			box-shadow: 0 16px 28px rgba(15,81,50,0.14);
		}

		.action-secondary {
			background: rgba(255,255,255,0.96);
			color: var(--order-green-800);
			border: 1px solid rgba(15,81,50,0.12);
			box-shadow: 0 12px 22px rgba(15,81,50,0.06);
		}

		.order-action-stack {
			grid-template-columns: 1fr;
			margin-top: 1rem;
		}

		@media (max-width: 1199px) {
			.order-summary-card {
				top: var(--sticky-safe-top, 112px);
			}
		}

		@media (max-width: 991px) {
			.order-page-header {
				padding: 5rem 0 5.75rem;
			}

			.order-chip-row,
			.order-meta-grid,
			.order-address-grid {
				grid-template-columns: 1fr;
			}

			.order-summary-card {
				position: static;
			}
		}

		@media (max-width: 767px) {
			.order-stage {
				margin-top: -54px;
			}

			.order-shell,
			.order-sidebar-shell,
			.order-summary-card,
			.order-item-card,
			.order-info-card {
				border-radius: 26px;
			}

			.order-item-grid {
				grid-template-columns: 1fr;
			}

			.order-item-price {
				text-align: left;
				min-width: 0;
			}
		}

		@media (max-width: 575px) {
			.order-page-header {
				border-radius: 0 0 28px 28px;
			}

			.order-summary-row,
			.order-summary-total {
				flex-direction: column;
				align-items: flex-start;
			}

			.order-summary-row strong,
			.order-summary-row span {
				text-align: left;
			}
		}
	</style>

	@php
		$renderAttributes = function ($jsonAttributes) {
			$jsonAttr = (string) $jsonAttributes;
			$attributes = json_decode($jsonAttr, true);
			$html = '';

			if ($attributes) {
				$html .= '<ul>';
				foreach ($attributes as $attribute) {
					if (is_array($attribute) && count($attribute) != 0) {
						foreach ($attribute as $label => $value) {
							$html .= '<li>' . e($label) . ': <span>' . e($value) . '</span></li>';
						}
					} else {
						$html .= '<li><span>-</span></li>';
					}
				}
				$html .= '</ul>';
			}

			return $html;
		};

		$trackingNumber = \App\Models\Shipment::where('order_id', $order->id)->pluck('track_number')->first();
		$status = strtolower((string) $order->status);
		$statusClass = 'status-pill--neutral';
		if (in_array($status, ['completed', 'delivered'])) {
			$statusClass = 'status-pill--success';
		} elseif (in_array($status, ['pending', 'waiting', 'created', 'processing'])) {
			$statusClass = 'status-pill--warning';
		} elseif (in_array($status, ['cancelled', 'failed'])) {
			$statusClass = 'status-pill--danger';
		}

		$paymentStatus = strtolower((string) $order->payment_status);
		$paymentClass = 'payment-pill--neutral';
		if ($paymentStatus === 'paid') {
			$paymentClass = 'payment-pill--success';
		} elseif (in_array($paymentStatus, ['waiting', 'pending'])) {
			$paymentClass = 'payment-pill--warning';
		} elseif (in_array($paymentStatus, ['unpaid', 'failed', 'expired'])) {
			$paymentClass = 'payment-pill--danger';
		}

		$itemCount = $order->orderItems->count();
	@endphp

	<div class="container-fluid page-header order-page-header py-5">
		<div class="container">
			<div class="order-hero-content text-center">
				<span class="order-hero-kicker"><i class="fas fa-box-open"></i> Detail Pesanan</span>
				<h1 class="text-white display-5 fw-bold mb-3">Order #{{ $order->code }}</h1>
				<p class="text-white-50 lead mb-3">Semua informasi order, item, status, dan aksi lanjutan ditata ulang agar lebih jelas dibaca tanpa mengubah proses backend yang sudah ada.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ url('orders') }}">Orders</a></li>
					<li class="breadcrumb-item active text-white">{{ $order->code }}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid order-stage py-5">
		<div class="container pb-5">
			<div class="row g-4 align-items-start">
				<div class="col-lg-3">
					<div class="order-sidebar-shell">
						@include('frontend.partials.user_menu')
					</div>
				</div>

				<div class="col-lg-9">
					<div class="order-surface order-shell">
						<div class="order-section-head">
							<div>
								<span class="order-section-kicker"><i class="fas fa-receipt"></i> Order Overview</span>
								<h2>Pesanan Anda Siap Dipantau</h2>
								<p>Gunakan halaman ini untuk memeriksa alamat, status pembayaran, detail item, biaya kirim, dan aksi lanjutan seperti invoice atau penyelesaian order.</p>
							</div>
						</div>

						<div class="order-chip-row">
							<div class="order-chip-card">
								<small>Status Pesanan</small>
								<span class="status-pill {{ $statusClass }}">{{ $order->status }}</span>
							</div>
							<div class="order-chip-card">
								<small>Status Pembayaran</small>
								<span class="payment-pill {{ $paymentClass }}">{{ $order->payment_status }}</span>
							</div>
							<div class="order-chip-card">
								<small>Total Item</small>
								<strong>{{ $itemCount }}</strong>
							</div>
						</div>

						<div class="order-address-grid">
							<div class="order-info-card order-address-card">
								<div class="order-card-title"><i class="fas fa-location-dot"></i><span>Billing Address</span></div>
								<address>
									{{ $order->customer_first_name }} {{ $order->customer_last_name }}
									<br>{{ $order->customer_address1 }}
									<br>{{ $order->customer_address2 }}
									<br>Email: {{ $order->customer_email }}
									<br>Phone: {{ $order->customer_phone }}
									<br>Postcode: {{ $order->customer_postcode }}
								</address>
							</div>

							@if ($order->shipment != null)
								<div class="order-info-card order-address-card">
									<div class="order-card-title"><i class="fas fa-truck"></i><span>Shipment Address</span></div>
									<address>
										{{ $order->shipment->first_name }} {{ $order->shipment->last_name }}
										<br>{{ $order->shipment->address1 }}
										<br>{{ $order->shipment->address2 }}
										<br>Email: {{ $order->shipment->email }}
										<br>Phone: {{ $order->shipment->phone }}
										<br>Postcode: {{ $order->shipment->postcode }}
									</address>
								</div>
							@endif

							<div class="order-info-card">
								<div class="order-card-title"><i class="fas fa-circle-info"></i><span>Order Meta</span></div>
								<div class="order-meta-list">
									<div><strong>ID:</strong> #{{ $order->code }}</div>
									<div><strong>Tanggal:</strong> {{ date('d M Y', strtotime($order->order_date)) }}</div>
									<div><strong>Courier:</strong> {{ $order->shipping_courier }} - {{ $order->shipping_service_name }}</div>
									<div><strong>Tracking:</strong> {{ $trackingNumber ?: '-' }}</div>
									@if($order->handled_by)
										<div><strong>Handled by:</strong> {{ $order->handled_by }}</div>
									@endif
									@if ($order->isCancelled())
										<div><strong>Cancelled at:</strong> {{ date('d M Y', strtotime($order->cancelled_at)) }}</div>
										@if ($order->cancellation_note)
											<div class="order-note"><strong>Cancellation Note:</strong> {{ $order->cancellation_note }}</div>
										@endif
									@endif
									@if ($order->isShippingCostAdjusted())
										<div><strong>Adjusted Shipping:</strong> Rp{{ number_format($order->shipping_cost, 0, ",", ".") }}</div>
										<div class="order-note">Original Cost: Rp{{ number_format($order->original_shipping_cost, 0, ",", ".") }}</div>
										@if ($order->shipping_adjustment_note)
											<div class="order-note">Note: {{ $order->shipping_adjustment_note }}</div>
										@endif
									@endif
								</div>
							</div>
						</div>

						<div class="row g-4 align-items-start">
							<div class="col-lg-7 col-xl-8">
								<div class="order-section-head mb-3">
									<div>
										<span class="order-section-kicker"><i class="fas fa-bag-shopping"></i> Ordered Items</span>
										<h2 class="mb-0">Produk Dalam Pesanan</h2>
									</div>
								</div>

								<div class="order-items-stack">
									@forelse ($order->orderItems as $item)
										<div class="order-item-card">
											<div class="order-item-grid">
												<div>
													<div class="order-item-name">{{ $item->name }}</div>
													<div class="order-item-sku">SKU: {{ $item->sku }}</div>
													<div class="order-item-attrs">{!! $renderAttributes($item->attributes) !!}</div>
												</div>
												<div class="order-item-price">
													<strong>Rp{{ number_format($item->sub_total, 0, ",", ".") }}</strong>
													<span>{{ $item->qty }} x Rp{{ number_format($item->base_price, 0, ",", ".") }}</span>
												</div>
											</div>
										</div>
									@empty
										<div class="order-item-card">
											<div class="order-note">Order item not found!</div>
										</div>
									@endforelse
								</div>
							</div>

							<div class="col-lg-5 col-xl-4">
								<div class="order-summary-card">
									<div class="order-summary-title">Order Summary</div>
									<p class="order-summary-copy">Ringkasan nominal dan aksi utama tetap memakai data yang sama seperti sebelumnya, hanya dibuat lebih mudah dipindai.</p>

									<div class="summary-note">
										@if ($order->isShippingCostAdjusted())
											Biaya kirim order ini sudah disesuaikan. Nominal asli tetap ditampilkan agar riwayat transaksi tetap mudah dipahami.
										@else
											Semua total di bawah ini mengikuti data order yang tersimpan pada sistem tanpa perubahan logic perhitungan.
										@endif
									</div>

									<div class="order-summary-list">
										<div class="order-summary-row">
											<small>Subtotal</small>
											<span>Rp{{ number_format($order->base_total_price, 0, ",", ".") }}</span>
										</div>
										<div class="order-summary-row">
											<small>Tax (10%)</small>
											<span>Rp{{ number_format($order->tax_amount, 0, ",", ".") }}</span>
										</div>
										<div class="order-summary-row">
											<small>
												@if ($order->isShippingCostAdjusted())
													Shipping Cost (Adjusted)
												@else
													Shipping Cost
												@endif
											</small>
											<span>Rp{{ number_format($order->shipping_cost, 0, ",", ".") }}</span>
										</div>
										@if ($order->isShippingCostAdjusted())
											<div class="order-summary-row">
												<small>Original Shipping</small>
												<span>Rp{{ number_format($order->original_shipping_cost, 0, ",", ".") }}</span>
											</div>
										@endif
									</div>

									<div class="order-summary-total">
										<strong>Grand Total</strong>
										<span>Rp{{ number_format($order->grand_total, 0, ",", ".") }}</span>
									</div>

									<div class="order-action-stack">
										<a href="{{ url('orders') }}" class="action-secondary">Back to Orders</a>
										@if ($order->isDelivered())
											<a href="#" class="action-button" onclick="event.preventDefault(); document.getElementById('complete-form-{{ $order->id }}').submit();">Mark as Completed</a>
											<form class="d-none" method="POST" action="{{ route('orders.complete', $order) }}" id="complete-form-{{ $order->id }}">
												@csrf
											</form>
										@endif
										@if ($order->isPaid())
											<a href="{{ route('admin.orders.invoices', $order) }}" class="action-button">Download Invoice</a>
										@endif
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
