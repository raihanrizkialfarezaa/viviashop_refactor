@extends('frontend.layouts')

@push('styles')
	@include('frontend.auth.partials.entry-styles')
@endpush

@section('content')
<div class="container-fluid page-header auth-entry-header py-5">
	<div class="container">
		<div class="auth-entry-hero text-center">
			<span class="auth-entry-kicker"><i class="fas fa-right-to-bracket"></i> Customer Login</span>
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
						<span class="auth-entry-card-kicker"><i class="fas fa-bag-shopping"></i> Member Access</span>
						<h2>Satu Akun Untuk Semua Aktivitas Belanja</h2>
						<p>Masuk ke akun Anda untuk meneruskan proses belanja dengan data pelanggan, alamat, dan histori order yang sudah tersimpan.</p>

						<div class="auth-entry-feature-list">
							<div class="auth-entry-feature">
								<i class="fas fa-cart-shopping"></i>
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
								<i class="fas fa-truck-fast"></i>
								<div>
									<strong>Lacak Pesanan</strong>
									<span>Lihat status pembayaran dan progres order tanpa perlu mengulang langkah.</span>
								</div>
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
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password">Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="{{ __('Password') }}">
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

							<button type="submit" class="auth-entry-submit">Login</button>

							<div class="auth-entry-links">
								<a class="auth-entry-link" href="{{ route('register') }}">Create Your Account</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection