@extends('frontend.layouts')

@push('styles')
<style>
	.wishlist-page-header {
		position: relative;
		margin-top: 18px;
		padding: 5.5rem 0 6.3rem;
		border-radius: 0 0 42px 42px;
		background:
			radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
			radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
			linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
		overflow: hidden;
	}

	.wishlist-page-header::after {
		content: '';
		position: absolute;
		left: -110px;
		bottom: -180px;
		width: 340px;
		height: 340px;
		border-radius: 50%;
		background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
	}

	.wishlist-hero-content {
		position: relative;
		z-index: 1;
		max-width: 780px;
		margin-left: auto;
		margin-right: auto;
	}

	.wishlist-kicker,
	.wishlist-section-kicker {
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

	.wishlist-kicker {
		margin-bottom: 1rem;
		background: rgba(255,255,255,0.14);
		border: 1px solid rgba(255,255,255,0.18);
		color: #fff;
		backdrop-filter: blur(10px);
		-webkit-backdrop-filter: blur(10px);
	}

	.wishlist-page-header .breadcrumb-item,
	.wishlist-page-header .breadcrumb-item a {
		color: rgba(255,255,255,0.82) !important;
		text-decoration: none;
	}

	.wishlist-page-header .breadcrumb-item.active {
		color: #fff !important;
	}

	.wishlist-stage {
		margin-top: -74px;
	}

	.wishlist-sidebar-shell,
	.wishlist-surface,
	.wishlist-item-card,
	.wishlist-count-card,
	.wishlist-empty-state {
		border-radius: 32px;
		border: 1px solid rgba(15,81,50,0.08);
		background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
		box-shadow: 0 26px 48px rgba(15,81,50,0.08);
	}

	.wishlist-sidebar-shell {
		padding: 14px;
	}

	.wishlist-surface {
		padding: 26px;
	}

	.wishlist-alert {
		border: none;
		border-radius: 20px;
		margin-bottom: 1rem;
	}

	.wishlist-shell-head {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		gap: 18px;
		margin-bottom: 1.5rem;
	}

	.wishlist-section-kicker {
		margin-bottom: 0.85rem;
		background: rgba(15,81,50,0.06);
		color: #0f5132;
	}

	.wishlist-shell-head h2 {
		margin: 0 0 0.35rem;
		font-family: 'Raleway', sans-serif;
		font-size: clamp(1.7rem, 3vw, 2.3rem);
		font-weight: 800;
		line-height: 1.06;
		letter-spacing: -0.03em;
		color: #213547;
	}

	.wishlist-shell-head p,
	.wishlist-empty-state p,
	.wishlist-item-meta {
		margin: 0;
		color: #6b7b74;
		line-height: 1.7;
	}

	.wishlist-count-card {
		min-width: 170px;
		padding: 18px 20px;
	}

	.wishlist-count-card small {
		display: block;
		margin-bottom: 0.45rem;
		color: #6b7b74;
		font-size: 0.78rem;
		font-weight: 800;
		letter-spacing: 0.08em;
		text-transform: uppercase;
	}

	.wishlist-count-card strong {
		display: block;
		color: #0f5132;
		font-size: 1.7rem;
		font-weight: 900;
	}

	.wishlist-list {
		display: grid;
		gap: 16px;
	}

	.wishlist-item-card {
		display: grid;
		grid-template-columns: 180px minmax(0, 1fr);
		gap: 18px;
		padding: 18px;
	}

	.wishlist-item-media {
		position: relative;
		min-height: 176px;
		border-radius: 24px;
		overflow: hidden;
		background: linear-gradient(180deg, #f6fbf8 0%, #ffffff 100%);
		border: 1px solid rgba(15,81,50,0.08);
	}

	.wishlist-item-media img {
		width: 100%;
		height: 100%;
		object-fit: cover;
	}

	.wishlist-item-body {
		display: flex;
		flex-direction: column;
		gap: 14px;
	}

	.wishlist-item-top {
		display: flex;
		justify-content: space-between;
		align-items: flex-start;
		gap: 16px;
	}

	.wishlist-item-badge {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		margin-bottom: 0.8rem;
		border-radius: 999px;
		background: rgba(15,81,50,0.08);
		color: #0f5132;
		font-size: 0.75rem;
		font-weight: 800;
		letter-spacing: 0.06em;
		text-transform: uppercase;
	}

	.wishlist-item-title {
		margin: 0 0 0.45rem;
		color: #213547;
		font-size: 1.22rem;
		font-weight: 800;
		line-height: 1.45;
	}

	.wishlist-item-title a {
		color: inherit;
		text-decoration: none;
	}

	.wishlist-item-title a:hover {
		color: #0f5132;
	}

	.wishlist-item-price {
		min-width: 150px;
		text-align: right;
		color: #0f5132;
		font-size: 1.2rem;
		font-weight: 900;
	}

	.wishlist-item-meta {
		display: flex;
		flex-wrap: wrap;
		gap: 10px;
	}

	.wishlist-item-meta span {
		display: inline-flex;
		align-items: center;
		gap: 8px;
		padding: 8px 12px;
		border-radius: 999px;
		background: rgba(15,81,50,0.05);
	}

	.wishlist-item-actions {
		display: flex;
		gap: 12px;
		flex-wrap: wrap;
		margin-top: auto;
	}

	.wishlist-action,
	.wishlist-secondary {
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

	.wishlist-action:hover,
	.wishlist-secondary:hover {
		text-decoration: none;
		transform: translateY(-2px);
	}

	.wishlist-action:hover {
		color: #fff;
		box-shadow: 0 22px 34px rgba(15,81,50,0.18);
	}

	.wishlist-secondary:hover {
		color: #0f5132;
		box-shadow: 0 18px 28px rgba(15,81,50,0.1);
	}

	.wishlist-action {
		background: linear-gradient(90deg, #0f5132, #22a06b);
		color: #fff;
		box-shadow: 0 16px 28px rgba(15,81,50,0.14);
	}

	.wishlist-secondary {
		border: 1px solid rgba(15,81,50,0.12);
		background: rgba(255,255,255,0.96);
		color: #0f5132;
		box-shadow: 0 12px 22px rgba(15,81,50,0.06);
	}

	.wishlist-secondary button {
		border: 0;
		background: transparent;
		color: inherit;
		font-weight: 800;
		padding: 0;
	}

	.wishlist-empty-state {
		padding: 34px 26px;
		text-align: center;
	}

	.wishlist-empty-state i {
		width: 68px;
		height: 68px;
		margin-bottom: 1rem;
		border-radius: 22px;
		display: inline-flex;
		align-items: center;
		justify-content: center;
		background: rgba(15,81,50,0.08);
		color: #0f5132;
		font-size: 1.5rem;
	}

	@media (max-width: 991px) {
		.wishlist-shell-head {
			flex-direction: column;
		}

		.wishlist-count-card {
			width: 100%;
		}

		.wishlist-item-card {
			grid-template-columns: 1fr;
		}
	}

	@media (max-width: 767px) {
		.wishlist-page-header {
			padding: 5rem 0 5.8rem;
			border-radius: 0 0 28px 28px;
		}

		.wishlist-stage {
			margin-top: -54px;
		}

		.wishlist-sidebar-shell,
		.wishlist-surface,
		.wishlist-item-card,
		.wishlist-count-card,
		.wishlist-empty-state {
			border-radius: 24px;
		}

		.wishlist-surface {
			padding: 20px;
		}

		.wishlist-item-top {
			flex-direction: column;
		}

		.wishlist-item-price {
			min-width: 0;
			text-align: left;
		}

		.wishlist-item-media {
			min-height: 220px;
		}

		.wishlist-item-actions {
			flex-direction: column;
		}

		.wishlist-action,
		.wishlist-secondary {
			width: 100%;
		}
	}
</style>
@endpush

@section('content')
	<div class="container-fluid page-header wishlist-page-header py-5">
		<div class="container">
			<div class="wishlist-hero-content text-center">
				<span class="wishlist-kicker"><i class="fas fa-heart"></i> Saved Products</span>
				<h1 class="text-white display-5 fw-bold mb-3">Wishlist Anda, Kini Lebih Enak Dipantau</h1>
				<p class="text-white-50 lead mb-3">Produk favorit tetap sama, tetapi tampilannya sekarang lebih bersih, lebih fokus, dan jauh lebih nyaman dipakai dari mobile.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item active text-white">Wishlist</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid wishlist-stage py-5">
		<div class="container pb-5">
			<div class="row g-4 align-items-start">
				<div class="col-lg-4 col-xl-3">
					<div class="wishlist-sidebar-shell">
						@include('frontend.partials.user_menu')
					</div>
				</div>

				<div class="col-lg-8 col-xl-9">
					@if(session()->has('message'))
						<div class="alert wishlist-alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
							<strong>{{ session()->get('message') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					<div class="wishlist-surface">
						<div class="wishlist-shell-head">
							<div>
								<span class="wishlist-section-kicker"><i class="fas fa-star"></i> Customer Wishlist</span>
								<h2>Koleksi Produk Favorit</h2>
								<p>Daftar ini tetap memakai data wishlist yang sama. Saya hanya mengubah komponen tampilannya agar review produk tersimpan jadi lebih cepat dan lebih rapi.</p>
							</div>

							<div class="wishlist-count-card">
								<small>Saved Items</small>
								<strong>{{ $wishlists->count() }}</strong>
							</div>
						</div>

						<div class="wishlist-list">
							@forelse ($wishlists as $wishlist)
								@php
									$product = $wishlist->product;
									$displayProduct = $product && $product->parent ? $product->parent : $product;
									$image = $displayProduct && $displayProduct->productImages->first()
										? asset('storage/' . $displayProduct->productImages->first()->path)
										: asset('themes/ezone/assets/img/cart/3.jpg');
									$productUrl = $displayProduct ? url('product/' . $displayProduct->slug) : null;
								@endphp

								<article class="wishlist-item-card">
									<div class="wishlist-item-media">
										@if($productUrl)
											<a href="{{ $productUrl }}"><img src="{{ $image }}" alt="{{ $displayProduct->name }}"></a>
										@else
											<img src="{{ $image }}" alt="Produk tidak tersedia">
										@endif
									</div>

									<div class="wishlist-item-body">
										<div class="wishlist-item-top">
											<div>
												<span class="wishlist-item-badge"><i class="fas fa-heart"></i> Wishlist Item</span>
												<h3 class="wishlist-item-title">
													@if($productUrl)
														<a href="{{ $productUrl }}">{{ $displayProduct->name }}</a>
													@else
														Produk tidak tersedia
													@endif
												</h3>
												<p class="wishlist-item-meta">
													<span><i class="fas fa-calendar-day"></i> Ditambahkan {{ optional($wishlist->created_at)->format('d M Y') ?: '-' }}</span>
													<span><i class="fas fa-bag-shopping"></i> Siap ditinjau kapan saja</span>
												</p>
											</div>

											<div class="wishlist-item-price">
												@if($displayProduct)
													Rp{{ number_format($displayProduct->priceLabel(), 0, ",", ".") }}
												@else
													-
												@endif
											</div>
										</div>

										<div class="wishlist-item-actions">
											@if($productUrl)
												<a class="wishlist-action" href="{{ $productUrl }}"><i class="fas fa-eye"></i> Lihat Produk</a>
											@endif

											<form action="{{ route('wishlists.destroy', $wishlist->id) }}" method="post" class="delete d-inline-block wishlist-secondary">
												@csrf
												@method('delete')
												<button type="submit"><i class="fas fa-trash"></i> Hapus dari Wishlist</button>
											</form>
										</div>
									</div>
								</article>
							@empty
								<div class="wishlist-empty-state">
									<i class="fas fa-heart-crack"></i>
									<h3 class="mb-3">Wishlist masih kosong</h3>
									<p class="mb-4">Belum ada produk yang disimpan. Saat Anda mulai menandai produk favorit, daftar ini akan menjadi titik kumpul yang lebih rapi untuk perbandingan sebelum belanja.</p>
									<a class="wishlist-action" href="{{ url('shop') }}"><i class="fas fa-store"></i> Jelajahi Produk</a>
								</div>
							@endforelse
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection