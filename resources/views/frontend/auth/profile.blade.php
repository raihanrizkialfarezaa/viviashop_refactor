@extends('frontend.layouts')

@push('styles')
<style>
	.profile-page-header {
		position: relative;
		margin-top: 18px;
		padding: 5.5rem 0 6.4rem;
		border-radius: 0 0 42px 42px;
		background:
			radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
			radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
			linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
		overflow: hidden;
	}

	.profile-page-header::after {
		content: '';
		position: absolute;
		inset: auto -120px -180px auto;
		width: 360px;
		height: 360px;
		border-radius: 50%;
		background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
	}

	.profile-hero-content {
		position: relative;
		z-index: 1;
		max-width: 780px;
		margin: 0 auto;
	}

	.profile-kicker,
	.profile-section-kicker {
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

	.profile-kicker {
		margin-bottom: 1rem;
		background: rgba(255,255,255,0.14);
		border: 1px solid rgba(255,255,255,0.18);
		color: #fff;
		backdrop-filter: blur(10px);
		-webkit-backdrop-filter: blur(10px);
	}

	.profile-page-header .breadcrumb-item,
	.profile-page-header .breadcrumb-item a {
		color: rgba(255,255,255,0.82) !important;
		text-decoration: none;
	}

	.profile-page-header .breadcrumb-item.active {
		color: #fff !important;
	}

	.profile-stage {
		margin-top: -74px;
	}

	.profile-sidebar-shell,
	.profile-surface,
	.profile-stat-card {
		border-radius: 32px;
		border: 1px solid rgba(15,81,50,0.08);
		background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
		box-shadow: 0 26px 48px rgba(15,81,50,0.08);
	}

	.profile-sidebar-shell {
		padding: 14px;
	}

	.profile-surface {
		padding: 26px;
	}

	.profile-alert {
		border: none;
		border-radius: 20px;
		margin-bottom: 1rem;
	}

	.profile-section-head {
		display: flex;
		justify-content: space-between;
		gap: 16px;
		align-items: flex-start;
		margin-bottom: 1.5rem;
	}

	.profile-section-kicker {
		margin-bottom: 0.9rem;
		background: rgba(15,81,50,0.06);
		color: #0f5132;
	}

	.profile-section-head h2 {
		margin: 0 0 0.4rem;
		font-family: 'Raleway', sans-serif;
		font-size: clamp(1.7rem, 3vw, 2.3rem);
		font-weight: 800;
		line-height: 1.06;
		letter-spacing: -0.03em;
		color: #213547;
	}

	.profile-section-head p,
	.profile-note {
		margin: 0;
		color: #6b7b74;
		line-height: 1.7;
	}

	.profile-stat-grid,
	.profile-form-grid {
		display: grid;
		gap: 14px;
	}

	.profile-stat-grid {
		grid-template-columns: repeat(3, minmax(0, 1fr));
		margin-bottom: 1.5rem;
	}

	.profile-stat-card {
		padding: 18px 20px;
	}

	.profile-stat-card small {
		display: block;
		margin-bottom: 0.45rem;
		color: #6b7b74;
		font-size: 0.78rem;
		font-weight: 800;
		letter-spacing: 0.08em;
		text-transform: uppercase;
	}

	.profile-stat-card strong {
		display: block;
		color: #0f5132;
		font-size: 1.05rem;
		line-height: 1.5;
		word-break: break-word;
	}

	.profile-form-grid {
		grid-template-columns: repeat(12, minmax(0, 1fr));
	}

	.profile-field {
		display: flex;
		flex-direction: column;
		gap: 0.65rem;
		padding: 18px 18px 16px;
		border-radius: 24px;
		background: rgba(255,255,255,0.82);
		border: 1px solid rgba(15,81,50,0.08);
		box-shadow: inset 0 1px 0 rgba(255,255,255,0.75);
	}

	.profile-field--half {
		grid-column: span 6;
	}

	.profile-field--third {
		grid-column: span 4;
	}

	.profile-field--full {
		grid-column: span 12;
	}

	.profile-field label {
		margin: 0;
		color: #213547;
		font-size: 0.92rem;
		font-weight: 800;
	}

	.profile-field label span {
		color: #198754;
	}

	.profile-field .form-control,
	.profile-field select {
		width: 100%;
		min-height: 52px;
		border-radius: 16px;
		border: 1px solid rgba(15,81,50,0.12);
		background: #fff;
		color: #213547;
		box-shadow: none;
	}

	.profile-field .form-control:focus,
	.profile-field select:focus {
		border-color: rgba(25,135,84,0.52);
		box-shadow: 0 0 0 0.22rem rgba(25,135,84,0.14);
	}

	.profile-help {
		color: #7a8982;
		font-size: 0.84rem;
		line-height: 1.6;
	}

	.field-error {
		color: #c1121f;
		font-size: 0.84rem;
		font-weight: 700;
	}

	.profile-action-row {
		display: flex;
		justify-content: flex-end;
		margin-top: 1.4rem;
	}

	.profile-submit {
		min-width: 210px;
		min-height: 52px;
		border: 0;
		border-radius: 18px;
		background: linear-gradient(90deg, #0f5132, #22a06b);
		color: #fff;
		font-weight: 800;
		box-shadow: 0 18px 28px rgba(15,81,50,0.14);
		transition: transform 0.22s ease, box-shadow 0.22s ease;
	}

	.profile-submit:hover {
		color: #fff;
		transform: translateY(-2px);
		box-shadow: 0 22px 34px rgba(15,81,50,0.18);
	}

	@media (max-width: 991px) {
		.profile-stat-grid {
			grid-template-columns: 1fr;
		}

		.profile-field--half,
		.profile-field--third,
		.profile-field--full {
			grid-column: span 12;
		}
	}

	@media (max-width: 767px) {
		.profile-page-header {
			padding: 5rem 0 5.8rem;
			border-radius: 0 0 28px 28px;
		}

		.profile-stage {
			margin-top: -54px;
		}

		.profile-sidebar-shell,
		.profile-surface,
		.profile-stat-card,
		.profile-field {
			border-radius: 24px;
		}

		.profile-surface {
			padding: 20px;
		}

		.profile-action-row {
			justify-content: stretch;
		}

		.profile-submit {
			width: 100%;
		}
	}
</style>
@endpush

@section('content')
	<div class="container-fluid page-header profile-page-header py-5">
		<div class="container">
			<div class="profile-hero-content text-center">
				<span class="profile-kicker"><i class="fas fa-user-gear"></i> Customer Profile</span>
				<h1 class="text-white display-5 fw-bold mb-3">Atur Detail Akun dan Alamat Anda</h1>
				<p class="text-white-50 lead mb-3">Form yang sama sekarang dibuat lebih jelas, lebih rapi, dan lebih aman dipakai di mobile tanpa mengubah field atau alur update yang sudah ada.</p>
				<ol class="breadcrumb justify-content-center mb-0">
					<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
					<li class="breadcrumb-item active text-white">Profile</li>
				</ol>
			</div>
		</div>
	</div>

	<div class="container-fluid profile-stage py-5">
		<div class="container pb-5">
			<div class="row g-4 align-items-start">
				<div class="col-lg-4 col-xl-3">
					<div class="profile-sidebar-shell">
						@include('frontend.partials.user_menu')
					</div>
				</div>
				<div class="col-lg-8 col-xl-9">
					@if(session()->has('message'))
						<div class="alert profile-alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert">
							<strong>{{ session()->get('message') }}</strong>
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
					@endif

					<div class="profile-surface">
						<div class="profile-section-head">
							<div>
								<span class="profile-section-kicker"><i class="fas fa-address-card"></i> Account Details</span>
								<h2>Update Profil Dengan Lebih Nyaman</h2>
								<p>Semua field lama tetap dipakai apa adanya. Yang berubah hanya susunan visual, hirarki informasi, dan kenyamanan saat mengisi dari layar kecil.</p>
							</div>
						</div>

						<div class="profile-stat-grid">
							<div class="profile-stat-card">
								<small>Email</small>
								<strong>{{ auth()->user()->email }}</strong>
							</div>
							<div class="profile-stat-card">
								<small>Phone</small>
								<strong>{{ auth()->user()->phone ?: 'Belum diisi' }}</strong>
							</div>
							<div class="profile-stat-card">
								<small>Postcode</small>
								<strong>{{ auth()->user()->postcode ?: 'Belum diisi' }}</strong>
							</div>
						</div>

						<form action="{{ url('profile') }}" method="post">
							@csrf
							@method('put')

							<div class="profile-form-grid">
								<div class="profile-field profile-field--half">
									<label>Nama <span>*</span></label>
									<input type="text" class="form-control" name="name" value="{{ old('name', auth()->user()->name) }}">
									<span class="profile-help">Nama ini akan dipakai di informasi akun pelanggan.</span>
									@error('name')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--half">
									<label>Email <span>*</span></label>
									<input class="form-control" name="email" type="email" value="{{ old('email', auth()->user()->email) }}" placeholder="Email">
									<span class="profile-help">Email aktif untuk komunikasi order dan akun.</span>
									@error('email')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--full">
									<label>Address <span>*</span></label>
									<input class="form-control" type="text" name="address1" value="{{ old('address1', auth()->user()->address1) }}">
									@error('address1')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--full">
									<label>Address Detail Tambahan</label>
									<input class="form-control" type="text" name="address2" value="{{ old('address2', auth()->user()->address2) }}">
									<span class="profile-help">Contoh: blok, lantai, patokan, atau catatan alamat.</span>
									@error('address2')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--third">
									<label>Provinsi <span>*</span></label>
									<select class="form-control" name="province_id" id="shipping-province">
										<option value="">-- Pilih Provinsi --</option>
										@foreach($provinces as $id => $province)
											<option value="{{ $id }}" {{ $id == auth()->user()->province_id ? 'selected' : '' }}>{{ $province }}</option>
										@endforeach
									</select>
									@error('province_id')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--third">
									<label>City <span>*</span></label>
									<select class="form-control" name="city_id" id="shipping-city">
										<option value="">-- Pilih Kota --</option>
										@if($cities)
											@foreach($cities as $id => $city)
												<option value="{{ $id }}" {{ $id == auth()->user()->city_id ? 'selected' : '' }}>{{ $city }}</option>
											@endforeach
										@endif
									</select>
									@error('city_id')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--third">
									<label>District <span>*</span></label>
									<select class="form-control" name="district_id" id="shipping-district">
										<option value="">-- Pilih Kecamatan --</option>
										@if($districts)
											@foreach($districts as $id => $district)
												<option value="{{ $id }}" {{ $id == auth()->user()->district_id ? 'selected' : '' }}>{{ $district }}</option>
											@endforeach
										@endif
									</select>
									@error('district_id')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--half">
									<label>Postcode / Zip <span>*</span></label>
									<input class="form-control" type="text" name="postcode" value="{{ old('postcode', auth()->user()->postcode) }}">
									@error('postcode')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>

								<div class="profile-field profile-field--half">
									<label>Phone <span>*</span></label>
									<input class="form-control" type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
									@error('phone')
										<span class="field-error">{{ $message }}</span>
									@enderror
								</div>
							</div>

							<div class="profile-action-row">
								<button type="submit" class="profile-submit">Update Profile</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@push('script-alt')
	<script>
		$(document).ready(function(){
			console.log('Profile page initialized');
			
			// Setup CSRF token for all AJAX requests
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			// Remove any existing event handlers to prevent duplicates
			$('#shipping-province').off('change');
			$('#shipping-city').off('change');
			
			// Auto-load cities if province is selected
			var userProvinceId = "{{ auth()->user()->province_id }}";
			console.log('User province ID:', userProvinceId);
			
			if (userProvinceId) {
				// Set the province dropdown value first
				$('#shipping-province').val(userProvinceId);
				// Then trigger change to load cities
				$('#shipping-province').trigger('change');
			}
		});

		$(document).on('change', '#shipping-province', function() {
			var province_id = $(this).val();
			console.log('Province changed to:', province_id);
			
			if (province_id) {
				var cityUrl = "{{ url('api/cities') }}/" + province_id + '?t=' + Date.now();
				console.log('Fetching cities from:', cityUrl);
				
				$.ajax({
					url: cityUrl,
					type: 'GET',
					success: function(response) {
						console.log('Cities loaded:', response.length, 'cities');
						var options = '<option value="">-- Pilih Kota --</option>';
						
						if (response && Array.isArray(response)) {
							$.each(response, function(index, city) {
								var selected = city.id == '{{ auth()->user()->city_id }}' ? 'selected' : '';
								options += '<option value="' + city.id + '" ' + selected + '>' + city.name + '</option>';
							});
						}
						
						$('#shipping-city').html(options);
						$('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
						
						// Auto-load districts if city is selected
						var selectedCityId = $('#shipping-city').val();
						if (selectedCityId) {
							console.log('Auto-loading districts for city:', selectedCityId);
							loadDistricts(selectedCityId);
						}
					},
					error: function(xhr, status, error) {
						console.error('Error loading cities:', error);
						$('#shipping-city').html('<option value="">Error loading cities</option>');
					}
				});
			} else {
				$('#shipping-city').html('<option value="">-- Pilih Kota --</option>');
				$('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
			}
		});
		
		$(document).on('change', '#shipping-city', function() {
			var city_id = $(this).val();
			console.log('City changed to:', city_id);
			loadDistricts(city_id);
		});
		
		function loadDistricts(city_id) {
			if (city_id) {
				var districtUrl = "{{ url('api/districts') }}/" + city_id + '?t=' + Date.now();
				console.log('Loading districts from:', districtUrl);
				
				$.ajax({
					url: districtUrl,
					type: 'GET',
					success: function(response) {
						console.log('Districts loaded:', response.length, 'districts');
						var options = '<option value="">-- Pilih Kecamatan --</option>';
						
						if (response && Array.isArray(response)) {
							$.each(response, function(index, district) {
								var selected = district.id == '{{ auth()->user()->district_id }}' ? 'selected' : '';
								options += '<option value="' + district.id + '" ' + selected + '>' + district.name + '</option>';
							});
						}
						$('#shipping-district').html(options);
					},
					error: function(xhr, status, error) {
						console.error('Error loading districts:', error);
						$('#shipping-district').html('<option value="">Error loading districts</option>');
					}
				});
			} else {
				$('#shipping-district').html('<option value="">-- Pilih Kecamatan --</option>');
			}
		}
	</script>
@endpush
