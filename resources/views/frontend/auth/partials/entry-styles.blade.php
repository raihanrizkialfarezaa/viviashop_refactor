<style>
    .auth-entry-header {
        position: relative;
        margin-top: 18px;
        padding: 5.4rem 0 6.2rem;
        border-radius: 0 0 42px 42px;
        background:
            radial-gradient(circle at top left, rgba(255,255,255,0.16), transparent 24%),
            radial-gradient(circle at 84% 18%, rgba(32,201,151,0.18), transparent 24%),
            linear-gradient(135deg, rgba(8,39,27,0.97) 0%, rgba(15,81,50,0.95) 48%, rgba(34,197,94,0.82) 100%);
        overflow: hidden;
    }

    .auth-entry-header::after {
        content: '';
        position: absolute;
        right: -120px;
        top: -110px;
        width: 360px;
        height: 360px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(255,255,255,0.14), rgba(255,255,255,0));
    }

    .auth-entry-hero {
        position: relative;
        z-index: 1;
        max-width: 820px;
        margin-left: auto;
        margin-right: auto;
    }

    .auth-entry-kicker,
    .auth-entry-card-kicker {
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

    .auth-entry-kicker {
        margin-bottom: 1rem;
        background: rgba(255,255,255,0.14);
        border: 1px solid rgba(255,255,255,0.18);
        color: #fff;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .auth-entry-header .breadcrumb-item,
    .auth-entry-header .breadcrumb-item a {
        color: rgba(255,255,255,0.82) !important;
        text-decoration: none;
    }

    .auth-entry-header .breadcrumb-item.active {
        color: #fff !important;
    }

    .auth-entry-stage {
        margin-top: -74px;
    }

    .auth-entry-shell {
        border-radius: 34px;
        border: 1px solid rgba(15,81,50,0.08);
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: 0 28px 52px rgba(15,81,50,0.08);
        padding: 22px;
    }

    .auth-entry-panel {
        height: 100%;
        border-radius: 30px;
        border: 1px solid rgba(15,81,50,0.08);
        padding: 24px;
    }

    .auth-entry-aside {
        background:
            radial-gradient(circle at top right, rgba(255,255,255,0.16), transparent 24%),
            linear-gradient(180deg, rgba(9,43,28,0.98), rgba(15,81,50,0.94));
        color: #fff;
        box-shadow: 0 24px 42px rgba(15,81,50,0.14);
    }

    .auth-entry-aside .auth-entry-card-kicker {
        margin-bottom: 0.95rem;
        background: rgba(255,255,255,0.12);
        border: 1px solid rgba(255,255,255,0.16);
        color: #fff;
    }

    .auth-entry-aside h2,
    .auth-entry-form-card h2 {
        margin: 0 0 0.5rem;
        font-family: 'Raleway', sans-serif;
        font-size: clamp(1.8rem, 3vw, 2.35rem);
        font-weight: 800;
        line-height: 1.08;
        letter-spacing: -0.03em;
    }

    .auth-entry-aside h2 {
        color: #fff;
    }

    .auth-entry-aside p,
    .auth-entry-aside li {
        color: rgba(255,255,255,0.82);
        line-height: 1.75;
    }

    .auth-entry-feature-list {
        display: grid;
        gap: 14px;
        margin: 1.5rem 0 0;
    }

    .auth-entry-feature {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        padding: 14px 16px;
        border-radius: 22px;
        background: rgba(255,255,255,0.1);
        border: 1px solid rgba(255,255,255,0.08);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .auth-entry-feature i {
        width: 40px;
        height: 40px;
        flex-shrink: 0;
        border-radius: 14px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        background: rgba(255,255,255,0.14);
        color: #fff;
    }

    .auth-entry-feature strong {
        display: block;
        margin-bottom: 0.25rem;
        color: #fff;
        font-size: 0.96rem;
    }

    .auth-entry-form-card {
        background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(247,251,248,0.96));
        box-shadow: inset 0 1px 0 rgba(255,255,255,0.72);
    }

    .auth-entry-form-card .auth-entry-card-kicker {
        margin-bottom: 0.95rem;
        background: rgba(15,81,50,0.06);
        color: #0f5132;
    }

    .auth-entry-form-card h2 {
        color: #213547;
    }

    .auth-entry-form-card p {
        margin: 0;
        color: #6b7b74;
        line-height: 1.7;
    }

    .auth-entry-status {
        border: none;
        border-radius: 18px;
        margin-bottom: 1rem;
    }

    .auth-entry-form {
        margin-top: 1.6rem;
    }

    .auth-entry-field {
        display: flex;
        flex-direction: column;
        gap: 0.55rem;
        margin-bottom: 14px;
        position: relative;
    }

    .auth-entry-field label {
        margin: 0;
        color: #213547;
        font-size: 0.92rem;
        font-weight: 800;
    }

    .auth-entry-field .form-control {
        min-height: 54px;
        border-radius: 18px;
        border: 1px solid rgba(15,81,50,0.12);
        background: #fff;
        color: #213547;
        box-shadow: none;
    }

    .auth-entry-field .form-control:focus {
        border-color: rgba(25,135,84,0.52);
        box-shadow: 0 0 0 0.22rem rgba(25,135,84,0.14);
    }

    .auth-entry-field .invalid-feedback {
        display: block;
        margin-top: 0;
        font-weight: 600;
    }

    .auth-entry-remember {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
        margin: 0.25rem 0 1rem;
    }

    .auth-entry-remember .form-check {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        min-height: 24px;
        margin: 0;
    }

    .auth-entry-remember .form-check-input {
        margin: 0;
    }

    .auth-entry-link,
    .auth-entry-inline-link {
        color: #0f5132;
        font-weight: 800;
        text-decoration: none;
    }

    .auth-entry-link:hover,
    .auth-entry-inline-link:hover {
        color: #0a2f21;
        text-decoration: none;
    }

    .auth-entry-links {
        display: grid;
        gap: 10px;
        margin-top: 1rem;
    }

    .auth-entry-submit {
        width: 100%;
        min-height: 54px;
        border: 0;
        border-radius: 18px;
        background: linear-gradient(90deg, #0f5132, #22a06b);
        color: #fff;
        font-weight: 800;
        box-shadow: 0 16px 28px rgba(15,81,50,0.14);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .auth-entry-submit:hover {
        color: #fff;
        transform: translateY(-2px);
        box-shadow: 0 22px 34px rgba(15,81,50,0.18);
    }

    .auth-entry-meta {
        display: grid;
        gap: 12px;
        margin-top: 1.5rem;
    }

    .auth-entry-meta-card {
        padding: 14px 16px;
        border-radius: 20px;
        background: rgba(15,81,50,0.05);
        border: 1px solid rgba(15,81,50,0.08);
        color: #3f5a51;
        line-height: 1.7;
    }

    .auth-entry-meta-card strong {
        display: block;
        margin-bottom: 0.25rem;
        color: #213547;
        font-size: 0.96rem;
    }

    @media (max-width: 991px) {
        .auth-entry-shell {
            padding: 18px;
        }
    }

    @media (max-width: 767px) {
        .auth-entry-header {
            padding: 4.9rem 0 5.8rem;
            border-radius: 0 0 28px 28px;
        }

        .auth-entry-stage {
            margin-top: -54px;
        }

        .auth-entry-shell,
        .auth-entry-panel,
        .auth-entry-feature,
        .auth-entry-meta-card {
            border-radius: 24px;
        }

        .auth-entry-panel {
            padding: 20px;
        }

        .auth-entry-remember {
            align-items: flex-start;
            flex-direction: column;
        }
    }
</style>
