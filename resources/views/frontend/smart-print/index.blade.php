@extends('frontend.layouts')

@push('styles')
<style>
    .smart-print-page {
        padding: 2rem 0 5.5rem;
        background:
            radial-gradient(circle at top left, rgba(32,201,151,0.1), transparent 24%),
            linear-gradient(180deg, #f6fbf8 0%, #ffffff 34%, #f8fbf9 100%);
    }

    .smart-print-hero {
        position: relative;
        overflow: hidden;
        margin-top: 18px;
        padding: 5rem 0 4.25rem;
        border-radius: 0 0 42px 42px;
        background:
            radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
            linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
    }

    .smart-print-hero::after {
        content: '';
        position: absolute;
        right: -120px;
        top: -110px;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
    }

    .smart-print-hero-content {
        position: relative;
        z-index: 1;
        max-width: 820px;
        margin: 0 auto;
    }

    .smart-print-kicker,
    .smart-print-section-kicker {
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

    .smart-print-kicker {
        margin-bottom: 1rem;
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .smart-print-stage {
        margin-top: -54px;
    }

    .smart-print-surface,
    .smart-print-card,
    .smart-print-process,
    .smart-print-access-card,
    .smart-print-stat {
        border-radius: 32px;
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: 0 26px 48px rgba(15,81,50,0.08);
    }

    .smart-print-surface {
        padding: 26px;
    }

    .smart-print-shell-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        gap: 18px;
        margin-bottom: 1.6rem;
    }

    .smart-print-section-kicker {
        margin-bottom: 0.85rem;
        background: rgba(15,81,50,0.06);
        color: #0f5132;
    }

    .smart-print-shell-head h2,
    .smart-print-process h3,
    .smart-print-access-card h3 {
        margin: 0 0 0.35rem;
        font-family: 'Raleway', sans-serif;
        font-size: clamp(1.7rem, 3vw, 2.2rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -0.03em;
        color: #213547;
    }

    .smart-print-shell-head p,
    .smart-print-card p,
    .smart-print-process p,
    .smart-print-access-card p,
    .smart-print-step p {
        margin: 0;
        color: #6b7b74;
        line-height: 1.7;
    }

    .smart-print-stats,
    .smart-print-card-grid,
    .smart-print-step-grid {
        display: grid;
        gap: 16px;
    }

    .smart-print-stats,
    .smart-print-card-grid {
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .smart-print-stat,
    .smart-print-card,
    .smart-print-process,
    .smart-print-access-card {
        padding: 22px;
    }

    .smart-print-stat small {
        display: block;
        margin-bottom: 0.4rem;
        color: #6b7b74;
        font-size: 0.78rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .smart-print-stat strong {
        color: #0f5132;
        font-size: 1.28rem;
        font-weight: 900;
    }

    .smart-print-card {
        display: flex;
        flex-direction: column;
        gap: 16px;
        height: 100%;
    }

    .smart-print-icon {
        width: 66px;
        height: 66px;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: #0f5132;
        background: rgba(15,81,50,0.08);
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.6);
    }

    .smart-print-card h4,
    .smart-print-step h5 {
        margin: 0;
        color: #213547;
        font-weight: 800;
    }

    .smart-print-action,
    .smart-print-secondary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        min-height: 50px;
        padding: 0 18px;
        border-radius: 18px;
        border: 0;
        text-decoration: none;
        font-weight: 800;
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .smart-print-action:hover,
    .smart-print-secondary:hover {
        text-decoration: none;
        transform: translateY(-2px);
    }

    .smart-print-action:hover {
        color: #fff;
        box-shadow: 0 22px 34px rgba(15,81,50,0.18);
    }

    .smart-print-secondary:hover {
        color: #0f5132;
        box-shadow: 0 18px 28px rgba(15,81,50,0.1);
    }

    .smart-print-action {
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        box-shadow: 0 16px 28px rgba(15,81,50,0.14);
    }

    .smart-print-secondary {
        border: 1px solid rgba(15,81,50,0.12);
        background: rgba(255,255,255,0.96);
        color: #0f5132;
        box-shadow: 0 12px 22px rgba(15,81,50,0.06);
    }

    .smart-print-process {
        margin-top: 1.6rem;
    }

    .smart-print-step-grid {
        grid-template-columns: repeat(4, minmax(0, 1fr));
        margin-top: 1.35rem;
    }

    .smart-print-step {
        padding: 18px;
        border-radius: 24px;
        background: rgba(255,255,255,0.92);
        border: 1px solid rgba(15,81,50,0.08);
    }

    .smart-print-step-number {
        width: 46px;
        height: 46px;
        margin-bottom: 1rem;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f5132, #22a06b);
        color: #fff;
        font-weight: 900;
        box-shadow: 0 14px 22px rgba(15,81,50,0.14);
    }

    .smart-print-access-card {
        margin-top: 1.6rem;
        text-align: center;
    }

    .smart-print-access-inner {
        max-width: 760px;
        margin: 0 auto;
    }

    .smart-print-access-form {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 12px;
        margin-top: 1.35rem;
    }

    .smart-print-access-form .form-control {
        min-height: 54px;
        border-radius: 18px;
        border: 1px solid rgba(15,81,50,0.12);
        box-shadow: none;
    }

    .smart-print-access-form .form-control:focus {
        border-color: rgba(25,135,84,0.52);
        box-shadow: 0 0 0 0.22rem rgba(25,135,84,0.14);
    }

    @media (max-width: 991px) {
        .smart-print-stats,
        .smart-print-card-grid,
        .smart-print-step-grid {
            grid-template-columns: 1fr;
        }

        .smart-print-shell-head {
            flex-direction: column;
        }
    }

    @media (max-width: 767px) {
        .smart-print-page {
            padding-bottom: 4rem;
        }

        .smart-print-hero {
            padding: 4.8rem 0 4rem;
            border-radius: 0 0 28px 28px;
        }

        .smart-print-stage {
            margin-top: -40px;
        }

        .smart-print-surface,
        .smart-print-card,
        .smart-print-process,
        .smart-print-access-card,
        .smart-print-stat,
        .smart-print-step {
            border-radius: 24px;
        }

        .smart-print-surface {
            padding: 20px;
        }

        .smart-print-access-form {
            grid-template-columns: 1fr;
        }

        .smart-print-action,
        .smart-print-secondary {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="smart-print-page">
    <div class="container-fluid smart-print-hero">
        <div class="container">
            <div class="smart-print-hero-content text-center">
                <span class="smart-print-kicker"><i class="fas fa-print"></i> Smart Print Service</span>
                <h1 class="text-white display-5 fw-bold mb-3">Cetak Dokumen Lebih Cepat, Lebih Jelas, Lebih Modern</h1>
                <p class="text-white-50 lead mb-0">Layanan smart print ini tetap memakai flow yang sama, tetapi sekarang dipresentasikan sebagai service page yang lebih meyakinkan, terstruktur, dan nyaman digunakan dari mobile.</p>
            </div>
        </div>
    </div>

    <div class="container smart-print-stage">
        <div class="smart-print-surface">
            <div class="smart-print-shell-head">
                <div>
                    <span class="smart-print-section-kicker"><i class="fas fa-bolt"></i> Print Workflow</span>
                    <h2>Satu Halaman Untuk Memulai Seluruh Proses Cetak</h2>
                    <p>Semua aksi lama tetap dipertahankan: generate session, masuk lewat token, dan lanjut ke halaman session yang sama. Saya hanya menguatkan struktur visual dan urutan informasinya.</p>
                </div>
            </div>

            <div class="smart-print-stats mb-4">
                <div class="smart-print-stat">
                    <small>Flow</small>
                    <strong>Generate Session</strong>
                </div>
                <div class="smart-print-stat">
                    <small>Input</small>
                    <strong>Upload Dokumen</strong>
                </div>
                <div class="smart-print-stat">
                    <small>Output</small>
                    <strong>Bayar & Cetak</strong>
                </div>
            </div>

            <div class="smart-print-card-grid">
                <div class="smart-print-card">
                    <div class="smart-print-icon"><i class="fas fa-qrcode"></i></div>
                    <h4>Mulai Dari QR atau Session Baru</h4>
                    <p>Dapatkan QR code dari mesin cetak atau buat session baru langsung dari tombol yang sudah dipakai sebelumnya.</p>
                    <div class="mt-auto">
                        <button class="smart-print-action" onclick="generateSession()"><i class="fas fa-plus"></i> Generate Session Baru</button>
                    </div>
                </div>

                <div class="smart-print-card">
                    <div class="smart-print-icon"><i class="fas fa-upload"></i></div>
                    <h4>Upload Dokumen Dengan Mudah</h4>
                    <p>File PDF, DOC, atau gambar tetap bisa diunggah lewat alur session yang sama, hanya penyajiannya yang sekarang terasa lebih profesional.</p>
                    <div class="mt-auto">
                        <span class="smart-print-secondary"><i class="fas fa-file-arrow-up"></i> Siapkan File Anda</span>
                    </div>
                </div>

                <div class="smart-print-card">
                    <div class="smart-print-icon"><i class="fas fa-print"></i></div>
                    <h4>Atur Opsi dan Cetak</h4>
                    <p>Pilih warna, jenis kertas, dan preferensi cetak lain sebelum dokumen diproses di toko.</p>
                    <div class="mt-auto">
                        <span class="smart-print-secondary"><i class="fas fa-sliders"></i> Review Opsi Cetak</span>
                    </div>
                </div>
            </div>

            <div class="smart-print-process">
                <h3>Cara Menggunakan Smart Print</h3>
                <p>Langkahnya tetap sederhana, sekarang dibuat lebih mudah dipahami dalam satu pandangan.</p>

                <div class="smart-print-step-grid">
                    <div class="smart-print-step">
                        <div class="smart-print-step-number">1</div>
                        <h5>Generate Session</h5>
                        <p>Buat session baru atau scan QR code dari mesin cetak untuk memulai.</p>
                    </div>
                    <div class="smart-print-step">
                        <div class="smart-print-step-number">2</div>
                        <h5>Upload File</h5>
                        <p>Unggah dokumen yang ingin dicetak langsung dari perangkat Anda.</p>
                    </div>
                    <div class="smart-print-step">
                        <div class="smart-print-step-number">3</div>
                        <h5>Pilih Opsi</h5>
                        <p>Tentukan jenis kertas, warna, dan pengaturan cetak lainnya sesuai kebutuhan.</p>
                    </div>
                    <div class="smart-print-step">
                        <div class="smart-print-step-number">4</div>
                        <h5>Bayar & Cetak</h5>
                        <p>Selesaikan pembayaran dan dokumen akan diproses di jalur cetak yang sama.</p>
                    </div>
                </div>
            </div>

            <div class="smart-print-access-card">
                <div class="smart-print-access-inner">
                    <span class="smart-print-section-kicker"><i class="fas fa-key"></i> Session Access</span>
                    <h3>Sudah Punya Session?</h3>
                    <p>Masukkan token session yang sudah ada untuk melanjutkan proses cetak tanpa memulai ulang.</p>

                    <div class="smart-print-access-form">
                        <input type="text" class="form-control" id="sessionToken" placeholder="Masukkan token session...">
                        <button class="smart-print-action" onclick="accessSession()"><i class="fas fa-arrow-right"></i> Akses Session</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script-alt')
<script>
function generateSession() {
    console.log('Generating session...');
    
    fetch('/print-service/generate-session', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => {
        console.log('Response status:', response.status);
        
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        
        if (data.success && data.token) {
            console.log('Redirecting to:', '/print-service/' + data.token);
            window.location.href = '/print-service/' + data.token;
        } else {
            console.error('Invalid response:', data);
            alert('Gagal membuat session. Silakan coba lagi.');
        }
    })
    .catch(error => {
        console.error('Error details:', error);
        alert('Terjadi kesalahan: ' + error.message);
    });
}

function accessSession() {
    const token = document.getElementById('sessionToken').value.trim();
    if (token) {
        window.location.href = '/print-service/' + token;
    } else {
        alert('Silakan masukkan token session');
    }
}
</script>
@endpush
