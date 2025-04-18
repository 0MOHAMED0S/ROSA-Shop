document.addEventListener('DOMContentLoaded', function () {
    let counted = false;

    function animateCounter(elementId, target) {
        let count = 0;
        let speed = Math.max(1, Math.floor(target / 50)); // Avoid speed 0
        let interval = setInterval(() => {
            count += speed;
            if (count >= target) {
                count = target;
                clearInterval(interval);
            }
            document.getElementById(elementId).innerText = count.toLocaleString();
        }, 30);
    }

    function startCount() {
        if (!counted) {
            counted = true;
            animateCounter('instagram-followers', instaCount);
            animateCounter('tiktok-followers', tikTokCount);
            animateCounter('facebook-followers', facebookCount);
            animateCounter('orders-count', ordersCount);
        }
    }

    function isVisible(el) {
        const rect = el.getBoundingClientRect();
        return rect.top < window.innerHeight && rect.bottom > 0;
    }

    function checkVisibilityAndStart() {
        const aboutUsSection = document.getElementById('about-us');
        if (aboutUsSection && isVisible(aboutUsSection)) {
            startCount();
        }
    }

    window.addEventListener('scroll', checkVisibilityAndStart);
    window.addEventListener('load', checkVisibilityAndStart); // In case it's already in view
});

