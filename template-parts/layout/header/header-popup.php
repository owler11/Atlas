<?php
/**
 * Template Parts - Header - Popup
 * 
 * Header Masthead
 * 
 * @package mingo
 */

$popup_active	= get_field('site_popup_activate', 'option');
$popup_content 	= get_field('site_popup_content', 'option');
$pop_image 		= ($popup_content && isset($popup_content['image'])) ? $popup_content['image'] : '';
$pop_content	= ($popup_content && isset($popup_content['content'])) ? $popup_content['content'] : '';
$pop_link 		= ($popup_content && isset($popup_content['link'])) ? $popup_content['link'] : '';
$pop_form 		= ($popup_content && isset($popup_content['form_id'])) ? $popup_content['form_id'] : '';
$popup_reappear = get_field('site_popup_reappear', 'option');
$popup_prefix 	= get_bloginfo('name');
$popup_prefix 	= str_replace(' ', '-', $popup_prefix);

if($popup_active) { ?>
    <script>
		document.addEventListener('DOMContentLoaded', function() {
			const popupNameSuffix = '...'; // replace with actual suffix
			const thePopup = readPopup('hide-popup-' + popupNameSuffix);
			const sitePopup = document.getElementById('site-popup');

			if (sitePopup) {
				let hasExecuted = false;
				let totalScrollDistance = 0;
				let lastScrollX = window.scrollX;
				let lastScrollY = window.scrollY;

				// Function to execute the popup logic
				function executePopupLogic() {
					if (hasExecuted) return;
					hasExecuted = true;

					if (thePopup) {
						sitePopup.close();
						document.body.classList.remove('modal-open'); // Unlock the body
					} else {
						sitePopup.showModal();
						document.body.classList.add('modal-open'); // Lock the body
					}
				}

				// Set a timeout for 5 seconds
				const timeoutId = setTimeout(executePopupLogic, 5000);

				// Add a scroll event listener
				function onScroll() {
					const deltaX = window.scrollX - lastScrollX;
					const deltaY = window.scrollY - lastScrollY;
					totalScrollDistance += Math.sqrt(deltaX ** 2 + deltaY ** 2);
					lastScrollX = window.scrollX;
					lastScrollY = window.scrollY;

					if (totalScrollDistance >= 500) {
						clearTimeout(timeoutId); // Clear the timeout if the user scrolls 500px in any direction
						executePopupLogic();
						window.removeEventListener('scroll', onScroll); // Remove the scroll event listener
					}
				}

				window.addEventListener('scroll', onScroll);
			} else {
				console.error('Popup element with ID "site-popup" not found.');
			}
		});

		function readPopup(name) {
			const nameEQ = name + "=";
			const cookies = document.cookie.split(';');
			for (let i = 0; i < cookies.length; i++) {
				let cookie = cookies[i].trim();
				if (cookie.indexOf(nameEQ) === 0) {
					return cookie.substring(nameEQ.length, cookie.length);
				}
			}
			return null;
		}
	</script>
    
    <dialog id="site-popup" class="modal modal__site-popup">	
        <div class="modal-wrapper">
            <div class="modal-grid__site-popup">
				<?php
				if($pop_image) {
					echo '<div class="popup-image">';
						echo wp_get_attachment_image($pop_image, 'full');
					echo '</div>';
				}

				if($pop_content || $pop_link || $pop_form) {
					echo '<div class="popup-content">';
						if($pop_content) {
							echo $pop_content;
						}
						if($pop_link) {
							echo getButton($pop_link, 'btn__outline', '');
						}
						if($pop_form) {
							echo do_shortcode('[gravityform id="'. $pop_form .'" title="false" description="false" ajax="true"]');
						}
					echo '</div>';
				}
				?>
            </div>
        </div>

        <a id="closeModalBtn" aria-label="close" href="javascript:;"><i class="fa-solid fa-circle-xmark"></i></a>
    </dialog>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const closeModalBtn = document.getElementById('closeModalBtn');
            const sitePopup = document.getElementById('site-popup');

            if (closeModalBtn && sitePopup) {
                // Close Popup and Set Cookie
                closeModalBtn.addEventListener('click', function() {
                    const popupPrefix = '...'; // replace with actual prefix
                    const popupReappear = '...'; // replace with actual reappear time
                    sitePopup.close();
                    document.body.classList.remove('modal-open'); // Unlock the body
                    createPopup('hide-popup-' + popupPrefix, '1', popupReappear);
                });
            } else {
                console.error('Close button or popup element not found.');
            }
        }); 

        // Function to create a cookie
        function createPopup(name, value, days) {
            let expires = "";
            if (days) {
                const date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = `${name}=${value}${expires}; path=/`;
        }
    </script>
<?php } ?>