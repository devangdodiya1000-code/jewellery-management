<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>AURUM — Luxury Jewellery</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Bootstrap Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>
  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Josefin+Sans:wght@200;300;400;600&display=swap" rel="stylesheet"/>

  <style>
    /* ═══════════════════════════════════════════
       CSS VARIABLES & RESET
    ═══════════════════════════════════════════ */
    :root {
      --gold:        #D4AF37;
      --gold-light:  #E8C84A;
      --gold-dark:   #A8871A;
      --gold-pale:   rgba(212, 175, 55, 0.12);
      --gold-glow:   rgba(212, 175, 55, 0.45);
      --black:       #000000;
      --black-rich:  #0A0A0A;
      --beige:       #F5EFE0;
      --beige-mid:   #EDE3CE;
      --white:       #FFFFFF;
      --text-muted:  #9A8C72;
      --nav-height:  80px;
      --font-serif:  'Cormorant Garamond', Georgia, serif;
      --font-sans:   'Josefin Sans', 'Gill Sans', sans-serif;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    html { scroll-behavior: smooth; }

    body {
      font-family: var(--font-sans);
      background: var(--black-rich);
      color: var(--white);
      overflow-x: hidden;
    }

    /* ═══════════════════════════════════════════
       CUSTOM SCROLLBAR
    ═══════════════════════════════════════════ */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: var(--black); }
    ::-webkit-scrollbar-thumb { background: var(--gold-dark); border-radius: 3px; }

    /* ═══════════════════════════════════════════
       ANNOUNCEMENT BAR
    ═══════════════════════════════════════════ */
    .announcement-bar {
      background: var(--gold);
      color: var(--black);
      text-align: center;
      padding: 8px 16px;
      font-family: var(--font-sans);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 3px;
      text-transform: uppercase;
    }

    /* ═══════════════════════════════════════════
       NAVBAR
    ═══════════════════════════════════════════ */
    #mainNav {
      position: fixed;
      top: 0; left: 0; right: 0;
      z-index: 1000;
      height: var(--nav-height);
      background: transparent;
      transition: background 0.5s ease, box-shadow 0.5s ease, backdrop-filter 0.5s ease;
      border-bottom: 1px solid transparent;
    }

    #mainNav.scrolled {
      background: rgba(0, 0, 0, 0.92);
      backdrop-filter: blur(18px);
      -webkit-backdrop-filter: blur(18px);
      box-shadow: 0 4px 40px rgba(0,0,0,0.6), 0 1px 0 rgba(212,175,55,0.2);
      border-bottom-color: rgba(212, 175, 55, 0.18);
    }

    .navbar-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      height: var(--nav-height);
      padding: 0 40px;
    }

    /* Logo */
    .nav-logo {
      display: flex;
      flex-direction: column;
      line-height: 1;
      text-decoration: none;
      gap: 2px;
    }
    .nav-logo-main {
      font-family: var(--font-serif);
      font-size: 28px;
      font-weight: 600;
      color: var(--gold);
      letter-spacing: 6px;
      text-transform: uppercase;
    }
    .nav-logo-sub {
      font-family: var(--font-sans);
      font-size: 8px;
      font-weight: 300;
      color: rgba(212,175,55,0.65);
      letter-spacing: 5px;
      text-transform: uppercase;
      text-align: center;
    }

    /* Nav Links */
    .nav-links {
      display: flex;
      align-items: center;
      gap: 10px;
      list-style: none;
    }

    .nav-links > li > a {
      font-family: var(--font-sans);
      font-size: 11px;
      font-weight: 400;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.85);
      text-decoration: none;
      padding: 8px 14px;
      position: relative;
      transition: color 0.3s;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .nav-links > li > a::after {
      content: '';
      position: absolute;
      bottom: 2px;
      left: 14px;
      right: 14px;
      height: 1px;
      background: var(--gold);
      transform: scaleX(0);
      transform-origin: right;
      transition: transform 0.4s cubic-bezier(0.77, 0, 0.175, 1);
    }

    .nav-links > li > a:hover,
    .nav-links > li > a.active {
      color: var(--gold);
    }

    .nav-links > li > a:hover::after,
    .nav-links > li > a.active::after {
      transform: scaleX(1);
      transform-origin: left;
    }

    /* Dropdown */
    .nav-dropdown {
      position: relative;
    }

    .dropdown-menu-custom {
      position: absolute;
      top: calc(100% + 14px);
      left: 50%;
      transform: translateX(-50%) translateY(10px);
      min-width: 220px;
      z-index: 1200;
      background: rgba(8, 8, 8, 0.97);
      border: 1px solid rgba(212,175,55,0.2);
      backdrop-filter: blur(20px);
      padding: 12px 0;
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.35s ease, transform 0.35s cubic-bezier(0.165, 0.84, 0.44, 1), visibility 0.35s;
      pointer-events: none;
    }

    .dropdown-menu-custom::before {
      content: '';
      position: absolute;
      top: -6px;
      left: 50%;
      transform: translateX(-50%);
      width: 10px; height: 10px;
      background: rgba(8,8,8,0.97);
      border-left: 1px solid rgba(212,175,55,0.2);
      border-top: 1px solid rgba(212,175,55,0.2);
      transform: translateX(-50%) rotate(45deg);
    }

    .nav-dropdown.open .dropdown-menu-custom {
      opacity: 1;
      visibility: visible;
      transform: translateX(-50%) translateY(0);
      pointer-events: auto;
    }

    .dropdown-menu-custom a {
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 24px;
      font-family: var(--font-sans);
      font-size: 10px;
      font-weight: 300;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.7);
      text-decoration: none;
      transition: color 0.25s, background 0.25s, padding-left 0.25s;
    }

    .dropdown-menu-custom button {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 12px;
      padding: 10px 24px;
      font-family: var(--font-sans);
      font-size: 10px;
      font-weight: 300;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.7);
      background: transparent;
      border: 0;
      text-align: left;
      transition: color 0.25s, background 0.25s, padding-left 0.25s;
    }

    .dropdown-menu-custom a:hover,
    .dropdown-menu-custom button:hover {
      color: var(--gold);
      background: rgba(212,175,55,0.06);
      padding-left: 32px;
    }

    .dropdown-menu-custom a .cat-dot {
      width: 5px; height: 5px;
      border-radius: 50%;
      background: var(--gold-dark);
      flex-shrink: 0;
    }

    .account-menu .dropdown-menu-custom {
      left: auto;
      right: 0;
      transform: translateY(10px);
      min-width: 250px;
    }

    .account-menu .dropdown-menu-custom::before {
      left: auto;
      right: 15px;
      transform: rotate(45deg);
    }

    .account-menu.open .dropdown-menu-custom {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
      pointer-events: auto;
    }

    .account-menu-form {
      margin: 0;
    }

    .account-summary {
      padding: 10px 24px 12px;
      border-bottom: 1px solid rgba(212,175,55,0.12);
      margin-bottom: 6px;
    }

    .account-summary strong {
      display: block;
      color: var(--gold);
      font-family: var(--font-serif);
      font-size: 20px;
      font-weight: 500;
      line-height: 1.05;
    }

    .account-summary span {
      display: block;
      margin-top: 5px;
      color: rgba(255,255,255,0.48);
      font-size: 9px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      word-break: break-word;
    }

    /* Nav Icons */
    .nav-icons {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .nav-icon-btn {
      position: relative;
      width: 40px; height: 40px;
      display: flex; align-items: center; justify-content: center;
      color: rgba(255,255,255,0.75);
      font-size: 17px;
      background: transparent;
      border: none;
      cursor: pointer;
      transition: color 0.3s, transform 0.3s;
      border-radius: 50%;
    }

    .nav-icon-btn:hover {
      color: var(--gold);
      transform: scale(1.1);
    }

    .cart-badge {
      position: absolute;
      top: 4px; right: 4px;
      width: 17px; height: 17px;
      background: var(--gold);
      color: var(--black);
      border-radius: 50%;
      font-size: 9px;
      font-weight: 700;
      font-family: var(--font-sans);
      display: flex; align-items: center; justify-content: center;
      line-height: 1;
      animation: badgePop 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @keyframes badgePop {
      0% { transform: scale(0); }
      100% { transform: scale(1); }
    }

    /* Cart Drawer */
    body.cart-drawer-open {
      overflow: hidden;
    }

    .cart-drawer-overlay {
      position: fixed;
      inset: 0;
      z-index: 1600;
      background: rgba(0, 0, 0, 0.62);
      opacity: 0;
      visibility: hidden;
      transition: opacity 0.3s ease, visibility 0.3s ease;
    }

    .cart-drawer-overlay.show {
      opacity: 1;
      visibility: visible;
    }

    .cart-drawer {
      position: fixed;
      top: 0;
      right: 0;
      z-index: 1700;
      width: min(420px, 100vw);
      height: 100vh;
      background: rgba(8, 8, 8, 0.98);
      border-left: 1px solid rgba(212,175,55,0.22);
      box-shadow: -24px 0 70px rgba(0,0,0,0.58);
      transform: translateX(100%);
      transition: transform 0.38s cubic-bezier(0.77, 0, 0.175, 1);
      display: flex;
      flex-direction: column;
    }

    .cart-drawer.show {
      transform: translateX(0);
    }

    .cart-drawer-header {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 26px 26px 20px;
      border-bottom: 1px solid rgba(212,175,55,0.14);
    }

    .cart-drawer-title {
      font-family: var(--font-serif);
      color: var(--gold);
      font-size: 32px;
      line-height: 1;
      margin: 0;
    }

    .cart-drawer-count {
      color: rgba(255,255,255,0.55);
      font-size: 10px;
      letter-spacing: 2px;
      text-transform: uppercase;
      margin-top: 6px;
    }

    .cart-close-btn {
      width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(212,175,55,0.2);
      border-radius: 50%;
      background: transparent;
      color: rgba(255,255,255,0.74);
      transition: color 0.25s, border-color 0.25s, transform 0.25s;
    }

    .cart-close-btn:hover {
      color: var(--gold);
      border-color: rgba(212,175,55,0.5);
      transform: rotate(90deg);
    }

    .cart-drawer-body {
      flex: 1;
      overflow-y: auto;
      padding: 22px 26px;
    }

    .cart-item {
      display: grid;
      grid-template-columns: 82px 1fr;
      gap: 16px;
      padding: 16px 0;
      border-bottom: 1px solid rgba(255,255,255,0.08);
    }

    .cart-item:first-child {
      padding-top: 0;
    }

    .cart-item-image {
      width: 82px;
      height: 96px;
      object-fit: cover;
      border: 1px solid rgba(212,175,55,0.18);
      background: #050505;
    }

    .cart-item-info {
      min-width: 0;
    }

    .cart-item-name {
      font-family: var(--font-serif);
      font-size: 22px;
      line-height: 1.05;
      color: var(--white);
      margin: 0 0 8px;
    }

    .cart-item-meta {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      color: rgba(255,255,255,0.48);
      font-size: 10px;
      letter-spacing: 1.7px;
      text-transform: uppercase;
      margin-bottom: 12px;
    }

    .cart-item-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .cart-qty {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      color: rgba(255,255,255,0.68);
      font-size: 12px;
    }

    .cart-qty button {
      width: 26px;
      height: 26px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border: 1px solid rgba(212,175,55,0.2);
      border-radius: 50%;
      background: transparent;
      color: rgba(255,255,255,0.7);
      cursor: default;
    }

    .cart-item-price {
      color: var(--gold);
      font-weight: 600;
      font-size: 14px;
      white-space: nowrap;
    }

    .cart-drawer-footer {
      padding: 20px 26px 26px;
      border-top: 1px solid rgba(212,175,55,0.14);
      background: rgba(0,0,0,0.62);
    }

    .cart-total-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: var(--white);
      font-family: var(--font-serif);
      font-size: 24px;
      margin-bottom: 16px;
    }

    .cart-total-row span:first-child {
      color: rgba(255,255,255,0.64);
      font-family: var(--font-sans);
      font-size: 11px;
      letter-spacing: 2.5px;
      text-transform: uppercase;
    }

    .cart-checkout-btn {
      width: 100%;
      height: 48px;
      border: 1px solid var(--gold);
      background: var(--gold);
      color: var(--black);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      transition: background 0.25s, color 0.25s;
    }

    .cart-checkout-btn:hover {
      background: transparent;
      color: var(--gold);
    }

    /* Hamburger */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      cursor: pointer;
      padding: 8px;
      background: none;
      border: none;
    }

    .hamburger span {
      display: block;
      width: 24px; height: 1.5px;
      background: var(--white);
      transition: all 0.4s cubic-bezier(0.77, 0, 0.175, 1);
    }

    .hamburger.open span:nth-child(1) {
      transform: translateY(6.5px) rotate(45deg);
      background: var(--gold);
    }
    .hamburger.open span:nth-child(2) {
      opacity: 0; transform: scaleX(0);
    }
    .hamburger.open span:nth-child(3) {
      transform: translateY(-6.5px) rotate(-45deg);
      background: var(--gold);
    }

    /* Mobile Menu */
    .mobile-menu {
      display: none;
      position: fixed;
      top: var(--nav-height);
      left: 0; right: 0;
      background: rgba(0,0,0,0.97);
      backdrop-filter: blur(20px);
      padding: 20px 0 40px;
      border-bottom: 1px solid rgba(212,175,55,0.15);
      transform: translateY(-20px);
      opacity: 0;
      transition: all 0.4s ease;
      z-index: 999;
    }

    .mobile-menu.show {
      display: block;
      transform: translateY(0);
      opacity: 1;
    }

    .mobile-menu a {
      display: block;
      padding: 13px 40px;
      font-family: var(--font-sans);
      font-size: 11px;
      font-weight: 300;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.75);
      text-decoration: none;
      border-bottom: 1px solid rgba(255,255,255,0.05);
      transition: color 0.2s, padding-left 0.3s;
    }

    .mobile-menu form {
      margin: 0;
    }

    .mobile-menu button {
      width: 100%;
      display: block;
      padding: 13px 40px;
      font-family: var(--font-sans);
      font-size: 11px;
      font-weight: 300;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.75);
      background: transparent;
      border: 0;
      border-bottom: 1px solid rgba(255,255,255,0.05);
      text-align: left;
      transition: color 0.2s, padding-left 0.3s;
    }

    .mobile-menu a:hover,
    .mobile-menu button:hover {
      color: var(--gold);
      padding-left: 52px;
    }

    /* ═══════════════════════════════════════════
       HERO SECTION
    ═══════════════════════════════════════════ */
    .hero {
      position: relative;
      width: 100%;
      height: 100vh;
      min-height: 700px;
      overflow: hidden;
      display: flex;
      align-items: center;
    }

    /* Gradient background (no external image needed) */
    .hero-bg {
      position: absolute;
      inset: 0;
      background:
        radial-gradient(ellipse 80% 60% at 70% 50%, rgba(212,175,55,0.08) 0%, transparent 60%),
        radial-gradient(ellipse 60% 80% at 20% 80%, rgba(212,175,55,0.05) 0%, transparent 50%),
        linear-gradient(135deg, #0A0806 0%, #1A1208 40%, #080604 100%);
      will-change: transform;
      transition: transform 0.05s linear;
    }

    /* Decorative geometric overlays */
    .hero-geo {
      position: absolute;
      inset: 0;
      pointer-events: none;
      overflow: hidden;
    }

    .geo-circle-1 {
      position: absolute;
      right: 8%;
      top: 50%;
      transform: translateY(-50%);
      width: clamp(300px, 42vw, 640px);
      height: clamp(300px, 42vw, 640px);
      border-radius: 50%;
      border: 1px solid rgba(212,175,55,0.12);
      animation: rotateSlow 30s linear infinite;
    }

    .geo-circle-2 {
      position: absolute;
      right: calc(8% + 40px);
      top: 50%;
      transform: translateY(-50%);
      width: clamp(240px, 34vw, 520px);
      height: clamp(240px, 34vw, 520px);
      border-radius: 50%;
      border: 1px solid rgba(212,175,55,0.18);
      animation: rotateSlow 20s linear infinite reverse;
    }

    .geo-circle-3 {
      position: absolute;
      right: calc(8% + 90px);
      top: 50%;
      transform: translateY(-50%);
      width: clamp(160px, 24vw, 380px);
      height: clamp(160px, 24vw, 380px);
      border-radius: 50%;
      border: 1px dashed rgba(212,175,55,0.25);
      animation: rotateSlow 15s linear infinite;
    }

    .geo-diamond {
      position: absolute;
      right: calc(8% + 160px);
      top: 50%;
      transform: translateY(-50%) rotate(45deg);
      width: clamp(60px, 8vw, 120px);
      height: clamp(60px, 8vw, 120px);
      border: 1px solid rgba(212,175,55,0.4);
    }

    .geo-line-h {
      position: absolute;
      top: 50%;
      right: 0;
      width: 52%;
      height: 1px;
      background: linear-gradient(to left, transparent, rgba(212,175,55,0.2));
      transform: translateY(0);
    }

    /* Floating gold dust particles */
    .particle {
      position: absolute;
      border-radius: 50%;
      background: var(--gold);
      opacity: 0;
      animation: floatParticle var(--dur, 8s) var(--delay, 0s) ease-in-out infinite;
    }

    @keyframes floatParticle {
      0%   { opacity: 0; transform: translateY(100px) scale(0); }
      15%  { opacity: var(--op, 0.6); }
      85%  { opacity: var(--op, 0.6); }
      100% { opacity: 0; transform: translateY(-120px) scale(0.5); }
    }

    @keyframes rotateSlow {
      from { transform: translateY(-50%) rotate(0deg); }
      to   { transform: translateY(-50%) rotate(360deg); }
    }

    /* Hero decorative jewel SVG center */
    .hero-jewel {
      position: absolute;
      right: calc(8% + 100px);
      top: 50%;
      transform: translateY(-50%);
      width: clamp(80px, 12vw, 180px);
      height: clamp(80px, 12vw, 180px);
      animation: jewelFloat 6s ease-in-out infinite;
      filter: drop-shadow(0 0 30px rgba(212,175,55,0.5));
    }

    @keyframes jewelFloat {
      0%, 100% { transform: translateY(-50%) translateY(0px);   }
      50%       { transform: translateY(-50%) translateY(-18px); }
    }

    /* Hero Content */
    .hero-content {
      position: relative;
      z-index: 10;
      padding-left: clamp(30px, 8vw, 120px);
      max-width: 680px;
    }

    .hero-eyebrow {
      display: flex;
      align-items: center;
      gap: 14px;
      margin-bottom: 28px;
      opacity: 0;
      animation: slideUp 0.8s ease 0.3s forwards;
    }

    .hero-eyebrow-line {
      width: 48px;
      height: 1px;
      background: var(--gold);
    }

    .hero-eyebrow-text {
      font-family: var(--font-sans);
      font-size: 10px;
      font-weight: 400;
      letter-spacing: 5px;
      text-transform: uppercase;
      color: var(--gold);
    }

    .hero-title {
      font-family: var(--font-serif);
      font-size: clamp(52px, 8vw, 110px);
      font-weight: 300;
      line-height: 0.95;
      color: var(--white);
      margin-bottom: 6px;
      opacity: 0;
      animation: slideUp 0.9s ease 0.55s forwards;
    }

    .hero-title em {
      font-style: italic;
      color: var(--gold);
      display: block;
    }

    .hero-subtitle {
      font-family: var(--font-serif);
      font-size: clamp(16px, 2vw, 22px);
      font-weight: 300;
      font-style: italic;
      color: rgba(255,255,255,0.55);
      letter-spacing: 1px;
      margin-top: 20px;
      margin-bottom: 50px;
      max-width: 420px;
      line-height: 1.7;
      opacity: 0;
      animation: slideUp 0.9s ease 0.8s forwards;
    }

    .hero-cta-group {
      display: flex;
      align-items: center;
      gap: 20px;
      flex-wrap: wrap;
      opacity: 0;
      animation: slideUp 0.9s ease 1.05s forwards;
    }

    /* Primary CTA */
    .btn-luxury {
      position: relative;
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 16px 38px;
      font-family: var(--font-sans);
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 3.5px;
      text-transform: uppercase;
      text-decoration: none;
      color: var(--black);
      background: var(--gold);
      border: none;
      cursor: pointer;
      overflow: hidden;
      transition: color 0.4s ease, transform 0.3s ease, box-shadow 0.4s ease;
    }

    .btn-luxury::before {
      content: '';
      position: absolute;
      inset: 0;
      background: linear-gradient(135deg, var(--gold-light), var(--gold), var(--gold-dark), var(--gold-light));
      background-size: 300% 300%;
      opacity: 0;
      transition: opacity 0.4s;
      animation: shimmer 3s ease infinite;
    }

    .btn-luxury:hover::before { opacity: 1; }

    .btn-luxury:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 40px var(--gold-glow), 0 0 0 1px var(--gold);
      color: var(--black);
    }

    .btn-luxury span { position: relative; z-index: 1; }

    /* Ghost CTA */
    .btn-ghost {
      display: inline-flex;
      align-items: center;
      gap: 10px;
      padding: 16px 38px;
      font-family: var(--font-sans);
      font-size: 10px;
      font-weight: 400;
      letter-spacing: 3.5px;
      text-transform: uppercase;
      text-decoration: none;
      color: var(--white);
      background: transparent;
      border: 1px solid rgba(255,255,255,0.3);
      cursor: pointer;
      transition: color 0.4s, border-color 0.4s, background 0.4s, transform 0.3s, box-shadow 0.4s;
    }

    .btn-ghost:hover {
      color: var(--gold);
      border-color: var(--gold);
      background: rgba(212,175,55,0.06);
      transform: translateY(-2px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.3);
    }

    .btn-arrow {
      transition: transform 0.3s ease;
    }
    .btn-luxury:hover .btn-arrow,
    .btn-ghost:hover .btn-arrow {
      transform: translateX(5px);
    }

    /* Hero scroll indicator */
    .hero-scroll {
      position: absolute;
      bottom: 40px;
      left: 50%;
      transform: translateX(-50%);
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 10px;
      opacity: 0;
      animation: fadeIn 1s ease 1.6s forwards;
      cursor: pointer;
      z-index: 10;
    }

    .hero-scroll-text {
      font-family: var(--font-sans);
      font-size: 8px;
      font-weight: 300;
      letter-spacing: 4px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
    }

    .hero-scroll-track {
      width: 1px;
      height: 50px;
      background: rgba(255,255,255,0.15);
      position: relative;
      overflow: hidden;
    }

    .hero-scroll-fill {
      position: absolute;
      top: 0; left: 0;
      width: 100%;
      background: var(--gold);
      height: 40%;
      animation: scrollDown 2s ease-in-out infinite;
    }

    @keyframes scrollDown {
      0%   { top: -40%; height: 40%; }
      100% { top: 140%; height: 40%; }
    }

    /* Hero Stats Bar */
    .hero-stats {
      position: absolute;
      bottom: 0;
      left: 0; right: 0;
      display: flex;
      align-items: stretch;
      border-top: 1px solid rgba(212,175,55,0.12);
      background: rgba(0,0,0,0.5);
      backdrop-filter: blur(10px);
      z-index: 10;
      opacity: 0;
      animation: fadeIn 1s ease 1.4s forwards;
    }

    .hero-stat {
      flex: 1;
      padding: 22px 30px;
      display: flex;
      flex-direction: column;
      gap: 5px;
      border-right: 1px solid rgba(212,175,55,0.1);
      transition: background 0.3s;
    }

    .hero-stat:last-child { border-right: none; }
    .hero-stat:hover { background: rgba(212,175,55,0.04); }

    .hero-stat-num {
      font-family: var(--font-serif);
      font-size: 28px;
      font-weight: 500;
      color: var(--gold);
      line-height: 1;
    }

    .hero-stat-label {
      font-family: var(--font-sans);
      font-size: 8px;
      font-weight: 300;
      letter-spacing: 2.5px;
      text-transform: uppercase;
      color: rgba(255,255,255,0.4);
    }

    /* Animations */
    @keyframes slideUp {
      from { opacity: 0; transform: translateY(30px); }
      to   { opacity: 1; transform: translateY(0);    }
    }

    @keyframes fadeIn {
      from { opacity: 0; }
      to   { opacity: 1; }
    }

    @keyframes shimmer {
      0%   { background-position: 0%   50%; }
      50%  { background-position: 100% 50%; }
      100% { background-position: 0%   50%; }
    }

    /* ═══════════════════════════════════════════
       SECTION BELOW HERO (teaser)
    ═══════════════════════════════════════════ */
    .section-teaser {
      padding: 100px 0 80px;
      background: var(--black-rich);
      text-align: center;
    }

    .section-teaser .divider {
      display: flex;
      align-items: center;
      gap: 20px;
      justify-content: center;
      margin-bottom: 50px;
    }

    .section-teaser .divider-line {
      width: 80px;
      height: 1px;
      background: linear-gradient(to right, transparent, var(--gold));
    }

    .section-teaser .divider-line.right {
      background: linear-gradient(to left, transparent, var(--gold));
    }

    .section-teaser .divider-diamond {
      width: 8px; height: 8px;
      background: var(--gold);
      transform: rotate(45deg);
    }

    .section-teaser h2 {
      font-family: var(--font-serif);
      font-size: clamp(36px, 5vw, 62px);
      font-weight: 300;
      color: var(--white);
      margin-bottom: 16px;
    }

    .section-teaser p {
      font-family: var(--font-sans);
      font-size: 11px;
      letter-spacing: 3px;
      text-transform: uppercase;
      color: var(--text-muted);
    }

    /* ═══════════════════════════════════════════
       PRODUCT CARDS
    ═══════════════════════════════════════════ */
    .product-showcase {
      position: relative;
      padding: 10px 0 120px;
      background:
        radial-gradient(ellipse 58% 44% at 50% 0%, rgba(212,175,55,0.08), transparent 65%),
        linear-gradient(180deg, var(--black-rich) 0%, #060504 100%);
      overflow: hidden;
    }

    .product-showcase::before {
      content: '';
      position: absolute;
      left: 50%;
      top: 0;
      width: min(1180px, 88vw);
      height: 1px;
      transform: translateX(-50%);
      background: linear-gradient(to right, transparent, rgba(212,175,55,0.35), transparent);
    }

    .product-grid {
      position: relative;
      z-index: 1;
      width: min(1180px, calc(100% - 48px));
      margin: 0 auto;
      display: grid;
      grid-template-columns: repeat(3, minmax(0, 1fr));
      gap: 24px;
    }

    .jewellery-card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-height: 100%;
      background: #0f0e0c;
      border: 1px solid rgba(232,200,74,0.16);
      border-radius: 8px;
      overflow: hidden;
      box-shadow: 0 18px 56px rgba(0,0,0,0.32);
      opacity: 0;
      transform: translateY(26px);
      animation: slideUp 0.85s ease forwards;
      transition: transform 0.35s ease, border-color 0.35s, box-shadow 0.35s, background 0.35s;
    }

    .jewellery-card:hover {
      transform: translateY(-7px);
      background: #14120f;
      border-color: rgba(232,200,74,0.38);
      box-shadow: 0 28px 76px rgba(0,0,0,0.45);
    }

    .product-media {
      position: relative;
      aspect-ratio: 1 / 1.05;
      background:
        linear-gradient(180deg, rgba(245,239,224,0.08), transparent 60%),
        #080807;
      overflow: hidden;
    }

    .product-media::after {
      content: '';
      position: absolute;
      inset: auto 18px 0;
      height: 1px;
      background: linear-gradient(to right, transparent, rgba(212,175,55,0.38), transparent);
      z-index: 2;
    }

    .product-media img {
      width: 100%;
      height: 100%;
      object-fit: contain;
      padding: 28px;
      transition: transform 0.55s ease, filter 0.55s;
      filter: saturate(0.98) contrast(1.04);
    }

    .jewellery-card:hover .product-media img {
      transform: scale(1.045);
      filter: saturate(1.08) contrast(1.08);
    }

    .product-tag {
      position: absolute;
      top: 14px;
      left: 14px;
      z-index: 2;
      max-width: calc(100% - 74px);
      padding: 7px 10px 6px;
      background: rgba(245,239,224,0.92);
      border: 1px solid rgba(212,175,55,0.28);
      color: var(--black-rich);
      font-family: var(--font-sans);
      font-size: 8px;
      font-weight: 600;
      letter-spacing: 1.8px;
      text-transform: uppercase;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    .wishlist-btn {
      position: absolute;
      top: 12px;
      right: 12px;
      z-index: 2;
      width: 36px;
      height: 36px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: rgba(255,255,255,0.78);
      background: rgba(0,0,0,0.5);
      border: 1px solid rgba(255,255,255,0.18);
      border-radius: 50%;
      cursor: pointer;
      backdrop-filter: blur(12px);
      transition: color 0.3s, border-color 0.3s, transform 0.3s, background 0.3s;
    }

    .wishlist-btn:hover,
    .wishlist-btn.active {
      color: var(--gold);
      border-color: rgba(212,175,55,0.5);
      background: rgba(212,175,55,0.1);
      transform: scale(1.08);
    }

    .product-body {
      display: flex;
      flex: 1;
      flex-direction: column;
      padding: 20px;
    }

    .product-meta {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
      margin-bottom: 10px;
      color: var(--text-muted);
      font-family: var(--font-sans);
      font-size: 9px;
      letter-spacing: 2.2px;
      text-transform: uppercase;
    }

    .product-stock {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      color: rgba(255,255,255,0.56);
      white-space: nowrap;
    }

    .product-stock::before {
      content: '';
      width: 6px;
      height: 6px;
      border-radius: 50%;
      background: #58c484;
      box-shadow: 0 0 0 4px rgba(88,196,132,0.12);
    }

    .product-stock.out-of-stock::before {
      background: #b95b5b;
      box-shadow: 0 0 0 4px rgba(185,91,91,0.14);
    }

    .product-title {
      font-family: var(--font-serif);
      font-size: clamp(25px, 2.2vw, 31px);
      font-weight: 500;
      line-height: 1.08;
      color: var(--white);
      margin-bottom: 8px;
    }

    .product-description {
      min-height: 48px;
      margin-bottom: 18px;
      color: rgba(255,255,255,0.58);
      font-family: var(--font-sans);
      font-size: 13px;
      font-weight: 300;
      line-height: 1.55;
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }

    .product-details {
      display: flex;
      flex-wrap: wrap;
      gap: 8px;
      margin-bottom: 18px;
    }

    .product-detail {
      min-width: 0;
      flex: 1 1 120px;
      padding: 10px 11px;
      background: rgba(255,255,255,0.035);
      border: 1px solid rgba(212,175,55,0.12);
      border-radius: 6px;
    }

    .product-detail span {
      display: block;
      margin-bottom: 5px;
      color: rgba(255,255,255,0.38);
      font-size: 8px;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .product-detail strong {
      color: var(--gold);
      font-family: var(--font-sans);
      font-size: 11px;
      font-weight: 600;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .product-footer {
      display: flex;
      flex-direction: column;
      gap: 16px;
      margin-top: auto;
      padding-top: 18px;
      border-top: 1px solid rgba(212,175,55,0.12);
    }

    .product-purchase-row {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 14px;
      width: 100%;
    }

    .product-price {
      display: flex;
      flex-direction: column;
      gap: 4px;
      min-width: 0;
    }

    .product-price .current {
      font-family: var(--font-serif);
      font-size: 26px;
      font-weight: 500;
      color: var(--gold);
      line-height: 1;
      white-space: nowrap;
    }

    .product-price .original {
      color: rgba(255,255,255,0.38);
      font-size: 11px;
      text-decoration: line-through;
    }

    .product-qty {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      color: rgba(255,255,255,0.5);
      font-size: 9px;
      letter-spacing: 2px;
      text-transform: uppercase;
      white-space: nowrap;
    }

    .product-qty select {
      height: 38px;
      min-width: 62px;
      padding: 0 28px 0 12px;
      color: var(--white);
      background: rgba(255,255,255,0.04);
      border: 1px solid rgba(212,175,55,0.24);
      border-radius: 6px;
      font-family: var(--font-sans);
      font-size: 12px;
      outline: none;
    }

    .product-actions {
      width: 100%;
      display: flex;
      align-items: center;
      gap: 8px;
      justify-content: space-between;
    }

    .product-actions .btn-luxury,
    .product-actions .btn-ghost {
      flex: 1 1 auto;
      justify-content: center;
      min-height: 44px;
      padding: 12px 14px;
      border-radius: 6px;
      font-size: 8px;
      letter-spacing: 1.9px;
      white-space: nowrap;
    }

    .product-actions .btn-icon {
      flex: 0 0 44px;
      width: 44px;
      height: 44px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: var(--white);
      border: 1px solid rgba(255,255,255,0.18);
      background: rgba(255,255,255,0.03);
      border-radius: 6px;
      transition: color 0.3s, border-color 0.3s, transform 0.3s, background 0.3s;
    }

    .product-actions .btn-icon:hover {
      color: var(--gold);
      border-color: rgba(212,175,55,0.5);
      background: rgba(212,175,55,0.08);
      transform: translateY(-2px);
    }

    .quick-view-modal .modal-content {
      color: var(--white);
      background: rgba(8,8,8,0.97);
      border: 1px solid rgba(212,175,55,0.24);
      border-radius: 8px;
      box-shadow: 0 30px 100px rgba(0,0,0,0.6);
    }

    .quick-view-modal .modal-header,
    .quick-view-modal .modal-footer {
      border-color: rgba(212,175,55,0.14);
    }

    .quick-view-modal .btn-close {
      filter: invert(1) sepia(1) saturate(0.6);
      opacity: 0.85;
    }

    .quick-view-image {
      width: 100%;
      aspect-ratio: 1 / 1;
      object-fit: cover;
      border: 1px solid rgba(212,175,55,0.16);
      background: #050505;
    }

    .quick-view-title {
      font-family: var(--font-serif);
      font-size: clamp(34px, 5vw, 52px);
      line-height: 1;
      color: var(--gold);
    }

    .quick-view-text {
      color: rgba(255,255,255,0.62);
      font-family: var(--font-serif);
      font-size: 18px;
      font-style: italic;
      line-height: 1.65;
    }

    /* ═══════════════════════════════════════════
       ABOUT & CONTACT
    ═══════════════════════════════════════════ */
    .info-section {
      position: relative;
      padding: 112px 0;
      background: #080706;
      border-top: 1px solid rgba(212,175,55,0.12);
    }

    .info-section.alt {
      background:
        radial-gradient(ellipse 42% 52% at 18% 0%, rgba(212,175,55,0.08), transparent 65%),
        #0c0b09;
    }

    .info-wrap {
      width: min(1180px, calc(100% - 48px));
      margin: 0 auto;
      display: grid;
      grid-template-columns: minmax(0, 1.05fr) minmax(320px, 0.95fr);
      gap: 56px;
      align-items: center;
    }

    .info-eyebrow {
      display: inline-flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 18px;
      color: var(--gold);
      font-size: 10px;
      font-weight: 600;
      letter-spacing: 3px;
      text-transform: uppercase;
    }

    .info-eyebrow::before {
      content: '';
      width: 42px;
      height: 1px;
      background: var(--gold);
    }

    .info-title {
      max-width: 620px;
      margin-bottom: 22px;
      color: var(--white);
      font-family: var(--font-serif);
      font-size: clamp(38px, 5vw, 66px);
      font-weight: 400;
      line-height: 0.98;
    }

    .info-text {
      max-width: 620px;
      color: rgba(255,255,255,0.64);
      font-family: var(--font-serif);
      font-size: 21px;
      font-style: italic;
      line-height: 1.6;
    }

    .info-points {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
      margin-top: 34px;
    }

    .info-point {
      padding: 18px;
      background: rgba(255,255,255,0.035);
      border: 1px solid rgba(212,175,55,0.13);
      border-radius: 8px;
    }

    .info-point i {
      display: inline-flex;
      margin-bottom: 12px;
      color: var(--gold);
      font-size: 20px;
    }

    .info-point strong {
      display: block;
      margin-bottom: 6px;
      color: var(--white);
      font-family: var(--font-serif);
      font-size: 22px;
      font-weight: 500;
    }

    .info-point span {
      color: rgba(255,255,255,0.5);
      font-size: 12px;
      line-height: 1.55;
    }

    .atelier-panel,
    .contact-panel {
      position: relative;
      padding: 34px;
      background:
        linear-gradient(180deg, rgba(245,239,224,0.06), rgba(255,255,255,0.02));
      border: 1px solid rgba(212,175,55,0.18);
      border-radius: 8px;
      box-shadow: 0 26px 70px rgba(0,0,0,0.34);
    }

    .atelier-panel::before {
      content: '';
      display: block;
      width: 100%;
      aspect-ratio: 4 / 3;
      margin-bottom: 28px;
      border: 1px solid rgba(212,175,55,0.16);
      background:
        radial-gradient(circle at 50% 45%, rgba(212,175,55,0.28), transparent 22%),
        radial-gradient(circle at 50% 45%, rgba(255,255,255,0.06), transparent 44%),
        linear-gradient(135deg, #17120c, #050505);
      border-radius: 8px;
    }

    .atelier-panel h3,
    .contact-panel h3 {
      margin-bottom: 12px;
      color: var(--gold);
      font-family: var(--font-serif);
      font-size: 34px;
      font-weight: 500;
    }

    .atelier-panel p,
    .contact-panel p {
      color: rgba(255,255,255,0.58);
      font-size: 13px;
      line-height: 1.7;
    }

    .contact-list {
      display: grid;
      gap: 16px;
      margin: 26px 0 0;
      padding: 0;
      list-style: none;
    }

    .contact-list li {
      display: grid;
      grid-template-columns: 42px 1fr;
      gap: 14px;
      align-items: center;
      padding: 14px 0;
      border-top: 1px solid rgba(212,175,55,0.12);
    }

    .contact-list i {
      width: 42px;
      height: 42px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: var(--gold);
      background: rgba(212,175,55,0.08);
      border: 1px solid rgba(212,175,55,0.18);
      border-radius: 50%;
    }

    .contact-list span {
      display: block;
      margin-bottom: 4px;
      color: rgba(255,255,255,0.38);
      font-size: 9px;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .contact-list strong {
      color: var(--white);
      font-size: 14px;
      font-weight: 400;
    }

    .contact-form {
      display: grid;
      gap: 14px;
      margin-top: 30px;
      padding-top: 24px;
      border-top: 1px solid rgba(212,175,55,0.12);
    }

    .form-row {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 14px;
    }

    .contact-field {
      display: flex;
      flex-direction: column;
      gap: 8px;
    }

    .contact-field label {
      color: rgba(255,255,255,0.44);
      font-size: 9px;
      font-weight: 600;
      letter-spacing: 2.2px;
      text-transform: uppercase;
    }

    .contact-field input,
    .contact-field select,
    .contact-field textarea {
      width: 100%;
      min-height: 46px;
      padding: 13px 14px;
      color: var(--white);
      background: rgba(0,0,0,0.26);
      border: 1px solid rgba(212,175,55,0.18);
      border-radius: 6px;
      font-family: var(--font-sans);
      font-size: 13px;
      outline: none;
      transition: border-color 0.25s, background 0.25s, box-shadow 0.25s;
    }

    .contact-field textarea {
      min-height: 112px;
      resize: vertical;
    }

    .contact-field input:focus,
    .contact-field select:focus,
    .contact-field textarea:focus {
      background: rgba(0,0,0,0.36);
      border-color: rgba(212,175,55,0.52);
      box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
    }

    .contact-field select {
      color: rgba(255,255,255,0.78);
    }

    .contact-form .btn-luxury {
      justify-content: center;
      width: 100%;
      min-height: 48px;
      border-radius: 6px;
    }

    .form-note {
      display: none;
      margin: 0;
      color: var(--gold);
      font-size: 12px;
      line-height: 1.6;
    }

    .form-note.show {
      display: block;
    }

    /* ═══════════════════════════════════════════
       FOOTER
    ═══════════════════════════════════════════ */
    .site-footer {
      position: relative;
      overflow: hidden;
      background:
        radial-gradient(ellipse 42% 48% at 86% 10%, rgba(212,175,55,0.09), transparent 62%),
        linear-gradient(180deg, #080706 0%, #030303 100%);
      border-top: 1px solid rgba(212,175,55,0.16);
    }

    .footer-wrap {
      width: min(1180px, calc(100% - 48px));
      margin: 0 auto;
      padding: 74px 0 28px;
    }

    .footer-main {
      display: grid;
      grid-template-columns: minmax(260px, 1.25fr) repeat(3, minmax(160px, 0.75fr));
      gap: 34px;
      align-items: start;
      padding-bottom: 44px;
      border-bottom: 1px solid rgba(212,175,55,0.13);
    }

    .footer-brand {
      max-width: 390px;
    }

    .footer-logo {
      display: inline-flex;
      flex-direction: column;
      gap: 3px;
      margin-bottom: 18px;
      line-height: 1;
      text-decoration: none;
    }

    .footer-logo-main {
      color: var(--gold);
      font-family: var(--font-serif);
      font-size: 38px;
      font-weight: 600;
      letter-spacing: 8px;
      text-transform: uppercase;
    }

    .footer-logo-sub {
      color: rgba(212,175,55,0.64);
      font-size: 8px;
      font-weight: 300;
      letter-spacing: 5px;
      text-align: center;
      text-transform: uppercase;
    }

    .footer-text {
      margin: 0 0 24px;
      color: rgba(255,255,255,0.58);
      font-family: var(--font-serif);
      font-size: 19px;
      font-style: italic;
      line-height: 1.65;
    }

    .footer-social {
      display: flex;
      align-items: center;
      gap: 10px;
    }

    .footer-social a {
      width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      color: rgba(255,255,255,0.72);
      background: rgba(255,255,255,0.035);
      border: 1px solid rgba(212,175,55,0.16);
      border-radius: 50%;
      text-decoration: none;
      transition: color 0.25s, border-color 0.25s, transform 0.25s, background 0.25s;
    }

    .footer-social a:hover {
      color: var(--gold);
      background: rgba(212,175,55,0.08);
      border-color: rgba(212,175,55,0.45);
      transform: translateY(-2px);
    }

    .footer-title {
      margin: 4px 0 18px;
      color: var(--gold);
      font-family: var(--font-serif);
      font-size: 24px;
      font-weight: 500;
    }

    .footer-links,
    .footer-contact {
      display: grid;
      gap: 12px;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .footer-links a,
    .footer-contact a {
      color: rgba(255,255,255,0.62);
      font-size: 11px;
      letter-spacing: 1.8px;
      text-decoration: none;
      text-transform: uppercase;
      transition: color 0.25s, padding-left 0.25s;
    }

    .footer-links a:hover,
    .footer-contact a:hover {
      color: var(--gold);
      padding-left: 6px;
    }

    .footer-contact li {
      display: grid;
      grid-template-columns: 28px 1fr;
      gap: 10px;
      color: rgba(255,255,255,0.62);
      font-size: 12px;
      line-height: 1.55;
    }

    .footer-contact i {
      color: var(--gold);
      font-size: 15px;
      margin-top: 2px;
    }

    .footer-newsletter {
      display: grid;
      grid-template-columns: minmax(0, 1fr) minmax(320px, 0.72fr);
      gap: 30px;
      align-items: center;
      padding: 30px 0;
      border-bottom: 1px solid rgba(212,175,55,0.13);
    }

    .footer-newsletter h3 {
      margin: 0 0 8px;
      color: var(--white);
      font-family: var(--font-serif);
      font-size: clamp(30px, 4vw, 44px);
      font-weight: 400;
      line-height: 1;
    }

    .footer-newsletter p {
      margin: 0;
      color: rgba(255,255,255,0.52);
      font-size: 12px;
      letter-spacing: 1.5px;
      text-transform: uppercase;
    }

    .newsletter-form {
      display: grid;
      grid-template-columns: minmax(0, 1fr) auto;
      gap: 10px;
    }

    .newsletter-form input {
      min-height: 48px;
      padding: 13px 15px;
      color: var(--white);
      background: rgba(255,255,255,0.035);
      border: 1px solid rgba(212,175,55,0.18);
      border-radius: 6px;
      font-family: var(--font-sans);
      font-size: 13px;
      outline: none;
    }

    .newsletter-form input:focus {
      border-color: rgba(212,175,55,0.54);
      box-shadow: 0 0 0 3px rgba(212,175,55,0.08);
    }

    .newsletter-form .btn-luxury {
      min-height: 48px;
      border-radius: 6px;
      white-space: nowrap;
    }

    .newsletter-note {
      display: none;
      grid-column: 1 / -1;
      margin: 0;
      color: var(--gold);
      font-size: 12px;
    }

    .newsletter-note.show {
      display: block;
    }

    .footer-bottom {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 18px;
      padding-top: 24px;
      color: rgba(255,255,255,0.42);
      font-size: 10px;
      letter-spacing: 1.8px;
      text-transform: uppercase;
    }

    .footer-badges {
      display: flex;
      align-items: center;
      gap: 10px;
      flex-wrap: wrap;
    }

    .footer-badges span {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      padding: 8px 10px;
      color: rgba(255,255,255,0.58);
      border: 1px solid rgba(212,175,55,0.12);
      border-radius: 999px;
      background: rgba(255,255,255,0.025);
    }

    /* ═══════════════════════════════════════════
       RESPONSIVE
    ═══════════════════════════════════════════ */
    @media (max-width: 991px) {
      .nav-links, .nav-icons .nav-icon-btn:not(:last-child):not(.cart-btn), .account-menu { display: none; }
      .cart-btn { display: flex !important; }
      .hamburger { display: flex; }
      .navbar-inner { padding: 0 24px; }
      .product-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }

    @media (max-width: 768px) {
      .hero-content { padding-left: 24px; padding-right: 24px; max-width: 100%; }
      .hero-geo { display: none; }
      .hero-stats { display: none; }
      .hero-title { font-size: clamp(46px, 12vw, 70px); }
      .hero-scroll { bottom: 28px; }
      .section-teaser { padding: 80px 24px 56px; }
      .product-showcase { padding-bottom: 80px; }
      .product-grid { width: calc(100% - 32px); grid-template-columns: 1fr; }
      .product-media { aspect-ratio: 1 / 0.9; }
      .product-purchase-row { align-items: flex-start; flex-direction: column; }
      .product-actions { align-items: stretch; flex-direction: column; }
      .product-actions .btn-icon,
      .product-actions .btn-luxury,
      .product-actions .btn-ghost { width: 100%; flex-basis: auto; }
      .info-section { padding: 76px 0; }
      .info-wrap { width: calc(100% - 32px); grid-template-columns: 1fr; gap: 32px; }
      .info-points { grid-template-columns: 1fr; }
      .form-row { grid-template-columns: 1fr; }
      .atelier-panel,
      .contact-panel { padding: 24px; }
      .footer-wrap { width: calc(100% - 32px); padding-top: 56px; }
      .footer-main,
      .footer-newsletter { grid-template-columns: 1fr; }
      .newsletter-form { grid-template-columns: 1fr; }
      .footer-bottom { align-items: flex-start; flex-direction: column; }
      .cart-drawer-header,
      .cart-drawer-body,
      .cart-drawer-footer { padding-left: 20px; padding-right: 20px; }
      .cart-item { grid-template-columns: 74px 1fr; gap: 14px; }
      .cart-item-image { width: 74px; height: 90px; }
    }

    @media (min-width: 992px) {
      .hamburger { display: none !important; }
      .mobile-menu { display: none !important; }
    }
  </style>
</head>
<body>

  <!-- ══════════════════════════════════
       ANNOUNCEMENT BAR
  ══════════════════════════════════ -->
  <div class="announcement-bar" id="announcementBar">
    ✦ &nbsp; Complimentary shipping on orders above ₹25,000 &nbsp; ✦ &nbsp; New Collection: The Solstice Edit — Now Live &nbsp; ✦
  </div>

  <!-- ══════════════════════════════════
       NAVIGATION BAR
  ══════════════════════════════════ -->
  <nav id="mainNav">
    <div class="navbar-inner">

      <!-- Logo -->
      <a href="#" class="nav-logo">
        <span class="nav-logo-main">AURUM</span>
        <span class="nav-logo-sub">Luxury Jewellery</span>
      </a>

      <!-- Desktop Nav Links -->
      <ul class="nav-links">
        <li><a href="#hero" class="active">Home</a></li>
        <li><a href="#shop">Shop</a></li>
        <li class="nav-dropdown">
          <a href="#" class="dropdown-toggle-link" aria-expanded="false">Categories <i class="bi bi-chevron-down" style="font-size:9px; opacity:0.6;"></i></a>
          <div class="dropdown-menu-custom">
            <a href="#"><span class="cat-dot"></span>Necklaces &amp; Pendants</a>
            <a href="#"><span class="cat-dot"></span>Rings &amp; Bands</a>
            <a href="#"><span class="cat-dot"></span>Earrings</a>
            <a href="#"><span class="cat-dot"></span>Bracelets</a>
            <a href="#"><span class="cat-dot"></span>Bridal Collection</a>
            <a href="#"><span class="cat-dot"></span>Men's Jewellery</a>
            <a href="#"><span class="cat-dot"></span>Custom &amp; Bespoke</a>
          </div>
        </li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
      </ul>

      <!-- Right Icons -->
        <div class="nav-icons d-flex align-items-center gap-1">

        <div class="position-relative" id="navSearchWrap">
          <button class="nav-icon-btn" title="Search" id="navSearchBtn" aria-expanded="false" aria-controls="navSearchPanel">
            <i class="bi bi-search"></i>
          </button>

          <div id="navSearchPanel" class="d-none" style="position:absolute; right:0; top:48px; width:min(360px, 80vw); z-index:2000;">
            <div style="background: rgba(8,8,8,0.97); border:1px solid rgba(212,175,55,0.2); border-radius:12px; backdrop-filter: blur(20px); overflow:hidden;">
              <div style="padding:12px 12px 10px; border-bottom:1px solid rgba(212,175,55,0.14);">
                <input id="navSearchInput" type="text" placeholder="Search jewellery..." autocomplete="off"
                  style="width:100%; min-height:44px; background: rgba(255,255,255,0.03); border:1px solid rgba(212,175,55,0.18); border-radius:10px; padding:0 14px; color:#fff; outline:none; font-family: var(--font-sans);" />
              </div>
              <div id="navSearchResults" style="max-height:320px; overflow:auto;">
                <div style="padding:12px 14px; color: rgba(255,255,255,0.55);">Type to search...</div>
              </div>
            </div>
          </div>
        </div>

        <button class="nav-icon-btn cart-btn" title="Cart" id="cartBtn" style="position:relative;" aria-controls="cartDrawer" aria-expanded="false">
          <i class="bi bi-bag"></i>
          <span class="cart-badge" id="cartBadge">0</span>
        </button>
        <div class="nav-dropdown account-menu">
          <button type="button" class="nav-icon-btn dropdown-toggle-link" title="Account" aria-label="Account menu" aria-expanded="false">
            <i class="bi bi-person"></i>
          </button>
          <div class="dropdown-menu-custom">
            @auth
              <div class="account-summary">
                <strong>{{ Auth::user()->name }}</strong>
                <span>{{ Auth::user()->email }}</span>
              </div>

              @if (Auth::user()->isAdmin())
                <a href="{{ route('dashboard') }}"><span class="cat-dot"></span>Admin Dashboard</a>
                <a href="{{ route('profile.edit') }}"><span class="cat-dot"></span>Admin Profile</a>
              @else
                <a href="{{ route('customer.profile') }}"><span class="cat-dot"></span>My Profile</a>
              @endif

              <form method="POST" action="{{ route('logout') }}" class="account-menu-form">
                @csrf
                <button type="submit"><span class="cat-dot"></span>Log Out</button>
              </form>
            @else
<a href="{{ route('customer.login') }}"><span class="cat-dot"></span>Customer Login</a>
              <a href="{{ route('customer.register') }}"><span class="cat-dot"></span>Create Account</a>
            @endauth
          </div>
        </div>
        <!-- Hamburger -->
        <button class="hamburger" id="hamburger" aria-label="Toggle menu">
          <span></span><span></span><span></span>
        </button>
      </div>

    </div>
  </nav>

  <!-- Mobile Menu -->
  <div class="mobile-menu" id="mobileMenu">
    <a href="#hero">Home</a>
    <a href="#shop">Shop</a>
    <a href="#">Necklaces &amp; Pendants</a>
    <a href="#">Rings &amp; Bands</a>
    <a href="#">Earrings</a>
    <a href="#">Bracelets</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
    @auth
      @if (Auth::user()->isAdmin())
        <a href="{{ route('dashboard') }}">Admin Dashboard</a>
        <a href="{{ route('profile.edit') }}">Admin Profile</a>
      @else
        <a href="{{ route('customer.profile') }}">My Profile</a>
      @endif
      <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Log Out</button>
      </form>
    @else
<a href="{{ route('customer.login') }}">Customer Login</a>
      <a href="{{ route('customer.register') }}">Create Account</a>
    @endauth
  </div>

  <!-- Cart Drawer -->
  <div class="cart-drawer-overlay" id="cartDrawerOverlay"></div>
  <aside class="cart-drawer" id="cartDrawer" aria-hidden="true" aria-labelledby="cartDrawerTitle">
    <div class="cart-drawer-header">
      <div>
        <h2 class="cart-drawer-title" id="cartDrawerTitle">Shopping Bag</h2>
        <div class="cart-drawer-count" id="cartDrawerCount">0 items added</div>
      </div>
      <button type="button" class="cart-close-btn" id="cartCloseBtn" aria-label="Close cart">
        <i class="bi bi-x-lg"></i>
      </button>
    </div>

    <div class="cart-drawer-body" id="cartDrawerBody">
      <div class="text-center py-4">
        <p class="mb-0">Loading...</p>
      </div>
    </div>

    <div class="cart-drawer-footer">
      <div class="cart-total-row">
        <span>Subtotal</span>
        <strong id="cartSubtotal">₹0.00</strong>
      </div>
      <button type="button" class="cart-checkout-btn">Proceed To Checkout</button>
    </div>
  </aside>

  <!-- ══════════════════════════════════
       HERO SECTION
  ══════════════════════════════════ -->
  <section class="hero" id="hero">

    <!-- Parallax Background -->
    <div class="hero-bg" id="heroBg"></div>

    <!-- Geometric Decorations -->
    <div class="hero-geo">
      <div class="geo-circle-1"></div>
      <div class="geo-circle-2"></div>
      <div class="geo-circle-3"></div>
      <div class="geo-diamond"></div>
      <div class="geo-line-h"></div>
    </div>

    <!-- Floating Particles (generated by JS) -->
    <div id="particles"></div>

    <!-- Jewel SVG -->
    <svg class="hero-jewel" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
      <polygon points="100,10 190,70 190,130 100,190 10,130 10,70" fill="none" stroke="rgba(212,175,55,0.5)" stroke-width="1"/>
      <polygon points="100,30 170,78 170,122 100,170 30,122 30,78" fill="none" stroke="rgba(212,175,55,0.35)" stroke-width="0.8"/>
      <polygon points="100,50 150,85 150,115 100,150 50,115 50,85" fill="rgba(212,175,55,0.06)" stroke="rgba(212,175,55,0.6)" stroke-width="1"/>
      <line x1="100" y1="10" x2="100" y2="50"   stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <line x1="190" y1="70" x2="150" y2="85"   stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <line x1="190" y1="130" x2="150" y2="115" stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <line x1="100" y1="190" x2="100" y2="150" stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <line x1="10" y1="130" x2="50" y2="115"   stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <line x1="10" y1="70" x2="50" y2="85"     stroke="rgba(212,175,55,0.3)" stroke-width="0.8"/>
      <circle cx="100" cy="100" r="18" fill="rgba(212,175,55,0.15)" stroke="rgba(212,175,55,0.7)" stroke-width="1"/>
      <circle cx="100" cy="100" r="6" fill="rgba(212,175,55,0.8)"/>
    </svg>

    <!-- Hero Content -->
    <div class="hero-content">
      <div class="hero-eyebrow">
        <span class="hero-eyebrow-line"></span>
        <span class="hero-eyebrow-text">New Collection 2025</span>
      </div>
      <h1 class="hero-title">
        Timeless<br/>
        <em>Elegance</em>
      </h1>
      <p class="hero-subtitle">
        Discover handcrafted luxury jewellery — each piece a testament to artistry, heritage, and enduring beauty.
      </p>
      <div class="hero-cta-group">
        <a href="#shop" class="btn-luxury">
          <span>Shop Now</span>
          <i class="bi bi-arrow-right btn-arrow"></i>
        </a>
        <a href="#collections" class="btn-ghost">
          <span>Explore Collection</span>
          <i class="bi bi-arrow-right btn-arrow"></i>
        </a>
      </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="hero-scroll" id="heroScroll">
      <span class="hero-scroll-text">Scroll</span>
      <div class="hero-scroll-track">
        <div class="hero-scroll-fill"></div>
      </div>
    </div>

    <!-- Stats Bar -->
    <div class="hero-stats">
      <div class="hero-stat">
        <div class="hero-stat-num">2,400+</div>
        <div class="hero-stat-label">Unique Pieces</div>
      </div>
      <div class="hero-stat">
        <div class="hero-stat-num">18 Yrs</div>
        <div class="hero-stat-label">Craftsmanship</div>
      </div>
      <div class="hero-stat">
        <div class="hero-stat-num">48K+</div>
        <div class="hero-stat-label">Happy Clients</div>
      </div>
      <div class="hero-stat">
        <div class="hero-stat-num">100%</div>
        <div class="hero-stat-label">Ethically Sourced</div>
      </div>
    </div>

  </section>

  <!-- ══════════════════════════════════
       TEASER SECTION (below hero)
  ══════════════════════════════════ -->
  <section class="section-teaser" id="collections">
    <div class="divider">
      <div class="divider-line"></div>
      <div class="divider-diamond"></div>
      <div class="divider-line right"></div>
    </div>
    <h2>The Solstice Edit</h2>
    <p>A curated selection of our finest handcrafted pieces</p>
  </section>

  <!-- ══════════════════════════════════
       PRODUCT CARDS
  ══════════════════════════════════ -->
  <section class="product-showcase" id="shop">
    <div class="product-grid">
    @if ($products->count() > 0)
        @foreach ($products as $product)
        <article class="jewellery-card" style="animation-delay: 0s;">
            <div class="product-media">
            <span class="product-tag">{{ $product->type->name ?? 'Aurum Edit' }}</span>
            <button type="button" class="wishlist-btn" title="Add to wishlist" aria-label="Add {{ $product->name }} to wishlist">
                <i class="bi bi-heart"></i>
            </button>
            <img src="{{ asset('uploads/'. $product->images) }}" alt="{{ $product->name }}">
            </div>

            <div class="product-body">
            <div class="product-meta">
                <span>{{ ucfirst($product->metal_type) }}</span>
                <span class="product-stock {{ $product->qty > 0 ? 'in-stock' : 'out-of-stock' }}">{{ $product->qty > 0 ? 'In Stock' : 'Out of Stock'}}</span>
            </div>

            <h3 class="product-title">{{ $product->name }}</h3>
            <p class="product-description">{{ $product->short_description ?: $product->description }}</p>

            <div class="product-details">
                <div class="product-detail">
                <span>Metal</span>
                <strong>{{ ucfirst($product->metal_type) }}</strong>
                </div>
                <div class="product-detail">
                <span>Weight</span>
                <strong>{{ $product->weight ? $product->weight . ' g' : '-' }}</strong>
                </div>
            </div>

            <div class="product-footer">
                <div class="product-purchase-row">
                <div class="product-price">
                <span class="current">₹{{ number_format(max(0, $product->price - $product->discount), 2) }}</span>
                @if ($product->discount > 0)
                <span class="original">₹{{ number_format($product->price, 2) }}</span>
                @endif
                </div>
                    <label class="product-qty">
                        <span>Qty</span>
                        <select name="qty" aria-label="Quantity for {{ $product->name }}">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </label>
                </div>

                <div class="product-actions">
                <button
                    type="button"
                    class="btn-icon quick-view-btn"
                    title="Quick view"
                    aria-label="Quick view {{ $product->name }}"
                    data-name="{{ $product->name }}"
                    data-category="{{ $product->type->name ?? 'Jewellery' }}"
                    data-image="{{ asset('uploads/'. $product->images) }}"
                    data-description="{{ $product->description }}"
                    data-price="₹{{ number_format(max(0, $product->price - $product->discount), 2) }}"
                    data-metal="{{ ucfirst($product->metal_type) }}"
                    data-weight="{{ $product->weight ? $product->weight . ' g' : '-' }}"
                    data-id="{{ $product->id }}"
                >
                    <i class="bi bi-eye"></i>
                </button>
                <button type="button" class="btn-ghost add-to-cart-btn" data-id="{{ $product->id }}">
                    <span>Add To Cart</span>
                </button>
                <button type="button" class="btn-luxury buy-now-btn" data-id="{{ $product->id }}">
                    <span>Buy Now</span>
                    <i class="bi bi-arrow-right btn-arrow"></i>
                </button>
                </div>
            </div>
            </div>
        </article>
        @endforeach
    @else
        <div>No data found</div>
    @endif
    </div>
  </section>

  <!-- ══════════════════════════════════
       ABOUT SECTION
  ══════════════════════════════════ -->
  <section class="info-section" id="about">
    <div class="info-wrap">
      <div>
        <span class="info-eyebrow">About Aurum</span>
        <h2 class="info-title">Jewellery shaped with patience, precision, and quiet luxury.</h2>
        <p class="info-text">
          Aurum brings together traditional goldsmithing and modern silhouettes to create pieces that feel personal from the first wear. Every design is finished with careful detailing, balanced proportions, and a lasting sense of occasion.
        </p>

        <div class="info-points">
          <div class="info-point">
            <i class="bi bi-gem"></i>
            <strong>Fine Materials</strong>
            <span>Gold, silver, platinum, and selected stones chosen for lasting beauty.</span>
          </div>
          <div class="info-point">
            <i class="bi bi-award"></i>
            <strong>Made To Last</strong>
            <span>Each piece is checked for finish, fit, polish, and everyday comfort.</span>
          </div>
          <div class="info-point">
            <i class="bi bi-brush"></i>
            <strong>Hand Finished</strong>
            <span>Delicate settings and surfaces are refined by skilled artisans.</span>
          </div>
          <div class="info-point">
            <i class="bi bi-shield-check"></i>
            <strong>Trusted Craft</strong>
            <span>Transparent making standards for pieces you can wear with confidence.</span>
          </div>
        </div>
      </div>

      <div class="atelier-panel">
        <h3>The Atelier</h3>
        <p>
          From first sketch to final polish, our process is built around restraint, proportion, and detail. We create jewellery for celebrations, daily rituals, and heirlooms that stay close for years.
        </p>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       CONTACT SECTION
  ══════════════════════════════════ -->
  <section class="info-section alt" id="contact">
    <div class="info-wrap">
      <div>
        <span class="info-eyebrow">Contact</span>
        <h2 class="info-title">Visit the studio or speak with our jewellery consultant.</h2>
        <p class="info-text">
          For custom orders, sizing help, product availability, or care guidance, reach out to the Aurum team. We will help you choose the right piece with calm, personal attention.
        </p>
      </div>

      <div class="contact-panel">
        <h3>Get In Touch</h3>
        <p>Our team is available for appointments, collection enquiries, and bespoke jewellery discussions.</p>

        <ul class="contact-list">
          <li>
            <i class="bi bi-geo-alt"></i>
            <div>
              <span>Studio</span>
              <strong>Aurum House, CG Road, Ahmedabad, Gujarat</strong>
            </div>
          </li>
          <li>
            <i class="bi bi-telephone"></i>
            <div>
              <span>Phone</span>
              <strong>+91 98765 43210</strong>
            </div>
          </li>
          <li>
            <i class="bi bi-envelope"></i>
            <div>
              <span>Email</span>
              <strong>care@aurumjewellery.com</strong>
            </div>
          </li>
          <li>
            <i class="bi bi-clock"></i>
            <div>
              <span>Hours</span>
              <strong>Mon to Sat, 10:30 AM - 8:00 PM</strong>
            </div>
          </li>
        </ul>

        <form class="contact-form" id="contactForm">
          <div class="form-row">
            <div class="contact-field">
              <label for="contactName">Name</label>
              <input type="text" id="contactName" name="name" placeholder="Your name" required>
            </div>
            <div class="contact-field">
              <label for="contactPhone">Phone</label>
              <input type="tel" id="contactPhone" name="phone" placeholder="+91" required>
            </div>
          </div>

          <div class="form-row">
            <div class="contact-field">
              <label for="contactEmail">Email</label>
              <input type="email" id="contactEmail" name="email" placeholder="you@example.com" required>
            </div>
            <div class="contact-field">
              <label for="contactInterest">Interested In</label>
              <select id="contactInterest" name="interest" required>
                <option value="">Select option</option>
                <option value="Custom Jewellery">Custom Jewellery</option>
                <option value="Product Enquiry">Product Enquiry</option>
                <option value="Sizing Help">Sizing Help</option>
                <option value="Appointment">Appointment</option>
              </select>
            </div>
          </div>

          <div class="contact-field">
            <label for="contactMessage">Message</label>
            <textarea id="contactMessage" name="message" placeholder="Tell us what you are looking for" required></textarea>
          </div>

          <button type="submit" class="btn-luxury">
            <span>Send Enquiry</span>
            <i class="bi bi-send btn-arrow"></i>
          </button>
          <p class="form-note" id="contactFormNote">Thank you. Your enquiry is ready for the Aurum team.</p>
        </form>
      </div>
    </div>
  </section>

  <!-- ══════════════════════════════════
       FOOTER
  ══════════════════════════════════ -->
  <footer class="site-footer">
    <div class="footer-wrap">
      <div class="footer-main">
        <div class="footer-brand">
          <a href="#hero" class="footer-logo">
            <span class="footer-logo-main">AURUM</span>
            <span class="footer-logo-sub">Luxury Jewellery</span>
          </a>
          <p class="footer-text">
            Handcrafted jewellery for celebrations, daily rituals, and heirlooms that stay close for years.
          </p>

          <div class="footer-social" aria-label="Social links">
            <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            <a href="#" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

        <div>
          <h3 class="footer-title">Shop</h3>
          <ul class="footer-links">
            <li><a href="#shop">All Jewellery</a></li>
            <li><a href="#">Rings &amp; Bands</a></li>
            <li><a href="#">Necklaces</a></li>
            <li><a href="#">Earrings</a></li>
            <li><a href="#">Bracelets</a></li>
          </ul>
        </div>

        <div>
          <h3 class="footer-title">Aurum</h3>
          <ul class="footer-links">
            <li><a href="#about">About The Atelier</a></li>
            <li><a href="#contact">Book Appointment</a></li>
            <li><a href="#contact">Custom Orders</a></li>
            <li><a href="#contact">Care Guidance</a></li>
            @auth
              <li><a href="{{ Auth::user()->isAdmin() ? route('dashboard') : route('customer.profile') }}">My Account</a></li>
            @else
              <li><a href="{{ route('login') }}">Customer Login</a></li>
            @endauth
          </ul>
        </div>

        <div>
          <h3 class="footer-title">Visit</h3>
          <ul class="footer-contact">
            <li>
              <i class="bi bi-geo-alt"></i>
              <span>Aurum House, CG Road, Ahmedabad, Gujarat</span>
            </li>
            <li>
              <i class="bi bi-telephone"></i>
              <a href="tel:+919876543210">+91 98765 43210</a>
            </li>
            <li>
              <i class="bi bi-envelope"></i>
              <a href="mailto:care@aurumjewellery.com">care@aurumjewellery.com</a>
            </li>
            <li>
              <i class="bi bi-clock"></i>
              <span>Mon to Sat, 10:30 AM - 8:00 PM</span>
            </li>
          </ul>
        </div>
      </div>

      <div class="footer-newsletter">
        <div>
          <h3>Private previews, thoughtful releases.</h3>
          <p>Receive collection notes and appointment invitations from Aurum.</p>
        </div>

        <form class="newsletter-form" id="newsletterForm">
          <input type="email" name="email" placeholder="Email address" aria-label="Email address" required>
          <button type="submit" class="btn-luxury">
            <span>Subscribe</span>
            <i class="bi bi-arrow-right btn-arrow"></i>
          </button>
          <p class="newsletter-note" id="newsletterNote">Thank you. You are added to the Aurum list.</p>
        </form>
      </div>

      <div class="footer-bottom">
        <div>© {{ date('Y') }} Aurum Jewellery. All rights reserved.</div>
        <div class="footer-badges">
          <span><i class="bi bi-shield-check"></i> Secure Checkout</span>
          <span><i class="bi bi-truck"></i> Insured Shipping</span>
          <span><i class="bi bi-gem"></i> Certified Craft</span>
        </div>
      </div>
    </div>
  </footer>
  <div id="modalContainer"></div>


  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <script>
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $(document).ready(function() {
        getAddToListProducts();
    });

    function getAddToListProducts() {
        $.ajax({
            url: "{{ route('home.add-to-list') }}",
            type: "GET",
            success: function(response) {
                if(response.status) {
                    const itemText = response.count === 1 ? '1 item added' : response.count + ' items added';

                    $('#cartDrawerBody').html(response.html);
                    $('#cartDrawerCount').text(itemText);
                    $('#cartBadge').text(response.count);
                    $('#cartSubtotal').text(response.subtotal);
                }
            }
        });
    }

    $(function () {

      /* ─────────────────────────────────────
         NAVBAR: announcement offset + scroll
      ───────────────────────────────────── */
      const $nav  = $('#mainNav');
      const $bar  = $('#announcementBar');

      function setNavTop() {
        const barH = $bar.is(':visible') ? $bar.outerHeight() : 0;
        $nav.css('top', barH + 'px');
      }
      setNavTop();

      $(window).on('scroll', function () {
        const scrollY = $(this).scrollTop();
        if (scrollY > 40) {
          $nav.addClass('scrolled');
          $bar.fadeOut(300);
          setNavTop();
        } else {
          $nav.removeClass('scrolled');
          $bar.fadeIn(300);
          setNavTop();
        }

        /* Parallax hero bg */
        $('#heroBg').css('transform', 'translateY(' + (scrollY * 0.3) + 'px)');
      });

      /* ─────────────────────────────────────
         HAMBURGER / MOBILE MENU
      ───────────────────────────────────── */
      $('#hamburger').on('click', function () {
        $(this).toggleClass('open');
        const $menu = $('#mobileMenu');
        if ($menu.hasClass('show')) {
          $menu.removeClass('show');
          setTimeout(() => $menu.hide(), 400);
        } else {
          $menu.show();
          setTimeout(() => $menu.addClass('show'), 10);
        }
      });

      $('#mobileMenu a').on('click', function () {
        $('#hamburger').removeClass('open');
        $('#mobileMenu').removeClass('show');
        setTimeout(() => $('#mobileMenu').hide(), 300);
      });

      $('.dropdown-toggle-link').on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const $dropdown = $(this).closest('.nav-dropdown');
        const willOpen = !$dropdown.hasClass('open');

        $('.nav-dropdown.open')
          .removeClass('open')
          .find('.dropdown-toggle-link')
          .attr('aria-expanded', 'false');

        if (willOpen) {
          $dropdown.addClass('open');
          $(this).attr('aria-expanded', 'true');
        }
      });

      $('.dropdown-menu-custom').on('click', function (e) {
        e.stopPropagation();
      });

      /* NAV SEARCH (AJAX) */
      let navSearchTimer = null;
      const $navSearchBtn = $('#navSearchBtn');
      const $navSearchPanel = $('#navSearchPanel');
      const $navSearchInput = $('#navSearchInput');
      const $navSearchResults = $('#navSearchResults');

      function openNavSearch() {
        $navSearchPanel.removeClass('d-none');
        $navSearchBtn.attr('aria-expanded', 'true');
        setTimeout(() => $navSearchInput.trigger('focus'), 0);
      }

      function closeNavSearch() {
        $navSearchPanel.addClass('d-none');
        $navSearchBtn.attr('aria-expanded', 'false');
        $navSearchResults.html('<div style="padding:12px 14px; color: rgba(255,255,255,0.55);">Type to search...</div>');
      }

      $navSearchBtn.on('click', function (e) {
        e.stopPropagation();
        const isOpen = !$navSearchPanel.hasClass('d-none');
        if (isOpen) closeNavSearch();
        else openNavSearch();
      });

      $(document).on('click', function (e) {
        if ($navSearchPanel.hasClass('d-none')) return;
        if ($(e.target).closest('#navSearchWrap').length) return;
        closeNavSearch();
      });

      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') closeNavSearch();
      });

      $navSearchInput.on('input', function () {
        const q = ($navSearchInput.val() || '').trim();
        clearTimeout(navSearchTimer);

        if (q.length < 2) {
          $navSearchResults.html('<div style="padding:12px 14px; color: rgba(255,255,255,0.55);">Type at least 2 characters...</div>');
          return;
        }

        navSearchTimer = setTimeout(function () {
          $navSearchResults.html('<div style="padding:12px 14px; color: rgba(255,255,255,0.55);">Searching...</div>');

          $.ajax({
            url: "{{ route('home.search') }}",
            type: 'GET',
            data: { q },
            success: function (response) {
              if (response.status) $navSearchResults.html(response.html);
            },
            error: function () {
              $navSearchResults.html('<div style="padding:12px 14px; color: rgba(255,255,255,0.55);">Search failed. Please try again.</div>');
            }
          });
        }, 300);
      });

      $(document).on('click', '.search-result-item', function () {
        const productId = $(this).data('product-id');
        if (!productId) return;

        let url = "{{ route('home.view', ':id') }}";
        url = url.replace(':id', productId);

        $.ajax({
          url: url,
          type: 'GET',
          success: function (response) {
            if (response.status) {
              $('#modalContainer').html(response.html);
              let ModalEl = document.getElementById('exampleModal');
              let modal = new bootstrap.Modal(ModalEl);
              modal.show();


            }
          }
        });

        closeNavSearch();
      });


      $(document).on('click', function () {

        $('.nav-dropdown.open')
          .removeClass('open')
          .find('.dropdown-toggle-link')
          .attr('aria-expanded', 'false');
      });

      $('#contactForm').on('submit', function (e) {
        e.preventDefault();
        $('#contactFormNote').addClass('show');
        this.reset();
      });

      $('#newsletterForm').on('submit', function (e) {
        e.preventDefault();
        $('#newsletterNote').addClass('show');
        this.reset();
      });

      /* ─────────────────────────────────────
         CART DRAWER
      ───────────────────────────────────── */
      function animateCartBadge() {
        const $badge = $('#cartBadge');
        $badge.css('animation', 'none');
        void $badge[0].offsetWidth; // reflow
        $badge.css('animation', 'badgePop 0.4s cubic-bezier(0.175,0.885,0.32,1.275)');
      }

      function openCartDrawer() {
        $('#cartDrawerOverlay, #cartDrawer').addClass('show');
        $('#cartDrawer').attr('aria-hidden', 'false');
        $('#cartBtn').attr('aria-expanded', 'true');
        $('body').addClass('cart-drawer-open');
        animateCartBadge();

        $('#cartBtn').css('box-shadow', '0 0 0 3px rgba(212,175,55,0.5)');
        setTimeout(() => $('#cartBtn').css('box-shadow', ''), 500);
      }

      function closeCartDrawer() {
        $('#cartDrawerOverlay, #cartDrawer').removeClass('show');
        $('#cartDrawer').attr('aria-hidden', 'true');
        $('#cartBtn').attr('aria-expanded', 'false');
        $('body').removeClass('cart-drawer-open');
      }

      function renderCartDrawer(response) {
        const itemText = response.count === 1 ? '1 item added' : response.count + ' items added';

        $('#cartDrawerBody').html(response.html);
        $('#cartDrawerCount').text(itemText);
        $('#cartBadge').text(response.count);
        $('#cartSubtotal').text(response.subtotal);
      }

      $('#cartBtn').on('click', function () {
        getAddToListProducts();
        openCartDrawer();
      });

      $(document).on('click', '.add-to-cart-btn', function () {
        const $button = $(this);
        const productId = $button.data('id');

        if (!productId) {
          return;
        }

        let url = "{{ route('home.add-to-list.store', ':id') }}";
        url = url.replace(':id', productId);

        $button.prop('disabled', true);

        $.ajax({
          url: url,
          type: "GET",
          success: function(response) {
            if(response.status) {
              renderCartDrawer(response);
              openCartDrawer();
            }
          },
          complete: function() {
            $button.prop('disabled', false);
          }
        });
      });

      $(document).on('click', '.buy-now-btn', function () {
        const $button = $(this);
        const productId = $button.data('id');
        const qty = $button.closest('.jewellery-card').find('select[name="qty"]').val() || 1;

        if (!productId) {
          return;
        }

        let url = "{{ route('home.checkout', ':id') }}";
        url = url.replace(':id', productId);

        const originalHtml = $button.html();
        $button.prop('disabled', true).html('<span>Redirecting</span>');

        $.ajax({
          url: url,
          type: "POST",
          data: { qty },
          success: function(response) {
            if (response.status && response.checkout_url) {
              window.location.href = response.checkout_url;
              return;
            }

            alert(response.message || 'Unable to start checkout.');
            $button.prop('disabled', false).html(originalHtml);
          },
          error: function(xhr) {
            const message = xhr.responseJSON?.message || 'Unable to start checkout. Please try again.';
            alert(message);
            $button.prop('disabled', false).html(originalHtml);
          }
        });
      });

      $('#cartCloseBtn, #cartDrawerOverlay').on('click', function () {
        closeCartDrawer();
      });

      $(document).on('keydown', function (e) {
        if (e.key === 'Escape') {
          closeCartDrawer();
        }
      });

      /* ─────────────────────────────────────
         PARTICLES
      ───────────────────────────────────── */
      const $pContainer = $('#particles');
      const particleCount = 22;

      for (let i = 0; i < particleCount; i++) {
        const size  = (Math.random() * 2.5 + 1).toFixed(1);
        const left  = (Math.random() * 100).toFixed(1);
        const top   = (Math.random() * 100).toFixed(1);
        const dur   = (Math.random() * 8 + 6).toFixed(1);
        const delay = (Math.random() * 10).toFixed(1);
        const op    = (Math.random() * 0.4 + 0.2).toFixed(2);

        $('<div class="particle">').css({
          width:  size + 'px',
          height: size + 'px',
          left:   left + '%',
          top:    top  + '%',
          '--dur':   dur   + 's',
          '--delay': delay + 's',
          '--op':    op
        }).appendTo($pContainer);
      }

      /* ─────────────────────────────────────
         SCROLL CTA click → smooth scroll
      ───────────────────────────────────── */
      $('#heroScroll').on('click', function () {
        $('html, body').animate({ scrollTop: $('#collections').offset().top }, 800, 'swing');
      });

      /* ─────────────────────────────────────
         3D TILT on hero content (desktop)
      ───────────────────────────────────── */
      if (window.innerWidth > 991) {
        $('#hero').on('mousemove', function (e) {
          const rect = this.getBoundingClientRect();
          const cx = rect.width  / 2;
          const cy = rect.height / 2;
          const dx = (e.clientX - rect.left  - cx) / cx;
          const dy = (e.clientY - rect.top   - cy) / cy;
          const tiltX = (dy * -4).toFixed(2);
          const tiltY = (dx *  4).toFixed(2);
          $('.hero-content').css('transform',
            `perspective(1000px) rotateX(${tiltX}deg) rotateY(${tiltY}deg)`
          );
        }).on('mouseleave', function () {
          $('.hero-content').css('transform', 'perspective(1000px) rotateX(0) rotateY(0)');
        });
      }

    }); // end document ready

    $(document).on('click', '.quick-view-btn', function() {
        let card_id = $(this).data('id');

        let url = "{{ route('home.view', ':id') }}";
        url = url.replace(':id', card_id);

        $.ajax({
            url: url,
            type: "GET",
            success: function(response) {
                if(response.status) {
                    $('#modalContainer').html(response.html);

                    let ModalEl = document.getElementById('exampleModal');
                    let modal = new bootstrap.Modal(ModalEl);

                    modal.show();
                }
            }
        });
    });
  </script>
</body>
</html>
