<?php

add_action('wp_ajax_nopriv_omega_add_paypal_tracking_ajax_add_to_cart', 'omega_add_paypal_tracking_ajax_add_to_cart');
add_action('wp_ajax_omega_add_paypal_tracking_ajax_add_to_cart', 'omega_add_paypal_tracking_ajax_add_to_cart');

function omega_add_paypal_tracking_ajax_add_to_cart()
{

    // Security nonce check
    check_ajax_referer('rhe_ajax_nonce', 'nonce');

    if (isset($_REQUEST)) {

        $return = array();



        wp_send_json($return);
    }
    die();
};