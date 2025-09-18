/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Globals
2.0 - Popup
--------------------------------------------------------------*/


// 1.0 - Globals
const $ = require('jquery');

// 2.0 - Popup
export function popup() {
    $('[data-mfp-help]').magnificPopup({
        type:'inline',
    });

    $('.js-popup-video').magnificPopup({
        type: 'iframe',
    }); 
};