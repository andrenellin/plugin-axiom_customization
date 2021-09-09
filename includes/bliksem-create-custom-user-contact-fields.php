<?php

function bs_add_user_custom_fields($methods, $user)
{

    // Add user contact methods
    $methods['bs_user_organization'] = __('Organization');
    $methods['bs_user_address'] = __('Address');
    $methods['bs_user_phone'] = __('Phone');
    $methods['bs_user_logo_url'] = __('Logo');

    // Remove user contact methods
    unset($methods['aim']);
    unset($methods['jabber']);
    unset($methods['yahoo']);

    return $methods;
}

add_filter('user_contactmethods', 'bs_add_user_custom_fields', 10, 2);