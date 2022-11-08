<?php
/*
Plugin Name: Synctrack - Add Paypal Tracking Auto
Description: Turn visitors into customers.
Version:     1.0.0
Author:      Omegatheme
Author URI:  https://omegatheme.com
*/

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

define('OMG_PP_DIR', plugin_dir_path(__FILE__));
define('OMG_PP_URL', plugin_dir_url(__FILE__));
define('OMG_PP_BASENAME', plugin_basename(__FILE__));
define('OMG_PP_VERSION', '1.0.9');
define('OMG_PP_FRONTEND_URL', 'https://apps.synctrack.io/add-paypal-tracking/woocommerce/server/get_code.php');
define('OMG_PP_MIN_WC_VERSION', '3.4.0');

/**
 * Localize plugin
 */
add_action('init', 'omega_add_paypal_tracking_localize_plugin');
function omega_add_paypal_tracking_localize_plugin()
{
	load_plugin_textdomain('omega-add-paypal-tracking', false, OMG_PP_DIR . 'languages/');
}

/**
 * Load plugin and check if WooCommerce is active.
 */
add_action('plugins_loaded', 'omega_add_paypal_tracking_plugin_init');
function omega_add_paypal_tracking_plugin_init()
{

	// If WooCommerce is NOT active, if not correct version or not pretty permalinks or old PHP version
	if (!class_exists('woocommerce') || !get_option('permalink_structure') || (class_exists('woocommerce') && version_compare(wc()->version, OMG_PP_MIN_WC_VERSION, '<')) || version_compare(PHP_VERSION, '5.3.0') < 0) {

		add_action('admin_init', 'omega_add_paypal_tracking_deactivate');
		add_action('admin_notices', 'omega_add_paypal_tracking_admin_notice');
		return;
	}

	// Classes
	require_once(OMG_PP_DIR . 'includes/class-rh-easy-helper.php');

	// Endpoints
	require_once(OMG_PP_DIR . 'includes/rest-api-endpoints.php');

	// Scripts
	require_once(OMG_PP_DIR . 'includes/enqueue_scripts.php');

	// Admin
	require_once(OMG_PP_DIR . 'includes/admin/settings.php');
	require_once(OMG_PP_DIR . 'includes/admin/plugin-settings-link.php');
	require_once(OMG_PP_DIR . 'includes/admin/rating.php');
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/activation.php
 */
function activate_omega_add_paypal_tracking()
{
	require_once(OMG_PP_DIR . 'includes/activation.php');
}
register_activation_hook(__FILE__, 'activate_omega_add_paypal_tracking');

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/deactivation.php
 */
function deactivate_omega_add_paypal_tracking()
{
	require_once(OMG_PP_DIR . 'includes/deactivation.php');
}
register_deactivation_hook(__FILE__, 'deactivate_omega_add_paypal_tracking');

/**
 * Deactivate the Child Plugin
 */
function omega_add_paypal_tracking_deactivate()
{
	deactivate_plugins(OMG_PP_BASENAME);
}

/**
 * Throw an Alert to tell the Admin why it didn't activate
 */
function omega_add_paypal_tracking_admin_notice()
{

	$omega_add_paypal_tracking_plugin = esc_html(__('Omega Add PayPal Tracking', 'omega-add-paypal-tracking'));
	$woocommerce_plugin = esc_html(__('WooCommerce', 'omega-add-paypal-tracking'));

	$error = '<div class="error">';

	if (!class_exists('woocommerce')) {

		$error .= '<p>' . sprintf(__('%1$s requires %2$s version %3$s. Please activate/install %2$s before activation of %1$s. ', 'omega-add-paypal-tracking'), $omega_add_paypal_tracking_plugin, $woocommerce_plugin, OMG_PP_MIN_WC_VERSION) . '</p>';
	} elseif (version_compare(wc()->version, OMG_PP_MIN_WC_VERSION, '<')) {

		$error .= '<p>' . sprintf(__('%1$s requires %2$s version %3$s. Please upgrade %2$s at least to version %3$s before activation of %1$s. ', 'omega-add-paypal-tracking'), $omega_add_paypal_tracking_plugin, $woocommerce_plugin, OMG_PP_MIN_WC_VERSION) . '</p>';
	}

	if (!get_option('permalink_structure')) {

		$error .= '<p>' . sprintf(__('%1$s requires pretty permalinks enabled. Please enable pretty permalinks in your settings before activation of %1$s. <b>WARNING: In order to not to loose SEO of your page redirect all old URL to the new ones using your .htaccess and Redirect 301 rules.</b>', 'omega-add-paypal-tracking'), $omega_add_paypal_tracking_plugin) . '</p>';
	}

	if (version_compare(PHP_VERSION, '5.3.0') < 0) {

		$error .= '<p>' . sprintf(__('%1$s requires at least PHP 5.3. Contact your hosting provider for more support.</b>', 'omega-add-paypal-tracking'), $omega_add_paypal_tracking_plugin) . '</p>';
	}

	$error .= __('The plugin has been deactivated.', 'omega-add-paypal-tracking') . '</div>';

	echo $error;

	if (isset($_GET['activate']))
		unset($_GET['activate']);
}
