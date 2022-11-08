<?php

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

if (class_exists('WC_Settings_OMG_PP_New', false)) {
    return new WC_Settings_OMG_PP_New();
}

/**
 * WC_Settings_OMG_PP_New.
 */
class WC_Settings_OMG_PP_New
{

    /**
     * Constructor.
     */
    public function __construct()
    {
        // Hook into the admin menu
        add_action('admin_menu', array($this, 'settings_page'));
    }

    public function settings_page()
    {
        // Add the menu item and page
        $page_title =  __('PayPal Tracking', 'omega-add-paypal-tracking');
        $menu_title =  __('PayPal Tracking', 'omega-add-paypal-tracking');
        $capability = 'manage_options';
        $slug = 'omega-add-paypal-tracking';
        $callback = array($this, 'settings_page_content');
        $icon =  'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABQAAAATCAMAAACnUt2HAAAABGdBTUEAALGPC/xhBQAAACBjSFJN AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAClFBMVEXP0tTQ09XO0dPJzM7N z9LMz9HMztHJzM/O0dTR1NbS1NbY29y/wsbAw8bZ3N3Mz9LKzdDDxsm/w8bBxcjKzc/W2drX2tvR 09bHys3AxMe9wcS8wMS+wcXCxsjGyczY293T1tjT1dfEx8rFyMu9wMTLztDV19rg4+PIy83GyMzM zdHQ0dXQ09bHy826vsHLztHU1tiusraqrrPP0dTO0NO7v8K8v8PIy86hpquPlJuorbHFycu9wMPD x8rFyczN0NPHyszCxcjKzNDCxsnBxMfGyMvS09bX2duorLGPlJqkqa6+wsXHys7Q0tWtsbWxtbnL zNDGyszh5OTV2NrBxMjS1dfT1tfHyczW2dvEyMq8wMPa3N3O0tTQ09TN0NK8wMOssbWip6ygpaqk qa6ssLS7v8PEyMujqK2gpaqlqa6ipqyorbLEyMu6vsKfpKm1ub2+wcW+wcS5vcCqrrOcoabEx8q7 v8O0uLy2ur6boabLztDCxcjBxci7v8OnrLHLztGrsLTIy86qrrO+wsW6vsHLztC+wsWusrfT1tjG ys2ip6ykqa6nrLGgpaqXnaKboaaaoKWrr7SrsLSan6WboKWYnaOgpaqnq7Clqq6hpqvGyczT1dev s7e9wcTJzM66vcG+wsWorbLIy86rsLTLztGorrK6vsHBxcjCxsjMz9Gcoaa2ur20uLy8v8PHys2c oaeprrK6vsHAw8a/w8bGycyprbKkqa6jqK3Ex8q7v8KrsLSkqa2gpaqhpqussbW7v8KdoqidoqeV mqCYnqOaoKWXnKGZnqScoaaZnqOWm6Geo6ian6ScoaeXnaKhpquWnKKgpaqZn6SboKacoqeYnaOW nKGan6WVm6GUmp+XnKKdo6j///+VMAPhAAAAwHRSTlMAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA AAAAAAAAAAAAAAAAADKj7fPXpzwg3/z1/sQZZvZsFQtJwv4+d3No/ixXMG7GGb4ywFFiSVaiJhP0 1M7uWGFoRjhVT0jt09H5GCmcXk1lSsc1wBfAdjJWJvpvdXY6/MZMDRUXw/bhIjyo2fLvpjWMcL9Q AAAAAWJLR0TbmQQWFAAAAAd0SU1FB+QKBgUCEumeZWgAAAGVSURBVBjTY2BgZGJmYY1PSDxwMCk5 JZWVjZ2RAQg4ONPSDx3OyMw6cvTwkewcLpAgI3fuobz8Ah7ewqLiY8dPlJRyMzEw8JWdLOcXEBQS EhZhqzhy6nRllSiDWPWZGnEJSSlpGV5ZOfnas+fO1ykw1Dc0KiopKcsJCqlIqnKqNR27cLaZoaVV XUNTS1tHV1JPRV/VoO3ihbPtDB0Ghkbi4sYmcpKmZsrmAp1dBw92M5haWFqpAUWtJU1tBG1t7Xou Xehl6OufMNFegJ3fASjo6MTCMWnylKkM0y4cn67kLMlsLmkq5eLq5u7h6eXNMOPygZmzWH0EJICC ji4Ovn7+orMZ5py9cGKuQQB/IEhQUElJNWjefIYFVy4cWxisqGobAhJUVg5dtHgJQ9jSq+fOLuML FxQGCjo7cC6/vEKMIWLlqmOnrq1mZY2M8nZVVV1zfW10DAMT97r1hy9f3LBxk5T35vy8G7ncoKCL Dd6y9drhm9fObcs4cWP7Dk4mUBgzxvGz7ty1e8/BW3v37VeNM2diZAAAccWG4VHwnREAAAAldEVY dGRhdGU6Y3JlYXRlADIwMjAtMTAtMDZUMDU6MDI6MTgrMDM6MDDOQLZpAAAAJXRFWHRkYXRlOm1v ZGlmeQAyMDIwLTEwLTA2VDA1OjAyOjE4KzAzOjAwvx0O1QAAAABJRU5ErkJggg==';
        $position = 100;

        add_menu_page($page_title, $menu_title, $capability, $slug, $callback, $icon, $position);
    }

    public function settings_page_content()
    {

        $helper = new OMG_PP_Helper();
        $applicationConfig = $helper->get_config();

        wp_enqueue_script('omega-add-paypal-tracking-admin', OMG_PP_URL . 'assets/js/admin.min.js');
        wp_enqueue_style('omega-add-paypal-tracking-admin', OMG_PP_URL . 'assets/css/admin.min.css');

?>

        <script type="application/javascript">
            let goostavApplicationConfig = JSON.parse('<?= json_encode($applicationConfig) ?>');
        </script>
        <?php
        $payload = base64_encode(json_encode($applicationConfig));
        $website_name = $applicationConfig['storeName'];
        $app_url = "https://apps.synctrack.io/add-paypal-tracking/woocommerce/get_code.php?platform=WOO_COMMERCE&woo_type=plugin&website_name=" . $website_name;
        ?>
        <div class="omega-add-tracking-paypal">
            <iframe src="<?php echo $app_url ?>&payload=<?php echo $payload ?>" title="Omega PayPal Tracking for Woo"></iframe>
        </div>

<?php
    }
}

return new WC_Settings_OMG_PP_New();
