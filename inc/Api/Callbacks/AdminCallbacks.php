<?php

/**
 * @package  Travelbase
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController
{

	function travelbase_intro_page()
	{
		return require_once("$this->plugin_path/templates/admin.php");
	}

	public function travelbaseSettings()
	{
		return require_once("$this->plugin_path/templates/travelbaseSettings.php");
	}
}
