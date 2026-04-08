@extends('frontend.layouts')

@push('styles')
	@include('frontend.auth.partials.entry-styles')
@endpush

@section('content')
<div class="container-fluid page-header auth-entry-header py-5">
	<div class="container">
		<div class="auth-entry-hero text-center">
			<span class="auth-entry-kicker"><i class="fas fa-user-plus"></i> New Account</span>
			<h1 class="text-white display-5 fw-bold mb-3">Buat Akun Agar Pengalaman Belanja Lebih Mulus</h1>
			<p class="text-white-50 lead mb-3">Simpan data pelanggan, alamat, wishlist, dan histori order dalam satu akun dengan tampilan pendaftaran yang lebih tertata.</p>
			<ol class="breadcrumb justify-content-center mb-0">
				<li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
				<li class="breadcrumb-item active text-white">Register</li>
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
						<span class="auth-entry-card-kicker"><i class="fas fa-sparkles"></i> Account Benefits</span>
						<h2>Daftar Sekali, Pakai Untuk Semua Flow Pelanggan</h2>
						<p>Pendaftaran tetap memakai endpoint dan field yang sama. Saya hanya menyusun ulang tampilannya agar onboarding terasa lebih premium dan jelas.</p>

						<div class="auth-entry-feature-list">
							<div class="auth-entry-feature">
								<i class="fas fa-location-dot"></i>
								<div>
									<strong>Simpan Alamat</strong>
									<span>Alamat pelanggan dapat dipakai ulang saat checkout sehingga prosesnya lebih singkat.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
								<i class="fas fa-heart"></i>
								<div>
									<strong>Kelola Wishlist</strong>
									<span>Simpan produk favorit untuk dibandingkan sebelum melakukan pembelian.</span>
								</div>
							</div>
							<div class="auth-entry-feature">
								<i class="fas fa-receipt"></i>
								<div>
									<strong>Riwayat Order Lebih Rapi</strong>
									<span>Akses status order, invoice, dan pembayaran dari halaman akun pelanggan.</span>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="col-lg-7">
					<div class="auth-entry-panel auth-entry-form-card">
						<span class="auth-entry-card-kicker"><i class="fas fa-id-card"></i> Register Form</span>
						<h2>Buat Akun Baru</h2>
						<p>Isi field seperti biasa. Route, validasi, dan proses register tidak diubah, hanya tampilan form dan responsifnya yang diperhalus.</p>

						<form method="POST" action="{{ route('register') }}" class="auth-entry-form">
							@csrf

							<div class="auth-entry-field">
								<label for="name">Name</label>
								<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
								@error('name')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="email">Email</label>
								<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password">Password</label>
								<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password-confirm">Confirm Password</label>
								<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
							</div>

							<button type="submit" class="auth-entry-submit">Register</button>

							<div class="auth-entry-links">
								<a class="auth-entry-link" href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
