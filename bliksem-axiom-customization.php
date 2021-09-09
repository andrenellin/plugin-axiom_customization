<?php
/*
Plugin Name: Bliksem Customization
Description: Add custom fucntionality
Version: 1.0
Author: Bliksem LLC
 */

/**
 * Plugin Name: BLIKSEM Add Organization to User Meta
 * Description: Updates coaching hours on purchase or consumption of coaching hours
 * Version: 1.0
 * Author: Andre Nell
 */
/* Exit if accessed directly */
if (!function_exists('add_action')) {
    echo "Hi there! I'm just a plugin, not much I can do when called directly";
    exit;
}

/*
 * Define constants
 *
 *  */
define('BS_VERSION', '1.0.1');
define('BS_PLUGIN_URL', plugin_dir_url(__FILE__));
define('BS_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('BS_PLUGIN_BASE_NAME', plugin_basename(__FILE__));
define('BS_PLUGIN_FILE', basename(__FILE__));
define('BS_PLUGIN_FULL_PATH', __FILE__);

/*
 * Include files
 *
 *  */
require_once BS_PLUGIN_DIR . 'includes/bliksem-create-custom-user-contact-fields.php';
require_once BS_PLUGIN_DIR . 'includes/bliksem-generate-new-user-password.php';


function bs_update_partner_contact_information($entry, $form)
{
    $bs_user_email = rgar($entry, '1');
    $bs_user_organization = rgar($entry, '8');
    $bs_user_address_street_1 = rgar($entry, '7.1');
    $bs_user_address_street_2 = rgar($entry, '7.2');
    $bs_user_address_city = rgar($entry, '7.3');
    $bs_user_address_state = rgar($entry, '7.4');
    $bs_user_address_zip = rgar($entry, '7.5');
    $bs_user_address_country = rgar($entry, '7.6');
    $bs_user_phone = rgar($entry, '8');
    $bs_user_log_url = rgar($entry, '9');

    echo '<pre>';
    echo 'Email:<br>';
    print_r($bs_user_email);
    echo '<br>';
    echo 'Organization:<br>';
    print_r($bs_user_organization);
    echo '<br>';
    echo 'Address:<br>';
    print_r($bs_user_address_street_1);
    echo '<br>';
    print_r($bs_user_address_street_2);
    echo '<br>';
    print_r($bs_user_address_city);
    echo '<br>';
    print_r($bs_user_address_state);
    echo '<br>';
    print_r($bs_user_address_zip);
    echo '<br>';
    print_r($bs_user_address_country);
    echo '<br>';
    echo 'Address Inline:<br>';
    if ($bs_user_address_street_2 == '') {
        $bs_user_address_inline = $bs_user_address_street_1 . ', ' . $bs_user_address_city . ', ' . $bs_user_address_state . ', ' . $bs_user_address_zip . ', ' . $bs_user_address_country;
    } else {
        $bs_user_address_inline = $bs_user_address_street_1 . ' ' . $bs_user_address_street_2 . ', ' . $bs_user_address_city . ', ' . $bs_user_address_state . ', ' . $bs_user_address_zip . ', ' . $bs_user_address_country;
    }
    print_r($bs_user_address_inline);
    echo '<br>';
    echo 'Phone:<br>';
    print_r($bs_user_phone);
    echo '<br>';
    echo 'Logo URL:<br>';
    print_r($bs_user_log_url);
    echo '<br>';
    echo '</pre>';

    $user = get_user_by('email', $bs_user_email);
    $user_id = $user->ID;

    update_user_meta($user_id, 'bs_user_organization', (string) $bs_user_organization);
    update_user_meta($user_id, 'bs_user_address', (string) $bs_user_address_inline);
    update_user_meta($user_id, 'bs_user_phone', (string) $bs_user_phone);
    update_user_meta($user_id, 'bs_user_logo_url', (string) $bs_user_logo_url);

}

add_action('gform_after_submission_28', 'bs_update_partner_contact_information', 10, 2);