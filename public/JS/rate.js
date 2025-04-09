
    document.addEventListener("DOMContentLoaded", function() {
        const slider = document.getElementById("testimonial-wrapper");
        const slides = document.querySelectorAll(".testimonial-slide");
        let index = 0;

        function updateSlider() {
            slider.style.transform = `translateX(-${index * 100}%)`;
        }

        document.getElementById("prev-btn").addEventListener("click", function() {
            index = (index > 0) ? index - 1 : slides.length - 1;
            updateSlider();
        });

        document.getElementById("next-btn").addEventListener("click", function() {
            index = (index < slides.length - 1) ? index + 1 : 0;
            updateSlider();
        });

        // // Auto-slide every 5 seconds
        // setInterval(() => {
        //     index = (index < slides.length - 1) ? index + 1 : 0;
        //     updateSlider();
        // }, 5000);
    });
