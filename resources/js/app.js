import './bootstrap';

function loadScript(src) {
    return new Promise((resolve, reject) => {
        const script = document.createElement('script');
        script.src = src;
        script.async = true;
        script.onload = resolve;
        script.onerror = reject;
        document.body.appendChild(script);
    });
}

let analyticsLoaded = false;

function loadAnalytics() {
    if (analyticsLoaded) return;
    const configEl = document.getElementById('analytics-config');
    if (!configEl) return;

    let config;
    try {
        config = JSON.parse(configEl.textContent);
    } catch {
        return;
    }

    const hasTracking = config.gtmId || config.gaId || config.clarityId || config.fbPixelId;
    if (!hasTracking) return;

    analyticsLoaded = true;

    if (config.gtmId) {
        window.dataLayer = window.dataLayer || [];
        window.dataLayer.push({ 'gtm.start': new Date().getTime(), event: 'gtm.js' });
        loadScript(`https://www.googletagmanager.com/gtm.js?id=${config.gtmId}`);
    } else if (config.gaId) {
        window.dataLayer = window.dataLayer || [];
        window.gtag = function () { window.dataLayer.push(arguments); };
        window.gtag('js', new Date());
        loadScript(`https://www.googletagmanager.com/gtag/js?id=${config.gaId}`).then(() => {
            window.gtag('config', config.gaId);
        });
    }

    if (config.clarityId) {
        (function (c, l, a, r, i) {
            c[a] = c[a] || function () { (c[a].q = c[a].q || []).push(arguments); };
            const t = l.createElement(r);
            t.async = 1;
            t.src = 'https://www.clarity.ms/tag/' + i;
            const y = l.getElementsByTagName(r)[0];
            y.parentNode.insertBefore(t, y);
        })(window, document, 'clarity', 'script', config.clarityId);
    }

    if (config.fbPixelId) {
        !(function (f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function () {
                n.callMethod ? n.callMethod.apply(n, arguments) : n.queue.push(arguments);
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s);
        })(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        window.fbq('init', config.fbPixelId);
        window.fbq('track', 'PageView');
    }
}

function initAnalytics() {
    const configEl = document.getElementById('analytics-config');
    if (!configEl) return;

    let config;
    try {
        config = JSON.parse(configEl.textContent);
    } catch {
        return;
    }

    if (!config.consentRequired || config.hasConsent) {
        loadAnalytics();
    }
}

function initCookieConsent() {
    const button = document.getElementById('cookie-consent-button');
    const banner = document.getElementById('cookie-consent');
    if (!button || !banner) return;

    button.addEventListener('click', () => {
        document.cookie = 'cookie_consent=true; path=/; max-age=' + (60 * 60 * 24 * 365);
        banner.style.display = 'none';
        loadAnalytics();
    });
}

window.toggleMobileNav = function () {
    const panel = document.getElementById('mobile-nav-panel');
    if (panel) panel.classList.toggle('active');
};

window.openQuoteModal = function () {
    const modal = document.getElementById('quote-modal');
    if (modal) modal.style.display = 'flex';
};

window.showToast = function (message, type = 'success', duration = 5000) {
    if (!message) return;
    const container = document.getElementById('toast-container');
    if (!container) return;

    const toast = document.createElement('div');
    toast.className = `toast ${type}`;
    toast.textContent = message;
    container.appendChild(toast);

    requestAnimationFrame(() => toast.classList.add('show'));

    setTimeout(() => {
        toast.classList.remove('show');
        toast.addEventListener('transitionend', () => toast.remove(), { once: true });
    }, duration);
};

function initTestimonialsSlider() {
    const track = document.querySelector('.testimonials-track');
    const cards = document.querySelectorAll('.testimonials-section .testimonial-card');
    const prevBtn = document.querySelector('.testimonials-section .prev-btn');
    const nextBtn = document.querySelector('.testimonials-section .next-btn');

    if (!track || !cards.length || !prevBtn || !nextBtn) return;

    let currentIndex = 0;

    function getVisibleCards() {
        if (window.innerWidth > 1200) return 3;
        if (window.innerWidth > 768) return 2;
        return 1;
    }

    function updateSlider() {
        const cardWidth = cards[0].offsetWidth + 30;
        track.style.transform = `translateX(${-currentIndex * cardWidth}px)`;

        prevBtn.disabled = currentIndex === 0;
        nextBtn.disabled = currentIndex >= cards.length - getVisibleCards();
        prevBtn.style.opacity = prevBtn.disabled ? '0.5' : '1';
        nextBtn.style.opacity = nextBtn.disabled ? '0.5' : '1';
    }

    prevBtn.addEventListener('click', () => {
        if (currentIndex > 0) {
            currentIndex--;
            updateSlider();
        }
    });

    nextBtn.addEventListener('click', () => {
        if (currentIndex < cards.length - getVisibleCards()) {
            currentIndex++;
            updateSlider();
        }
    });

    window.addEventListener('resize', () => {
        currentIndex = 0;
        updateSlider();
    });

    updateSlider();
}

const observer = new IntersectionObserver((entries, obs) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('visible');
            obs.unobserve(entry.target);
        }
    });
}, { root: null, rootMargin: '0px', threshold: 0.1 });

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.service-card, .testimonial-card, .cta-card').forEach(el => {
        observer.observe(el);
    });

    const mobileToggle = document.getElementById('mobile-menu-toggle');
    if (mobileToggle) {
        mobileToggle.addEventListener('click', window.toggleMobileNav);
    }

    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));
            if (!target) return;
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth' });
        });
    });

    const flashEl = document.getElementById('flash-messages');
    if (flashEl) {
        const status = flashEl.dataset.status;
        const error = flashEl.dataset.error;
        if (status) window.showToast(status, 'success');
        if (error) window.showToast(error, 'error');
    }

    initTestimonialsSlider();
    // initCookieConsent();
    // initAnalytics();
});
