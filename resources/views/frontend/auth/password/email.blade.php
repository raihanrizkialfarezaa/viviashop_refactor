@extends('frontend.layouts')

@push('styles')
	@include('frontend.auth.partials.entry-styles')
@endpush

@section('content')
<div class="container-fluid page-header auth-entry-header py-5">
	<div class="container">
		<div class="auth-entry-hero text-center">
			<span class="auth-entry-kicker"><i class="fas fa-key"></i> Password Recovery</span>
			<h1 class="text-white display-5 fw-bold mb-3">Reset Akses Akun Dengan Aman</h1>
			<p class="text-white-50 lead mb-3">Form pemulihan password tetap menggunakan flow Laravel yang sama, hanya disajikan lebih jelas agar pengguna tidak kebingungan saat membuka dari perangkat apa pun.</p>
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				<li class="breadcrumb-item active text-white">Forgot Password</li>
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
						<span class="auth-entry-card-kicker"><i class="fas fa-shield-halved"></i> Recovery Flow</span>
						<h2>Kirim Link Reset ke Email Anda</h2>
						<p>Masukkan email akun Anda, lalu sistem akan mengirim tautan reset password ke alamat yang sama seperti sebelumnya.</p>

						<div class="auth-entry-feature-list">
							<div class="auth-entry-feature">
								<i class="fas fa-envelope"></i>
								<div>
									<strong>Masukkan Email Aktif</strong>
									<span>Gunakan email yang terdaftar agar link reset dapat dikirim dengan benar.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
								<i class="fas fa-link"></i>
								<div>
									<strong>Buka Link Reset</strong>
									<span>Tautan reset akan membawa Anda ke form pembuatan password baru.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
								<i class="fas fa-lock"></i>
								<div>
									<strong>Login Kembali</strong>
									<span>Setelah password baru tersimpan, Anda dapat masuk seperti biasa.</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="auth-entry-panel auth-entry-form-card">
						<span class="auth-entry-card-kicker"><i class="fas fa-paper-plane"></i> Email Reset</span>
						<h2>Kirim Link Reset Password</h2>
						<p>Field dan route pengiriman email reset tidak berubah. Saya hanya memperjelas struktur formulir dan feedback statusnya.</p>

						@if (session('status'))
							<div class="alert auth-entry-status alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<form method="POST" action="{{ route('password.email') }}" class="auth-entry-form">
							@csrf

							<div class="auth-entry-field">
								<label for="email">Email Address</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<button type="submit" class="auth-entry-submit">{{ __('Send Password Reset Link') }}</button>

							<div class="auth-entry-links">
								<a class="auth-entry-link" href="{{ route('login') }}">Kembali ke login</a>
								<a class="auth-entry-link" href="{{ route('register') }}">Belum punya akun? Daftar</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection