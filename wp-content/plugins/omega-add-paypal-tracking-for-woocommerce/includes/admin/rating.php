<?php

/**
 * Change the admin footer text on omega Hunter Easy admin page.
 *
 * @since  1.0.2
 * @param  string $footer_text
 * @return string
 */
function omega_add_paypal_tracking_admin_footer_text($footer_text)
{

    if (!current_user_can('manage_woocommerce')) {
        return $footer_text;
    }

    $helper = new OMG_PP_Helper();
    $current_screen = get_current_screen();

    // Check to make sure we're on a omega Hunter Easy admin page.
    if (isset($current_screen->id) && $current_screen->id === 'toplevel_page_omega-add-paypal-tracking') {
        // Change the footer text
        if (!$helper->get_option('admin_footer_text_rated')) {
            $footer_text = sprintf(
                /* translators: 1: omega Hunter Easy 2:: five stars */
                __('If you like %1$s please leave us a %2$s rating. A huge thanks in advance!', 'omega-add-paypal-tracking'),
                sprintf('<strong>%s</strong>', esc_html__('Synctrack - Add Paypal Tracking Auto', 'omega-add-paypal-tracking')),
                '<a href="https://wordpress.org/support/plugin/omega-add-paypal-tracking-for-woocommerce/reviews?rate=5#new-post" target="_blank" class="rhe-rating-link" data-rated="' . esc_attr__('Thanks :)', 'omega-add-paypal-tracking') . '">&#9733;&#9733;&#9733;&#9733;&#9733;</a>'
            );
            wc_enqueue_js(
                "jQuery( 'a.rhe-rating-link' ).click( function() {
                    jQuery.post( '" . admin_url('admin-ajax.php') . "', { action: 'omega_add_paypal_tracking_rated' } );
                    jQuery( this ).parent().text( jQuery( this ).data( 'rated' ) );
                });"
            );
        } else {
            $footer_text = __('Thank you for using omega Hunter Easy.', 'omega-add-paypal-tracking');
        }
    }

    return $footer_text;
}
// add_filter('admin_footer_text', 'omega_add_paypal_tracking_admin_footer_text', 1);

/**
 * Save the option when the plugin already rated.
 *
 * @return void
 * @since 1.0.2
 */
function omega_add_paypal_tracking_rated()
{
    if (!current_user_can('manage_woocommerce')) {
        wp_die(-1);
    }
    $helper = new OMG_PP_Helper();
    $helper->update_options(array('admin_footer_text_rated' => 1));
    wp_die();
}
add_action('wp_ajax_omega_add_paypal_tracking_rated', 'omega_add_paypal_tracking_rated');
