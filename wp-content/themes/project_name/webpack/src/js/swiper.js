import 'swiper/swiper-bundle.css';

import Swiper from 'swiper';
import { Navigation, Pagination, Autoplay } from 'swiper/modules';

const swiper = new Swiper('.heroSwiper', {
    modules: [Navigation, Pagination, Autoplay],
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },
    autoplay: {
        delay: 10000,
        disableOnInteraction: false,
    },
    speed: 600,
});

swiper.on('reachEnd', () => {
    swiper.params.autoplay.reverseDirection = true;
    swiper.autoplay.start();
});

swiper.on('reachBeginning', () => {
    swiper.params.autoplay.reverseDirection = false;
    swiper.autoplay.start();
});