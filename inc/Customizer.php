<?php

/**
 * @package Eskidoos
 */

namespace Inc;

class Customizer
{

	function __construct()
	{
		self::customLogin();
	}

	function customLogin()
	{
		add_action('login_enqueue_scripts', array(__CLASS__, 'travelbase_login_logo'), 11);
		add_filter('login_headerurl', array(__CLASS__, 'travelbase_login_logo_url'));
		add_filter('login_headertitle', array(__CLASS__, 'travelbase_login_logo_url_title'));
	}


	function travelbase_login_logo()
	{ ?>
		<style type="text/css">
			#login h1 a,
			.login h1 a {
				background-image: url(<?php echo esc_url(plugins_url('../assets/images/travelbase.svg', __FILE__)) ?>);
				width: 250px;
				background-size: contain;
				background-repeat: no-repeat;
				background-position: bottom;
				margin: 30px auto;
			}

			.login #login .message,
			.login #login .success,
			.login #login #login_error {
				border-left-color: #5a635c;
			}

			.wp-core-ui #loginform .button-primary {
				background-color: #5a635c;
				border-color: #5a635c;
			}

			.wp-core-ui #loginform .button-secondary {
				color: #5a635c;
			}
		</style>
<?php }

	function travelbase_login_logo_url()
	{
		return "https://travelbase.eu";
	}


	function travelbase_login_logo_url_title()
	{
		return 'Travelbase.eu';
	}
}
