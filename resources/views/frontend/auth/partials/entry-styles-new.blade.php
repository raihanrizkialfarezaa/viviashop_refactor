<style>
/* ================================================================
   ViviaShop — Auth Pages (Login / Register)
   Fully self-contained, mobile-first, consistent with site theme.
   ================================================================ */

/* ── Page banner ─────────────────────────────────────────────── */
.auth-entry-header {
    position: relative;
    margin-top: 18px;
    padding: 5.5rem 0 7.5rem;
    border-radius: 0 0 48px 48px;
    overflow: hidden;
    background:
        radial-gradient(ellipse 65% 55% at 6%  8%,  rgba(32,201,151,0.26) 0%, transparent 100%),
        radial-gradient(ellipse 55% 65% at 94% 92%, rgba(255,255,255,0.10) 0%, transparent 100%),
        linear-gradient(148deg, #020f08 0%, #0a3822 36%, #0f5132 66%, #145c38 100%);
}

.auth-entry-header::before {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
        45deg,
        rgba(255,255,255,0.013) 0px, rgba(255,255,255,0.013) 1px,
        transparent 1px, transparent 38px
    );
    pointer-events: none;
}

.auth-entry-header::after {
    content: '';
    position: absolute;
    right: -150px;
    top: -130px;
    width: 440px;
    height: 440px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(255,255,255,0.09) 0%, transparent 65%);
    pointer-events: none;
}

.auth-entry-hero {
    position: relative;
    z-index: 1;
    max-width: 820px;
    margin: 0 auto;
}

/* ── Kicker badges ───────────────────────────────────────────── */
.auth-entry-kicker,
.auth-entry-card-kicker {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 16px;
    border-radius: 999px;
    font-size: 0.78rem;
    font-weight: 800;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    white-space: nowrap;
}

.auth-entry-kicker {
    margin-bottom: 1rem;
    background: rgba(255,255,255,0.14);
    border: 1px solid rgba(255,255,255,0.18);
    color: #fff;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
}

.auth-entry-header .breadcrumb-item a {
    color: rgba(255,255,255,0.78) !important;
    text-decoration: none;
}
.auth-entry-header .breadcrumb-item.active { color: #fff !important; }
.auth-entry-header .breadcrumb-item + .breadcrumb-item::before { color: rgba(255,255,255,0.4); }

/* ── Stage (overlaps banner) ─────────────────────────────────── */
.auth-entry-stage {
    position: relative;
    z-index: 2;
    margin-top: -82px;
}

/* ── Outer shell card ───────────────────────────────────────── */
.auth-entry-shell {
    border-radius: 38px;
    background: linear-gradient(180deg, #ffffff 0%, #f3faf6 100%);
    border: 1px solid rgba(15,81,50,0.09);
    box-shadow:
        0 36px 72px rgba(15,81,50,0.11),
        0 4px 16px  rgba(15,81,50,0.06);
    padding: 22px;
}

/* ── Inner panels ───────────────────────────────────────────── */
.auth-entry-panel {
    height: 100%;
    border-radius: 28px;
    border: 1px solid rgba(15,81,50,0.08);
    padding: 30px 28px;
}

/* ── Aside (dark green) ─────────────────────────────────────── */
.auth-entry-aside {
    position: relative;
    overflow: hidden;
    background:
        radial-gradient(ellipse 72% 42% at 96% 98%, rgba(255,255,255,0.11) 0%, transparent 100%),
        radial-gradient(ellipse 62% 52% at 4%  4%,  rgba(32,201,151,0.24) 0%, transparent 100%),
        linear-gradient(165deg, #071c12 0%, #0a3321 28%, #0f5132 62%, #145a36 100%);
    color: #fff;
    box-shadow: 0 28px 52px rgba(6,22,13,0.24);
    border: none;
}

.auth-entry-aside::before {
    content: '';
    position: absolute;
    inset: 0;
    background: repeating-linear-gradient(
        -45deg,
        rgba(255,255,255,0.013) 0px, rgba(255,255,255,0.013) 1px,
        transparent 1px, transparent 32px
    );
    pointer-events: none;
}

.auth-entry-aside .auth-entry-card-kicker {
    position: relative;
    z-index: 1;
    margin-bottom: 1rem;
    background: rgba(255,255,255,0.11);
    border: 1px solid rgba(255,255,255,0.14);
    color: rgba(255,255,255,0.90);
}

.auth-entry-aside h2 {
    position: relative;
    z-index: 1;
    margin: 0 0 0.6rem;
    font-family: 'Raleway', sans-serif;
    font-size: clamp(1.55rem, 2.6vw, 2rem);
    font-weight: 800;
    line-height: 1.12;
    letter-spacing: -0.03em;
    color: #fff;
}

.auth-entry-aside > p {
    position: relative;
    z-index: 1;
    color: rgba(255,255,255,0.74);
    line-height: 1.72;
    margin: 0;
    font-size: 0.91rem;
}

/* ── Feature list ────────────────────────────────────────────── */
.auth-entry-feature-list {
    position: relative;
    z-index: 1;
    display: grid;
    gap: 10px;
    margin-top: 1.4rem;
}

.auth-entry-feature {
    display: flex;
    gap: 13px;
    align-items: flex-start;
    padding: 13px 15px;
    border-radius: 20px;
    background: rgba(255,255,255,0.09);
    border: 1px solid rgba(255,255,255,0.08);
    transition: background 0.22s;
}

.auth-entry-feature:hover {
    background: rgba(255,255,255,0.14);
}

.auth-entry-feature i {
    width: 38px;
    height: 38px;
    flex-shrink: 0;
    border-radius: 13px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(32,201,151,0.18);
    border: 1px solid rgba(32,201,151,0.22);
    color: #20c997;
    font-size: 0.88rem;
}

.auth-entry-feature strong {
    display: block;
    margin-bottom: 3px;
    color: #fff;
    font-size: 0.91rem;
    font-weight: 700;
}

.auth-entry-feature span {
    color: rgba(255,255,255,0.66);
    font-size: 0.82rem;
    line-height: 1.58;
}

/* ── Aside stats bar ─────────────────────────────────────────── */
.auth-entry-aside-stats {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: center;
    margin-top: 1.4rem;
    padding: 14px 16px;
    border-radius: 18px;
    background: rgba(255,255,255,0.09);
    border: 1px solid rgba(255,255,255,0.10);
}

.auth-entry-aside-stat {
    flex: 1;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 2px;
}

.auth-entry-aside-stat strong {
    display: block;
    margin: 0;
    font-family: 'Raleway', sans-serif;
    font-size: 1rem;
    font-weight: 800;
    color: #20c997;
    line-height: 1.2;
}

.auth-entry-aside-stat span {
    display: block;
    color: rgba(255,255,255,0.52);
    font-size: 0.66rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.07em;
}

.auth-entry-aside-stat-divider {
    width: 1px;
    height: 28px;
    background: rgba(255,255,255,0.14);
    margin: 0 10px;
    flex-shrink: 0;
}

/* ── Form card ───────────────────────────────────────────────── */
.auth-entry-form-card {
    background: #fff;
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.85);
}

.auth-entry-form-card .auth-entry-card-kicker {
    margin-bottom: 0.9rem;
    background: rgba(15,81,50,0.07);
    border: 1px solid rgba(15,81,50,0.09);
    color: #0f5132;
}

.auth-entry-form-card h2 {
    margin: 0 0 0.5rem;
    font-family: 'Raleway', sans-serif;
    font-size: clamp(1.65rem, 2.8vw, 2.1rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: #1a2e24;
}

.auth-entry-form-card > p,
.auth-entry-form-card .auth-entry-form > p {
    margin: 0;
    color: #6b7b74;
    line-height: 1.68;
    font-size: 0.91rem;
}

/* ── Status alert ────────────────────────────────────────────── */
.auth-entry-status {
    border: none;
    border-radius: 14px;
    margin-bottom: 1rem;
}

/* ── Form wrapper ────────────────────────────────────────────── */
.auth-entry-form {
    margin-top: 1.5rem;
}

/* ── Field rows ──────────────────────────────────────────────── */
.auth-entry-field {
    display: flex;
    flex-direction: column;
    gap: 7px;
    margin-bottom: 14px;
}

.auth-entry-field label {
    margin: 0;
    color: #1a2e24;
    font-size: 0.89rem;
    font-weight: 800;
    letter-spacing: 0.01em;
}

/* ── Input icon wrapper ──────────────────────────────────────── */
.auth-field-wrap {
    position: relative;
}

.auth-field-icon {
    position: absolute;
    top: 50%;
    left: 16px;
    transform: translateY(-50%);
    color: #198754;
    font-size: 0.84rem;
    pointer-events: none;
    z-index: 5;
    line-height: 1;
    opacity: 0.85;
}

/* Override Bootstrap's form-control within our wrapper */
.auth-field-wrap .form-control,
.auth-field-wrap .form-control:not(.is-invalid):not(.is-valid) {
    padding-left: 44px !important;
}

.auth-field-wrap.has-toggle .form-control,
.auth-field-wrap.has-toggle .form-control:not(.is-invalid):not(.is-valid) {
    padding-right: 50px !important;
}

/* ── The inputs themselves ───────────────────────────────────── */
.auth-entry-field .form-control {
    display: block;
    width: 100%;
    height: 52px;
    min-height: 52px;
    padding-top: 0;
    padding-bottom: 0;
    padding-left: 16px;
    padding-right: 16px;
    border-radius: 16px !important;
    border: 1.5px solid rgba(15,81,50,0.15) !important;
    background-color: #f8fcfa !important;
    color: #1a2e24;
    font-size: 0.95rem;
    box-shadow: none !important;
    transition: border-color 0.22s ease, box-shadow 0.22s ease, background-color 0.22s ease;
    -webkit-appearance: none;
    appearance: none;
}

.auth-entry-field .form-control:focus {
    background-color: #fff !important;
    border-color: #198754 !important;
    box-shadow: 0 0 0 4px rgba(25,135,84,0.13) !important;
    outline: none;
}

.auth-entry-field .form-control::placeholder {
    color: #b0bdb8;
    font-weight: 400;
}

.auth-entry-field .form-control.is-invalid {
    border-color: #c1121f !important;
    background-image: none !important;
}

.auth-entry-field .form-control.is-invalid:focus {
    box-shadow: 0 0 0 4px rgba(193,18,31,0.12) !important;
}

.auth-entry-field .invalid-feedback {
    display: block;
    font-size: 0.83rem;
    font-weight: 700;
    color: #c1121f;
    margin-top: 2px;
}

/* ── Chrome autofill fix ─────────────────────────────────────── */
.auth-entry-field .form-control:-webkit-autofill,
.auth-entry-field .form-control:-webkit-autofill:hover,
.auth-entry-field .form-control:-webkit-autofill:focus {
    -webkit-box-shadow: 0 0 0 100px #fff inset !important;
    -webkit-text-fill-color: #1a2e24 !important;
    caret-color: #1a2e24;
    transition: background-color 9999s ease-in-out 0s;
}

/* ── Password toggle ─────────────────────────────────────────── */
.auth-field-toggle {
    position: absolute;
    top: 50%;
    right: 13px;
    transform: translateY(-50%);
    z-index: 5;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: none;
    border: none;
    border-radius: 8px;
    color: #adb5bd;
    font-size: 0.87rem;
    padding: 0;
    cursor: pointer;
    line-height: 1;
    transition: color 0.18s, background 0.18s;
}

.auth-field-toggle:hover {
    color: #198754;
    background: rgba(25,135,84,0.08);
}

/* ── Remember row ────────────────────────────────────────────── */
.auth-entry-remember {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin: 0.4rem 0 1.1rem;
}

.auth-entry-remember .form-check {
    display: inline-flex;
    align-items: center;
    gap: 9px;
    min-height: 20px;
    padding: 0;
    margin: 0;
}

.auth-entry-remember .form-check-input {
    margin: 0;
    flex-shrink: 0;
    width: 18px;
    height: 18px;
    border-radius: 6px !important;
    border: 1.5px solid rgba(15,81,50,0.25);
    cursor: pointer;
    position: relative;
    top: 0;
}

.auth-entry-remember .form-check-input:checked {
    background-color: #198754;
    border-color: #198754;
}

.auth-entry-remember .mb-0 {
    margin: 0;
    font-size: 0.88rem;
    font-weight: 600;
    color: #374a3e;
}

/* ── Links ───────────────────────────────────────────────────── */
.auth-entry-link,
.auth-entry-inline-link {
    color: #0f5132;
    font-weight: 800;
    font-size: 0.89rem;
    text-decoration: none;
    transition: color 0.18s;
}

.auth-entry-link:hover,
.auth-entry-inline-link:hover {
    color: #198754;
    text-decoration: none;
}

.auth-entry-links {
    display: flex;
    justify-content: center;
    margin-top: 0.9rem;
    padding-top: 0.9rem;
    border-top: 1px solid rgba(15,81,50,0.07);
}

/* ── Submit button ───────────────────────────────────────────── */
.auth-entry-submit {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    height: 54px;
    padding: 0 28px;
    border: none;
    border-radius: 16px;
    background: linear-gradient(135deg, #0a3321 0%, #0f5132 40%, #198754 80%, #22a06b 100%);
    color: #fff;
    font-family: 'Raleway', sans-serif;
    font-size: 0.97rem;
    font-weight: 800;
    letter-spacing: 0.025em;
    box-shadow:
        0 14px 28px rgba(15,81,50,0.24),
        0 3px 8px  rgba(15,81,50,0.14),
        inset 0 1px 0 rgba(255,255,255,0.18);
    cursor: pointer;
    transition: all 0.28s cubic-bezier(0.16,1,0.3,1);
    -webkit-appearance: none;
    appearance: none;
}

.auth-entry-submit:hover {
    color: #fff;
    transform: translateY(-3px);
    box-shadow:
        0 22px 40px rgba(15,81,50,0.28),
        0 6px 14px rgba(15,81,50,0.18),
        inset 0 1px 0 rgba(255,255,255,0.22);
}

.auth-entry-submit:active {
    transform: translateY(-1px);
    box-shadow:
        0 10px 20px rgba(15,81,50,0.20),
        0 2px 6px  rgba(15,81,50,0.12);
}

/* ── Trust badges ────────────────────────────────────────────── */
.auth-entry-trust-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 1rem;
    justify-content: center;
}

.auth-entry-trust-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 6px 12px;
    border-radius: 8px;
    background: rgba(15,81,50,0.05);
    border: 1px solid rgba(15,81,50,0.08);
    color: #4a6558;
    font-size: 0.77rem;
    font-weight: 700;
}

.auth-entry-trust-item i {
    color: #198754;
    font-size: 0.78rem;
}

/* ── Responsive ──────────────────────────────────────────────── */
@media (max-width: 1199.98px) {
    .auth-entry-header { padding: 5rem 0 7rem; }
}

@media (max-width: 991.98px) {
    .auth-entry-stage  { margin-top: -62px; }
    .auth-entry-shell  { padding: 16px; border-radius: 32px; }
    .auth-entry-panel  { padding: 26px 22px; border-radius: 24px; }
}

@media (max-width: 767.98px) {
    .auth-entry-header {
        padding: 4.6rem 0 6.2rem;
        border-radius: 0 0 32px 32px;
    }
    .auth-entry-stage  { margin-top: -50px; }
    .auth-entry-shell  { padding: 12px; border-radius: 26px; }
    .auth-entry-panel  { padding: 22px 18px; border-radius: 20px; }
    /* Collapse feature list on mobile to keep aside compact */
    .auth-entry-feature-list { display: none; }
    .auth-entry-aside > p    { display: none; }
    .auth-entry-aside-stats  { margin-top: 1rem; }
    .auth-entry-remember     { flex-direction: column; align-items: flex-start; }
    .auth-entry-form-card h2 { font-size: 1.7rem; }
}

@media (max-width: 575.98px) {
    .auth-entry-header h1    { font-size: 1.55rem; }
    .auth-entry-header .lead { font-size: 0.88rem; }
    .auth-entry-shell        { padding: 10px; border-radius: 22px; }
    .auth-entry-panel        { padding: 20px 16px; border-radius: 18px; }
    .auth-entry-aside-stats  { flex-wrap: wrap; justify-content: space-around; }
    .auth-entry-aside-stat-divider { display: none; }
    .auth-entry-aside-stat   { flex: 0 0 calc(33% - 8px); align-items: flex-start; padding-left: 4px; }
    .auth-field-wrap .form-control,
    .auth-field-wrap .form-control:not(.is-invalid):not(.is-valid) {
        padding-left: 42px !important;
    }
}
</style>
