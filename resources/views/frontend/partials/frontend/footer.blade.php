<!-- Footer Start -->
<style>
    .site-footer {
        position: relative;
        background: linear-gradient(180deg, #0a2e1d 0%, #071f14 100%);
        color: rgba(255,255,255,0.7);
        overflow: hidden;
    }

    .site-footer::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #0f5132, #20c997, #0f5132);
    }

    .site-footer::after {
        content: '';
        position: absolute;
        top: -200px;
        right: -100px;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(32,201,151,0.06) 0%, transparent 70%);
        pointer-events: none;
    }

    .footer-brand h3 {
        font-family: 'Raleway', sans-serif;
        font-weight: 800;
        color: #fff;
        font-size: 1.6rem;
        margin-bottom: 4px;
    }

    .footer-brand-tagline {
        color: #20c997;
        font-size: 0.85rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }

    .footer-desc {
        color: rgba(255,255,255,0.55);
        font-size: 0.92rem;
        line-height: 1.7;
        margin-top: 1rem;
    }

    .footer-social {
        display: flex;
        gap: 10px;
        margin-top: 1.25rem;
    }

    .footer-social-link {
        width: 40px;
        height: 40px;
        border-radius: 12px;
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(255,255,255,0.1);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: rgba(255,255,255,0.6);
        font-size: 1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .footer-social-link:hover {
        background: rgba(32,201,151,0.15);
        border-color: rgba(32,201,151,0.3);
        color: #20c997;
        transform: translateY(-2px);
    }

    .footer-heading {
        color: #fff;
        font-weight: 700;
        font-size: 1rem;
        margin-bottom: 1.25rem;
        position: relative;
        padding-bottom: 12px;
    }

    .footer-heading::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 30px;
        height: 2px;
        background: #20c997;
        border-radius: 1px;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links li {
        margin-bottom: 10px;
    }

    .footer-links a {
        color: rgba(255,255,255,0.55);
        text-decoration: none;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .footer-links a:hover {
        color: #20c997;
        transform: translateX(4px);
    }

    .footer-links a::before {
        content: '';
        width: 4px;
        height: 4px;
        border-radius: 50%;
        background: rgba(255,255,255,0.2);
        transition: background 0.2s ease;
    }

    .footer-links a:hover::before {
        background: #20c997;
    }

    .footer-contact-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
        margin-bottom: 14px;
        font-size: 0.9rem;
    }

    .footer-contact-item i {
        color: #20c997;
        margin-top: 3px;
        font-size: 0.85rem;
        width: 16px;
        text-align: center;
        flex-shrink: 0;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.06);
        padding: 1.25rem 0;
        margin-top: 1rem;
    }

    .footer-bottom-text {
        color: rgba(255,255,255,0.35);
        font-size: 0.85rem;
    }

    .footer-bottom-text a {
        color: #20c997;
        text-decoration: none;
        font-weight: 600;
    }

    @media (max-width: 767.98px) {
        .site-footer .container {
            padding-left: 20px;
            padding-right: 20px;
        }

        .footer-heading {
            margin-top: 0.5rem;
        }
    }
</style>

<footer class="site-footer pt-5 mt-5">
    <div class="container py-5">
        <div class="row g-5">
            <div class="col-lg-4 col-md-6">
                <div class="footer-brand">
                    <h3>{{ optional($setting)->nama_toko ?? config('app.name') }}</h3>
                    <span class="footer-brand-tagline">Percetakan & ATK</span>
                </div>
                <p class="footer-desc">Harga yang bersaing, dengan kualitas yang terbaik. Telah dipercaya oleh beberapa instansi ternama di Jombang dan sekitarnya.</p>
                <div class="footer-social">
                    <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/vivia_printshop/" target="_blank" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="footer-social-link"><i class="fab fa-youtube"></i></a>
                    <a href="#" class="footer-social-link"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            <div class="col-lg-2 col-md-6">
                <h5 class="footer-heading">Informasi</h5>
                <ul class="footer-links">
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">FAQs & Help</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Akun Saya</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('profile') }}">My Account</a></li>
                    <li><a href="{{ url('/carts') }}">Shopping Cart</a></li>
                    <li><a href="{{ route('orders.index') }}">Order History</a></li>
                </ul>
            </div>
            <div class="col-lg-3 col-md-6">
                <h5 class="footer-heading">Kontak</h5>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ optional($setting)->alamat ?? 'Tebu Ireng IV No. 38, Cukir, Diwek, Jombang' }}</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>{{ optional($setting)->email ?? 'info@vivia.com' }}</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone"></i>
                    <span>{{ optional($setting)->telepon ?? '+62 812 3456 7890' }}</span>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="text-center">
                <span class="footer-bottom-text"><i class="fas fa-copyright me-1"></i> {{ date('Y') }} <a href="#">{{ optional($setting)->nama_toko ?? config('app.name') }}</a>. All rights reserved.</span>
            </div>
        </div>
    </div>
</footer>
<!-- Footer End -->
