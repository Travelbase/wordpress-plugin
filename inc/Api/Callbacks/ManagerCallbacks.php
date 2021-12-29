<?php

/**
 * @package  Travelbase
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class ManagerCallbacks extends BaseController
{
	public function checkboxSanitize($input)
	{
		$output = array();

		foreach ($this->managers as $key => $value) {
			$output[$key] = isset($input[$key]) ? true : false;
		}

		return $output;
	}

	public function textfieldSanitize($input)
	{
		$output = array();
		$output['postaff'] = sanitize_text_field($input['postaff']);
		$output['gtm'] = sanitize_text_field($input['gtm']);

		return $output;
	}

	public function adminSectionManager()
	{
		echo 'Manage the libraries here';
	}

	public function adminSectionSettings()
	{
		echo 'Please fill in the following fields';
	}

	public function textField($args)
	{
		$name = $args['label_for'];
		$option_name = $args['option_name'];
		$value = 'test';

		$input = get_option($option_name);
		$value = $input[$name];

		echo '<input type="text" class="regular-text" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="' . $value . '" placeholder="' . $args['placeholder'] . '" required>';
	}

	public function checkboxField($args)
	{
		$name = $args['label_for'];
		$classes = $args['class'];
		$option_name = $args['option_name'];
		$checkbox = get_option($option_name);
		$checked = isset($checkbox[$name]) ? ($checkbox[$name] ? true : false) : false;

		echo '<div class="' . $classes . '"><input type="checkbox" id="' . $name . '" name="' . $option_name . '[' . $name . ']" value="1" class="" ' . ($checked ? 'checked' : '') . '><label for="' . $name . '"><div></div></label></div>';
	}
}
