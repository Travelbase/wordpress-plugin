<?php

/**
 * @package Travelbase
 */
/*
Plugin Name: Travelbase
Plugin URI: https://travelbase.eu
Description: Plugin to enhance your Travelbase website
Version: 1.0.1
Author: Boghaert Pieter
Author URI: https://pieterboghaert.be
License: GPLv2 or later
Text Domain: travelbase
*/

//security
if (!defined('ABSPATH')) {
	die('You can\'t access this file directly you piece of shit');
}

if (file_exists(dirname(__FILE__) . '/vendor/autoload.php')) {
	require_once dirname(__FILE__) . '/vendor/autoload.php';
}

/**
 * Initialize all the core classes of the plugin
 */
if (class_exists('Inc\\Init')) {
	Inc\Init::register_services();
}

class Travelbase
{
}
