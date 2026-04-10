@extends('frontend.layouts')

@push('styles')
<style>
/* ================================================================
   ViviaShop â€” Profile Page
   ================================================================ */

.profile-page-header {
    position: relative;
    margin-top: 18px;
    padding: 5.5rem 0 7rem;
    border-radius: 0 0 48px 48px;
    overflow: hidden;
    background:
        radial-gradient(ellipse 65% 55% at 6%  8%,  rgba(32,201,151,0.26) 0%, transparent 100%),
        radial-gradient(ellipse 55% 65% at 94% 92%, rgba(255,255,255,0.10) 0%, transparent 100%),
        linear-gradient(148deg, #020f08 0%, #0a3822 36%, #0f5132 66%, #145c38 100%);
}

.profile-page-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(45deg, rgba(255,255,255,0.013) 0px, rgba(255,255,255,0.013) 1px, transparent 1px, transparent 38px);
    pointer-events: none;
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
    padding: 9px 16px;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.11em;
    text-transform: uppercase;
    white-space: nowrap;
}

.profile-kicker {
    margin-bottom: 1rem;
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.profile-page-header .breadcrumb-item a  { color: rgba(255,255,255,0.78) !important; text-decoration: none; }
.profile-page-header .breadcrumb-item.active { color: #fff !important; }
.profile-page-header .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

/* â”€â”€ Stage â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-stage {
    position: relative;
    z-index: 2;
    margin-top: -80px;
}

/* â”€â”€ Sidebar shell â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-sidebar-shell {
    border-radius: 32px;
    border: 1px solid rgba(15,81,50,0.09);
    background: linear-gradient(180deg, #fff 0%, #f3faf6 100%);
    box-shadow: 0 28px 52px rgba(15,81,50,0.09);
    padding: 14px;
}

/* â”€â”€ Main content card â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-surface {
    border-radius: 32px;
    border: 1px solid rgba(15,81,50,0.09);
    background: #fff;
    box-shadow: 0 28px 52px rgba(15,81,50,0.09);
    padding: 28px 30px;
}

/* â”€â”€ Alert â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-alert {
    border: none;
    border-radius: 16px;
    margin-bottom: 1rem;
}

/* â”€â”€ Section head â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-section-head {
    display: flex;
    justify-content: space-between;
    gap: 16px;
    align-items: flex-start;
    margin-bottom: 1.5rem;
}

.profile-section-kicker {
    margin-bottom: 0.85rem;
    background: rgba(15,81,50,0.07);
    border: 1px solid rgba(15,81,50,0.09);
    color: #0f5132;
}

.profile-section-head h2 {
    margin: 0 0 0.4rem;
    font-family: 'Raleway', sans-serif;
    font-size: clamp(1.6rem, 2.8vw, 2.1rem);
    font-weight: 800;
    line-height: 1.08;
    letter-spacing: -0.03em;
    color: #1a2e24;
}

.profile-section-head p,
.profile-note {
    margin: 0;
    color: #6b7b74;
    line-height: 1.68;
    font-size: 0.91rem;
}

/* â”€â”€ Stat grid â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-stat-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 1.5rem;
}

.profile-stat-card {
    padding: 16px 18px;
    border-radius: 22px;
    border: 1px solid rgba(15,81,50,0.08);
    background: linear-gradient(180deg, #f9fdfb 0%, #f3faf6 100%);
    box-shadow: 0 4px 12px rgba(15,81,50,0.05);
}

.profile-stat-icon {
    width: 34px;
    height: 34px;
    flex-shrink: 0;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(15,81,50,0.07);
    color: #0f5132;
    margin-bottom: 10px;
    font-size: 0.86rem;
}

.profile-stat-card small {
    display: block;
    margin-bottom: 0.4rem;
    color: #6b7b74;
    font-size: 0.74rem;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
}

.profile-stat-card strong {
    display: block;
    color: #1a2e24;
    font-size: 0.96rem;
    font-weight: 700;
    line-height: 1.45;
    word-break: break-word;
}

/* â”€â”€ Form grid â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-form-grid {
    display: grid;
    grid-template-columns: repeat(12, minmax(0, 1fr));
    gap: 12px;
}

/* â”€â”€ Section divider â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-form-section-divider {
    grid-column: span 12;
    display: flex;
    align-items: center;
    gap: 12px;
    margin: 6px 0 2px;
}

.profile-form-section-divider::before,
.profile-form-section-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: rgba(15,81,50,0.08);
}

.profile-form-section-divider span {
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 7px 14px;
    border-radius: 999px;
    background: rgba(15,81,50,0.06);
    border: 1px solid rgba(15,81,50,0.08);
    color: #0f5132;
    font-size: 0.75rem;
    font-weight: 800;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    white-space: nowrap;
}

/* â”€â”€ Fields â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-field {
    display: flex;
    flex-direction: column;
    gap: 8px;
    padding: 14px 16px 13px;
    border-radius: 20px;
    background: #f8fcfa;
    border: 1px solid rgba(15,81,50,0.09);
}

.profile-field--half  { grid-column: span 6; }
.profile-field--third { grid-column: span 4; }
.profile-field--full  { grid-column: span 12; }

.profile-field label {
    margin: 0;
    color: #1a2e24;
    font-size: 0.88rem;
    font-weight: 800;
    letter-spacing: 0.01em;
}

.profile-field label span { color: #198754; }

.profile-field .form-control,
.profile-field select {
    display: block;
    width: 100%;
    height: 46px;
    min-height: 46px;
    padding: 0 14px;
    border-radius: 14px !important;
    border: 1.5px solid rgba(15,81,50,0.14) !important;
    background-color: #fff !important;
    color: #1a2e24;
    font-size: 0.92rem;
    box-shadow: none !important;
    transition: border-color 0.22s ease, box-shadow 0.22s ease;
    -webkit-appearance: none;
    appearance: none;
}

.profile-field select {
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='8' viewBox='0 0 12 8'%3E%3Cpath d='M1 1l5 5 5-5' stroke='%23198754' stroke-width='1.5' fill='none' stroke-linecap='round'/%3E%3C/svg%3E") !important;
    background-repeat: no-repeat !important;
    background-position: right 14px center !important;
    padding-right: 38px !important;
}

.profile-field .form-control:focus,
.profile-field select:focus {
    background-color: #fff !important;
    border-color: #198754 !important;
    box-shadow: 0 0 0 4px rgba(25,135,84,0.12) !important;
    outline: none;
}

/* Chrome autofill fix */
.profile-field .form-control:-webkit-autofill,
.profile-field .form-control:-webkit-autofill:hover,
.profile-field .form-control:-webkit-autofill:focus,
.profile-field select:-webkit-autofill {
    -webkit-box-shadow: 0 0 0 100px #fff inset !important;
    -webkit-text-fill-color: #1a2e24 !important;
    caret-color: #1a2e24;
    transition: background-color 9999s ease-in-out 0s;
}

.profile-help {
    color: #7a8982;
    font-size: 0.81rem;
    line-height: 1.55;
    margin: 0;
}

.field-error {
    color: #c1121f;
    font-size: 0.81rem;
    font-weight: 700;
}

/* â”€â”€ Action row â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
.profile-action-row {
    display: flex;
    justify-content: flex-end;
    margin-top: 1.5rem;
}

.profile-submit {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-width: 220px;
    height: 52px;
    padding: 0 28px;
    border: none;
    border-radius: 16px;
    background: linear-gradient(135deg, #0a3321 0%, #0f5132 40%, #198754 80%, #22a06b 100%);
    color: #fff;
    font-family: 'Raleway', sans-serif;
    font-size: 0.95rem;
    font-weight: 800;
    letter-spacing: 0.025em;
    box-shadow:
        0 14px 28px rgba(15,81,50,0.22),
        0 3px 8px  rgba(15,81,50,0.14),
        inset 0 1px 0 rgba(255,255,255,0.18);
    cursor: pointer;
    transition: all 0.26s cubic-bezier(0.16,1,0.3,1);
    -webkit-appearance: none;
    appearance: none;
}

.profile-submit:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow:
        0 20px 38px rgba(15,81,50,0.26),
        0 5px 12px rgba(15,81,50,0.16),
        inset 0 1px 0 rgba(255,255,255,0.22);
}

.profile-submit:active { transform: translateY(-1px); }

/* â”€â”€ Responsive â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€â”€ */
@media (max-width: 991.98px) {
    .profile-stat-grid { grid-template-columns: 1fr; }
    .profile-field--half,
    .profile-field--third,
    .profile-field--full { grid-column: span 12; }
    .profile-stage { margin-top: -60px; }
}

@media (max-width: 767.98px) {
    .profile-page-header { padding: 4.6rem 0 6.2rem; border-radius: 0 0 32px 32px; }
    .profile-stage { margin-top: -50px; }
    .profile-surface { padding: 20px 18px; border-radius: 26px; }
    .profile-sidebar-shell { border-radius: 26px; }
    .profile-action-row { justify-content: stretch; }
    .profile-submit { width: 100%; min-width: unset; }
}

@media (max-width: 575.98px) {
    .profile-surface { padding: 18px 14px; }
    .profile-stat-grid { gap: 10px; }
    .profile-stat-card { padding: 14px; }
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
								<div class="profile-stat-icon"><i class="fas fa-envelope"></i></div>
								<small>Email</small>
								<strong>{{ auth()->user()->email }}</strong>
							</div>
							<div class="profile-stat-card">
								<div class="profile-stat-icon"><i class="fas fa-phone"></i></div>
								<small>Phone</small>
								<strong>{{ auth()->user()->phone ?: 'Belum diisi' }}</strong>
							</div>
							<div class="profile-stat-card">
								<div class="profile-stat-icon"><i class="fas fa-map-pin"></i></div>
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

								<div class="profile-form-section-divider">
									<span><i class="fas fa-map-marker-alt"></i> Alamat &amp; Kontak</span>
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
								<button type="submit" class="profile-submit"><i class="fas fa-save"></i> Simpan Perubahan</button>
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
