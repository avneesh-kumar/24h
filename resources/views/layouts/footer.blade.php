<footer class="footer">
    <div class="footer-content">
        <div class="footer-section">
            <div class="footer-logo">
                <a href="/">
                    <img src="{{ $site_logo ? asset('storage/' . $site_logo) : asset('logo.png') }}" alt="READY 24h Security Logo">
                </a>
            </div>
            <p>Professional security solutions for your peace of mind.</p>
            <div class="social-links">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-linkedin"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('services.index') }}">Services</a></li>
                <li><a href="{{ route('areas.index') }}">Areas</a></li>
                <li><a href="{{ route('industries.index') }}">Industries</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h3>Services</h3>
            <ul>
                @foreach($footer_services as $service)
                    <li><a href="{{ url('services/' . $service->slug) }}">{{ $service->title }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>
    <!-- scroll to top button -->
    <button id="scrollToTop" class="scroll-to-top" onclick="scrollToTop()">
        <i class="fas fa-arrow-up"></i>
    </button>
    <style>
        .scroll-to-top {
            position: fixed;
            bottom: 80px;
            right: 20px;
            background-color: #ff0000;
            border: 2px solid #fff;
            color: #fff;
            border-radius: 5px;
            padding: 15px 20px;
            cursor: pointer;
            display: none;
            font-size: 20px;
        }

        .scroll-to-top:hover {
            /* background-color: */
        }
        
    </style>
    <script>
        // Scroll to top function
        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        // Show/hide scroll to top button
        window.onscroll = function() {
            const scrollToTopButton = document.getElementById('scrollToTop');
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                scrollToTopButton.style.display = 'block';
            } else {
                scrollToTopButton.style.display = 'none';
            }
        };
    </script>


</footer>