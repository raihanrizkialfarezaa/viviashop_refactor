
<!-- Navbar start -->
<style>
    :root {
        --v-primary: #0F5132;
        --v-primary-soft: #d1e7dd;
        --v-secondary: #198754;
        --v-accent: #20c997;
        --v-dark: #1F2937;
        --v-light: #F9FAFB;
    }

    .site-header {
        position: sticky;
        top: 0;
        padding: 0;
        left: 0;
        right: 0;
        background: transparent;
        z-index: 1080;
    }

    .site-nav-shell {
        background: #ffffff;
        border: 1px solid rgba(15, 81, 50, 0.06);
        border-radius: 24px;
        padding: 12px 18px;
        box-shadow: 0 16px 36px rgba(15, 81, 50, 0.10);
        backdrop-filter: none;
        -webkit-backdrop-filter: none;
        transition: box-shadow 0.24s ease, border-color 0.24s ease;
    }

    .site-brand {
        display: inline-flex;
        align-items: center;
        gap: 12px;
        text-decoration: none;
    }

    .site-brand:hover {
        text-decoration: none;
    }

    .brand-mark {
        width: 50px;
        height: 50px;
        border-radius: 18px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #0f5132, #20c997);
        color: #fff;
        box-shadow: 0 12px 24px rgba(15, 81, 50, 0.24);
        flex: 0 0 auto;
    }

    .brand-mark i {
        font-size: 1.15rem;
    }

    .brand-text {
        display: flex;
        flex-direction: column;
    }

    .brand-name {
        font-family: 'Raleway', sans-serif;
        font-size: 1.15rem;
        font-weight: 800;
        line-height: 1.05;
        color: #111827;
        letter-spacing: -0.02em;
    }

    .brand-subtitle {
        margin-top: 4px;
        color: #6b7280;
        font-size: 0.72rem;
        font-weight: 700;
        letter-spacing: 0.18em;
        text-transform: uppercase;
    }

    .site-collapse {
        align-items: center;
    }

    .site-nav-links {
        gap: 8px;
    }

    .site-nav-links .nav-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 16px;
        border-radius: 999px;
        color: #374151;
        font-weight: 700;
        transition: all 0.25s ease;
    }

    .site-nav-links .nav-link:hover {
        background: #d1e7dd;
        color: #0f5132;
    }

    .site-nav-links .nav-link.active {
        color: #fff !important;
        background: linear-gradient(135deg, #0f5132, #198754);
        box-shadow: 0 10px 20px rgba(15, 81, 50, 0.18);
    }

    .site-actions {
        gap: 10px;
        margin-left: 16px;
    }

    .site-action-btn {
        position: relative;
        width: 46px;
        height: 46px;
        border-radius: 16px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #0f5132;
        background: #f8fafb;
        border: 1px solid rgba(15, 81, 50, 0.08);
        box-shadow: 0 8px 18px rgba(15, 81, 50, 0.08);
        transition: all 0.25s ease;
        text-decoration: none;
    }

    .site-action-btn:hover {
        color: #fff;
        background: linear-gradient(135deg, #0f5132, #198754);
        transform: translateY(-2px);
        box-shadow: 0 14px 24px rgba(15, 81, 50, 0.16);
    }

    .site-cart-badge {
        position: absolute;
        top: -6px;
        right: -6px;
        min-width: 20px;
        height: 20px;
        padding: 0 6px;
        border-radius: 999px;
        font-size: 0.7rem;
        font-weight: 800;
        letter-spacing: 0;
        box-shadow: 0 6px 14px rgba(15, 81, 50, 0.22);
    }

    .site-toggler {
        border: 0;
        width: 46px;
        height: 46px;
        border-radius: 16px;
        background: linear-gradient(135deg, #0f5132, #198754);
        border: 1px solid rgba(15, 81, 50, 0.08);
        color: #fff;
        box-shadow: 0 12px 24px rgba(15, 81, 50, 0.18);
    }

    .site-toggler:focus {
        box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
    }

    .site-toggler .fa-bars {
        color: #fff !important;
    }

    @media (max-width: 1199.98px) {
        .site-nav-shell {
            border-radius: 24px;
            padding: 12px 14px;
        }

        .site-collapse {
            margin-top: 12px;
            padding: 14px;
            border-radius: 22px;
            background: #ffffff;
            border: 1px solid rgba(15, 81, 50, 0.06);
        }

        .site-nav-links {
            width: 100%;
            margin-bottom: 14px;
        }

        .site-nav-links .nav-link {
            width: 100%;
            justify-content: flex-start;
        }

        .site-actions {
            margin-left: 0;
            width: 100%;
            justify-content: flex-start;
        }
    }

    @media (max-width: 575.98px) {
        .site-header {
            padding-top: 0;
        }

        .site-nav-shell {
            padding: 12px;
            border-radius: 22px;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 16px;
        }

        .brand-name {
            font-size: 1.05rem;
        }
    }
</style>
<div class="container-fluid site-header">
    <div class="container px-0">
        <nav class="navbar navbar-expand-xl site-nav-shell">
            <a href="{{ url('/') }}" class="site-brand">
                <span class="brand-mark">
                    <i class="fas fa-print"></i>
                </span>
                <span class="brand-text">
                    <span class="brand-name">{{ optional($setting)->nama_toko ?? config('app.name') }}</span>
                    <span class="brand-subtitle">Percetakan & ATK</span>
                </span>
            </a>
            <button class="navbar-toggler site-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
            </button>
            <div class="collapse navbar-collapse site-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto site-nav-links">
                    <a href="{{ url('/') }}" class="nav-item {{ Request::is('/') ? 'active' : '' }} nav-link">Home</a>
                    <a href="{{ route('shop') }}" class="nav-item {{ Request::is('shop*') && !Request::is('shopCetak*') ? 'active' : '' }} nav-link">Products</a>
                    <a href="{{ route('shopCetak') }}" class="nav-item {{ Request::is('shopCetak*') ? 'active' : '' }} nav-link">Layanan Cetak</a>
                    @auth
                        <a href="{{ url('carts') }}" class="nav-item {{ Request::is('carts*') ? 'active' : '' }} nav-link">Carts</a>
                        <a href="{{ url('orders') }}" class="nav-item {{ Request::is('orders*') ? 'active' : '' }} nav-link">Orders</a>
                        <a href="{{ route('frontend.print-service') }}" class="nav-item {{ Request::is('smart-print*') ? 'active' : '' }} nav-link">Smart Print</a>
                    @endauth
                </div>
                <div class="d-flex align-items-center site-actions">
                    <button type="button" class="site-action-btn d-none d-lg-inline-flex" data-bs-toggle="modal" data-bs-target="#searchModal" aria-label="Cari produk">
                        <i class="fas fa-search"></i>
                    </button>
                    <a href="{{ route('carts.index') }}" class="site-action-btn" aria-label="Keranjang">
                        <i class="fas fa-shopping-bag"></i>
                        @if (Request::is('register'))
                            <span class="badge bg-success text-white site-cart-badge">0</span>
                        @else
                            <span class="badge bg-success text-white site-cart-badge">{{ $countCart }}</span>
                        @endif
                    </a>
                    <a href="{{ route('profile') }}" class="site-action-btn" aria-label="Akun">
                        <i class="fas fa-user"></i>
                    </a>
                </div>
            </div>
        </nav>
    </div>
</div>
<!-- Navbar End -->
        <!-- Modal Search Start -->
        <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content rounded-0">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Search by keyword</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex align-items-center">
                        <div class="input-group w-75 mx-auto d-flex">
                            <input type="search" class="form-control p-3" placeholder="keywords" aria-describedby="search-icon-1">
                            <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Search End -->
