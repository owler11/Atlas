/*--------------------------------------------------------------
>>> TABLE OF CONTENTS:
----------------------------------------------------------------
1.0 - Plyr
--------------------------------------------------------------*/

import Plyr from 'plyr';

// 1.0 - Plyr
export function videoPlyr() { 
    // Initialize Plyr for all elements with the class 'player'
    document.querySelectorAll('.player').forEach(playerElement => {
        // eslint-disable-next-line
        const player = new Plyr(playerElement, {
            youtube: {
                noCookie: false, 
                rel: 0, 
                showinfo: 0, 
                // eslint-disable-next-line
                iv_load_policy: 3, // Hide video annotations
                modestbranding: 1
            }
        });
    });

    // Initialize Plyr for all elements with the class 'player-autoplay'
    document.querySelectorAll('.player-autoplay').forEach(playerElement => {
        // eslint-disable-next-line
        const playerAutoplay = new Plyr(playerElement, {
            controls: [],
            autoplay: true,
            muted: true,
        });
    });
}
