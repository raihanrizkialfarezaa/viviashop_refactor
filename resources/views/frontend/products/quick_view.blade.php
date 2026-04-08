@once
<style>
    .legacy-quickview-shell {
        display: grid;
        grid-template-columns: minmax(0, 1.05fr) minmax(0, 0.95fr);
        gap: 18px;
        align-items: start;
    }

    .legacy-quickview-gallery,
    .legacy-quickview-summary {
        border-radius: 28px;
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: 0 22px 40px rgba(15,81,50,0.08);
        padding: 18px;
    }

    .legacy-quickview-main {
        overflow: hidden;
        border-radius: 24px;
        background: linear-gradient(180deg, #f5faf7 0%, #ffffff 100%);
        min-height: 340px;
    }

    .legacy-quickview-main .tab-pane {
        height: 100%;
    }

    .legacy-quickview-main img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .legacy-quickview-thumbs {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(70px, 1fr));
        gap: 10px;
        margin-top: 12px;
    }

    .legacy-quickview-thumbs a {
        display: block;
        overflow: hidden;
        border-radius: 18px;
        border: 1px solid rgba(15,81,50,0.1);
        background: #fff;
        min-height: 88px;
    }

    .legacy-quickview-thumbs a.active {
        border-color: rgba(15,81,50,0.22);
        box-shadow: 0 12px 22px rgba(15,81,50,0.08);
    }

    .legacy-quickview-thumbs img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .legacy-quickview-kicker {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 12px;
        margin-bottom: 0.9rem;
        border-radius: 999px;
        background: rgba(15,81,50,0.08);
        color: #0f5132;
        font-size: 0.76rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .legacy-quickview-title {
        margin: 0 0 0.55rem;
        color: #213547;
        font-family: 'Raleway', sans-serif;
        font-size: 1.85rem;
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -0.03em;
    }

    .legacy-quickview-summary .price .new {
        color: #0f5132;
        font-size: 1.35rem;
        font-weight: 900;
    }

    .legacy-quickview-copy,
    .legacy-quickview-stock,
    .legacy-quickview-summary p {
        color: #6b7b74;
        line-height: 1.7;
    }

    .legacy-quickview-select {
        margin-top: 1rem;
        padding: 18px;
        border-radius: 24px;
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,81,50,0.08);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.76);
    }

    .legacy-quickview-select .select-option-part + .select-option-part {
        margin-top: 14px;
    }

    .legacy-quickview-select label {
        display: block;
        margin-bottom: 0.55rem;
        color: #213547;
        font-weight: 800;
    }

    .legacy-quickview-select .select,
    .legacy-quickview-shell .cart-plus-minus-box {
        width: 100%;
        min-height: 48px;
        border-radius: 16px;
        border: 1px solid rgba(15,81,50,0.12);
        background: #fff;
        box-shadow: none;
    }

    #variant-details .alert {
        border-radius: 20px;
        border: 1px solid rgba(15,81,50,0.12);
        background: linear-gradient(180deg, rgba(243,250,246,0.98), rgba(255,255,255,0.96));
        color: #456157;
    }

    .legacy-quickview-shell .quickview-plus-minus {
        display: grid;
        grid-template-columns: 110px minmax(0, 1fr) 56px;
        gap: 12px;
        margin-top: 1rem;
    }

    .legacy-quickview-shell .quickview-btn-cart button,
    .legacy-quickview-shell .quickview-btn-wishlist a {
        width: 100%;
        min-height: 50px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        font-weight: 800;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .legacy-quickview-shell .quickview-btn-cart button {
        border: 0;
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        box-shadow: 0 16px 28px rgba(15,81,50,0.14);
    }

    .legacy-quickview-shell .quickview-btn-wishlist a {
        background: rgba(255,255,255,0.96);
        border: 1px solid rgba(15,81,50,0.12);
        color: #0f5132;
        box-shadow: 0 12px 22px rgba(15,81,50,0.06);
    }

    .legacy-quickview-shell .quickview-btn-cart button:hover,
    .legacy-quickview-shell .quickview-btn-wishlist a:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .legacy-quickview-shell .quickview-btn-cart button:hover {
        color: #fff;
        box-shadow: 0 22px 34px rgba(15,81,50,0.18);
    }

    .legacy-quickview-shell .quickview-btn-wishlist a:hover {
        color: #0f5132;
        box-shadow: 0 18px 28px rgba(15,81,50,0.1);
    }

    @media (max-width: 991px) {
        .legacy-quickview-shell {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 767px) {
        .legacy-quickview-gallery,
        .legacy-quickview-summary,
        .legacy-quickview-select {
            border-radius: 24px;
        }

        .legacy-quickview-shell .quickview-plus-minus {
            grid-template-columns: 1fr;
        }

        .legacy-quickview-shell .quickview-btn-wishlist a {
            justify-content: center;
            gap: 10px;
            padding: 0 18px;
        }

        .legacy-quickview-shell .quickview-btn-wishlist a::after {
            content: 'Wishlist';
            font-size: 0.92rem;
            line-height: 1;
        }
    }
</style>
@endonce

@php
	$quickViewStock = $product->type == 'configurable' ? $product->total_stock : ($product->productInventory->qty ?? 0);
@endphp

<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	<span class="pe-7s-close" aria-hidden="true"></span>
</button>
<div class="modal-dialog modal-quickview-width" role="document">
	<div class="modal-content">
		<div class="modal-body">
			<div class="legacy-quickview-shell">
				<div class="legacy-quickview-gallery">
					<div class="quick-view-tab-content tab-content legacy-quickview-main">
						@php $i = 1 @endphp
						@foreach ($product->productImages as $image)
							<div class="tab-pane fade {{ ($i == 1) ? 'active show' : '' }}" id="modal{{ $i}}" role="tabpanel">
								@if ($image->path)
									<img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
								@else
									<img src="{{ asset('themes/ezone/assets/img/quick-view/l3.jpg') }}" alt="{{ $product->name }}">
								@endif
							</div>
							@php $i++ @endphp
						@endforeach
					</div>
					<div class="quick-view-list nav legacy-quickview-thumbs" role="tablist">
						@php $i = 1 @endphp
						@foreach ($product->productImages as $image)
							<a class="{{ ($i == 1) ? 'active' : '' }}" href="#modal{{ $i }}" data-toggle="tab" role="tab">
								@if ($image->path)
									<img src="{{ asset('storage/'.$image->path) }}" alt="{{ $product->name }}">
								@else
									<img src="{{ asset('themes/ezone/assets/img/quick-view/s3.jpg') }}" alt="{{ $product->name }}">
								@endif
							</a>
							@php $i++ @endphp
						@endforeach
					</div>
				</div>

				<div class="legacy-quickview-summary">
					<span class="legacy-quickview-kicker"><i class="fas fa-eye"></i> Quick View</span>
					<h3 class="legacy-quickview-title">{{ $product->name }}</h3>
					<div class="price"><span class="new">{{ number_format($product->priceLabel()) }}</span></div>
					<p class="legacy-quickview-copy">{{ $product->short_description }}</p>
					<p class="legacy-quickview-stock">Stok : {{ $quickViewStock }}</p>

					<form action="{{ route('carts.store') }}" method="post" id="quick-view-form">
						@csrf 
						<input type="hidden" name="product_id" value="{{ $product->id }}">
						<input type="hidden" name="variant_id" id="selected-variant-id" value="">
						
						@if ($product->configurable())
							<div class="quick-view-select legacy-quickview-select">
								@php $variantOptions = $product->getVariantOptions(); @endphp
								@foreach($variantOptions as $attributeName => $options)
									<div class="select-option-part">
										<label>{{ ucfirst($attributeName) }}*</label>
										<select name="variant_attributes[{{ $attributeName }}]" class="select variant-select" data-attribute="{{ $attributeName }}" required>
											<option value="">Pilih {{ ucfirst($attributeName) }}</option>
											@foreach($options as $option)
												<option value="{{ $option }}">{{ $option }}</option>
											@endforeach
										</select>
									</div>
								@endforeach
								
								<div id="variant-details" class="mt-3" style="display: none;">
									<div class="alert alert-info">
										<h6 class="mb-2"><i class="fas fa-tag"></i> <strong>Selected Variant:</strong></h6>
										<div class="variant-name mb-2"><strong>Name:</strong> <span id="variant-name" class="text-primary">-</span></div>
										<div class="variant-attributes mb-2"><strong>Attributes:</strong> <span id="variant-attributes" class="text-secondary">-</span></div>
										<div class="row">
											<div class="col-4"><small><strong>SKU:</strong> <span id="variant-sku">-</span></small></div>
											<div class="col-4"><small><strong>Price:</strong> <span id="variant-price">-</span></small></div>
											<div class="col-4"><small><strong>Stock:</strong> <span id="variant-stock">-</span></small></div>
										</div>
									</div>
								</div>
							</div>
						@endif

						<div class="quickview-plus-minus">
							<div class="cart-plus-minus">
								<input type="number" name="qty" value="1" class="cart-plus-minus-box" min="1" max="999">
							</div>
							<div class="quickview-btn-cart">
								<button type="submit" class="submit contact-btn btn-hover" id="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> add to cart</button>
							</div>
							<div class="quickview-btn-wishlist">
								<a class="btn-hover" href="#"><i class="pe-7s-like"></i></a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

@if ($product->configurable())
<script>
document.addEventListener('DOMContentLoaded', function() {
    const variantSelects = document.querySelectorAll('.variant-select');
    const productPrice = document.querySelector('.price .new');
    const variantDetails = document.getElementById('variant-details');
    const variantSku = document.getElementById('variant-sku');
    const variantPrice = document.getElementById('variant-price');
    const variantName = document.getElementById('variant-name');
    const variantAttributes = document.getElementById('variant-attributes');
    const variantStock = document.getElementById('variant-stock');
    const selectedVariantId = document.getElementById('selected-variant-id');
    const addToCartBtn = document.getElementById('add-to-cart-btn');
    const qtyInput = document.querySelector('input[name="qty"]');

    let selectedAttributes = {};

    function updateVariantInfo() {
        let allSelected = true;

        variantSelects.forEach(select => {
            if (select.value) {
                selectedAttributes[select.dataset.attribute] = select.value;
            } else {
                allSelected = false;
            }
        });

        if (allSelected) {
            fetch(`{{ route('api.products.variant-by-attributes', $product->id) }}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    attributes: selectedAttributes
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.data) {
                    const variant = data.data;
                    selectedVariantId.value = variant.id;
                    productPrice.textContent = variant.formatted_price;
                    
                    // Update variant details
                    variantName.textContent = variant.name;
                    variantSku.textContent = variant.sku;
                    variantPrice.textContent = variant.formatted_price;
                    variantStock.textContent = variant.stock;
                    
                    // Format attributes display
                    if (variant.attributes && Object.keys(variant.attributes).length > 0) {
                        const attributesList = Object.entries(variant.attributes)
                            .map(([key, value]) => `${key}: ${value}`)
                            .join(', ');
                        variantAttributes.textContent = attributesList;
                    } else {
                        variantAttributes.textContent = '-';
                    }
                    
                    variantDetails.style.display = 'block';
                    addToCartBtn.disabled = !variant.is_available;
                    addToCartBtn.innerHTML = variant.is_available ? '<i class="fa fa-shopping-cart"></i> add to cart' : 'Out of Stock';
                    qtyInput.max = variant.stock;
                } else {
                    resetVariantInfo();
                }
            })
            .catch(error => {
                console.error('Error:', error);
                resetVariantInfo();
            });
        } else {
            resetVariantInfo();
        }
    }

    function resetVariantInfo() {
        selectedVariantId.value = '';
        productPrice.textContent = '{{ number_format($product->priceLabel()) }}';
        variantDetails.style.display = 'none';
        addToCartBtn.disabled = true;
        addToCartBtn.innerHTML = 'Select Variant';
        qtyInput.max = 999;
    }

    variantSelects.forEach(select => {
        select.addEventListener('change', updateVariantInfo);
    });

    resetVariantInfo();

    document.getElementById('quick-view-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (!selectedVariantId.value) {
            alert('Please select a product variant');
            return;
        }

        const formData = new FormData(this);
        
        fetch('{{ route("carts.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Product added to cart successfully!');
                location.reload();
            } else {
                alert('Error adding product to cart: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error adding product to cart');
        });
    });
});
</script>
@endif