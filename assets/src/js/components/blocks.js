/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Globals
2.0 - Blocks
--------------------------------------------------------------*/

// 1.0 - Globals
const $ = require("jquery");

// 2.0 - Blocks
export function blocks() {
  (function () {
    const sliderThree = function () {
      $(".js-slider-3")
        .not(".slick-initialized")
        .slick({
          rows: 0,
          dots: false,
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 450,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
    };

    const sliderRelatedContent = function () {
      $(".js-slider-related-content")
        .not(".slick-initialized")
        .slick({
          rows: 0,
          dots: false,
          infinite: false,
          slidesToShow: 3,
          slidesToScroll: 1,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 1,
              },
            },
            {
              breakpoint: 450,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
    };

    const sliderLogo = function () {
      $(".js-slider-logo")
        .not(".slick-initialized")
        .slick({
          rows: 0,
          dots: false,
          slidesToShow: 6,
          slidesToScroll: 1,
          // variableWidth: true,
          infinite: true,
          responsive: [
            {
              breakpoint: 1024,
              settings: {
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 600,
              settings: {
                slidesToShow: 2,
              },
            },
            {
              breakpoint: 450,
              settings: {
                slidesToShow: 1,
              },
            },
          ],
        });
    };

    const sliderTestimonial = function () {
      $(".js-slider-testimonial").not(".slick-initialized").slick({
        rows: 0,
        dots: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        // variableWidth: true,
        infinite: true,
      });
    };

    // Initialize each block on page load (front end).
    $(document).ready(function () {
      sliderThree();
      sliderLogo();
      sliderTestimonial();
      sliderRelatedContent();
    });
  })(jQuery);
}
