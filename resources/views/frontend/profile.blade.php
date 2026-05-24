<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>My Profile - AURUM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #D4AF37;
            --gold-soft: rgba(212, 175, 55, 0.13);
            --black: #080706;
            --panel: #11100e;
            --white: #ffffff;
            --muted: rgba(255, 255, 255, 0.62);
            --border: rgba(212, 175, 55, 0.18);
            --font-serif: 'Cormorant Garamond', Georgia, serif;
            --font-sans: 'Josefin Sans', sans-serif;
        }

        body {
            min-height: 100vh;
            margin: 0;
            color: var(--white);
            background:
                radial-gradient(ellipse 55% 45% at 82% 8%, rgba(212,175,55,0.1), transparent 60%),
                linear-gradient(135deg, #050505, #15100a 52%, #080706);
            font-family: var(--font-sans);
        }

        a {
            color: inherit;
        }

        .profile-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 28px clamp(20px, 5vw, 72px);
            border-bottom: 1px solid rgba(212,175,55,0.12);
            background: rgba(0,0,0,0.5);
        }

        .brand {
            text-decoration: none;
            line-height: 1;
        }

        .brand strong {
            display: block;
            color: var(--gold);
            font-family: var(--font-serif);
            font-size: 30px;
            letter-spacing: 6px;
        }

        .brand span {
            display: block;
            color: rgba(212,175,55,0.68);
            font-size: 8px;
            letter-spacing: 4px;
            text-align: center;
            text-transform: uppercase;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-wrap: wrap;
        }

        .nav-link-luxury,
        .btn-luxury,
        .btn-ghost {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            min-height: 42px;
            padding: 12px 18px;
            border-radius: 6px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-decoration: none;
            text-transform: uppercase;
        }

        .nav-link-luxury,
        .btn-ghost {
            color: rgba(255,255,255,0.78);
            background: transparent;
            border: 1px solid rgba(255,255,255,0.18);
        }

        .btn-luxury {
            color: #050505;
            background: var(--gold);
            border: 1px solid var(--gold);
        }

        .btn-danger-soft {
            color: #ffb9b9;
            background: rgba(185, 75, 75, 0.08);
            border-color: rgba(255, 110, 110, 0.28);
        }

        .profile-shell {
            width: min(1120px, calc(100% - 32px));
            margin: 0 auto;
            padding: 70px 0;
        }

        .profile-hero {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 28px;
            align-items: end;
            margin-bottom: 30px;
        }

        .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        .eyebrow::before {
            content: '';
            width: 42px;
            height: 1px;
            background: var(--gold);
        }

        h1 {
            margin: 12px 0 8px;
            font-family: var(--font-serif);
            font-size: clamp(46px, 7vw, 78px);
            font-weight: 500;
            line-height: 0.95;
        }

        .hero-copy {
            max-width: 620px;
            color: var(--muted);
            font-family: var(--font-serif);
            font-size: 21px;
            font-style: italic;
            line-height: 1.55;
        }

        .role-pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            color: var(--gold);
            background: var(--gold-soft);
            border: 1px solid var(--border);
            border-radius: 999px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            white-space: nowrap;
        }

        .profile-grid {
            display: grid;
            grid-template-columns: minmax(260px, 0.75fr) minmax(0, 1.25fr);
            gap: 24px;
            align-items: start;
        }

        .panel {
            background: rgba(17, 16, 14, 0.92);
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: 0 24px 70px rgba(0,0,0,0.35);
        }

        .panel-inner {
            padding: 28px;
        }

        .customer-card {
            text-align: center;
        }

        .avatar {
            width: 96px;
            height: 96px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            color: #050505;
            background: var(--gold);
            border-radius: 50%;
            font-family: var(--font-serif);
            font-size: 44px;
            font-weight: 600;
        }

        .customer-card h2,
        .panel-title {
            margin: 0;
            color: var(--white);
            font-family: var(--font-serif);
            font-size: 30px;
            font-weight: 500;
        }

        .customer-card p,
        .panel-copy,
        .detail span {
            color: var(--muted);
            font-size: 13px;
            line-height: 1.6;
        }

        .detail-list {
            display: grid;
            gap: 14px;
            margin-top: 28px;
            text-align: left;
        }

        .detail {
            padding: 16px;
            background: rgba(255,255,255,0.035);
            border: 1px solid rgba(212,175,55,0.12);
            border-radius: 6px;
        }

        .detail strong {
            display: block;
            margin-top: 4px;
            color: var(--gold);
            font-size: 12px;
            letter-spacing: 1px;
            text-transform: uppercase;
            word-break: break-word;
        }

        .form-panel + .form-panel {
            margin-top: 24px;
        }

        .form-row-two {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
        }

        .field {
            margin-top: 18px;
        }

        .field label {
            display: block;
            margin-bottom: 8px;
            color: var(--gold);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
        }

        .field input {
            width: 100%;
            min-height: 46px;
            padding: 12px 14px;
            color: var(--white);
            background: rgba(0,0,0,0.28);
            border: 1px solid rgba(212,175,55,0.2);
            border-radius: 6px;
            outline: none;
        }

        .field input:focus {
            border-color: rgba(212,175,55,0.58);
            box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
        }

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 14px;
            margin-top: 22px;
            flex-wrap: wrap;
        }

        .status-text {
            margin: 0;
            color: var(--gold);
            font-size: 12px;
        }

        .error-text {
            margin: 7px 0 0;
            color: #ffb9b9;
            font-size: 12px;
        }

        @media (max-width: 860px) {
            .profile-hero,
            .profile-grid,
            .form-row-two {
                grid-template-columns: 1fr;
            }

            .profile-hero {
                align-items: start;
            }
        }

        @media (max-width: 560px) {
            .profile-nav,
            .nav-actions,
            .form-actions {
                align-items: stretch;
                flex-direction: column;
            }

            .brand {
                align-self: flex-start;
            }

            .nav-link-luxury,
            .btn-luxury,
            .btn-ghost {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <nav class="profile-nav">
        <a href="{{ route('home') }}" class="brand">
            <strong>AURUM</strong>
            <span>Luxury Jewellery</span>
        </a>

        <div class="nav-actions">
            <a href="{{ route('home') }}" class="nav-link-luxury">
                <i class="bi bi-house"></i>
                <span>Store</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-ghost">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div>
    </nav>

    <main class="profile-shell">
        <section class="profile-hero">
            <div>
                <span class="eyebrow">Customer Profile</span>
                <h1>Welcome, {{ $user->name }}</h1>
                <p class="hero-copy">Manage your Aurum account details and keep your jewellery shopping profile ready for every visit.</p>
            </div>

            <span class="role-pill">
                <i class="bi bi-person-check"></i>
                {{ ucfirst($user->role) }}
            </span>
        </section>

        <div class="profile-grid">
            <aside class="panel customer-card">
                <div class="panel-inner">
                    <div class="avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <h2>{{ $user->name }}</h2>
                    <p class="mb-0">{{ $user->email }}</p>

                    <div class="detail-list">
                        <div class="detail">
                            <span>Role</span>
                            <strong>{{ ucfirst($user->role) }}</strong>
                        </div>
                        <div class="detail">
                            <span>Member Since</span>
                            <strong>{{ $user->created_at?->format('d M Y') }}</strong>
                        </div>
                        <div class="detail">
                            <span>Email Status</span>
                            <strong>{{ $user->email_verified_at ? 'Verified' : 'Not Verified' }}</strong>
                        </div>
                    </div>
                </div>
            </aside>

            <section>
                <div class="panel form-panel">
                    <div class="panel-inner">
                        <h2 class="panel-title">Account Information</h2>
                        <p class="panel-copy mb-0">Update the name and email address connected with your customer account.</p>

                        <form method="POST" action="{{ route('customer.profile.update') }}">
                            @csrf
                            @method('patch')

                            <div class="form-row-two">
                                <div class="field">
                                    <label for="name">Name</label>
                                    <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name">
                                    @error('name')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="email">Email</label>
                                    <input id="email" type="email" name="email" value="{{ old('email', $user->email) }}" required autocomplete="username">
                                    @error('email')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-luxury">
                                    <i class="bi bi-check2"></i>
                                    <span>Save Profile</span>
                                </button>

                                @if (session('status') === 'profile-updated')
                                    <p class="status-text">Profile updated successfully.</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel form-panel">
                    <div class="panel-inner">
                        <h2 class="panel-title">Password</h2>
                        <p class="panel-copy mb-0">Choose a strong password to protect your customer account.</p>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            @method('put')

                            <div class="field">
                                <label for="current_password">Current Password</label>
                                <input id="current_password" type="password" name="current_password" autocomplete="current-password">
                                @error('current_password', 'updatePassword')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-row-two">
                                <div class="field">
                                    <label for="password">New Password</label>
                                    <input id="password" type="password" name="password" autocomplete="new-password">
                                    @error('password', 'updatePassword')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="field">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input id="password_confirmation" type="password" name="password_confirmation" autocomplete="new-password">
                                    @error('password_confirmation', 'updatePassword')
                                        <p class="error-text">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-luxury">
                                    <i class="bi bi-shield-lock"></i>
                                    <span>Update Password</span>
                                </button>

                                @if (session('status') === 'password-updated')
                                    <p class="status-text">Password updated successfully.</p>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel form-panel">
                    <div class="panel-inner">
                        <h2 class="panel-title">Delete Account</h2>
                        <p class="panel-copy mb-0">This permanently removes your customer account from Aurum.</p>

                        <form method="POST" action="{{ route('customer.profile.destroy') }}">
                            @csrf
                            @method('delete')

                            <div class="field">
                                <label for="delete_password">Confirm Password</label>
                                <input id="delete_password" type="password" name="password" autocomplete="current-password">
                                @error('password', 'userDeletion')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-ghost btn-danger-soft" onclick="return confirm('Delete your customer account permanently?')">
                                    <i class="bi bi-trash3"></i>
                                    <span>Delete Account</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>
        </div>
    </main>
</body>
</html>
