@extends('frontend.layouts')

@push('styles')
	@include('frontend.auth.partials.entry-styles')
@endpush

@section('content')
<div class="container-fluid page-header auth-entry-header py-5">
	<div class="container">
		<div class="auth-entry-hero text-center">
			<span class="auth-entry-kicker"><i class="fas fa-unlock-keyhole"></i> Reset Password</span>
			<h1 class="text-white display-5 fw-bold mb-3">Buat Password Baru Tanpa Mengubah Flow Lama</h1>
			<p class="text-white-50 lead mb-3">Token reset, endpoint update password, dan field aslinya tetap sama. Saya hanya merapikan tampilan agar proses reset terasa lebih aman dan jelas.</p>
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				<li class="breadcrumb-item active text-white">Reset Password</li>
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
						<span class="auth-entry-card-kicker"><i class="fas fa-shield"></i> Security Tips</span>
						<h2>Gunakan Password Baru Yang Lebih Kuat</h2>
						<p>Setelah form ini dikirim, akun Anda akan menggunakan password baru yang Anda tentukan di bawah.</p>

						<div class="auth-entry-meta">
							<div class="auth-entry-meta-card">
								<strong>Gunakan kombinasi yang unik</strong>
								Hindari password lama atau pola yang terlalu mudah ditebak.
							</div>
							<div class="auth-entry-meta-card">
								<strong>Pastikan email benar</strong>
								Email di form ini harus cocok dengan akun yang menerima tautan reset.
							</div>
							<div class="auth-entry-meta-card">
								<strong>Login kembali setelah selesai</strong>
								Setelah password diperbarui, Anda bisa masuk seperti biasa ke akun pelanggan.
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="auth-entry-panel auth-entry-form-card">
						<span class="auth-entry-card-kicker"><i class="fas fa-lock"></i> New Password</span>
						<h2>Atur Password Baru</h2>
						<p>Field email, token, password, dan konfirmasi tetap dipertahankan apa adanya agar integrasi reset password tidak berubah.</p>

						@if (session('status'))
							<div class="alert auth-entry-status alert-success" role="alert">
								{{ session('status') }}
							</div>
						@endif

						<form method="POST" action="{{ route('password.update') }}" class="auth-entry-form">
							@csrf
							<input type="hidden" name="token" value="{{ $token }}">

							<div class="auth-entry-field">
								<label for="email">Email Address</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('E-Mail Address') }}">
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password">Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password-confirm">Confirm Password</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
							</div>

							<button type="submit" class="auth-entry-submit">{{ __('Reset Password') }}</button>

							<div class="auth-entry-links">
								<a class="auth-entry-link" href="{{ route('login') }}">Kembali ke login</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection