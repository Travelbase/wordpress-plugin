<?php

/**
 * @package Eskidoos
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Api\Callbacks\AdminCallbacks;
use Inc\Api\Callbacks\ManagerCallbacks;
use Inc\Base\BaseController;

class Settings extends BaseController
{

	public $settings;
	public $callbacks;
	public $pages = array();
	public $subpages = array();

	public function register()
	{
		$this->settings = new SettingsApi();

		$this->callbacks = new AdminCallbacks();

		$this->callbacks_mngr = new ManagerCallbacks();

		$this->setPages();

		$this->setSubpages();

		$this->setSettings();
		$this->setSections();
		$this->setFields();

		$this->settings->addPages($this->pages)->addSubPages($this->subpages)->register();
	}

	public function setSettings()
	{
		//register fields
		$args = array(
			array(
				'option_group' => 'travelbase_plugin_actions',
				'option_name' => 'travelbase_plugin_settings_activate',
				'callback' => array($this->callbacks_mngr, 'checkboxSanitize')
			),
			array(
				'option_group' => 'travelbase_plugin_fields',
				'option_name' => 'travelbase_plugin_settings_fields',
				'callback' => array($this->callbacks_mngr, 'textfieldSanitize')
			)
		);

		$this->settings->setSettings($args);
	}

	public function setSections()
	{
		$args = array(
			array(
				'id' => 'travelbase_admin_settings_activate',
				'title' => 'Activate lib',
				'callback' => array($this->callbacks_mngr, 'adminSectionManager'),
				'page' => 'travelbase_plugin_actions' // ok
			),
			array(
				'id' => 'travelbase_admin_settings_fields',
				'title' => 'Settings fields',
				'callback' => array($this->callbacks_mngr, 'adminSectionSettings'),
				'page' => 'travelbase_plugin_fields' //Ok
			)
		);

		$this->settings->setSections($args);
	}


	public function setFields()
	{
		$args = array();

		//checkboxes
		foreach ($this->managers as $key => $value) {
			$args[] = array(
				'id' => $key,
				'title' => $value,
				'callback' => array($this->callbacks_mngr, 'checkboxField'),
				'page' => 'travelbase_plugin_actions',
				'section' => 'travelbase_admin_settings_activate',
				'args' => array(
					'option_name' => 'travelbase_plugin_settings_activate',
					'label_for' => $key,
					'class' => 'ui-toggle'
				)
			);
		}

		array_push(
			$args,
			[
				'id' => 'postaff',
				'title' => 'Post Affiliate ID',
				'callback' => array($this->callbacks_mngr, 'textField'),
				'page' => 'travelbase_plugin_fields',
				'section' => 'travelbase_admin_settings_fields',
				'args' => array(
					'option_name' => 'travelbase_plugin_settings_fields',
					'label_for' => 'postaff',
					'placeholder' => 'Your postaffliliate id'
				)
			],
			[
				'id' => 'gtm',
				'title' => 'Google Tag Manager ID',
				'callback' => array($this->callbacks_mngr, 'textField'),
				'page' => 'travelbase_plugin_fields',
				'section' => 'travelbase_admin_settings_fields',
				'args' => array(
					'option_name' => 'travelbase_plugin_settings_fields',
					'label_for' => 'gtm',
					'placeholder' => 'Your gtm id'
				)
			]
		);

		$this->settings->setFields($args);
	}

	public function setPages()
	{
		$this->pages = array(
			array(
				'page_title' => 'Travelbase',
				'menu_title' => 'Travelbase',
				'capability' => 'manage_options',
				'menu_slug' => 'travelbase',
				'callback' => array($this->callbacks, 'travelbase_intro_page'),
				'icon_url' => 'dashicons-palmtree',
				'position' => 40
			)
		);
	}

	public function setSubpages()
	{
		$this->subpages = array(
			array(
				'parent_slug' => 'travelbase',
				'page_title' => 'Settings page',
				'menu_title' => 'Settings',
				'capability' => 'manage_options',
				'menu_slug' => 'travelbase-settings',
				'callback' => array($this->callbacks, 'travelbaseSettings')
			),
		);
	}
}
