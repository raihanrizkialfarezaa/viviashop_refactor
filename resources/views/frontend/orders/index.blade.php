@extends('frontend.layouts')

@section('content')
	<style>
		:root {
			--orders-green-900: #092b1c;
			--orders-green-800: #0f5132;
			--orders-green-700: #198754;
			--orders-green-500: #20c997;
			--orders-ink: #1f2f46;
			--orders-muted: #647870;
		}

		.orders-page-header {
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

		.orders-page-header::after {
			content: '';
			position: absolute;
			right: -110px;
			top: -90px;
			width: 340px;
			height: 340px;
			background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
			pointer-events: none;
		}

		.orders-hero-content {
			position: relative;
			z-index: 1;
			max-width: 840px;
			margin: 0 auto;
		}

		.orders-hero-kicker,
		.orders-section-kicker {
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

		.orders-hero-kicker {
			margin-bottom: 1rem;
			background: rgba(255,255,255,0.14);
			border: 1px solid rgba(255,255,255,0.18);
			color: #fff;
			backdrop-filter: blur(10px);
			-webkit-backdrop-filter: blur(10px);
		}

		.orders-page-header .breadcrumb {
			gap: 0.45rem;
		}

		.orders-page-header .breadcrumb-item,
		.orders-page-header .breadcrumb-item a {
			color: rgba(255,255,255,0.8) !important;
			text-decoration: none;
		}

		.orders-page-header .breadcrumb-item.active {
			color: #fff !important;
		}

		.orders-stage {
			position: relative;
			margin-top: -74px;
			padding-top: 0 !important;
		}

		.orders-sidebar-shell,
		.orders-surface {
			border-radius: 32px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 28px 56px rgba(15,81,50,0.08);
		}

		.orders-sidebar-shell {
			padding: 6px;
		}

		.orders-sidebar-shell .user-sidebar {
			margin: 0 !important;
			max-width: 100%;
			padding: 0 !important;
		}

		.orders-sidebar-shell .user-sidebar .card {
			border-radius: 26px;
			box-shadow: none !important;
			border: none !important;
			background: transparent;
		}

		.orders-sidebar-shell .user-sidebar .card-body {
			padding: 1rem 1rem 1.1rem !important;
		}

		.orders-shell {
			padding: 22px;
		}

		.orders-section-head {
			display: flex;
			justify-content: space-between;
			align-items: flex-start;
			gap: 18px;
			margin-bottom: 1.4rem;
		}

		.orders-section-kicker {
			background: rgba(15,81,50,0.06);
			color: var(--orders-green-800);
			margin-bottom: 0.85rem;
		}

		.orders-section-head h2 {
			margin: 0 0 0.4rem;
			font-family: 'Raleway', sans-serif;
			font-size: clamp(1.65rem, 3vw, 2.2rem);
			font-weight: 800;
			line-height: 1.06;
			letter-spacing: -0.03em;
			color: var(--orders-ink);
		}

		.orders-section-head p {
			margin: 0;
			color: var(--orders-muted);
			line-height: 1.7;
		}

		.orders-stat-grid {
			display: grid;
			grid-template-columns: repeat(3, minmax(0, 1fr));
			gap: 14px;
			margin-bottom: 1.25rem;
		}

		.orders-stat-card {
			padding: 18px;
			border-radius: 24px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 16px 28px rgba(15,81,50,0.05);
		}

		.orders-stat-card small {
			display: block;
			margin-bottom: 0.5rem;
			color: var(--orders-muted);
			font-size: 0.78rem;
			font-weight: 800;
			letter-spacing: 0.08em;
			text-transform: uppercase;
		}

		.orders-stat-card strong {
			display: block;
			color: var(--orders-green-800);
			font-size: 1.45rem;
			font-weight: 900;
			line-height: 1;
		}

		.orders-stat-card span {
			display: block;
			margin-top: 0.5rem;
			color: var(--orders-muted);
			font-size: 0.92rem;
			line-height: 1.6;
		}

		.orders-toolbar {
			padding: 20px;
			border-radius: 26px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 16px 28px rgba(15,81,50,0.05);
			margin-bottom: 1.25rem;
		}

		.orders-toolbar form {
			display: grid;
			grid-template-columns: minmax(0, 1.4fr) minmax(240px, 0.8fr) auto;
			gap: 12px;
			align-items: stretch;
		}

		.orders-toolbar .input-group,
		.orders-toolbar .toolbar-selects {
			width: 100%;
		}

		.orders-toolbar .input-group {
			min-height: 54px;
			border-radius: 18px;
			overflow: hidden;
			border: 1px solid rgba(15,81,50,0.12);
			box-shadow: inset 0 2px 6px rgba(2,6,23,0.03);
			background: rgba(255,255,255,0.96);
		}

		.orders-toolbar .form-control,
		.orders-toolbar .form-select {
			min-height: 54px;
			border-radius: 18px;
			border: 1px solid rgba(15,81,50,0.12);
			background: rgba(255,255,255,0.96);
			color: var(--orders-ink);
			padding-inline: 16px;
			box-shadow: inset 0 2px 6px rgba(2,6,23,0.03);
		}

		.orders-toolbar .input-group .form-control {
			border: 0;
			border-radius: 0;
			box-shadow: none;
		}

		.orders-toolbar .form-control:focus,
		.orders-toolbar .form-select:focus {
			border-color: var(--orders-green-700);
			box-shadow: 0 10px 20px rgba(16,185,129,0.1);
		}

		.orders-toolbar .btn-search {
			min-width: 136px;
			border: 0;
			border-radius: 18px;
			background: linear-gradient(90deg, var(--orders-green-800), var(--orders-green-500));
			color: #fff;
			font-weight: 800;
			letter-spacing: 0.03em;
			box-shadow: 0 14px 24px rgba(15,81,50,0.14);
			transition: transform 0.22s ease, box-shadow 0.22s ease;
		}

		.orders-toolbar .btn-search:hover {
			color: #fff;
			transform: translateY(-2px);
			box-shadow: 0 20px 30px rgba(15,81,50,0.18);
		}

		.orders-toolbar .toolbar-selects {
			display: grid;
			grid-template-columns: 1fr 120px;
			gap: 12px;
		}

		.orders-table-card {
			overflow: hidden;
			border-radius: 28px;
			background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
			border: 1px solid rgba(15,81,50,0.08);
			box-shadow: 0 18px 32px rgba(15,81,50,0.06);
		}

		.orders-table {
			width: 100%;
			margin: 0;
			border-collapse: separate;
			border-spacing: 0;
		}

		.orders-table thead th {
			padding: 1rem 1.1rem;
			border-bottom: 1px solid rgba(15,81,50,0.08);
			background: rgba(240,247,243,0.92);
			color: #5c6f67;
			font-size: 0.74rem;
			font-weight: 800;
			letter-spacing: 0.12em;
			text-transform: uppercase;
		}

		.orders-table tbody tr {
			transition: background 0.22s ease;
		}

		.orders-table tbody tr:hover {
			background: rgba(209,231,221,0.18);
		}

		.orders-table tbody td {
			padding: 1rem 1.1rem;
			vertical-align: middle;
			border-top: 1px solid rgba(15,81,50,0.06);
			color: var(--orders-ink);
		}

		.order-code {
			font-weight: 800;
			color: var(--orders-ink);
		}

		.order-date {
			margin-top: 0.35rem;
			font-size: 0.88rem;
			color: var(--orders-muted);
		}

		.order-total {
			font-weight: 800;
			color: var(--orders-green-800);
		}

		.status-chip,
		.payment-chip,
		.resi-chip {
			display: inline-flex;
			align-items: center;
			gap: 8px;
			padding: 8px 12px;
			border-radius: 999px;
			font-size: 0.76rem;
			font-weight: 800;
			letter-spacing: 0.03em;
		}

		.status-chip--success,
		.payment-chip--success,
		.resi-chip--pickup {
			background: rgba(209,231,221,0.72);
			color: var(--orders-green-800);
		}

		.status-chip--warning,
		.payment-chip--warning {
			background: rgba(255,244,214,0.92);
			color: #8a6c12;
		}

		.status-chip--danger,
		.payment-chip--danger {
			background: rgba(255,229,231,0.92);
			color: #b42318;
		}

		.status-chip--neutral,
		.payment-chip--neutral,
		.resi-chip--neutral {
			background: rgba(243,244,246,0.96);
			color: #4b5563;
		}

		.order-actions {
			display: flex;
			flex-wrap: wrap;
			justify-content: center;
			gap: 8px;
		}

		.action-pill {
			display: inline-flex;
			align-items: center;
			justify-content: center;
			gap: 8px;
			min-height: 40px;
			padding: 0 14px;
			border-radius: 999px;
			text-decoration: none;
			font-size: 0.82rem;
			font-weight: 800;
			transition: transform 0.22s ease, box-shadow 0.22s ease;
		}

		.action-pill:hover {
			transform: translateY(-2px);
		}

		.action-pill--primary {
			background: linear-gradient(90deg, var(--orders-green-800), var(--orders-green-500));
			color: #fff;
			box-shadow: 0 14px 24px rgba(15,81,50,0.14);
		}

		.action-pill--secondary {
			background: rgba(255,255,255,0.96);
			color: var(--orders-green-800);
			border: 1px solid rgba(15,81,50,0.12);
			box-shadow: 0 12px 22px rgba(15,81,50,0.06);
		}

		.action-pill--warning {
			background: rgba(255,244,214,0.92);
			color: #8a6c12;
			box-shadow: 0 12px 22px rgba(138,108,18,0.08);
		}

		.orders-pagination {
			display: flex;
			justify-content: space-between;
			align-items: center;
			gap: 14px;
			padding: 1rem 1.1rem;
			border-top: 1px solid rgba(15,81,50,0.08);
			background: rgba(255,255,255,0.88);
		}

		.orders-pagination-copy {
			color: var(--orders-muted);
			font-size: 0.92rem;
			line-height: 1.6;
		}

		.pagination-wrapper .pagination {
			display: flex !important;
			flex-wrap: nowrap !important;
			gap: 0.25rem;
			margin: 0;
			padding: 0;
		}

		.pagination-wrapper {
			overflow-x: auto;
			-webkit-overflow-scrolling: touch;
			scrollbar-width: none;
		}

		.pagination-wrapper::-webkit-scrollbar {
			display: none;
		}

		.pagination-wrapper .page-item {
			display: inline-block;
		}

		.pagination-wrapper .page-link {
			border-radius: 12px;
			border: 1px solid rgba(15,81,50,0.1);
			color: var(--orders-green-800);
			box-shadow: 0 8px 14px rgba(15,81,50,0.04);
		}

		.pagination-wrapper .active .page-link {
			background: linear-gradient(90deg, var(--orders-green-800), var(--orders-green-500));
			border-color: transparent;
			color: #fff;
		}

		.orders-empty-state {
			text-align: center;
			padding: 3.25rem 1rem;
		}

		.orders-empty-icon {
			width: 78px;
			height: 78px;
			margin: 0 auto 1rem;
			display: inline-flex;
			align-items: center;
			justify-content: center;
			border-radius: 24px;
			background: linear-gradient(135deg, rgba(209,231,221,0.72), rgba(236,253,245,0.96));
			color: var(--orders-green-800);
			font-size: 1.6rem;
			box-shadow: 0 18px 28px rgba(15,81,50,0.08);
		}

		.orders-empty-state h4 {
			margin-bottom: 0.55rem;
			color: var(--orders-ink);
			font-weight: 800;
		}

		.orders-empty-state p {
			max-width: 440px;
			margin: 0 auto;
			color: var(--orders-muted);
			line-height: 1.7;
		}

		@media (max-width: 1199px) {
			.orders-stat-grid {
				grid-template-columns: repeat(2, minmax(0, 1fr));
			}
		}

		@media (max-width: 991px) {
			.orders-page-header {
				padding: 5rem 0 5.75rem;
			}

			.orders-shell,
			.orders-sidebar-shell {
				border-radius: 28px;
			}

			.orders-section-head {
				flex-direction: column;
			}

			.orders-toolbar form {
				grid-template-columns: 1fr;
			}

			.orders-toolbar .toolbar-selects {
				grid-template-columns: 1fr 140px;
			}
		}

		@media (max-width: 767px) {
			.orders-stage {
				margin-top: -54px;
			}

			.orders-stat-grid {
				grid-template-columns: 1fr;
			}

			.orders-table thead {
				display: none;
			}

			.orders-table,
			.orders-table tbody,
			.orders-table tr,
			.orders-table td {
				display: block;
				width: 100%;
			}

			.orders-table tbody tr {
				margin: 12px;
				padding: 14px;
				border-radius: 24px;
				background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,250,247,0.94));
				box-shadow: 0 18px 30px rgba(15,81,50,0.06);
			}

			.orders-table tbody td {
				padding: 0.55rem 0;
				border-top: 0;
			}

			.orders-table tbody td::before {
				content: attr(data-label);
				display: block;
				margin-bottom: 0.3rem;
				color: #6b7280;
				font-size: 0.74rem;
				font-weight: 800;
				letter-spacing: 0.08em;
				text-transform: uppercase;
			}

			.orders-table tbody td:first-child::before {
				display: none;
			}

			.orders-table tbody td.text-end,
			.orders-table tbody td.text-center {
				text-align: left !important;
			}

			.orders-pagination {
				flex-direction: column;
				align-items: stretch;
			}
		}

		@media (max-width: 575px) {
			.orders-page-header {
				border-radius: 0 0 28px 28px;
			}

			.orders-toolbar .toolbar-selects {
				grid-template-columns: 1fr;
			}

			.orders-toolbar form > .btn-search {
				width: 100%;
			}

			.order-actions {
				flex-direction: column;
				align-items: stretch;
			}

			.action-pill {
				width: 100%;
			}
		}
	</style>

	@php
		$totalOrders = $orders->total() ?? $orders->count();
		$visibleOrders = $orders->count();
		$activeSearch = request('q');
	@endphp

	<div class="container-fluid page-header orders-page-header py-5">
		<div class="container">
			<div class="orders-hero-content text-center">
				<span class="orders-hero-kicker"><i class="fas fa-receipt"></i> Riwayat Pesanan</span>
				<h1 class="text-white display-5 fw-bold mb-3">Semua Order Anda Dalam Satu Dashboard</h1>
				<p class="text-white-50 lead mb-3">Daftar order dibuat lebih rapi untuk memantau status, pembayaran, resi, dan aksi lanjutan dari desktop maupun mobile tanpa mengubah flow backend yang sudah stabil.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ url('profile') }}">Account</a></li>
					<li class="breadcrumb-item active text-white">Orders</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid orders-stage py-5">
		<div class="container pb-5">
			<div class="row g-4 align-items-start">
				<div class="col-lg-3">
					<div class="orders-sidebar-shell">
						@include('frontend.partials.user_menu')
					</div>
				</div>

				<div class="col-lg-9">
					<div class="orders-surface orders-shell">
						<div class="orders-section-head">
							<div>
								<span class="orders-section-kicker"><i class="fas fa-layer-group"></i> Order Center</span>
								<h2>My Orders</h2>
								<p>Gunakan panel ini untuk mencari order, memeriksa status pembayaran, melihat detail, dan melanjutkan pembayaran order yang belum selesai.</p>
							</div>
						</div>

						<div class="orders-stat-grid">
							<div class="orders-stat-card">
								<small>Total Order</small>
								<strong>{{ $totalOrders }}</strong>
								<span>Jumlah semua pesanan yang tercatat pada akun Anda.</span>
							</div>
							<div class="orders-stat-card">
								<small>Ditampilkan</small>
								<strong>{{ $visibleOrders }}</strong>
								<span>Item pada halaman saat ini setelah filter, pencarian, dan sorting diterapkan.</span>
							</div>
							<div class="orders-stat-card">
								<small>Filter Aktif</small>
								<strong>{{ $activeSearch ? 'Ya' : 'Tidak' }}</strong>
								<span>{{ $activeSearch ? 'Pencarian: ' . $activeSearch : 'Belum ada kata kunci pencarian yang dipakai.' }}</span>
							</div>
						</div>

						<div class="orders-toolbar">
							<form method="GET" action="{{ url('orders') }}">
								<div class="input-group">
									<input type="search" name="q" value="{{ request('q') }}" class="form-control" placeholder="Search by id, resi, status...">
									<button class="btn btn-search" type="submit"><i class="fas fa-search me-2"></i>Search</button>
								</div>
								<div class="toolbar-selects">
									<select name="sort" class="form-select">
										<option value="id" {{ request('sort')=='id' ? 'selected' : '' }}>Sort by ID</option>
										<option value="grand_total" {{ request('sort')=='grand_total' ? 'selected' : '' }}>Grand Total</option>
										<option value="resi" {{ request('sort')=='resi' ? 'selected' : '' }}>Nomer Resi</option>
										<option value="status" {{ request('sort')=='status' ? 'selected' : '' }}>Status</option>
										<option value="payment_method" {{ request('sort')=='payment_method' ? 'selected' : '' }}>Payment Method</option>
										<option value="order_date" {{ request('sort')=='order_date' ? 'selected' : '' }}>Date</option>
									</select>
									<select name="direction" class="form-select">
										<option value="desc" {{ request('direction','desc')=='desc' ? 'selected' : '' }}>Desc</option>
										<option value="asc" {{ request('direction')=='asc' ? 'selected' : '' }}>Asc</option>
									</select>
								</div>
								<button class="btn btn-search" type="submit"><i class="fas fa-sliders me-2"></i>Apply</button>
							</form>
						</div>

						<div class="orders-table-card">
							<div class="table-responsive">
								<table class="orders-table">
									<thead>
										<tr>
											<th>Order</th>
											<th class="text-end">Grand Total</th>
											<th>Resi</th>
											<th>Status</th>
											<th>Payment</th>
											<th>Method</th>
											<th class="text-center">Action</th>
										</tr>
									</thead>
									<tbody>
										@forelse($orders as $order)
											@php
												$status = strtolower((string) $order->status);
												$statusClass = 'status-chip--neutral';
												if (in_array($status, ['completed', 'delivered'])) {
													$statusClass = 'status-chip--success';
												} elseif (in_array($status, ['pending', 'waiting', 'created', 'processing'])) {
													$statusClass = 'status-chip--warning';
												} elseif (in_array($status, ['cancelled', 'failed'])) {
													$statusClass = 'status-chip--danger';
												}

												$paymentStatus = strtolower((string) $order->payment_status);
												$paymentClass = 'payment-chip--neutral';
												if ($paymentStatus === 'paid') {
													$paymentClass = 'payment-chip--success';
												} elseif (in_array($paymentStatus, ['waiting', 'pending'])) {
													$paymentClass = 'payment-chip--warning';
												} elseif (in_array($paymentStatus, ['unpaid', 'failed', 'expired'])) {
													$paymentClass = 'payment-chip--danger';
												}

												$hasShipment = $order->shipment != null;
												$trackNumber = $hasShipment ? $order->shipment->track_number : null;
												$isPickup = (!$hasShipment) || (!$trackNumber && $order->shipping_courier == 'SELF');
											@endphp
											<tr>
												<td>
													<div class="order-code">{{ $order->code }}</div>
													<div class="order-date">{{ date('d M Y', strtotime($order->order_date)) }}</div>
												</td>
												<td data-label="Grand Total" class="text-end">
													<span class="order-total">Rp{{ number_format($order->grand_total, 0, ",", ".") }}</span>
												</td>
												<td data-label="Nomer Resi">
													@if ($trackNumber)
														<span class="resi-chip resi-chip--neutral">{{ $trackNumber }}</span>
													@elseif($isPickup)
														<span class="resi-chip resi-chip--pickup">Ambil di Toko</span>
													@else
														<span class="resi-chip resi-chip--neutral">Belum Ada Resi</span>
													@endif
												</td>
												<td data-label="Status">
													<span class="status-chip {{ $statusClass }}">{{ $order->status }}</span>
												</td>
												<td data-label="Payment Status">
													<span class="payment-chip {{ $paymentClass }}">{{ $order->payment_status }}</span>
												</td>
												<td data-label="Payment Method">
													{{ $order->payment_method == 'cod' ? 'Toko' : $order->payment_method }}
												</td>
												<td data-label="Action" class="text-center">
													<div class="order-actions">
														<a href="{{ url('orders/'. $order->id) }}" class="action-pill action-pill--secondary">Details</a>
														@if ($order->payment_method == 'manual' || $order->payment_method == 'qris')
															@if ($order->payment_status == 'unpaid')
																<a href="{{ route('orders.confirmation_payment', $order->id) }}" class="action-pill action-pill--primary">Confirm</a>
															@endif
														@endif
														@if(in_array($order->payment_status, ['unpaid', 'waiting']) && !in_array($order->status, ['completed','cancelled']))
															<a href="{{ url('orders/checkout?order_id=' . $order->id) }}" class="action-pill action-pill--warning">Resume</a>
														@endif
													</div>
												</td>
											</tr>
										@empty
											<tr>
												<td colspan="7">
													<div class="orders-empty-state">
														<span class="orders-empty-icon"><i class="fas fa-box-open"></i></span>
														<h4>Belum ada order ditemukan</h4>
														<p>Tidak ada data order yang cocok dengan filter saat ini. Anda masih bisa kembali ke katalog dan mulai berbelanja dari halaman shop yang sudah diperbarui.</p>
													</div>
												</td>
											</tr>
										@endforelse
									</tbody>
								</table>
							</div>

							<div class="orders-pagination">
								<div class="orders-pagination-copy">
									Showing {{ $orders->firstItem() ?? 0 }} to {{ $orders->lastItem() ?? 0 }} of {{ $orders->total() ?? 0 }} orders
								</div>
								<div class="d-flex pagination-wrapper justify-content-end">
									{{ $orders->appends(request()->except('page'))->links('pagination::bootstrap-5') }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
