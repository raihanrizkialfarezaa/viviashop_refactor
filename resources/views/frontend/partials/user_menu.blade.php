@php
    $accountName = auth()->user()->name;
    $accountEmail = auth()->user()->email;
    $accountInitial = strtoupper(substr($accountName, 0, 1));
@endphp

<aside class="user-sidebar sticky">
    <style>
        .user-sidebar {
            --account-green-900: #0a2f21;
            --account-green-800: #0f5132;
            --account-green-700: #198754;
            --account-green-100: rgba(25, 135, 84, 0.08);
            --account-ink: #213547;
            --account-muted: #718096;
            max-width: 340px;
        }

        .user-sidebar.sticky {
            position: sticky;
            top: var(--sticky-safe-top, 6rem);
        }

        .user-sidebar-card {
            position: relative;
            overflow: hidden;
            border-radius: 28px;
            border: 1px solid rgba(15, 81, 50, 0.08);
            background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(246,251,248,0.96));
            box-shadow: 0 24px 40px rgba(15, 81, 50, 0.08);
        }

        .user-sidebar-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top right, rgba(32, 201, 151, 0.18), transparent 24%),
                radial-gradient(circle at bottom left, rgba(25, 135, 84, 0.12), transparent 26%);
            pointer-events: none;
        }

        .user-sidebar-body {
            position: relative;
            z-index: 1;
            padding: 1.4rem;
        }

        .user-sidebar-profile {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 16px;
            margin-bottom: 1rem;
            border-radius: 22px;
            background: linear-gradient(135deg, rgba(15,81,50,0.96), rgba(25,135,84,0.84));
            color: #fff;
            box-shadow: 0 18px 30px rgba(15, 81, 50, 0.14);
        }

        .user-sidebar-avatar {
            width: 60px;
            height: 60px;
            flex-shrink: 0;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(255,255,255,0.18);
            border: 1px solid rgba(255,255,255,0.18);
            font-size: 1.35rem;
            font-weight: 800;
        }

        .user-sidebar-profile small {
            display: block;
            margin-bottom: 2px;
            color: rgba(255,255,255,0.74);
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .user-sidebar-profile strong {
            display: block;
            font-size: 1rem;
            line-height: 1.35;
        }

        .user-sidebar-profile span {
            display: block;
            margin-top: 2px;
            color: rgba(255,255,255,0.82);
            font-size: 0.82rem;
            word-break: break-word;
        }

        .user-sidebar-nav {
            display: grid;
            gap: 8px;
        }

        .user-sidebar-link {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 18px;
            color: var(--account-ink);
            text-decoration: none;
            font-weight: 700;
            transition: transform 0.2s ease, background-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        .user-sidebar-link span {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            min-width: 0;
        }

        .user-sidebar-link i {
            width: 36px;
            height: 36px;
            flex-shrink: 0;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: rgba(15, 81, 50, 0.06);
            color: var(--account-green-800);
        }

        .user-sidebar-link small {
            color: var(--account-muted);
            font-weight: 600;
        }

        .user-sidebar-link.active,
        .user-sidebar-link:hover {
            background: rgba(25, 135, 84, 0.1);
            color: var(--account-green-800) !important;
            box-shadow: inset 0 0 0 1px rgba(15, 81, 50, 0.07);
            transform: translateY(-1px);
        }

        .user-sidebar-link.active i,
        .user-sidebar-link:hover i {
            background: rgba(255,255,255,0.9);
        }

        .user-sidebar-link.active small,
        .user-sidebar-link:hover small {
            color: var(--account-green-800);
        }

        .user-sidebar-logout {
            margin-top: 1rem;
            width: 100%;
            min-height: 48px;
            border: 0;
            border-radius: 18px;
            background: linear-gradient(90deg, var(--account-green-800), #22a06b);
            color: #fff;
            font-weight: 800;
            box-shadow: 0 18px 28px rgba(15, 81, 50, 0.14);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .user-sidebar-logout:hover {
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 22px 34px rgba(15, 81, 50, 0.18);
        }

        @media (max-width: 991px) {
            .user-sidebar {
                max-width: 100%;
            }
        }

        @media (max-width: 767px) {
            .user-sidebar.sticky {
                position: static;
                top: auto;
                margin-top: 0;
            }

            .user-sidebar-card {
                border-radius: 24px;
            }
        }
    </style>

    <div class="user-sidebar-card">
        <div class="user-sidebar-body">
            <div class="user-sidebar-profile">
                <div class="user-sidebar-avatar">{{ $accountInitial }}</div>
                <div>
                    <small>Customer Account</small>
                    <strong>{{ $accountName }}</strong>
                    <span>{{ $accountEmail }}</span>
                </div>
            </div>

            <nav class="user-sidebar-nav">
                <a class="user-sidebar-link {{ Request::is('profile') ? 'active' : '' }}" href="{{ url('profile') }}">
                    <span><i class="fas fa-user"></i> Profile</span>
                    <small>Edit</small>
                </a>
                <a class="user-sidebar-link {{ Request::is('orders*') ? 'active' : '' }}" href="{{ url('orders') }}">
                    <span><i class="fas fa-bag-shopping"></i> Orders</span>
                    <small>Track</small>
                </a>
                <a class="user-sidebar-link {{ Request::is('carts*') ? 'active' : '' }}" href="{{ url('carts') }}">
                    <span><i class="fas fa-cart-shopping"></i> Cart</span>
                    <small>Review</small>
                </a>
                <a class="user-sidebar-link {{ Request::is('wishlists*') ? 'active' : '' }}" href="{{ route('wishlists.index') }}">
                    <span><i class="fas fa-heart"></i> Wishlist</span>
                    <small>Saved</small>
                </a>
            </nav>

            <form action="{{ route('logout') }}" method="post" class="mt-3">
                @csrf
                <button class="user-sidebar-logout">Logout</button>
            </form>
        </div>
    </div>
</aside>
