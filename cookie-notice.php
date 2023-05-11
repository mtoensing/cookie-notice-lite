<?php
/*
* Plugin Name: Cookie Notice lite
* Description: Displays a cookie notice with less than > 1 KB and customizable text.
* GitHub Plugin URI: mtoensing/cookie-notice-lite
* Version:     1.9.5
* Author:      Marc Tönsing
* Author URI:  https://marc.tv
* Text Domain: cookie-notice-lite
* License: GPL v2 or later
* License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

add_action('wp_footer', 'add_cookie_notice');
add_action('admin_menu', 'cookie_notice_lite_settings_page');
add_action('admin_init', 'cookie_notice_lite_settings_init');

function add_cookie_notice()
{
    $url = get_privacy_policy_url();
    $link = '';
    if (get_privacy_policy_url() != '') {
        $link = '<a style="font-size: small; text-align: right" rel="nofollow" href="' . $url . '">' . __('More information', 'cookie-notice-lite') . '</a>';
    }

    $notice_text = get_option('cookie_notice_lite_text', '');

    if (empty($notice_text)) {
        $notice_text = __('This website uses cookies. By continuing here, you agree to the use of cookies.', 'cookie-notice-lite');
    }

    echo '<p id="cookie-notice">' . esc_html($notice_text) . ' <br><button onclick="acceptCookie();"> ' . __('Okay', 'cookie-notice-lite') . '</button> ' . $link. ' </p>';
    echo '<script>function acceptCookie(){document.cookie="cookieaccepted=1; expires=Sun, 22 Jul 2040 12:00:00 UTC; path=/",document.getElementById("cookie-notice").style.visibility="hidden"}document.cookie.indexOf("cookieaccepted")<0&&(document.getElementById("cookie-notice").style.visibility="visible");</script>';
    echo '<style>#cookie-notice{color:#fff;font-family:inherit;background:#337BB8;padding:20px;position:fixed;bottom:10px;left:10px;width:100%;max-width:300px;box-shadow:0 10px 20px rgba(0,0,0,.2);border-radius:5px;margin:0;visibility:hidden;z-index:1000000;box-sizing:border-box}#cookie-notice button{font-weight: 700;font-size: 100%;color:inherit;background:#005882;border:0;padding:10px;margin-top:10px;width:100%;cursor:pointer}#cookie-notice a{color:#fff;text-decoration:underline}@media only screen and (max-width:600px){#cookie-notice{max-width:100%;bottom:0;left:0;border-radius:0}}</style>';
}

function cookie_notice_lite_settings_page()
{
    add_options_page('Cookie Notice Lite Settings', 'Cookie Notice Lite', 'manage_options', 'cookie_notice_lite', 'cookie_notice_lite_settings_callback');
}

function cookie_notice_lite_settings_callback()
{
    ?>
	<div class="wrap">
		<h1>Cookie Notice Lite Settings</h1>
		<form method="post" action="options.php">
			<?php
                settings_fields('cookie_notice_lite_settings_group');
    do_settings_sections('cookie_notice_lite_settings');
    submit_button();
    ?>
		</form>
	</div>
	<?php
}

function cookie_notice_lite_settings_init()
{
    register_setting('cookie_notice_lite_settings_group', 'cookie_notice_lite_text');

    add_settings_section('cookie_notice_lite_settings_section', 'Notice Text', null, 'cookie_notice_lite_settings');

    add_settings_field('cookie_notice_lite_text', 'Cookie Notice Text', 'cookie_notice_lite_text_callback', 'cookie_notice_lite_settings', 'cookie_notice_lite_settings_section');
}

function cookie_notice_lite_text_callback()
{

    $notice_text = get_option('cookie_notice_lite_text', '');

    if (empty($notice_text)) {
        $text = __('This website uses cookies. By continuing here, you agree to the use of cookies.', 'cookie-notice-lite');
        $notice_text = $text;
    }
    ?>
<textarea id="cookie_notice_lite_text" name="cookie_notice_lite_text" rows="5" cols="50"><?php echo esc_textarea($notice_text); ?></textarea>
<p class="description"><?php __('Enter the text you would like to display for the cookie notice', 'cookie-notice-lite'); ?></p>
<?php
}
?>