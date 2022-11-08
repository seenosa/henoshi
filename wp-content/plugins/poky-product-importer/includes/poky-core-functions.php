<?php
/**
 * Poky Core Functions
 *
 * General core functions available on both the front-end and admin.
 *
 * @author      Poky
 * @category    Core
 * @package     Poky/Functions
 * @version     0.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function poky_maybe_define_constant( $name, $value ) {
    if ( ! defined( $name ) ) {
        define( $name, $value );
    }
}

add_action('admin_menu', 'poky_dashboard');
function poky_dashboard() {
    global $submenu;

    if (get_option( 'poky_token') != "") {
        $poky_token =  get_option( 'poky_token');
        $pokyDashboardUrl = POKY_APP_URL."?key=".$poky_token;
        $submenu['woocommerce'][] = array(
            '<div id="pokyDashboard">POKY</div>', 'manage_options', $pokyDashboardUrl);
    }
}

add_action( 'admin_footer', 'poky_dashboard_blank' );
function poky_dashboard_blank()
{
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#pokyDashboard').parent().attr('target','_blank');

        });
    </script>
    <?php
}

add_action( 'rest_api_init', function ( $server ) {
    $server->register_route( 'poky', '/poky', array(
        'methods'  => 'GET',
        'callback' => function () {
            return '813';
        },
    ) );
} );


add_action( 'wp_ajax_poky_create_product', 'poky_create_product' );
add_action( 'wp_ajax_nopriv_poky_create_product', 'poky_create_product' );

function poky_create_product() {
    global $PokyImport;

    $product=json_decode(stripslashes($_POST['product']), true);
    $resp=$PokyImport->insert_product( $product );

    $permalink='';

    if ($resp)
        $permalink=get_permalink($resp);
    echo $permalink;
    /*echo $resp;*/
    exit();
}