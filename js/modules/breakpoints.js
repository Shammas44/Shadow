import * as mod_sorting from "./sorting.js";

export function filter() {
    const SPAN = document.querySelectorAll('.filter SPAN');
    const FILTER_LIST = document.querySelectorAll('.filter__list');
    const MEDIAQUERY_768 = '(max-width: 768px)';
    const MEDIAQUERY_LIST = window.matchMedia(MEDIAQUERY_768);

    if (MEDIAQUERY_LIST.matches) {
        for (var i = 0; i < SPAN.length; i++) {
            FILTER_LIST[i].classList.add('is-displayNone');
            SPAN[i].classList.add('icon-plus');
            SPAN[i].classList.remove('icon-minus');
        }
    } else {
        for (var i = 0; i < SPAN.length; i++) {
            FILTER_LIST[i].classList.remove('is-displayNone');
            SPAN[i].classList.remove('icon-plus');
            SPAN[i].classList.add('icon-minus');
        }
    }

    MEDIAQUERY_LIST.addEventListener('change', event => {
        if (event.matches) {
            for (var i = 0; i < SPAN.length; i++) {
                FILTER_LIST[i].classList.add('is-displayNone');
                SPAN[i].classList.add('icon-plus');
                SPAN[i].classList.remove('icon-minus');
            }
        } else {
            for (var i = 0; i < SPAN.length; i++) {
                FILTER_LIST[i].classList.remove('is-displayNone');
                SPAN[i].classList.remove('icon-plus');
                SPAN[i].classList.add('icon-minus');
            }
        }
    })
}