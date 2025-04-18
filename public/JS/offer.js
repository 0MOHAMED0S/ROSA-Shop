// document.addEventListener('DOMContentLoaded', function () {
//     // Set the end date (15 days from now)
//     const offerEndDate = new Date();
//     offerEndDate.setDate(offerEndDate.getDate() + 15);
//     offerEndDate.setHours(23, 59, 59, 999); // Set to end of the day

//     function updateCountdown() {
//         const now = new Date();
//         const timeLeft = offerEndDate - now; // Difference in milliseconds

//         if (timeLeft <= 0) {
//             document.getElementById('countdown').innerHTML = 
//                 "<span class='text-red-500'>Offer Expired!</span>";
//             clearInterval(countdownInterval);
//             return;
//         }

//         const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
//         const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//         const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
//         const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

//         document.getElementById('countdown').innerHTML = `
//             <span class="text-3xl font-bold">${days}d</span> :
//             <span class="text-3xl font-bold">${hours}h</span> :
//             <span class="text-3xl font-bold">${minutes}m</span> :
//             <span class="text-3xl font-bold">${seconds}s</span>`;
//     }

//     // Run immediately and then update every second
//     updateCountdown();
//     const countdownInterval = setInterval(updateCountdown, 1000);
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
