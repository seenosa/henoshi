<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Add additional links to the plugin on plugin overview
 *
 * @since      	1.0.0
 *
 * @package    	omega_add_paypal_tracking
 * @subpackage	omega_add_paypal_tracking/includes/admin
 */
function omega_add_paypal_tracking_plugin_action_links($links)
{
	$action_links = array(
		'settings' => '<a href="' . admin_url('admin.php?page=omega-add-paypal-tracking') . '" aria-label="' . esc_attr__('View settings', 'omega-add-paypal-tracking') . '">' . esc_html__('Settings', 'omega-add-paypal-tracking') . '</a>',
	);

	return array_merge($action_links, $links);
}
add_filter('plugin_action_links_' . OMG_PP_BASENAME, 'omega_add_paypal_tracking_plugin_action_links');
