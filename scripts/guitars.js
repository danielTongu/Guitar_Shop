// guitars.js

$(document).ready(() => {
    $('section > div').bxSlider({
        mode: 'horizontal',
        auto: true,
        randomStart: true,
        controls: false, 
        captions: true,
        pager: true,
        pagerType: 'short',
        pause: 3000,
        maxSlides: 1,
        minSlides: 1,
        slideWidth: 250
    });

});