/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Globals
2.0 - Slideshow
--------------------------------------------------------------*/

// 1.0 - Globals
const $ = require("jquery");

// 2.0 - Slideshow
export function initSlideShows() {
  const slickPrev = '<button class="slick-prev">Prev</button>';
  const slickNext = '<button class="slick-next">Next</button>';

  //Hero Carousel Slider
  $("#hero_carousel_slide").slick({
    rows: 0,
    infinite: true,
    dots: true,
    slidesToShow: 1,
    slidesToScroll: 1,
    swipe: true,
    swipeToSlide: true,
    autoplay: true,
    autoplaySpeed: 8000,
    fade: true,
    cssEase: "linear",
  });

  $(".js-product-slider").slick({
    rows: 0,
    infinite: false,
    dots: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    nextArrow: slickNext,
    prevArrow: slickPrev,
  });
}
