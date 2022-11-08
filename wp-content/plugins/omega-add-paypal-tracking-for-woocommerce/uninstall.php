<?php

/**
 * Fired when the plugin is uninstalled.
 *
 * When populating this file, consider the following flow
 * of control:
 *
 * @since      	1.0.0
 *
 * @package    	omega_add_paypal_tracking
 * @subpackage	omega_add_paypal_tracking/includes
 */

// If this file is called directly, abort.
if (!defined('WP_UNINSTALL_PLUGIN')) {
	die;
}

// Include Helper class
require_once(plugin_dir_path(__FILE__) . 'includes/class-rh-easy-helper.php');
$helper = new OMG_PP_Helper();

// If cleanup allowed
if ($helper->get_option('cleanup') !== false) {
	// TODO smazat post meta z orders "OMG_PP_tracking_fb" a "OMG_PP_tracking_gtm"
}
