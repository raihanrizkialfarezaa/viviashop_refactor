@extends('frontend.layouts')

@push('styles')
<style>
    .legacy-products-header {
        position: relative;
        margin-top: 18px;
        padding: 5.5rem 0 6.25rem;
        border-radius: 0 0 42px 42px;
        background:
            radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
            linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
        overflow: hidden;
    }

    .legacy-products-header::after {
        content: '';
        position: absolute;
        inset: auto -120px -180px auto;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
    }

    .legacy-products-hero {
        position: relative;
        z-index: 1;
        max-width: 820px;
        margin-left: auto;
        margin-right: auto;
    }

    .legacy-products-kicker,
    .legacy-products-section-kicker,
    .legacy-products-card-badge {
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

    .legacy-products-kicker {
        margin-bottom: 1rem;
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
    }

    .legacy-products-header .breadcrumb-item,
    .legacy-products-header .breadcrumb-item a {
        color: rgba(255,255,255,0.82) !important;
        text-decoration: none;
    }

    .legacy-products-header .breadcrumb-item.active {
        color: #fff !important;
    }

    .legacy-products-stage {
        margin-top: -74px;
    }

    .legacy-products-sidebar,
    .legacy-products-shell,
    .legacy-products-toolbar,
    .legacy-products-card,
    .legacy-products-list-card,
    .legacy-products-empty {
        border-radius: 32px;
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: 0 26px 48px rgba(15,81,50,0.08);
    }

    .legacy-products-sidebar,
    .legacy-products-shell {
        padding: 22px;
    }

    .legacy-products-sidebar .sidebar-widget {
        padding: 18px;
        border-radius: 24px;
        background: rgba(255,255,255,0.9);
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.74);
    }

    .legacy-products-sidebar .sidebar-widget + .sidebar-widget {
        margin-top: 14px;
    }

    .legacy-products-sidebar .sidebar-title {
        margin: 0 0 1rem;
        color: #213547;
        font-size: 1.02rem;
        font-weight: 800;
        text-transform: none;
    }

    .legacy-products-sidebar .sidebar-categories ul,
    .legacy-products-sidebar .product-size ul {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 10px;
    }

    .legacy-products-sidebar .sidebar-categories a,
    .legacy-products-sidebar .product-size a {
        display: inline-flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        min-height: 44px;
        padding: 0 14px;
        border-radius: 16px;
        background: rgba(15,81,50,0.05);
        color: #456157;
        text-decoration: none;
        font-weight: 700;
        transition: transform 0.22s ease, background-color 0.22s ease;
    }

    .legacy-products-sidebar .sidebar-categories a:hover,
    .legacy-products-sidebar .product-size a:hover {
        transform: translateY(-1px);
        background: rgba(15,81,50,0.1);
        color: #0f5132;
    }

    .legacy-products-sidebar .price_slider_amount {
        display: grid;
        gap: 12px;
    }

    .legacy-products-sidebar .label-input {
        display: grid;
        gap: 10px;
    }

    .legacy-products-sidebar label {
        color: #213547;
        font-weight: 800;
    }

    .legacy-products-sidebar #amount,
    .legacy-products-toolbar select {
        width: 100% !important;
        min-height: 48px;
        border-radius: 16px;
        border: 1px solid rgba(15,81,50,0.12);
        background: #fff;
        color: #213547;
        box-shadow: none;
    }

    .legacy-products-sidebar button {
        min-height: 48px;
        border: 0;
        border-radius: 16px;
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        font-weight: 800;
        box-shadow: 0 14px 24px rgba(15,81,50,0.14);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .legacy-products-sidebar button:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 20px 30px rgba(15,81,50,0.18);
    }

    .legacy-products-toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        padding: 18px 20px;
        margin-bottom: 1.35rem;
    }

    .legacy-products-found p {
        margin: 0;
        color: #5c6f67;
        line-height: 1.7;
    }

    .legacy-products-found span,
    .legacy-products-sort label {
        color: #0f5132;
        font-weight: 800;
    }

    .legacy-products-sort {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
    }

    .legacy-products-toolbar-controls {
        display: flex;
        align-items: center;
        gap: 1rem;
        flex-wrap: wrap;
        justify-content: flex-end;
    }

    .legacy-products-tabs {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
    }

    .legacy-products-tabs a {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #456157;
        text-decoration: none;
    }

    .legacy-products-tabs a.active,
    .legacy-products-tabs a:hover {
        background: #fff;
        color: #0f5132;
        box-shadow: 0 10px 18px rgba(15,81,50,0.08);
    }

    .legacy-products-grid,
    .legacy-products-list {
        display: grid;
        gap: 18px;
    }

    .legacy-products-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .legacy-products-card {
        overflow: hidden;
        height: 100%;
    }

    .legacy-products-image {
        position: relative;
        overflow: hidden;
        aspect-ratio: 0.95;
        background: linear-gradient(180deg, #f5faf7 0%, #ffffff 100%);
    }

    .legacy-products-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .legacy-products-card:hover .legacy-products-image img,
    .legacy-products-list-card:hover .legacy-products-list-image img {
        transform: scale(1.05);
    }

    .legacy-products-chip {
        position: absolute;
        left: 16px;
        top: 16px;
        z-index: 1;
        background: rgba(255,255,255,0.94);
        color: #0f5132;
        box-shadow: 0 12px 20px rgba(15,81,50,0.08);
    }

    .legacy-products-actions {
        position: absolute;
        right: 16px;
        bottom: 16px;
        display: flex;
        gap: 10px;
        z-index: 1;
    }

    .legacy-products-actions a,
    .legacy-products-list-actions a {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.96);
        color: #0f5132;
        text-decoration: none;
        box-shadow: 0 12px 22px rgba(15,81,50,0.08);
        transition: transform 0.22s ease;
    }

    .legacy-products-list-actions a:not(.legacy-products-list-cta) {
        flex: 0 0 44px;
        flex-shrink: 0;
    }

    .legacy-products-actions a:hover,
    .legacy-products-list-actions a:hover {
        color: #0f5132;
        text-decoration: none;
        transform: translateY(-2px);
    }

    .legacy-products-content {
        padding: 18px 18px 20px;
    }

    .legacy-products-title,
    .legacy-products-title a,
    .legacy-products-list-title,
    .legacy-products-list-title a {
        color: #213547;
        text-decoration: none;
        font-weight: 800;
    }

    .legacy-products-title {
        margin: 0 0 0.45rem;
        font-size: 1rem;
        line-height: 1.5;
    }

    .legacy-products-price,
    .legacy-products-list-price {
        color: #0f5132;
        font-size: 1.05rem;
        font-weight: 900;
    }

    .legacy-products-list-card {
        display: grid;
        grid-template-columns: 240px minmax(0, 1fr);
        gap: 18px;
        padding: 18px;
    }

    .legacy-products-list-image {
        position: relative;
        overflow: hidden;
        min-height: 220px;
        border-radius: 24px;
        background: linear-gradient(180deg, #f5faf7 0%, #ffffff 100%);
    }

    .legacy-products-list-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.4s ease;
    }

    .legacy-products-list-body {
        display: flex;
        flex-direction: column;
        gap: 12px;
    }

    .legacy-products-list-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        color: #5c6f67;
    }

    .legacy-products-list-meta span {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15,81,50,0.05);
    }

    .legacy-products-list-copy {
        color: #6b7b74;
        line-height: 1.75;
    }

    .legacy-products-list-actions {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: auto;
    }

    .legacy-products-list-cta {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 48px;
        padding: 0 18px;
        border-radius: 18px;
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        font-weight: 800;
        text-decoration: none;
        box-shadow: 0 16px 28px rgba(15,81,50,0.14);
    }

    .legacy-products-list-cta:hover {
        color: #fff;
        text-decoration: none;
        transform: translateY(-2px);
        box-shadow: 0 22px 34px rgba(15,81,50,0.18);
    }

    .legacy-products-empty {
        padding: 40px 24px;
        text-align: center;
        color: #6b7b74;
    }

    @media (max-width: 1199px) {
        .legacy-products-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 991px) {
        .legacy-products-toolbar {
            flex-direction: column;
            align-items: stretch;
        }

        .legacy-products-toolbar-controls {
            width: 100%;
            justify-content: space-between;
        }

        .legacy-products-list-card {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .legacy-products-header {
            padding: 5rem 0 5.8rem;
            border-radius: 0 0 28px 28px;
        }

        .legacy-products-stage {
            margin-top: -54px;
        }

        .legacy-products-sidebar,
        .legacy-products-shell,
        .legacy-products-toolbar,
        .legacy-products-card,
        .legacy-products-list-card,
        .legacy-products-empty {
            border-radius: 24px;
        }

        .legacy-products-grid {
            grid-template-columns: 1fr;
        }

        .legacy-products-sidebar,
        .legacy-products-shell {
            padding: 18px;
        }

        .legacy-products-list-image {
            min-height: 200px;
        }
    }

    @media (max-width: 575px) {
        .legacy-products-toolbar {
            padding: 16px;
        }

        .legacy-products-sort {
            width: 100%;
            flex-direction: column;
            align-items: stretch;
        }

        .legacy-products-toolbar-controls {
            flex-direction: column;
            align-items: stretch;
        }

        .legacy-products-tabs {
            width: 100%;
            justify-content: center;
        }

        .legacy-products-content {
            padding: 16px;
        }

        .legacy-products-actions {
            gap: 8px;
        }

        .legacy-products-list-actions {
            width: 100%;
        }

        .legacy-products-list-actions a {
            flex: 1 1 auto;
        }

        .legacy-products-list-actions a:not(.legacy-products-list-cta) {
            flex: 0 0 48px;
        }

        .legacy-products-list-cta {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
	<div class="container-fluid page-header legacy-products-header py-5">
		<div class="container">
			<div class="legacy-products-hero text-center">
				<span class="legacy-products-kicker"><i class="fas fa-store"></i> Product Catalog</span>
				<h1 class="text-white display-5 fw-bold mb-3">Katalog Produk Dengan Jalur Legacy Yang Kini Lebih Konsisten</h1>
				<p class="text-white-50 lead mb-3">Route `/products` tetap dipertahankan seperti sebelumnya, tetapi sekarang tampilannya disejajarkan dengan shop baru agar pengalaman pengguna tidak pecah saat berpindah halaman.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item active text-white">Products</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid legacy-products-stage py-5">
		<div class="container-fluid px-xl-4 pb-5">
			<div class="row g-4 align-items-start">
				<div class="col-lg-4 col-xl-3">
					<div class="legacy-products-sidebar">
						<form method="GET" action="{{ url('products')}}">
							<div class="sidebar-widget">
								<h3 class="sidebar-title">Filter by Price</h3>
								<div class="price_filter">
									<div id="slider-range"></div>
									<div class="price_slider_amount">
										<div class="label-input">
											<label>Price</label>
											<input type="text" id="amount" name="price" placeholder="Add Your Price" />
											<input type="hidden" id="productMinPrice" value="{{ $minPrice }}"/>
											<input type="hidden" id="productMaxPrice" value="{{ $maxPrice }}"/>
										</div>
										<button type="submit">Filter</button>
									</div>
								</div>
							</div>
						</form>

						@if ($categories)
							<div class="sidebar-widget">
								<h3 class="sidebar-title">Categories</h3>
								<div class="sidebar-categories">
									<ul>
										@foreach ($categories as $category)
											<li><a href="{{ url('products?category='. $category->slug) }}">{{ $category->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
						
						@if ($colors)
							<div class="sidebar-widget sidebar-overflow">
								<h3 class="sidebar-title">Color</h3>
								<div class="sidebar-categories">
									<ul>
										@foreach ($colors as $color)
											<li><a href="{{ url('products?option='. $color->id) }}">{{ $color->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif

						@if ($sizes)
							<div class="sidebar-widget">
								<h3 class="sidebar-title">Size</h3>
								<div class="product-size">
									<ul>
										@foreach ($sizes as $size)
											<li><a href="{{ url('products?option='. $size->id) }}">{{ $size->name }}</a></li>
										@endforeach
									</ul>
								</div>
							</div>
						@endif
					</div>
				</div>

				<div class="col-lg-8 col-xl-9">
					<div class="legacy-products-shell">
                        <div class="legacy-products-toolbar">
							<div class="legacy-products-found">
								<p><span>{{ count($products) }}</span> product tampil di halaman ini dari total <span>{{ $products->total() }}</span> produk.</p>
							</div>
                            <div class="legacy-products-toolbar-controls d-flex align-items-center gap-3 flex-wrap justify-content-end">
								<div class="legacy-products-sort">
									<label>Sort By</label>
									<select onchange="this.options[this.selectedIndex].value && (window.location = this.options[this.selectedIndex].value)" name="sort">
										@foreach($sorts as $url => $sort)
											<option {{ $selectedSort == $url ? 'selected' : null }} value="{{ $url }}">{{ $sort }}</option>
										@endforeach
									</select>
								</div>
								<div class="legacy-products-tabs shop-tab nav" role="tablist">
									<a class="active" href="#grid-sidebar3" data-toggle="tab" role="tab" aria-selected="false"><i class="ti-layout-grid4-alt"></i></a>
									<a href="#grid-sidebar4" data-toggle="tab" role="tab" aria-selected="true"><i class="ti-menu"></i></a>
								</div>
							</div>
						</div>

						<div class="tab-content">
							<div id="grid-sidebar3" class="tab-pane fade active show">
								<div class="legacy-products-grid">
									@forelse ($products as $product)
										@php
											$image = $product->productImages->first()
												? asset('storage/' . $product->productImages->first()->path)
												: asset('themes/ezone/assets/img/product/fashion-colorful/1.jpg');
										@endphp
										<div class="legacy-products-card">
											<div class="legacy-products-image">
												<span class="legacy-products-card-badge legacy-products-chip"><i class="fas fa-fire"></i> Featured</span>
												<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}"></a>
												<div class="legacy-products-actions">
													<a class="add-to-fav" title="Favorite" product-slug="{{ $product->slug }}" href=""><i class="pe-7s-like"></i></a>
													<a class="add-to-card" title="Add To Cart" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}"><i class="pe-7s-cart"></i></a>
													<a class="quick-view" data-toggle="modal" data-target="#exampleModal" title="Quick View" product-slug="{{ $product->slug }}" href=""><i class="pe-7s-look"></i></a>
												</div>
											</div>
											<div class="legacy-products-content">
												<h4 class="legacy-products-title"><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
												<div class="legacy-products-price">Rp{{ number_format($product->priceLabel()) }}</div>
											</div>
										</div>
									@empty
										<div class="legacy-products-empty">No product found!</div>
									@endforelse
								</div>
							</div>

							<div id="grid-sidebar4" class="tab-pane fade">
								<div class="legacy-products-list">
									@forelse ($products as $product)
										@php
											$image = $product->productImages->first()
												? asset('storage/' . $product->productImages->first()->path)
												: asset('themes/ezone/assets/img/product/fashion-colorful/1.jpg');
											$stock = $product->type == 'configurable'
												? $product->total_stock
												: ($product->productInventory->qty ?? 0);
										@endphp
										<div class="legacy-products-list-card">
											<div class="legacy-products-list-image">
												<span class="legacy-products-card-badge legacy-products-chip"><i class="fas fa-layer-group"></i> Detail View</span>
												<a href="{{ url('product/'. $product->slug) }}"><img src="{{ $image }}" alt="{{ $product->name }}"></a>
											</div>
											<div class="legacy-products-list-body">
												<div>
													<h4 class="legacy-products-list-title"><a href="{{ url('product/'. $product->slug) }}">{{ $product->name }}</a></h4>
													<div class="legacy-products-list-price">Rp{{ number_format($product->priceLabel()) }}</div>
												</div>
												<div class="legacy-products-list-meta">
													<span><i class="fas fa-box"></i> Stok: {{ $stock }}</span>
													<span><i class="fas fa-tag"></i> {{ ucfirst($product->type) }}</span>
												</div>
												<p class="legacy-products-list-copy">{!! $product->short_description !!}</p>
												<div class="legacy-products-list-actions">
													<a class="legacy-products-list-cta add-to-card" href="" product-id="{{ $product->id }}" product-type="{{ $product->type }}" product-slug="{{ $product->slug }}"><i class="pe-7s-cart"></i> Add to cart</a>
													<a class="add-to-fav" title="Favorite" product-slug="{{ $product->slug }}" href=""><i class="pe-7s-like"></i></a>
													<a class="quick-view" data-toggle="modal" data-target="#exampleModal" title="Quick View" product-slug="{{ $product->slug }}" href=""><i class="pe-7s-look"></i></a>
												</div>
											</div>
										</div>
									@empty
										<div class="legacy-products-empty">No product found!</div>
									@endforelse
								</div>
							</div>
						</div>

						<div class="mt-4 text-center">
							{{ $products->links() }}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
