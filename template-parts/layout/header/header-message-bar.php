<?php
/**
 * Template Parts - Header - Message Bar
 * 
 * Header Masthead
 * 
 * @package mingo
 */

$hmb 			= get_field('hmb', 'option');
$hmb_tx 		= get_field('hmb_tx', 'option');
$hmb_cs 		= get_field('hmb_cs', 'option');
$hmb_reappear 	= get_field('hmb_reappear', 'option') ?: 7;
$hmb_prefix 	= get_bloginfo('name');
$hmb_prefix 	= str_replace(' ', '-', $hmb_prefix);
?>

<?php if($hmb) { ?>
	<script>
		// Check for Cookie	
		document.addEventListener('DOMContentLoaded', function() {
			var cookieNameSuffix = '...'; // replace with actual suffix
			var myCookie = readCookie('hide-message-bar-' + cookieNameSuffix);
			var headerMessageBar = document.getElementById('header-message-bar');

			// Hide the siteCookie by default
			headerMessageBar.style.display = 'none';

			// If the cookie is not set, display the siteCookie
			if (!myCookie) {
				headerMessageBar.style.display = 'block';
			}
		});

		function readCookie(name) {
			var nameEQ = name + "=";
			var ca = document.cookie.split(';');
			for(var i=0;i < ca.length;i++) {
				var c = ca[i];
				while (c.charAt(0)==' ') c = c.substring(1,c.length);
				if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
			}
			return null;
		}
	</script>
	
	<div id="header-message-bar">	
		<div class="container">
			<div class="grid">
				<div class="message-bar-content">
					<span class="header-message"><?php echo $hmb_tx; ?></span>
					<a class="close" href="javascript:;" title="Close" aria-label="close">
						<i class="fa-solid fa-circle-xmark"></i>
					</a>
				</div>
			</div>
		</div>
	</div><!-- #header-message-bar -->	
	
	<script>
		// Close Message Bar and Set Cookie	
		document.querySelector("#header-message-bar .close").addEventListener('click', function() {
			var hmb_prefix = '...'; // replace with actual prefix
			var hmb_reappear = '...'; // replace with actual reappear time
			document.getElementById('header-message-bar').classList.add('hide');
			createCookie('hide-message-bar-' + hmb_prefix, '1', hmb_reappear);
		});

		function createCookie(name, value, days) {
			var expires;
			if (days) {
				var date = new Date();
				date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
				expires = "; expires=" + date.toGMTString();
			} else {
				expires = "";
			}
			document.cookie = name + "=" + value + expires + "; path=/";
		}
	</script>
<?php } ?>