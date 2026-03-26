<div id="mobile-menu" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="fixed inset-y-0 right-0 w-64 bg-white shadow-lg transform translate-x-full transition-transform duration-300 ease-in-out">
        <div class="p-4">
            <div class="flex justify-between items-center mb-6">
                <img src="{{ asset('logo.png') }}" alt="READY 24h Security Logo" class="h-10">
                <button id="close-menu" class="text-gray-500 hover:text-primary">
                    <i class="fas fa-times text-2xl"></i>
                </button>
            </div>
            <nav class="space-y-4">
                <a href="{{ route('home') }}" class="block text-lg font-medium text-primary">Home</a>
                <a href="#services" class="block text-lg font-medium text-secondary hover:text-primary">Services</a>
                <a href="#about" class="block text-lg font-medium text-secondary hover:text-primary">About</a>
                <a href="#industries" class="block text-lg font-medium text-secondary hover:text-primary">Industries</a>
                <a href="#contact" class="block text-lg font-medium text-secondary hover:text-primary">Contact</a>
                <a href="#contact" class="block w-full text-center bg-primary text-white px-6 py-3 rounded-lg hover:bg-accent transition-colors">
                    Get a Quote
                </a>
            </nav>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuButton = document.querySelector('.fa-bars').parentElement;
        const mobileMenu = document.getElementById('mobile-menu');
        const closeButton = document.getElementById('close-menu');
        const menuContent = mobileMenu.querySelector('div');

        menuButton.addEventListener('click', function() {
            mobileMenu.classList.remove('hidden');
            setTimeout(() => {
                menuContent.classList.remove('translate-x-full');
            }, 10);
        });

        function closeMenu() {
            menuContent.classList.add('translate-x-full');
            setTimeout(() => {
                mobileMenu.classList.add('hidden');
            }, 300);
        }

        closeButton.addEventListener('click', closeMenu);
        mobileMenu.addEventListener('click', function(e) {
            if (e.target === mobileMenu) {
                closeMenu();
            }
        });
    });
</script>
@endpush 