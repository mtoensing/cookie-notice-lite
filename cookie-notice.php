<?php
/*
* Plugin Name: Cookie Notice Lite (Deutsch)
* Description: Displays a German cookie notice.
* GitHub Plugin URI: mtoensing/cookie-notice-lite
* Version:     1.5
* Author:      MarcDK
* Author URI:  https://marc.tv
* License: GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/
add_action('wp_footer', 'add_cookie_notice');

function add_cookie_notice(){
	$url = get_privacy_policy_url();
	$link = '';
	if (get_privacy_policy_url() != ''){
		$link = '<a style="font-size: small; text-align: right" rel="nofollow" href="' . $url . '">Mehr Informationen</a>';
	}
	echo '<p id="cookie-notice">Diese Webseite verwendet Cookies. In dem Du hier fortfährst, stimmst Du der Nutzung der Cookies zu. <br><button onclick="acceptCookie();">Hab\'s verstanden</button> ' . $link. ' </p>';
	echo '<script>function acceptCookie(){document.cookie="cookieaccepted=1; expires=Sun, 22 Jul 2040 12:00:00 UTC; path=/",document.getElementById("cookie-notice").style.visibility="hidden"}document.cookie.indexOf("cookieaccepted")<0&&(document.getElementById("cookie-notice").style.visibility="visible");</script>';
	echo '<style>#cookie-notice{color:#fff;font-family:inherit;background:#0073aa;padding:20px;position:fixed;bottom:10px;left:10px;width:100%;max-width:300px;box-shadow:0 10px 20px rgba(0,0,0,.2);border-radius:5px;margin:0;visibility:hidden;z-index:1000000;box-sizing:border-box}#cookie-notice button{font-weight: 700;font-size: 100%;color:inherit;background:#005882;border:0;padding:10px;margin-top:10px;width:100%;cursor:pointer}#cookie-notice a{color:#fff;text-decoration:underline}@media only screen and (max-width:600px){#cookie-notice{max-width:100%;bottom:0;left:0;border-radius:0}}</style>';
}
?>
