<div class="bg-gray-900 text-white px-6 pt-12 py-6 border-t border-gray-700">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8 text-sm">
        <!-- Brand & Social -->
        <div class="flex flex-col space-y-6">
            <h3 class="text-2xl font-semibold text-white">TiketMu</h3>
            <p class="text-gray-400 text-base">
                A platform to buy tickets for music events, seminars, exhibitions, and theater with an easy and secure experience.
            </p>
            <div class="flex space-x-6 mt-4">
                <a href="https://www.instagram.com/tiketmu" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="https://wa.me/62xxxxxxxxxx" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-whatsapp"></i>
                </a>
                <a href="https://www.tiktok.com/@tiketmu" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-tiktok"></i>
                </a>
                <a href="https://twitter.com/tiketmu" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-twitter"></i>
                </a>
                <a href="https://www.youtube.com/c/tiketmu" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-youtube"></i>
                </a>
                <a href="https://www.facebook.com/tiketmu" class="hover:text-blue-400 transition-all text-2xl" target="_blank">
                    <i class="fa-brands fa-facebook"></i>
                </a>
            </div>
        </div>

        <!-- Quick Links -->
        <div class="flex flex-col space-y-3">
            <h4 class="text-lg font-semibold text-white">Navigation</h4>
            <a href="{{ url('/#signup') }}" class="hover:text-blue-400 transition-all">Sign Up</a>
            <a href="{{ url('/#events-category') }}" class="hover:text-blue-400 transition-all">Events Category</a>
            <a href="{{ url('/#how-it-works') }}" class="hover:text-blue-400 transition-all">How It Works</a>
            <a href="{{ url('/#about-us') }}" class="hover:text-blue-400 transition-all">About Us</a>
            <a href="{{ url('/#login') }}" class="hover:text-blue-400 transition-all">Login</a>
        </div>

        <!-- Newsletter -->
        <div class="flex flex-col space-y-4">
            <h4 class="text-lg font-semibold text-white">Stay Updated</h4>
            <p class="text-gray-400">
                Get the latest event information straight to your inbox.
            </p>
            <form class="flex items-center mt-3">
                <input type="email" placeholder="you@example.com"
                    class="bg-gray-800 text-white px-4 py-2 rounded-l-full focus:outline-none w-full">
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-r-full text-white font-medium transition-all">
                    Subscribe
                </button>
            </form>
        </div>
    </div>

    <div class="text-center text-gray-500 text-xs mt-12">
        &copy; {{ date('Y') }} TiketMu. All rights reserved.
    </div>
</div>