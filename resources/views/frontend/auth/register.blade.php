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
						<span class="auth-entry-card-kicker"><i class="fas fa-magic"></i> Account Benefits</span>
						<h2>Daftar Sekali, Pakai Untuk Semua Flow Pelanggan</h2>
						<p>Pendaftaran tetap memakai endpoint dan field yang sama. Saya hanya menyusun ulang tampilannya agar onboarding terasa lebih premium dan jelas.</p>

						<div class="auth-entry-feature-list">
							<div class="auth-entry-feature">
									<i class="fas fa-map-marker-alt"></i>
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

						<div class="auth-entry-aside-stats">
							<div class="auth-entry-aside-stat">
								<strong>500+</strong>
								<span>Pelanggan</span>
							</div>
							<div class="auth-entry-aside-stat-divider"></div>
							<div class="auth-entry-aside-stat">
								<strong>Gratis</strong>
								<span>Daftar</span>
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
						<span class="auth-entry-card-kicker"><i class="fas fa-id-card"></i> Register Form</span>
						<h2>Buat Akun Baru</h2>
						<p>Isi field seperti biasa. Route, validasi, dan proses register tidak diubah, hanya tampilan form dan responsifnya yang diperhalus.</p>

						<form method="POST" action="{{ route('register') }}" class="auth-entry-form">
							@csrf

							<div class="auth-entry-field">
								<label for="name">Name</label>
								<div class="auth-field-wrap">
									<i class="fas fa-user auth-field-icon"></i>
									<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Name">
								</div>
								@error('name')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="email">Email</label>
								<div class="auth-field-wrap">
									<i class="fas fa-envelope auth-field-icon"></i>
									<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Email">
								</div>
								@error('email')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password">Password</label>
								<div class="auth-field-wrap has-toggle">
									<i class="fas fa-lock auth-field-icon"></i>
									<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Password">
									<button type="button" class="auth-field-toggle" tabindex="-1" aria-label="Tampilkan password"><i class="fas fa-eye"></i></button>
								</div>
								@error('password')
									<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
								@enderror
							</div>

							<div class="auth-entry-field">
								<label for="password-confirm">Confirm Password</label>
								<div class="auth-field-wrap has-toggle">
									<i class="fas fa-lock auth-field-icon"></i>
									<input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm password">
									<button type="button" class="auth-field-toggle" tabindex="-1" aria-label="Tampilkan password"><i class="fas fa-eye"></i></button>
								</div>
							</div>

							<button type="submit" class="auth-entry-submit"><i class="fas fa-user-plus"></i> Buat Akun Sekarang</button>

							<div class="auth-entry-trust-row">
								<span class="auth-entry-trust-item"><i class="fas fa-shield-alt"></i> Data aman & terenkripsi</span>
								<span class="auth-entry-trust-item"><i class="fas fa-gift"></i> Gratis selamanya</span>
							</div>

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