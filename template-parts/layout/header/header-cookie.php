<?php
/**
 * Template Parts - Header - Cookie
 * 
 * Header Masthead
 * 
 * @package mingo
 */

$cookie_active	= get_field('site_cookie', 'option');
$cookie_content = get_field('site_cookie_content', 'option');
$cookie_reappear = get_field('site_cookie_reappear', 'option');
$content 		= ($cookie_content) ? $cookie_content['content'] : '';
$cookie_prefix 	= get_bloginfo('name');
$cookie_prefix 	= str_replace(' ', '-', $cookie_prefix);
?>

<?php if($cookie_active) { ?>
	<script>
		// Check for Cookie	
		document.addEventListener('DOMContentLoaded', function() {
			var cookieNameSuffix = '...'; // replace with actual suffix
			var theCookie = readCookie('hide-cookie-' + cookieNameSuffix);
			var siteCookie = document.getElementById('site-cookie');

			// Hide the siteCookie by default
			siteCookie.style.display = 'none';

			// If the cookie is not set, display the siteCookie
			if (!theCookie) {
				siteCookie.style.display = 'block';
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
	
	<div id="site-cookie">	
		<div class="container">
			<div class="grid">
				<div class="cookie-content">
					<div class="icon">
						<i class="fa-solid fa-cookie-bite"></i>
					</div>

					<?php
					if($content) {
						echo '<div class="message">'. $content .'</div>';
					}
					?>
					<a class="button button__outline button__small" href="javascript:;" title="Accept" aria-label="accept">
						Agree
					</a>
				</div>
			</div>
		</div>
	</div><!-- #header-message-bar -->	
	
	<script>
		// Close Message Bar and Set Cookie	
		document.querySelector("#site-cookie .button").addEventListener('click', function() {
			var cookie_prefix = '...'; // replace with actual prefix
			var cookie_reappear = '...'; // replace with actual reappear time
			document.getElementById('site-cookie').classList.add('hide');
			createCookie('hide-cookie-' + cookie_prefix, '1', cookie_reappear);
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