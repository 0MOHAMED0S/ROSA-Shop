// document.addEventListener('DOMContentLoaded', function () {
//     let counted = false;

//     function animateCounter(elementId, target) {
//         let count = 0;
//         let speed = Math.max(1, Math.floor(target / 50)); // Avoid speed 0
//         let interval = setInterval(() => {
//             count += speed;
//             if (count >= target) {
//                 count = target;
//                 clearInterval(interval);
//             }
//             document.getElementById(elementId).innerText = count.toLocaleString();
//         }, 30);
//     }

//     function startCount() {
//         if (!counted) {
//             counted = true;
//             animateCounter('instagram-followers', instaCount);
//             animateCounter('tiktok-followers', tikTokCount);
//             animateCounter('facebook-followers', facebookCount);
//             animateCounter('orders-count', ordersCount);
//         }
//     }

//     function isVisible(el) {
//         const rect = el.getBoundingClientRect();
//         return rect.top < window.innerHeight && rect.bottom > 0;
//     }

//     function checkVisibilityAndStart() {
//         const aboutUsSection = document.getElementById('about-us');
//         if (aboutUsSection && isVisible(aboutUsSection)) {
//             startCount();
//         }
//     }

//     window.addEventListener('scroll', checkVisibilityAndStart);
//     window.addEventListener('load', checkVisibilityAndStart); // In case it's already in view
// });


let currentSlide = 1;
const totalSlides = 2;

function moveSlide(slideIndex) {
    currentSlide = slideIndex;
    const slider = document.querySelector('.slider');
    slider.style.transform = `translateX(-${(currentSlide - 1) * 100}%)`;
    updateDots();
}

function updateDots() {
    const dots = document.querySelectorAll('.dot');
    dots.forEach((dot, index) => {
        dot.classList.remove('active');
        if (index === currentSlide - 1) {
            dot.classList.add('active');
        }
    });
}

// Auto Slide Function
function autoSlide() {
    currentSlide = (currentSlide % totalSlides) + 1;
    moveSlide(currentSlide);
}

// Set interval for auto sliding every 3 seconds
setInterval(autoSlide, 5000);

// Initialize dots
updateDots();
