@extends('frontend.layouts')

@push('styles')
<style>
	:root {
		--received-green-900: #092b1c;
		--received-green-800: #0f5132;
		--received-green-700: #198754;
		--received-green-500: #20c997;
		--received-ink: #1f2f46;
		--received-muted: #647870;
	}

	@media print {
		.no-print,
		.order-received-header,
		nav,
		footer {
			display: none !important;
		}

		body * {
			visibility: hidden;
		}

		.received-stage,
		.received-stage * {
			visibility: visible;
		}

		.received-stage {
			position: absolute;
			left: 0;
			top: 0;
			width: 100%;
			margin-top: 0 !important;
		}
	}

	.order-received-header {
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

	.order-received-header::after {
		content: '';
		position: absolute;
		right: -110px;
		top: -90px;
		width: 340px;
		height: 340px;
		background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
		pointer-events: none;
	}

	.received-hero-content {
		position: relative;
		z-index: 1;
		max-width: 820px;
		margin: 0 auto;
	}

	.received-hero-kicker,
	.received-section-kicker {
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

	.received-hero-kicker {
		margin-bottom: 1rem;
		background: rgba(255,255,255,0.14);
		border: 1px solid rgba(255,255,255,0.18);
		color: #fff;
		backdrop-filter: blur(10px);
		-webkit-backdrop-filter: blur(10px);
	}

	.order-received-header .breadcrumb {
		gap: 0.45rem;
	}

	.order-received-header .breadcrumb-item,
	.order-received-header .breadcrumb-item a {
		color: rgba(255,255,255,0.8) !important;
		text-decoration: none;
	}

	.order-received-header .breadcrumb-item.active {
		color: #fff !important;
	}

	.received-stage {
		position: relative;
		margin-top: -74px;
		padding-top: 0 !important;
	}

	.received-surface,
	.received-meta-card,
	.received-item-card,
	.received-summary-card {
		border-radius: 32px;
		background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
		border: 1px solid rgba(15,81,50,0.08);
		box-shadow: 0 28px 56px rgba(15,81,50,0.08);
	}

	.received-shell {
		padding: 22px;
	}

	.received-section-head {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		gap: 16px;
		margin-bottom: 1.3rem;
	}

	.received-section-kicker {
		margin-bottom: 0.85rem;
		background: rgba(15,81,50,0.06);
		color: var(--received-green-800);
	}

	.received-section-head h2,
	.received-summary-title {
		margin: 0 0 0.4rem;
		font-family: 'Raleway', sans-serif;
		font-size: clamp(1.65rem, 3vw, 2.2rem);
		font-weight: 800;
		line-height: 1.06;
		letter-spacing: -0.03em;
		color: var(--received-ink);
	}

	.received-section-head p,
	.received-summary-copy,
	.received-note {
		margin: 0;
		color: var(--received-muted);
		line-height: 1.7;
	}

	.received-stat-grid,
	.received-address-grid,
	.received-items-stack,
	.received-action-stack {
		display: grid;
		gap: 14px;
	}

	.received-stat-grid,
	.received-address-grid {
		grid-template-columns: repeat(3, minmax(0, 1fr));
		margin-bottom: 1.25rem;
	}

	.received-stat-card,
	.received-meta-card,
	.received-item-card {
		padding: 20px;
		box-shadow: 0 18px 30px rgba(15,81,50,0.05);
	}

	.received-stat-card small {
		display: block;
		margin-bottom: 0.5rem;
		color: var(--received-muted);
		font-size: 0.78rem;
		font-weight: 800;
		letter-spacing: 0.08em;
		text-transform: uppercase;
	}

	.received-stat-card strong {
		display: block;
		color: var(--received-green-800);
		font-size: 1.2rem;
		font-weight: 900;
	}

	.received-card-title {
		display: flex;
		align-items: center;
		gap: 10px;
		margin-bottom: 1rem;
		color: #183b2b;
		font-size: 1.02rem;
		font-weight: 800;
	}

	.received-card-title i {
		width: 38px;
		height: 38px;
		border-radius: 12px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background: rgba(15,81,50,0.08);
		color: var(--received-green-800);
	}

	.received-meta-card address,
	.received-meta-list {
		margin: 0;
		color: var(--received-muted);
		line-height: 1.75;
	}

	.received-meta-list strong {
		color: var(--received-ink);
	}

	.received-badge,
	.received-payment-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		border-radius: 999px;
		font-size: 0.76rem;
		font-weight: 800;
		letter-spacing: 0.03em;
	}

	.received-badge--success,
	.received-payment-badge--success {
		background: rgba(209,231,221,0.72);
		color: var(--received-green-800);
	}

	.received-badge--warning,
	.received-payment-badge--warning {
		background: rgba(255,244,214,0.92);
		color: #8a6c12;
	}

	.received-badge--danger,
	.received-payment-badge--danger {
		background: rgba(255,229,231,0.92);
		color: #b42318;
	}

	.received-item-grid {
		display: grid;
		grid-template-columns: minmax(0, 1fr) auto;
		gap: 14px;
		align-items: start;
	}

	.received-item-name {
		margin-bottom: 0.3rem;
		color: var(--received-ink);
		font-size: 1.02rem;
		font-weight: 800;
	}

	.received-item-sku,
	.received-item-attrs {
		color: var(--received-muted);
		font-size: 0.92rem;
		line-height: 1.7;
	}

	.received-item-attrs ul {
		list-style: none;
		padding: 0;
		margin: 0.35rem 0 0;
	}

	.received-item-price {
		min-width: 170px;
		text-align: right;
	}

	.received-item-price strong {
		display: block;
		color: var(--received-green-800);
		font-size: 1.02rem;
	}

	.received-item-price span {
		display: block;
		margin-top: 0.35rem;
		color: var(--received-muted);
		font-size: 0.88rem;
	}

	.attachment-card {
		display: flex;
		gap: 14px;
		align-items: center;
		padding: 16px;
		border-radius: 20px;
		background: rgba(255,255,255,0.94);
		border: 1px solid rgba(15,81,50,0.08);
		box-shadow: 0 12px 20px rgba(15,81,50,0.04);
	}

	.attachment-thumb {
		width: 92px;
		height: 72px;
		border-radius: 16px;
		overflow: hidden;
		display: flex;
		align-items: center;
		justify-content: center;
		background: radial-gradient(circle at top right, rgba(32,201,151,0.14), transparent 32%), linear-gradient(180deg, #f2f6f4 0%, #ffffff 100%);
		border: 1px solid rgba(15,81,50,0.08);
	}

	.attachment-thumb img {
		max-width: 100%;
		max-height: 100%;
		display: block;
	}

	.attachment-meta {
		flex: 1;
	}

	.attachment-meta .title {
		font-weight: 800;
		color: var(--received-ink);
		margin-bottom: 0.35rem;
	}

	.attachment-meta .hint {
		color: var(--received-muted);
		font-size: 0.9rem;
		line-height: 1.6;
	}

	.attachment-actions {
		display: flex;
		gap: 10px;
		flex-wrap: wrap;
	}

	.attachment-actions a,
	.received-action,
	.received-secondary {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		gap: 10px;
		min-height: 48px;
		padding: 0 16px;
		border-radius: 18px;
		text-decoration: none;
		font-weight: 800;
		transition: transform 0.22s ease, box-shadow 0.22s ease;
	}

	.attachment-actions a:hover,
	.received-action:hover,
	.received-secondary:hover {
		text-decoration: none;
		transform: translateY(-2px);
	}

	.attachment-actions a:hover {
		color: var(--received-green-800);
		box-shadow: 0 18px 28px rgba(15,81,50,0.1);
	}

	.received-action:hover {
		color: #fff;
		box-shadow: 0 22px 34px rgba(15,81,50,0.18);
	}

	.received-secondary:hover {
		color: var(--received-green-800);
		box-shadow: 0 18px 28px rgba(15,81,50,0.1);
	}

	.received-action {
		background: linear-gradient(90deg, var(--received-green-800), var(--received-green-500));
		color: #fff;
		border: 0;
		box-shadow: 0 16px 28px rgba(15,81,50,0.14);
	}

	.received-secondary {
		background: rgba(255,255,255,0.96);
		color: var(--received-green-800);
		border: 1px solid rgba(15,81,50,0.12);
		box-shadow: 0 12px 22px rgba(15,81,50,0.06);
	}

	.received-summary-card {
		padding: 22px;
		position: sticky;
		top: var(--sticky-safe-top, 124px);
	}

	.received-summary-note {
		padding: 16px 18px;
		border-radius: 20px;
		background: linear-gradient(135deg, rgba(209,231,221,0.5), rgba(236,253,245,0.92));
		color: var(--received-green-800);
		border: 1px solid rgba(15,81,50,0.08);
		box-shadow: inset 0 1px 0 rgba(255,255,255,0.56);
		line-height: 1.7;
		margin-bottom: 1rem;
	}

	.received-summary-list {
		display: grid;
		gap: 12px;
		margin-bottom: 1rem;
	}

	.received-summary-row {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		gap: 12px;
		padding-bottom: 12px;
		border-bottom: 1px solid rgba(15,81,50,0.08);
		color: var(--received-muted);
	}

	.received-summary-row strong,
	.received-summary-row span {
		color: var(--received-ink);
		font-weight: 800;
		text-align: right;
	}

	.received-summary-total {
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 12px;
		padding: 16px 0 0;
	}

	.received-summary-total strong {
		color: var(--received-ink);
	}

	.received-summary-total span {
		color: var(--received-green-800);
		font-size: 1.35rem;
		font-weight: 900;
	}

	.received-action-stack {
		grid-template-columns: 1fr;
		margin-top: 1rem;
	}

	.received-alert {
		border-radius: 20px;
		border: none;
		margin-bottom: 1rem;
	}

	@media (max-width: 1199px) {
		.received-summary-card {
			top: var(--sticky-safe-top, 112px);
		}
	}

	@media (max-width: 991px) {
		.order-received-header {
			padding: 5rem 0 5.75rem;
		}

		.received-stat-grid,
		.received-address-grid {
			grid-template-columns: 1fr;
		}

		.received-summary-card {
			position: static;
		}
	}

	@media (max-width: 767px) {
		.received-stage {
			margin-top: -54px;
		}

		.received-shell,
		.received-meta-card,
		.received-item-card,
		.received-summary-card {
			border-radius: 26px;
		}

		.received-item-grid {
			grid-template-columns: 1fr;
		}

		.received-item-price {
			min-width: 0;
			text-align: left;
		}

		.attachment-card {
			flex-direction: column;
			align-items: flex-start;
		}
	}

	@media (max-width: 575px) {
		.order-received-header {
			border-radius: 0 0 28px 28px;
		}
	}
</style>
@endpush

@section('content')
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
		$statusClass = 'received-badge--warning';
		if (in_array($status, ['completed', 'delivered'])) {
			$statusClass = 'received-badge--success';
		} elseif (in_array($status, ['cancelled', 'failed'])) {
			$statusClass = 'received-badge--danger';
		}

		$paymentStatus = strtolower((string) $order->payment_status);
		$paymentClass = 'received-payment-badge--warning';
		if ($paymentStatus === 'paid') {
			$paymentClass = 'received-payment-badge--success';
		} elseif (in_array($paymentStatus, ['unpaid', 'failed', 'expired'])) {
			$paymentClass = 'received-payment-badge--danger';
		}
	@endphp

	<div class="container-fluid order-received-header py-5">
		<div class="container">
			<div class="received-hero-content text-center">
				<span class="received-hero-kicker"><i class="fas fa-check-circle"></i> Order Received</span>
				<h1 class="text-white display-5 fw-bold mb-3">Pesanan #{{ $order->code }} Berhasil Dicatat</h1>
				<p class="text-white-50 lead mb-3">Halaman konfirmasi ini dirapikan agar status pembayaran, detail order, dan langkah berikutnya terasa jelas sejak pertama kali dibuka.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ route('orders.index') }}">Orders</a></li>
					<li class="breadcrumb-item active text-white">Received</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid received-stage py-5">
		<div class="container pb-5">
			<div class="received-surface received-shell">
				@if(session()->has('message'))
					<div class="alert received-alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
						<strong>{{ session()->get('message') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif

				<div class="received-section-head">
					<div>
						<span class="received-section-kicker"><i class="fas fa-bag-shopping"></i> Confirmation</span>
						<h2>Order Anda Sudah Masuk Sistem</h2>
						<p>Cek alamat, item, nominal, dan metode pembayaran. Jika pembayaran belum selesai, aksi lanjutan tetap tersedia di panel kanan tanpa mengubah flow yang lama.</p>
					</div>
				</div>

				<div class="received-stat-grid">
					<div class="received-stat-card">
						<small>Status Pesanan</small>
						<span class="received-badge {{ $statusClass }}">{{ $order->status }}</span>
					</div>
					<div class="received-stat-card">
						<small>Status Pembayaran</small>
						<span class="received-payment-badge {{ $paymentClass }}">{{ $order->payment_status == 'paid' ? 'Paid' : ucfirst($order->payment_status) }}</span>
					</div>
					<div class="received-stat-card">
						<small>Order Date</small>
						<strong>{{ date('d M Y', strtotime($order->order_date)) }}</strong>
					</div>
				</div>

				<div class="received-address-grid">
					<div class="received-meta-card">
						<div class="received-card-title"><i class="fas fa-location-dot"></i><span>Billing Address</span></div>
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
						<div class="received-meta-card">
							<div class="received-card-title"><i class="fas fa-truck"></i><span>Shipment Address</span></div>
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

					<div class="received-meta-card">
						<div class="received-card-title"><i class="fas fa-circle-info"></i><span>Detail Order</span></div>
						<div class="received-meta-list">
							<div><strong>ID:</strong> #{{ $order->code }}</div>
							<div><strong>Courier:</strong> {{ $order->shipping_courier }} - {{ $order->shipping_service_name }}</div>
							<div><strong>Tracking Number:</strong> {{ $trackingNumber ?: '-' }}</div>
							@if ($order->isShippingCostAdjusted())
								<div><strong>Shipping Cost:</strong> Rp{{ number_format($order->shipping_cost, 0, ",", ".") }}</div>
								<div class="received-note">Original Cost: Rp{{ number_format($order->original_shipping_cost, 0, ",", ".") }}</div>
							@else
								<div><strong>Shipping Cost:</strong> Rp{{ number_format($order->shipping_cost, 0, ",", ".") }}</div>
							@endif
							@if($order->handled_by)
								<div><strong>Handled by:</strong> {{ $order->handled_by }}</div>
							@endif
						</div>
					</div>
				</div>

				<div class="row g-4 align-items-start">
					<div class="col-lg-7 col-xl-8">
						<div class="received-section-head mb-3">
							<div>
								<span class="received-section-kicker"><i class="fas fa-box-open"></i> Ordered Items</span>
								<h2 class="mb-0">Ringkasan Produk</h2>
							</div>
						</div>

						<div class="received-items-stack">
							@forelse ($order->orderItems as $item)
								<div class="received-item-card">
									<div class="received-item-grid">
										<div>
											<div class="received-item-name">{{ $item->name }}</div>
											<div class="received-item-sku">SKU: {{ $item->sku }}</div>
											<div class="received-item-attrs">{!! $renderAttributes($item->attributes) !!}</div>
										</div>
										<div class="received-item-price">
											<strong>Rp{{ number_format($item->sub_total, 0, ',', '.') }}</strong>
											<span>{{ $item->qty }} x Rp{{ number_format($item->base_price, 0, ',', '.') }}</span>
										</div>
									</div>
								</div>
							@empty
								<div class="received-item-card">
									<div class="received-note">Order item not found!</div>
								</div>
							@endforelse

							@if(!empty($order->payment_attachment))
								<div class="received-meta-card">
									<div class="received-card-title"><i class="fas fa-paperclip"></i><span>Bukti Pembayaran</span></div>
									<div class="attachment-card">
										<div class="attachment-thumb">
											@if(preg_match('/\.(jpg|jpeg|png|gif)$/i', $order->payment_attachment))
												<img src="{{ asset('storage/' . $order->payment_attachment) }}" alt="Bukti Pembayaran">
											@else
												<img src="{{ asset('images/file-icon.png') }}" alt="file">
											@endif
										</div>
										<div class="attachment-meta">
											<div class="title">Lampiran pembayaran</div>
											<div class="hint">Diterima pada {{ date('d M Y H:i', strtotime($order->updated_at ?? $order->order_date)) }}</div>
										</div>
										<div class="attachment-actions">
											<a class="received-action" href="{{ asset('storage/' . $order->payment_attachment) }}" target="_blank" rel="noopener">Lihat</a>
											<a class="received-secondary" href="{{ asset('storage/' . $order->payment_attachment) }}" download>Unduh</a>
										</div>
									</div>
								</div>
							@endif
						</div>
					</div>

					<div class="col-lg-5 col-xl-4">
						<div class="received-summary-card">
							<div class="received-summary-title">Order Summary</div>
							<p class="received-summary-copy">Semua total dan tindakan berikut memakai data order yang sama seperti sebelumnya, hanya dipresentasikan lebih rapi.</p>

							<div class="received-summary-note">
								@if(!$order->isPaid())
									Pesanan sudah tercatat, tetapi pembayaran belum selesai. Lanjutkan dari tombol aksi di bawah sesuai metode pembayaran yang dipilih.
								@else
									Pembayaran sudah diterima. Anda dapat mengunduh invoice atau mencetak halaman ini untuk arsip.
								@endif
							</div>

							<div class="received-summary-list">
								<div class="received-summary-row">
									<small>Subtotal</small>
									<span>Rp{{ number_format($order->base_total_price, 0, ',', '.') }}</span>
								</div>
								<div class="received-summary-row">
									<small>Tax (10%)</small>
									<span>Rp{{ number_format($order->tax_amount, 0, ',', '.') }}</span>
								</div>
								<div class="received-summary-row">
									<small>Shipping</small>
									<span>Rp{{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
								</div>
								<div class="received-summary-row">
									<small>Unique Code</small>
									<span>Rp{{ number_format(0, 0, ',', '.') }}</span>
								</div>
							</div>

							<div class="received-summary-total">
								<strong>Grand Total</strong>
								<span>Rp{{ number_format($order->grand_total, 0, ',', '.') }}</span>
							</div>

							<div class="received-action-stack no-print">
								@if (!$order->isPaid() && $order->payment_method == 'automatic')
									<button class="received-action d-none" id="pay-button">Proceed to Payment</button>
								@elseif(!$order->isPaid() && $order->payment_method == 'manual')
									<a class="received-action" href="{{ route('orders.confirmation_payment', $order->id) }}">Proceed to Payment</a>
								@elseif(!$order->isPaid() && in_array($order->payment_method, ['cod', 'toko']))
									<div class="received-note">Silahkan lakukan pembayaran ke toko.</div>
									<a href="{{ route('orders.index') }}" class="received-secondary">Kembali</a>
								@endif

								@if($order->isPaid())
									<a href="{{ route('orders.invoice', $order->id) }}" class="received-action"><i class="fa fa-download"></i> Download Invoice</a>
									<button onclick="window.print()" class="received-secondary"><i class="fa fa-print"></i> Print Page</button>
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script-alt')
	@if($order->payment_method == 'automatic' && $order->payment_status == 'unpaid' && !empty($order->payment_token))
		<!-- Load Midtrans JS library -->
		<script type="text/javascript" src="{{ $paymentData['snapUrl'] }}"
				data-client-key="{{ $paymentData['midtransClientKey'] }}"></script>

		<script type="text/javascript">
			document.addEventListener('DOMContentLoaded', function() {
				// Show payment button
				const payButton = document.getElementById('pay-button');
				if (payButton) {
					payButton.classList.remove('d-none');

					// Handle button click to open Snap payment page
					payButton.addEventListener('click', function() {
						snap.pay('{{ $order->payment_token }}', {
							onSuccess: function(result) {
								console.log('Payment success:', result);
								window.location.href = '{{ route('payment.finish') }}?order_id={{ $order->code }}';
							},
							onPending: function(result) {
								console.log('Payment pending:', result);
								window.location.href = '{{ route('payment.unfinish') }}?order_id={{ $order->code }}';
							},
							onError: function(result) {
								console.log('Payment error:', result);
								window.location.href = '{{ route('payment.error') }}?order_id={{ $order->code }}';
							},
							onClose: function() {
								console.log('Customer closed the payment window');
							}
						});
					});
				}
				
				// Auto-refresh payment status if unpaid
				@if(!$order->isPaid())
				function checkPaymentStatus() {
					fetch('{{ route('orders.status', $order->id) }}')
						.then(response => response.json())
						.then(data => {
							if (data.payment_status === 'paid') {
								location.reload();
							}
						})
						.catch(error => console.log('Status check error:', error));
				}
				
				// Check payment status every 10 seconds
				setInterval(checkPaymentStatus, 10000);
				@endif
			});
		</script>
	@endif
@endpush
