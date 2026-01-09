@php
    $profilToko = \App\Models\ProfilToko::first();
@endphp

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $profilToko->nama_toko ?? 'Essence' }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/essence.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@300;400;500;700&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    @stack('styles')
    <style>
        /* ===========================
   RESET & GLOBAL
=========================== */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-color: #2d3e50;
    --secondary-color: #d4a574;
    --accent: #d4a574;
    --text-dark: #1a1a1a;
    --text-light: #666;
    --ink: #272727;
    --muted: #6f6f6f;
    --bg-light: #f7f4ef;
    --bg-white: #ffffff;
    --surface: #faf7f2;
    --border: rgba(0,0,0,.08);
    --transition: .35s ease;
}

body {
    font-family: "Playfair Display", Georgia, serif;
    color: var(--text-dark);
    background: #fff;
    line-height: 1.6;
    overflow-x: hidden;
}

.container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}

/* ===========================
   NAVBAR
=========================== */
.navbar {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    background: var(--bg-white);
    padding: 18px 0;
    z-index: 1000;
    box-shadow: 0 4px 28px rgba(0,0,0,.05);
    transition: transform .45s ease, box-shadow .25s ease;
    will-change: transform;
}

.navbar.hide {
    transform: translateY(-100%);
}

.navbar.show {
    transform: translateY(0);
}

.nav-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.brand-wrap {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
}

.brand-logo {
    height: 62px;
    width: 62px;
    object-fit: contain;
    border-radius: 8px;
}

.brand-name {
    font-family: "Playfair Display", serif;
    font-size: 18px;
    font-weight: 600;
    color: #111;
}

.navbar .brand-wrap:hover .brand-name {
    opacity: .8;
}

.nav-menu {
    display: flex;
    gap: 36px;
    list-style: none;
}

.nav-link {
    text-decoration: none;
    color: var(--text-dark);
    font-size: 13px;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: var(--transition);
    font-family: Arial, sans-serif;
}

.nav-link:hover {
    color: var(--secondary-color);
}

.nav-tagline {
    font-size: 13px;
    opacity: .7;
    margin-left: 12px;
}

.hamburger {
    display: none;
    flex-direction: column;
    gap: 5px;
}

.hamburger span {
    width: 24px;
    height: 2px;
    background: var(--text-dark);
}

/* ===========================
   HERO
=========================== */
.hero {
    position: relative;
    overflow: hidden;
    z-index: 2;
    margin-top: 90px;
    min-height: 90vh;
    display: flex;
    align-items: center;
    background: linear-gradient(135deg, #faf8f4, #e9e4dc);
    padding: 60px 0;
}

.hero-content {
    display: grid;
    grid-template-columns: 2fr 0.6fr;
    align-items: center;
    max-width: 1250px;
    margin: auto;
}

.hero-text {
    padding-left: 20px;
}

.hero-title {
    font-size: 60px;
    font-weight: 300;
    line-height: 1.1;
    margin-bottom: 22px;
}

.hero-subtitle {
    font-size: 18px;
    color: var(--text-light);
    margin-bottom: 40px;
    font-family: Arial, sans-serif;
}

.hero-image {
    position: relative;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    min-height: 420px;
    padding-right: 10px;
}

#glbSlot {
    width: 330px;
    height: 350px;
}

#perfumeGLB,
.model-container {
    border: none !important;
    box-shadow: none !important;
}

model-viewer {
    --progress-bar-color: transparent;
    --progress-bar-height: 0px;
}

model-viewer::part(default-progress-bar) {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
}

.hero .hero-image model-viewer {
    width: 330px;
    height: 350px;
}

.hero-image model-viewer {
    position: static;
}

/* Scroll Indicator */
.scroll-indicator {
    position: absolute;
    bottom: 30px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 8px;
    font-family: Arial, sans-serif;
    color: #444;
    cursor: pointer;
}

.scroll-line {
    width: 2px;
    height: 30px;
    background: #444;
    border-radius: 2px;
    animation: lineMove 1s infinite ease-in-out;
}

@keyframes lineMove {
    0% {
        transform: translateY(-6px);
        opacity: .6;
    }
    50% {
        transform: translateY(6px);
        opacity: 1;
    }
    100% {
        transform: translateY(-6px);
        opacity: .6;
    }
}

/* ===========================
   BUTTONS
=========================== */
.btn {
    border-radius: 12px;
    padding: 10px 16px;
    font-size: 14px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
}

.btn-primary {
    background: var(--accent);
    color: #fff;
    border: 0;
    padding: 14px 36px;
    letter-spacing: 2px;
    text-transform: uppercase;
    font-size: 13px;
    cursor: pointer;
    font-family: Arial, sans-serif;
}

.btn-primary:hover {
    opacity: .9;
    transform: translateY(-2px);
}

.btn-dark {
    background: #1f2a37;
    color: #fff;
    border: 0;
}

.btn-dark:hover {
    opacity: .85;
}

.btn-outline-dark {
    border: 2px solid #1f2a37;
    color: #1f2a37;
    background: transparent;
}

.btn-outline-dark:hover {
    background: #1f2a37;
    color: #fff;
}

.back-home-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 18px;
    margin-left: 4px;
    background: #0F1C2E;
    color: #fff;
    padding: 10px 16px;
    border-radius: 12px;
    font-size: 14px;
    font-weight: 500;
    text-decoration: none;
    box-shadow: 0 10px 24px rgba(0,0,0,.08);
    transition: .22s ease;
    touch-action: manipulation;
}

.back-home-btn i {
    font-size: 14px;
}

.back-home-btn:hover {
    background: #D18B32;
    color: #fff;
    transform: translateY(-2px);
}

.back-home-btn:active {
    transform: translateY(0);
}

/* ===========================
   SECTIONS
=========================== */
section {
    padding: 90px 0;
}

.section-title {
    text-align: center;
    font-size: 40px;
    font-weight: 300;
    margin-bottom: 12px;
    opacity: 1;
    transform: translateY(0);
}

.section-subtitle {
    text-align: center;
    color: var(--text-light);
    margin-bottom: 40px;
    font-family: Arial, sans-serif;
}

/* ===========================
   PRODUCT CARDS
=========================== */
.product-card {
    background: #ffffff;
    border: 1px solid var(--border);
    border-radius: 16px;
    overflow: hidden;
    transition: .25s ease;
}

.product-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 25px 55px rgba(0,0,0,.08);
}

.product-image {
    height: 300px;
    background: var(--surface);
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    padding: 18px;
}

.product-img {
    width: 88%;
    height: 88%;
    object-fit: contain;
}

.product-info {
    text-align: center;
    padding: 20px 16px 26px;
}

.product-name {
    font-size: 20px;
    margin-bottom: 6px;
    font-weight: 500;
}

.product-notes {
    font-size: 13px;
    color: var(--text-light);
    font-style: italic;
    margin-bottom: 10px;
    font-family: Arial, sans-serif;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    line-clamp: 2;
    overflow: hidden;
    line-height: 1.55;
}

.product-price {
    color: var(--secondary-color);
    font-size: 18px;
    font-weight: 600;
}

.product-link {
    display: block;
    text-decoration: none;
    color: inherit;
}

.product-link * {
    text-decoration: none !important;
}

/* Product Badges */
.product-badge {
    position: absolute;
    top: 10px;
    left: 10px;
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 10px;
    color: #fff;
    display: inline-block;
    margin-top: 4px;
    background: #fff2d6;
    color: #7b531a;
}

.label-best_seller {
    background: #f5a623;
    color: #fff;
}

.label-new {
    background: #0099ff;
    color: #fff;
}

.label-limited {
    background: #444;
    color: #fff;
}

.label-promo {
    background: #e53935;
    color: #fff;
}

.product-status {
    position: absolute;
    top: 14px;
    left: 14px;
    padding: 6px 10px;
    font-size: 10px;
    border-radius: 20px;
    letter-spacing: .5px;
    font-family: Arial, sans-serif;
}

.status-active {
    background: #e7f4ea;
    color: #2f6e3e;
}

.status-inactive {
    background: #f5e1e1;
    color: #a24545;
}

.badge-category {
    display: inline-block;
    padding: 6px 10px;
    font-size: 12px;
    border-radius: 8px;
    background: #eef0f3;
    color: #333;
    letter-spacing: .5px;
}

/* ===========================
   PRODUCT GRID
=========================== */
.product-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 36px;
}

.empty-state {
    text-align: center;
    margin: 60px 0;
    color: #808080;
}

/* ===========================
   HIGHLIGHT CAROUSEL
=========================== */
.highlight-wrapper {
    width: 100%;
    overflow: hidden;
}

.highlight-track {
    display: flex;
    gap: 20px;
    align-items: stretch;
}

.highlight-track::-webkit-scrollbar {
    display: none;
}

.highlight-track .product-card {
    flex: 0 0 380px;
    margin: 0;
}

.highlight-track .product-image {
    height: 320px;
}

.highlight-track .product-img {
    width: 90%;
    height: 90%;
}

.highlight-track .product-info {
    padding: 18px 20px 24px;
}

.highlight-track .product-name,
.highlight-track h3 {
    font-size: 19px;
    margin-bottom: 8px;
}

.highlight-track .product-notes {
    font-size: 13px;
    margin-bottom: 10px;
    -webkit-line-clamp: 2;
    line-clamp: 2;
}

.highlight-track .product-price {
    font-size: 17px;
}

/* ===========================
   ABOUT SECTION
=========================== */
.about {
    position: relative;
    z-index: 1;
    background: var(--bg-light);
}

.about-content {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 70px;
    align-items: center;
}

.about-image {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 340px;
}

.about-visual {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.about-visual model-viewer {
    width: 260px;
    height: 300px;
    position: static !important;
    transform: none !important;
}

/* ===========================
   DETAIL PAGE
=========================== */
.detail-wrapper {
    display: grid;
    grid-template-columns: 1.1fr 1fr;
    gap: 70px;
    align-items: flex-start;
}

.detail-image {
    background: var(--surface);
    border-radius: 18px;
    padding: 32px;
    border: 1px solid rgba(0,0,0,.06);
}

.detail-img {
    width: 100%;
    object-fit: contain;
}

.detail-info {
    padding-top: 10px;
}

.detail-title {
    font-size: 38px;
    font-weight: 400;
    margin: 10px 0 8px;
    line-height: 1.2;
}

.detail-subtitle {
    color: #666;
    font-family: Arial, sans-serif;
    margin-bottom: 12px;
}

.detail-price {
    color: var(--accent);
    font-size: 22px;
    margin-top: 10px;
    font-weight: 500;
}

.detail-desc {
    margin-top: 20px;
    line-height: 1.8;
    color: var(--muted);
    font-family: Arial, sans-serif;
    font-size: 15px;
}

.btn-row {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-top: 16px;
}

.notes-title {
    margin: 5px 0 10px;
}

.notes-box {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    background: #f4f1eb;
    padding: 18px;
    border-radius: 10px;
}

.notes-box p {
    margin-top: 4px;
    color: #555;
    font-family: Arial, sans-serif;
}

/* ===========================
   RELATED PRODUCTS
=========================== */
.related-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
}

.related-card {
    border: 1px solid rgba(0,0,0,.08);
    border-radius: 14px;
    overflow: hidden;
    background: #fff;
    transition: .25s ease;
    text-decoration: none;
    color: inherit;
}

.related-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0,0,0,.08);
}

.related-img {
    width: 100%;
    height: 210px;
    object-fit: contain;
    background: var(--surface);
    padding: 18px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.related-meta {
    padding: 14px 16px 18px;
}

.related-card h4,
.related-name {
    color: var(--ink);
    font-weight: 500;
    margin-bottom: 4px;
    text-decoration: none;
    font-size: 16px;
}

.related-card div,
.related-price {
    color: var(--accent);
    font-weight: 600;
}

/* ===========================
   PROMO SECTION
=========================== */
.promo-section {
    background: linear-gradient(to right, #fde68a, #e7e5e4);
    padding: 80px 0;
}

.promo-container,
.visit-container {
    max-width: 1100px;
    margin: auto;
    padding: 40px 20px;
}

.promo-grid {
    max-width: 1100px;
    margin: auto;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 40px;
    align-items: center;
}

.promo-content {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.promo-label {
    text-transform: uppercase;
    font-size: 12px;
    letter-spacing: 2px;
    color: #92400e;
    margin-bottom: 8px;
}

.promo-title {
    font-size: 42px;
    font-weight: 300;
    margin-bottom: 8px;
}

.promo-discount {
    font-size: 26px;
    font-weight: 600;
    color: #b45309;
    margin-bottom: 20px;
}

.promo-countdown {
    font-size: 22px;
    font-weight: 600;
    color: #8a5a25;
    margin: 3px 0 8px 0;
    letter-spacing: .5px;
}

.promo-countdown.expired {
    color: #b63b3b;
}

.promo-btn {
    background: #1f2937;
    color: white;
    padding: 12px 26px;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-decoration: none;
    transition: .3s;
    display: inline-block;
    width: auto;
    max-width: 260px;
    text-align: center;
    border-radius: 4px;
}

.promo-btn:hover {
    background: #d97706;
}

.promo-image {
    max-width: 360px;
    width: 100%;
    object-fit: contain;
}

/* ===========================
   VISIT STORE
=========================== */
.visit-store {
    background: #1f2937;
    color: white;
    text-align: center;
    padding: 90px 0;
}

.visit-title {
    font-size: 40px;
    font-weight: 300;
    margin-bottom: 10px;
}

.visit-text {
    color: #d1d5db;
    font-size: 18px;
    margin-bottom: 20px;
}

.visit-btn {
    background: #d97706;
    color: white;
    padding: 14px 32px;
    text-transform: uppercase;
    text-decoration: none;
    letter-spacing: 1px;
    transition: .3s;
}

.visit-btn:hover {
    background: #f59e0b;
}

/* ===========================
   CONTACT
=========================== */
.contact-block {
    padding: 70px 0;
}

.contact-box {
    max-width: 650px;
    margin: auto;
    text-align: center;
}

.contact-title {
    font-size: 26px;
    font-weight: 600;
    margin-bottom: 15px;
}

.contact-info p {
    font-size: 16px;
    margin: 6px 0;
    color: #333;
}

.icon {
    margin-right: 6px;
}

.btn-shopee {
    display: inline-block;
    margin-top: 18px;
    background: #1f2a38;
    color: white;
    padding: 10px 22px;
    border-radius: 6px;
    text-decoration: none;
    transition: .25s;
    font-weight: 500;
    letter-spacing: .5px;
}

.btn-shopee:hover {
    background: #d4a574;
}

/* ===========================
   FOOTER
=========================== */
.footer-merged {
    background: #f8f9fb;
    border-top: 1px solid rgba(0,0,0,.05);
    padding: 60px 0 30px;
    font-family: 'Inter', sans-serif;
}

.footer-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 30px;
    align-items: start;
}

.footer-brand {
    font-family: 'Playfair Display', serif;
    font-size: 1.5rem;
    margin: 0 0 10px 0;
    color: #1a1a1a;
}

.footer-col h4 {
    font-family: 'Playfair Display', serif;
    font-size: 1.1rem;
    margin: 0 0 15px 0;
    font-weight: 700;
}

.footer-desc {
    color: #555;
    font-size: 14px;
    line-height: 1.5;
    margin: 0 0 15px 0;
}

.footer-links,
.footer-contact {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li,
.footer-contact li {
    margin-bottom: 8px;
}

.footer-links li a,
.contact-item {
    color: #555;
    text-decoration: none;
    font-size: 14px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: 0.2s;
}

.footer-bottom {
    text-align: center;
    margin-top: 50px;
    padding-top: 20px;
    border-top: 1px solid rgba(0,0,0,.03);
    font-size: 12px;
    color: #888;
}

/* ===========================
   RESPONSIVE - TABLET
=========================== */
@media(max-width: 1100px) {
    .detail-wrapper {
        grid-template-columns: 1fr;
    }
}

@media(max-width: 1024px) {
    .product-grid {
        grid-template-columns: repeat(3, 1fr);
    }
    
    .related-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media(max-width: 992px) {
    .promo-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }
}

/* ===========================
   RESPONSIVE - MOBILE
=========================== */
@media(max-width: 768px) {
    /* Navigation */
    .nav-menu {
        position: absolute;
        top: 100%;
        right: 0;
        background: #fff;
        width: 220px;
        padding: 16px;
        flex-direction: column;
        gap: 14px;
        box-shadow: 0 14px 30px rgba(0,0,0,.12);
        border-radius: 10px;
        display: none;
        z-index: 3000;
    }

    .nav-menu.active {
        display: flex;
    }

    .hamburger {
        display: flex;
        position: relative;
        z-index: 3001;
        cursor: pointer;
    }

    /* Hero */
    .hero-title {
        font-size: 40px;
    }

    .hero-content {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-image {
        justify-content: center;
    }

    .hero-image model-viewer {
        transform: none;
    }

    /* Product Grid */
    .product-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }

    .product-image {
        height: 180px;
    }

    .product-img {
        width: 75%;
        height: 75%;
    }

    .product-info {
        padding: 12px 10px 16px;
    }

    .product-info h3 {
        font-size: 15px;
        margin-bottom: 4px;
    }

    .product-notes {
        font-size: 11px;
        margin-bottom: 6px;
        -webkit-line-clamp: 1;
        line-clamp: 1;
    }

    .product-price {
        font-size: 15px;
    }

    /* Highlight Carousel */
    .highlight-track .product-card {
        flex: 0 0 370px;
    }

    .highlight-track .product-image {
        height: 240px;
    }

    .highlight-track .product-img {
        width: 85%;
        height: 85%;
    }

    .highlight-track .product-info {
        padding: 14px 16px 18px;
    }

    .highlight-track .product-name,
    .highlight-track h3 {
        font-size: 16px;
        margin-bottom: 6px;
    }

    .highlight-track .product-notes {
        font-size: 12px;
        -webkit-line-clamp: 2;
        line-clamp: 2;
        margin-bottom: 8px;
    }

    .highlight-track .product-price {
        font-size: 15px;
    }

    /* About Section */
    .about-content {
        grid-template-columns: 1fr;
        gap: 30px;
        text-align: center;
    }

    .about-image {
        order: 1;
        min-height: 260px;
    }

    .about-text {
        order: 2;
        padding: 0 10px;
    }

    .about-visual model-viewer {
        width: 220px;
        height: 260px;
    }

    /* Detail Page */
    .detail-title {
        font-size: 28px;
    }

    /* Related Products */
    .related-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    /* Promo Button */
    .promo-btn {
        display: block;
        margin: 0 auto;
        width: max-content;
    }

    /* Back Button */
    .back-home-btn {
        margin-left: 0;
        margin-top: -6px;
        padding: 9px 12px;
        border-radius: 10px;
    }

    /* Footer */
    .footer-grid {
        grid-template-columns: repeat(3, 1fr);
        gap: 10px;
    }

    .footer-col:first-child {
        grid-column: span 3;
        text-align: center;
        margin-bottom: 30px;
    }

    .footer-col h4 {
        font-size: 13px;
        margin-bottom: 10px;
    }

    .footer-links li a,
    .contact-item,
    .footer-desc {
        font-size: 10px;
        line-height: 1.3;
    }

    .contact-item i {
        font-size: 11px;
        min-width: 12px;
    }
}

@media(max-width: 480px) {
    .hero-title {
        font-size: 30px;
    }
}

/* ===========================
   RESPONSIVE - SMALL MOBILE
=========================== */
@media(max-width: 360px) {
    .product-grid {
        grid-template-columns: 1fr;
    }
    
    .related-grid {
        grid-template-columns: 1fr;
    }
}
    </style>
</head>


<body>


{{-- ================= NAVBAR ================= --}}
<nav class="navbar show" id="navbar">

    <div class="container nav-container">

        {{-- LOGO + NAMA --}}
        <a href="{{ route('home') }}" class="brand-wrap">
            @if($profilToko && $profilToko->logo)
                <img src="{{ asset('storage/'.$profilToko->logo) }}"
                     class="brand-logo">
            @endif
            <span class="brand-name">{{ $profilToko->nama_toko }}</span>
        </a>

        {{-- MENU --}}
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="nav-link">Home</a></li>
            <li><a href="{{ route('katalog') }}" class="nav-link">Katalog</a></li>
        </ul>

        {{-- HAMBURGER MOBILE --}}
        <button class="hamburger" type="button">
    <span></span><span></span><span></span>
</button>

    </div>
</nav>




{{-- =============== PAGE CONTENT =============== --}}
<main class="page-wrapper">
    @yield('content')
</main>





{{-- GLOBAL SCRIPT --}}
<script src="{{ asset('assets/js/essence.js') }}"></script>


{{-- SLOT SCRIPT TAMBAHAN PER PAGE (TERMASUK GLB ANIMATION) --}}
@stack('scripts')
<script>
function goBack() {
    if (document.referrer && window.history.length > 1) {
        window.history.back();
    } else {
        window.location.href = "{{ route('home') }}"; // fallback aman
    }
}
</script>

</body>
</html>
