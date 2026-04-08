@extends('frontend.layouts')

@push('styles')
<style>
    .legacy-product-header {
        position: relative;
        margin-top: 18px;
        padding: 5.4rem 0 6.25rem;
        border-radius: 0 0 42px 42px;
        background:
            radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
            linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
        overflow: hidden;
    }

    .legacy-product-header::after {
        content: '';
        position: absolute;
        right: -120px;
        top: -110px;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
    }

    .legacy-product-hero {
        position: relative;
        z-index: 1;
        max-width: 840px;
        margin-left: auto;
        margin-right: auto;
    }

    .legacy-product-kicker,
    .legacy-product-chip,
    .legacy-product-tab-kicker {
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

    .legacy-product-kicker {
        margin-bottom: 1rem;
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
    }

    .legacy-product-header .breadcrumb-item,
    .legacy-product-header .breadcrumb-item a {
        color: rgba(255,255,255,0.82) !important;
        text-decoration: none;
    }

    .legacy-product-header .breadcrumb-item.active {
        color: #fff !important;
    }

    .legacy-product-stage {
        margin-top: -74px;
    }

    .legacy-product-alert,
    .legacy-product-gallery,
    .legacy-product-summary,
    .legacy-product-tabs-shell {
        border-radius: 32px;
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: 0 26px 48px rgba(15,81,50,0.08);
    }

    .legacy-product-alert {
        border: none;
        margin-bottom: 1rem;
    }

    .legacy-product-gallery,
    .legacy-product-summary,
    .legacy-product-tabs-shell {
        padding: 24px;
    }

    .legacy-product-gallery-main {
        overflow: hidden;
        border-radius: 28px;
        background: linear-gradient(180deg, #f5faf7 0%, #ffffff 100%);
        border: 1px solid rgba(15,81,50,0.08);
        min-height: 520px;
    }

    .legacy-product-gallery-main .tab-pane,
    .legacy-product-gallery-main .easyzoom,
    .legacy-product-gallery-main a {
        display: block;
        height: 100%;
    }

    .legacy-product-gallery-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .legacy-product-thumbs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(90px, 1fr));
        gap: 12px;
        margin-top: 14px;
    }

    .legacy-product-thumbs a {
        display: block;
        overflow: hidden;
        border-radius: 20px;
        border: 1px solid rgba(15,81,50,0.1);
        background: #fff;
        min-height: 92px;
    }

    .legacy-product-thumbs a.active {
        box-shadow: 0 12px 22px rgba(15,81,50,0.12);
        border-color: rgba(15,81,50,0.22);
    }

    .legacy-product-thumbs img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .legacy-product-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 1rem;
    }

    .legacy-product-chip {
        background: rgba(15,81,50,0.08);
        color: #0f5132;
    }

    .legacy-product-title {
        margin: 0 0 0.65rem;
        color: #213547;
        font-family: 'Raleway', sans-serif;
        font-size: clamp(2rem, 3vw, 2.6rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -0.03em;
    }

    .legacy-product-copy,
    .legacy-product-summary p,
    .legacy-product-tab-pane {
        color: #6b7b74;
        line-height: 1.8;
    }

    .legacy-product-price {
        margin: 1rem 0;
        color: #0f5132;
        font-size: 1.65rem;
        font-weight: 900;
    }

    .legacy-product-selection,
    .selected-variant-info {
        padding: 18px;
        border-radius: 24px;
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.76);
    }

    .legacy-product-selection {
        margin-top: 1rem;
    }

    .variant-option-group + .variant-option-group {
        margin-top: 14px;
    }

    .variant-label {
        display: block;
        margin-bottom: 0.55rem;
        color: #213547;
        font-weight: 800;
    }

    .variant-selector,
    .cart-plus-minus-box {
        width: 100%;
        min-height: 50px;
        border-radius: 16px;
        border: 1px solid rgba(15,81,50,0.12);
        background: #fff;
        box-shadow: none;
    }

    .selected-variant-info {
        display: grid;
        gap: 8px;
        margin-top: 14px;
        color: #456157;
    }

    .selected-variant-info strong,
    .selected-variant-info span,
    .legacy-product-stock {
        color: #0f5132;
    }

    .quickview-plus-minus {
        display: grid;
        grid-template-columns: 120px minmax(0, 1fr) 56px;
        gap: 12px;
        margin-top: 1rem;
    }

    .quickview-btn-cart button,
    .quickview-btn-wishlist a {
        width: 100%;
        min-height: 52px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 800;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .quickview-btn-cart button {
        border: 0;
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        box-shadow: 0 16px 28px rgba(15,81,50,0.14);
    }

    .quickview-btn-wishlist a {
        background: rgba(255,255,255,0.96);
        border: 1px solid rgba(15,81,50,0.12);
        color: #0f5132;
        box-shadow: 0 12px 22px rgba(15,81,50,0.06);
    }

    .quickview-btn-cart button:hover,
    .quickview-btn-wishlist a:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .quickview-btn-cart button:hover {
        color: #fff;
        box-shadow: 0 22px 34px rgba(15,81,50,0.18);
    }

    .quickview-btn-wishlist a:hover {
        color: #0f5132;
        box-shadow: 0 18px 28px rgba(15,81,50,0.1);
    }

    .legacy-product-links {
        display: grid;
        gap: 14px;
        margin-top: 1.4rem;
    }

    .legacy-product-links ul {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        padding: 0;
        margin: 0;
        list-style: none;
    }

    .legacy-product-links .categories-title {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15,81,50,0.08);
        color: #0f5132;
        font-weight: 800;
    }

    .legacy-product-links a {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        background: rgba(15,81,50,0.05);
        color: #456157;
        text-decoration: none;
        font-weight: 700;
    }

    .legacy-product-links a:hover {
        background: rgba(15,81,50,0.1);
        color: #0f5132;
    }

    .legacy-product-tabs-shell {
        margin-top: 1.6rem;
    }

    .description-review-title {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px;
        margin-bottom: 1.3rem;
        border-radius: 999px;
        background: rgba(15,81,50,0.06);
    }

    .description-review-title a {
        padding: 12px 18px;
        border-radius: 999px;
        color: #456157;
        text-decoration: none;
        font-weight: 800;
    }

    .description-review-title a.active,
    .description-review-title a:hover {
        background: #fff;
        color: #0f5132;
        box-shadow: 0 10px 18px rgba(15,81,50,0.08);
    }

    .legacy-product-tab-pane a {
        color: #0f5132;
        font-weight: 800;
        text-decoration: none;
    }

    @media (max-width: 991px) {
        .legacy-product-gallery-main {
            min-height: 420px;
        }
    }

    @media (max-width: 767px) {
        .legacy-product-header {
            padding: 5rem 0 5.8rem;
            border-radius: 0 0 28px 28px;
        }

        .legacy-product-stage {
            margin-top: -54px;
        }

        .legacy-product-alert,
        .legacy-product-gallery,
        .legacy-product-summary,
        .legacy-product-tabs-shell,
        .legacy-product-selection,
        .selected-variant-info {
            border-radius: 24px;
        }

        .legacy-product-gallery,
        .legacy-product-summary,
        .legacy-product-tabs-shell {
            padding: 18px;
        }

        .legacy-product-gallery-main {
            min-height: 320px;
        }

        .quickview-plus-minus {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 575px) {
        .legacy-product-title {
            font-size: 1.7rem;
        }

        .description-review-title {
            display: grid;
            width: 100%;
            gap: 10px;
            border-radius: 22px;
        }

        .description-review-title a {
            width: 100%;
            text-align: center;
        }

        .legacy-product-links ul {
            flex-direction: column;
            align-items: stretch;
        }

        .legacy-product-links .categories-title,
        .legacy-product-links a {
            width: 100%;
            justify-content: center;
        }
    }
</style>
@endpush

@section('content')
	@php
		$stock = $product->type == 'configurable' ? $product->total_stock : ($product->productInventory->qty ?? 0);
	@endphp

	<div class="container-fluid page-header legacy-product-header py-5">
		<div class="container">
			<div class="legacy-product-hero text-center">
				<span class="legacy-product-kicker"><i class="fas fa-box-open"></i> Product Detail</span>
				<h1 class="text-white display-5 fw-bold mb-3">{{ $product->name }}</h1>
				<p class="text-white-50 lead mb-3">Route detail produk lama sekarang disejajarkan dengan visual storefront baru, tanpa mengubah form cart, varian, atau JavaScript yang sudah bekerja.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item"><a href="{{ url('products') }}">Products</a></li>
					<li class="breadcrumb-item active text-white">{{ $product->name }}</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid legacy-product-stage py-5">
		<div class="container pb-5">
			@if(session()->has('message'))
				<div class="alert legacy-product-alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
					<strong>{{ session()->get('message') }}</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			@endif

			<div class="row g-4 align-items-start">
				<div class="col-lg-7">
					<div class="legacy-product-gallery">
						<div class="product-details-large tab-content legacy-product-gallery-main">
							@php $i = 1 @endphp
							@forelse ($product->productImages as $image)
								<div class="tab-pane fade {{ ($i == 1) ? 'active show' : '' }}" id="pro-details{{ $i}}" role="tabpanel">
									<div class="easyzoom easyzoom--overlay">
										@if ($image->path)
											<a href="{{ asset('storage/'.$image->path) }}">
												<img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
											</a>
										@else
											<a href="{{ asset('themes/ezone/assets/img/product-details/bl1.jpg') }}">
												<img src="{{ asset('themes/ezone/assets/img/product-details/l1.jpg') }}" alt="{{ $product->name }}">
											</a>
										@endif
									</div>
								</div>
								@php $i++ @endphp
							@empty
								<div class="tab-pane fade active show" id="pro-details1" role="tabpanel">
									<div class="easyzoom easyzoom--overlay">
										<a href="{{ asset('themes/ezone/assets/img/product-details/bl1.jpg') }}">
											<img src="{{ asset('themes/ezone/assets/img/product-details/l1.jpg') }}" alt="{{ $product->name }}">
										</a>
									</div>
								</div>
							@endforelse
						</div>

						<div class="product-details-small nav legacy-product-thumbs" role="tablist">
							@php $i = 1 @endphp
							@forelse ($product->productImages as $image)
								<a class="{{ ($i == 1) ? 'active' : '' }}" href="#pro-details{{ $i }}" data-toggle="tab" role="tab" aria-selected="true">
									@if ($image->path)
										<img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
									@else
										<img src="{{ asset('themes/ezone/assets/img/product-details/s1.jpg') }}" alt="{{ $product->name }}">
									@endif
								</a>
								@php $i++ @endphp
							@empty
								<a class="active" href="#pro-details1" data-toggle="tab" role="tab" aria-selected="true">
									<img src="{{ asset('themes/ezone/assets/img/product-details/s1.jpg') }}" alt="{{ $product->name }}">
								</a>
							@endforelse
						</div>
					</div>
				</div>

				<div class="col-lg-5">
					<div class="legacy-product-summary">
						<div class="legacy-product-meta">
							<span class="legacy-product-chip"><i class="fas fa-tag"></i> {{ ucfirst($product->type) }}</span>
							<span class="legacy-product-chip"><i class="fas fa-box"></i> Stok {{ $stock }}</span>
						</div>
						<h2 class="legacy-product-title">{{ $product->name }}</h2>
						<div class="details-price legacy-product-price">
							<span>Rp{{ number_format($product->priceLabel()) }}</span>
						</div>
						<p class="legacy-product-copy">{{ $product->short_description }}</p>

						<form action="{{ route('carts.store') }}" method="post" id="addToCartForm">
							@csrf
							<input type="hidden" name="product_id" value="{{ $product->id }}">
							<input type="hidden" name="variant_id" id="selectedVariantId" value="">

							@if ($product->type == 'configurable')
								@php $variantOptions = $product->getVariantOptions(); @endphp
								@if(!empty($variantOptions))
									<div class="legacy-product-selection variant-selection-area">
										@foreach($variantOptions as $attributeName => $values)
											<div class="variant-option-group">
												<label class="variant-label">{{ ucfirst($attributeName) }} *</label>
												<select class="variant-selector form-control" data-attribute="{{ $attributeName }}" required>
													<option value="">Pilih {{ $attributeName }}</option>
													@foreach($values as $value)
														<option value="{{ $value }}">{{ $value }}</option>
													@endforeach
												</select>
											</div>
										@endforeach

										<div class="selected-variant-info mt-3" style="display: none;">
											<div class="variant-price"><strong>Harga: <span id="variantPrice">-</span></strong></div>
											<div class="variant-stock"><span>Stok: <span id="variantStock">-</span></span></div>
											<div class="variant-sku"><small>SKU: <span id="variantSku">-</span></small></div>
										</div>
									</div>
								@endif
							@else
								<p class="legacy-product-stock mt-3 mb-0">Stok : {{ $stock }}</p>
							@endif

							<div class="quickview-plus-minus">
								<div class="cart-plus-minus">
									<input type="number" name="qty" value="1" class="cart-plus-minus-box" min="1">
								</div>
								<div class="quickview-btn-cart">
									<button type="submit" class="submit contact-btn btn-hover">add to cart</button>
								</div>
								<div class="quickview-btn-wishlist">
									<a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
								</div>
							</div>
						</form>

						<div class="legacy-product-links">
							<ul>
								<li class="categories-title">Categories</li>
								@foreach ($product->categories as $category)
									<li><a href="{{ url('products?category='. $category->slug ) }}">{{ $category->name }}</a></li>
								@endforeach
							</ul>
							<ul>
								<li class="categories-title">Share</li>
								<li><a href="#"><i class="icofont icofont-social-facebook"></i></a></li>
								<li><a href="#"><i class="icofont icofont-social-twitter"></i></a></li>
								<li><a href="#"><i class="icofont icofont-social-pinterest"></i></a></li>
								<li><a href="#"><i class="icofont icofont-social-flikr"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>

			<div class="legacy-product-tabs-shell">
				<div class="product-description-review text-center">
					<div class="description-review-title nav" role="tablist">
						<a class="active" href="#pro-dec" data-toggle="tab" role="tab" aria-selected="true">Description</a>
						<a href="#pro-review" data-toggle="tab" role="tab" aria-selected="false">Reviews (0)</a>
					</div>
					<div class="description-review-text tab-content">
						<div class="tab-pane active show fade legacy-product-tab-pane" id="pro-dec" role="tabpanel">
							<p>{!! $product->description !!}</p>
						</div>
						<div class="tab-pane fade legacy-product-tab-pane" id="pro-review" role="tabpanel">
							<a href="#">Be the first to write your review!</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    let productVariants = @json($product->type == 'configurable' ? $product->productVariants : []);
    let selectedAttributes = {};
    
    // Handle variant selector changes
    $('.variant-selector').on('change', function() {
        const attributeName = $(this).data('attribute');
        const selectedValue = $(this).val();
        
        if (selectedValue) {
            selectedAttributes[attributeName] = selectedValue;
        } else {
            delete selectedAttributes[attributeName];
        }
        
        updateVariantSelection();
    });
    
    function updateVariantSelection() {
        // Find matching variant based on selected attributes
        const matchingVariant = findMatchingVariant();
        
        if (matchingVariant) {
            // Show variant info
            $('.selected-variant-info').show();
            $('#variantPrice').text('Rp ' + new Intl.NumberFormat('id-ID').format(matchingVariant.price));
            $('#variantStock').text(matchingVariant.stock);
            $('#variantSku').text(matchingVariant.sku);
            $('#selectedVariantId').val(matchingVariant.id);
            
            // Update main price display
            $('.details-price span').text('Rp ' + new Intl.NumberFormat('id-ID').format(matchingVariant.price));
            
            // Enable/disable add to cart based on stock
            const addToCartBtn = $('.quickview-btn-cart button');
            if (matchingVariant.stock > 0) {
                addToCartBtn.prop('disabled', false).text('add to cart');
                $('.cart-plus-minus-box').attr('max', matchingVariant.stock);
            } else {
                addToCartBtn.prop('disabled', true).text('out of stock');
                $('.cart-plus-minus-box').attr('max', 0);
            }
        } else {
            $('.selected-variant-info').hide();
            $('#selectedVariantId').val('');
            $('.quickview-btn-cart button').prop('disabled', true).text('select variant');
        }
    }
    
    function findMatchingVariant() {
        return productVariants.find(variant => {
            return variant.variant_attributes.every(attr => {
                return selectedAttributes[attr.attribute_name] === attr.attribute_value;
            });
        });
    }
    
    // Form submission validation
    $('#addToCartForm').on('submit', function(e) {
        if ($('#selectedVariantId').val() === '' && productVariants.length > 0) {
            e.preventDefault();
            alert('Silakan pilih varian produk terlebih dahulu.');
            return false;
        }
    });
});
</script>
@endpush
