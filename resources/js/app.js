import './bootstrap';

// Intersection Observer for scroll animations
const observerOptions = {
    root: null,
    rootMargin: '0px',
    threshold: 0.1
};

const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

// Observe all animated elements
document.addEventListener('DOMContentLoaded', () => {
    const animatedElements = document.querySelectorAll('.service-card, .testimonial-card, .cta-card');
    animatedElements.forEach(element => observer.observe(element));

    // Mobile menu toggle
    const mobileMenu = document.querySelector('.mobile-menu');
    const navLinks = document.querySelector('.nav-links');
    
    mobileMenu.addEventListener('click', () => {
        navLinks.classList.toggle('active');
        mobileMenu.classList.toggle('active');
    });
});

// Smooth scroll for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// Form Submission
document.querySelector('.contact-form').addEventListener('submit', function(e) {
    e.preventDefault();
    // Add your form submission logic here
    alert('Thank you for your message. We will get back to you soon!');
    this.reset();
});

// Scroll Animation
window.addEventListener('scroll', function() {
    const header = document.querySelector('.header');
    // if (window.scrollY > 50) {
    //     header.style.background = '#0a0a0a';
    // } else {
    //     header.style.background = 'rgba(0, 0, 0, 0.3)';
    // }
});

// Parallax Effect
document.addEventListener('DOMContentLoaded', function() {
    const parallaxSection = document.querySelector('.parallax-section');
    
    window.addEventListener('scroll', function() {
        if (parallaxSection) {
            const scrolled = window.pageYOffset;
            const rate = scrolled * 0.5;
            parallaxSection.style.backgroundPosition = `center ${rate}px`;
        }
    });
}); 