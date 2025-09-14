import 'swiper/swiper-bundle.css';
import Swiper from 'swiper';
import { Navigation, Scrollbar } from 'swiper/modules';

const slotsSwiper = new Swiper('.slotsSwiper', {
    modules: [Navigation, Scrollbar],
    slidesPerView: 5,
    slidesPerGroup: 5,
    spaceBetween: 16,

    navigation: {
        nextEl: '.slotsSwiper .swiper-button-next',
        prevEl: '.slotsSwiper .swiper-button-prev',
    },

    scrollbar: {
        el: '.slotsSwiper .swiper-scrollbar',
        draggable: true,
        dragSize: 'auto',
    },

    breakpoints: {
        768: {
            slidesPerView: 5,
            slidesPerGroup: 5,
        },
        390: {
            slidesPerView: 2,
            slidesPerGroup: 2,
        },
        0: {
            slidesPerView: 1,
            slidesPerGroup: 1,
        },
    },
});
