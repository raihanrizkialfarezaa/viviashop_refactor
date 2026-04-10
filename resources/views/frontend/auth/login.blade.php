@extends('frontend.layouts')

@push('styles')
	@include('frontend.auth.partials.entry-styles')
@endpush

@section('content')
<div class="container-fluid page-header auth-entry-header py-5">
	<div class="container">
		<div class="auth-entry-hero text-center">
			<span class="auth-entry-kicker"><i class="fas fa-sign-in-alt"></i> Customer Login</span>
			<h1 class="text-white display-5 fw-bold mb-3">Masuk Untuk Lanjut Belanja Lebih Cepat</h1>
			<p class="text-white-50 lead mb-3">Akses cart, wishlist, dan riwayat order Anda dari satu tempat dengan tampilan yang lebih bersih dan nyaman dipakai di mobile.</p>
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				<li class="breadcrumb-item active text-white">Login</li>
			</ol>
		</div>
	</div>
</div>

<div class="container-fluid auth-entry-stage py-5">
	<div class="container pb-5">
		<div class="auth-entry-shell">
			<div class="row g-4 align-items-stretch">
				<div class="col-lg-5">
					<div class="auth-entry-panel auth-entry-aside">
						<span class="auth-entry-card-kicker"><i class="fas fa-shopping-bag"></i> Member Access</span>
						<h2>Satu Akun Untuk Semua Aktivitas Belanja</h2>
						<p>Masuk ke akun Anda untuk meneruskan proses belanja dengan data pelanggan, alamat, dan histori order yang sudah tersimpan.</p>

						<div class="auth-entry-feature-list">
							<div class="auth-entry-feature">
									<i class="fas fa-shopping-cart"></i>
								<div>
									<strong>Checkout Lebih Ringkas</strong>
									<span>Cart dan alamat yang tersimpan membuat proses checkout jauh lebih cepat.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
								<i class="fas fa-heart"></i>
								<div>
									<strong>Wishlist Tetap Tersimpan</strong>
									<span>Produk favorit tetap bisa diakses kembali kapan saja dari akun Anda.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
									<i class="fas fa-shipping-fast"></i>
								<div>
									<strong>Lacak Pesanan</strong>
									<span>Lihat status pembayaran dan progres order tanpa perlu mengulang langkah.</span>
								</div>
							</div>
						</div>

						<div class="auth-entry-aside-stats">
							<div class="auth-entry-aside-stat">
								<strong>500+</strong>
								<span>Pelanggan</span>
							</div>
							<div class="auth-entry-aside-stat-divider"></div>
							<div class="auth-entry-aside-stat">
								<strong>4.9★</strong>
								<span>Rating</span>
							</div>
							<div class="auth-entry-aside-stat-divider"></div>
							<div class="auth-entry-aside-stat">
								<strong>Sejak 2019</strong>
								<span>Berdiri</span>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="auth-entry-panel auth-entry-form-card">
						<span class="auth-entry-card-kicker"><i class="fas fa-lock"></i> Login Form</span>
						<h2>Welcome Back</h2>
						<p>Gunakan email dan password Anda seperti biasa. Tidak ada perubahan pada proses autentikasi, hanya tampilan form yang diperjelas.</p>

						<form method="POST" action="{{ route('login') }}" class="auth-entry-form">
							@csrf

							<div class="auth-entry-field">
								<label for="email">Email Address</label>
								<div class="auth-field-wrap">
									<i class="fas fa-envelope auth-field-icon"></i>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
								</div>
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password">Password</label>
								<div class="auth-field-wrap has-toggle">
									<i class="fas fa-lock auth-field-icon"></i>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
									<button type="button" class="auth-field-toggle" tabindex="-1" aria-label="Tampilkan password"><i class="fas fa-eye"></i></button>
								</div>
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-remember">
								<div class="form-check">
									<input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
									<label class="mb-0" for="remember">{{ __('Remember Me') }}</label>
								</div>
								<a class="auth-entry-inline-link" href="{{ route('password.request') }}">{{ __('Forgot Your Password?') }}</a>
							</div>

							<button type="submit" class="auth-entry-submit"><i class="fas fa-sign-in-alt"></i> Masuk ke Akun</button>

							<div class="auth-entry-trust-row">
								<span class="auth-entry-trust-item"><i class="fas fa-shield-alt"></i> Data aman & terenkripsi</span>
								<span class="auth-entry-trust-item"><i class="fas fa-lock"></i> HTTPS Secured</span>
							</div>

							<div class="auth-entry-links">
								<a class="auth-entry-link" href="{{ route('register') }}">Belum punya akun? Daftar di sini</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('script-alt')
<script>
document.querySelectorAll('.auth-field-toggle').forEach(function(btn) {
    btn.addEventListener('click', function() {
        var inp = this.closest('.auth-field-wrap').querySelector('input');
        var ic  = this.querySelector('i');
        if (inp.type === 'password') {
            inp.type = 'text';
            ic.classList.remove('fa-eye');
            ic.classList.add('fa-eye-slash');
        } else {
            inp.type = 'password';
            ic.classList.remove('fa-eye-slash');
            ic.classList.add('fa-eye');
        }
    });
});
</script>
@endpush