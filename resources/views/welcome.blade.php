@extends('layouts.user')

@section('title', 'Parfum Collection')

@section('content')

<!-- HERO SECTION -->
<section class="hero">
    <div class="hero-text">
        <small>Member's days</small>
        <h1>Your exclusive sitewide offer awaits</h1>
        <a href="#" class="btn-black">SIGNUP NOW</a>
    </div>

    <div class="hero-image">
        <img src="/images/sample/chanel1.png">
    </div>
</section>


<!-- NEW FRAGRANCE SECTION -->
<section class="two-col">
    <div class="img-left">
        <img src="/images/sample/chanel2.png">
    </div>

    <div class="text-right">
        <small>Our original perfume</small>
        <h2>The new fragrance</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a class="btn-black">SHOP NOW</a>
    </div>
</section>


<!-- DISCOVERY SECTION -->
<section class="two-col reverse">
    <div class="text-left">
        <small>eau de toilette</small>
        <h2>instinctive and electric</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit,
            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
        <a class="btn-black">DISCOVER</a>
    </div>

    <div class="img-right">
        <img src="/images/sample/chanel3.png">
    </div>
</section>


<!-- BEST SELLER -->
<section class="center-text">
    <small>Check out our</small>
    <h2>Best Sellers</h2>
</section>


<!-- PRODUCT SAMPLE (STATIC FIRST) -->
<section class="product-grid">
    <div class="product-card">
        <img src="/images/sample/parfum-pink.png">
        <span class="badge">Sale!</span>
        <small>Women</small>
        <h4>Pink Emotions</h4>
        <p class="price"><del>$485.00</del> $390.00</p>
    </div>
</section>


<!-- DISCOVER MORE -->
<section class="discover">
    <div class="discover-text">
        <h3>The new fragrance that will surprise you every day</h3>
        <a class="btn-black">DISCOVER</a>
    </div>

    <div class="discover-image">
        <img src="/images/sample/chanel4.png">
    </div>
</section>


<!-- REFLECTIVE EDITION -->
<section class="banner">
    <div>
        <small>eau de toilette</small>
        <h2>perfume reflective edition</h2>
        <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit.</p>
        <a class="btn-black">SHOP NOW</a>
    </div>
</section>


<!-- SHOP BY CATEGORY -->
<section class="center-text">
    <small>New parfumes</small>
    <h2>Shop by Category</h2>
</section>

<section class="category-grid">
    <div class="cat-box">
        <img src="/images/sample/cat1.jpg">
        <div class="cat-label">EXCLUSIVE</div>
    </div>

    <div class="cat-box">
        <img src="/images/sample/cat2.jpg">
        <div class="cat-label">MEN</div>
    </div>

    <div class="cat-box">
        <img src="/images/sample/cat3.jpg">
        <div class="cat-label">WOMEN</div>
    </div>
</section>


<!-- FOOTER -->
<footer class="footer">
    <div>
        <h3>INESSA</h3>
        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore.</p>
    </div>

    <div>
        <h4>customer care</h4>
        <p>Need help? We're always here for you.</p>
        <p>E: info@example.com<br>P: +1 234 567 890</p>
    </div>

    <div>
        <h4>follow us</h4>
        <p>Facebook<br>Instagram<br>YouTube<br>Pinterest<br>Twitter</p>
    </div>

    <div>
        <h4>useful links</h4>
        <p>Returns & Exchange<br>FAQ<br>Shipping Information<br>Affiliates<br>Wholesale</p>
    </div>
</footer>

@endsection
