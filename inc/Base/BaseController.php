<?php

/**
 * @package  Travelbase
 */

namespace Inc\Base;

class BaseController
{

	public $managers = array();

	public $plugin_path;

	public $plugin_url;

	public $plugin;

	public function __construct()
	{
		$this->plugin_path = plugin_dir_path(dirname(__FILE__, 2));
		$this->plugin_url = plugin_dir_url(dirname(__FILE__, 2));
		$this->plugin = plugin_basename(dirname(__FILE__, 3)) . '/travelbase.php';

		$this->managers = array(
			'calendar' => 'Activate Travelbase Calendar',
			'iframeslide' => 'Activate Travelbase Iframe Slider'
		);
	}

	public function activated(string $key)
	{
		$option = get_option('travelbase_plugin_settings_activate');
		return isset($option[$key]) ? $option[$key] : false;
	}
}
