document.addEventListener('DOMContentLoaded', function () {
    new Swiper('.mySwiper', {
        slidesPerView: 3,
        spaceBetween: 20,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 2000,
            disableOnInteraction: false,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        breakpoints: {
            // screens <= 480px
            0: {
                slidesPerView: 1
            },
            // screens >= 640px
            640: {
                slidesPerView: 2
            },
            // screens >= 1024px
            1024: {
                slidesPerView: 3
            }
        }
    });
});
