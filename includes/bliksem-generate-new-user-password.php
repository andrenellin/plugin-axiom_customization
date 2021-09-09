<?php
// Generate a random password when adding a new user using form 10, Add a new user

function bliksem_generate_password_for_new_user()
{

    //only populating drop down for form id 10
    if ($form['id'] != 10) {
        return $form;
    }

    // Generate a random password

    $bliksem_password = bs_get_random_password();

    // Add the password to the hidden password field 7.
    $_POST['input_7'] = $bliksem_password;
    $_POST['input_8'] = $bliksem_password;

}

add_filter('gform_pre_render_10', 'bliksem_generate_password_for_new_user');

function bs_get_random_password()
{
    $digits = range('0', '9');
    $lowercase = range('a', 'z');
    $uppercase = range('A', 'Z');
    $special = str_split('!@#$%^&*+=-_?.,:;<>(){}[]/|~`\'"');
    shuffle($digits);
    shuffle($special);
    shuffle($lowercase);
    shuffle($uppercase);
    $array_special = array_rand($special);
    $array_digits = array_rand($digits, 3);
    $array_lowercase = array_rand($lowercase, 3);
    $array_uppercase = array_rand($uppercase, 3);
    $password = str_shuffle(
        $special[$array_special] .
        $digits[$array_digits[0]] .
        $digits[$array_digits[1]] .
        $digits[$array_digits[2]] .
        $lowercase[$array_lowercase[0]] .
        $lowercase[$array_lowercase[1]] .
        $lowercase[$array_lowercase[2]] .
        $uppercase[$array_uppercase[0]] .
        $uppercase[$array_uppercase[1]] .
        $uppercase[$array_uppercase[2]]
    );
    if (strlen($password) > 10) {
        $password = substr($password, 0, 10);
    }
    return $password;
}