@extends('layouts.welcome')

@section('content')
<div class="h-screen w-full overflow-y-scroll snap-y snap-mandatory">

    <!-- Sign Up -->
    <section id="signup" class="scroll-section bg-gradient-to-br from-gray-900 to-blue-800 text-white flex items-center justify-center flex-col px-6">
        <div class="section-content">
            <h1 class="heading-primary">Welcome to <span class="text-highlight">TiketMu</span></h1>
            <p class="text-body mb-8">
                Discover and purchase tickets for the most anticipated concerts, theatre performances, seminars, and exhibitions.
                With <span class="text-highlight">TiketMu</span>, your ticketing experience becomes seamless, secure, and accessible at your fingertips.
            </p>
            <a href="{{ route('register') }}" class="button-main">Register Now</a>
        </div>
    </section>

    <!-- Events Category -->
    <section id="events-category" class="scroll-section bg-blue-800 text-white flex items-center justify-center flex-col px-6 blurred-background">
        <div class="section-content">
            <h2 class="heading-primary">Explore Our Wide Range of Events</h2>
            <p class="text-body mb-6">
                Whether you're a fan of live music, a theatre enthusiast, or someone interested in professional seminars and exhibitions,
                <b">TiketMu</b> offers an extensive selection of events. Our platform is designed to help you easily navigate
                    through events, choose the ones that suit your interests, and complete your purchases in just a few clicks.
            </p>
        </div>
    </section>

    <!-- How It Works -->
    <section id="how-it-works" class="scroll-section bg-primary text-white flex items-center justify-center flex-col px-6 blurred-background">
        <div class="section-content">
            <h2 class="heading-primary">How It Works</h2>
            <p class="text-body mb-6">
                From discovering upcoming events to securing your tickets, our process is designed to be intuitive and fast. With a user-friendly interface,
                all you need to do is select an event, choose the tickets, and proceed to the checkout page.
                Rest assured, your payment and data are securely handled.
            </p>
            <ul class="text-body mb-8">
                <li class="bubble-item">Browse events across multiple categories</li>
                <li class="bubble-item">Pay via various trusted methods</li>
                <li class="bubble-item">Receive your e-ticket instantly</li>
                <li class="bubble-item">Fast and secure ticket purchasing</li>
                <li class="bubble-item">Multi-method payment options for greater convenience</li>
            </ul>
        </div>
    </section>

    <!-- About Us -->
    <section id="about-us" class="scroll-section bg-blue-800 text-white flex items-center justify-center flex-col px-6 blurred-background">
        <div class="section-content">
            <h2 class="heading-primary">About <span class="text-highlight">TiketMu</span></h2>
            <p class="text-body mb-8">
                <span class="text-highlight">TiketMu</span> is a leading digital ticketing platform revolutionizing how people discover, buy, and experience events.
                Our mission is to provide customers with the most convenient and secure way to purchase tickets for events that matter to them.
            </p>

        </div>
    </section>

    <!-- Login -->
    <section id="login" class="scroll-section bg-black text-white flex items-center justify-center flex-col px-6">
        <div class="section-content">
            <h2 class="heading-primary mb-6">Ready to Experience the Best in Live Entertainment?</h2>
            <p class="text-body mb-6">
                Join thousands of users who are already enjoying a smoother, safer, and faster ticketing experience. Sign up today to start exploring events
                and secure your tickets with ease. We look forward to helping you create unforgettable memories at your next event.
            </p>
            <a href="{{ route('login') }}" class="button-main">Log In</a>
        </div>
    </section>

    <section class="footer-scroll-section">
        @include('layouts.footer')
    </section>
</div>
@endsection