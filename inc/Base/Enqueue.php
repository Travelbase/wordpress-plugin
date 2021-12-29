<?php

/**
 * @package  Travelbase
 */

namespace Inc\Base;

use Inc\Base\BaseController;

/**
 * 
 */
class Enqueue extends BaseController
{
	function register()
	{
		add_action('wp_enqueue_scripts', array($this, 'enqueue'));
		add_action('admin_print_styles', array($this, 'enqueue_admin'));
		add_filter('script_loader_tag', array($this, 'tb_script_attributes'), 10, 3);
		add_action('wp_footer', array($this, 'postaff_script'));
		add_action('wp_head', array($this, 'gtm_head_code'));
		//add_filter('wp_handle_upload_prefilter', array($this, 'tb_restrict_upload_file_size'));
	}


	function enqueue_admin()
	{
		wp_enqueue_style('tbcss', $this->plugin_url . 'assets/css/main.css');
		wp_enqueue_script('tbmainadmin', $this->plugin_url . 'assets/js/main.js');
	}

	function enqueue()
	{
		// enqueue all our scripts

		//iframe loader
		if ($this->activated('iframeslide')) {
			wp_enqueue_style('iframestyle', 'https://travelbase.eu/css/iframe-loader.css');
			wp_enqueue_script('iframescript', 'https://travelbase.eu/js/iframe-loader.js');
		}

		//calendar
		if ($this->activated('calendar')) {
			wp_enqueue_style('calendarstyle', 'https://static.travelbase.eu/css/calendar/trip-calendar.min.css', false, '1.4', 'all');
			wp_enqueue_script('calendarscript', 'https://static.travelbase.eu/js/calendar/trip-calendar.min.js', [], '1.4', true);
		}

		//postaffiliate
		wp_register_script('postaffiliatepro', 'https://travelbase.postaffiliatepro.com/scripts/3uw8z5jvgh');
		wp_enqueue_script('postaffiliatepro');
		wp_enqueue_script('tbmain', $this->plugin_url . 'assets/js/main.js', array('postaffiliatepro'));
	}

	function tb_script_attributes($tag, $handle, $src)
	{
		if ('postaffiliatepro' === $handle) {

			// add attributes of your choice
			$tag = '<script id="pap_x2s6df8d" src="' . esc_url($src) . '"></script>';
		}

		return $tag;
	}

	function postaff_script()
	{

?>
		<script>
			PostAffTracker.setAccountId('default1');
			<?php
			if (get_option('travelbase_plugin_settings_fields') != null) {
				echo "var CampaignID='" . get_option('travelbase_plugin_settings_fields')['postaff'] . "'; 
					";
			}

			?>

			try {
				PostAffTracker.track();
			} catch (err) {}
		</script>
	<?php
	}


	function gtm_head_code()
	{
	?>
		<!-- Google Tag Manager -->
		<script>
			(function(w, d, s, l, i) {
				w[l] = w[l] || [];
				w[l].push({
					'gtm.start': new Date().getTime(),
					event: 'gtm.js'
				});
				var f = d.getElementsByTagName(s)[0],
					j = d.createElement(s),
					dl = l != 'dataLayer' ? '&l=' + l : '';
				j.async = true;
				j.src =
					'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
				f.parentNode.insertBefore(j, f);
			})(window, document, 'script', 'dataLayer', '<?= get_option("travelbase_plugin_settings_fields")["gtm"]; ?>');
		</script>
		<!-- End Google Tag Manager -->
<?php
	}

	function tb_restrict_upload_file_size($file)
	{

		$size = $file['size'];
		$size = $size / 1024;
		$type = $file['type'];
		$is_image = strpos($type, 'image') !== false;
		$limit = 900;
		$limit_output = '900kb';

		if ($is_image && $size > $limit) {
			$file['error'] = 'Image files must be smaller than ' . $limit_output;
		}

		return $file;
	}
}
