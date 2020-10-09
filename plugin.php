<?php

/**
 * @package force_login_wordpress_plugin
 * @version 1.0
 **/

/**
Plugin Name: Force Login
Plugin URI: https://sdardour.com/lab/2020/force-login-wordpress-plugin/
Description: Use the Force Login Plugin to keep your WordPress website private. The Plugin will force visitors to log in. Only registered users with administrative priveledges will have access to the website’s content.
Author: lab@sdardour.com
Version: 1.0
Author URI: https://sdardour.com/lab
 **/

/* --- */

if (!function_exists("add_action")) {
    exit;
}

/* --- */

function SDARDOURCOM_FORCE_LOGIN_TEMPLATE_REDIRECT()
{
    $login_screen = true;
    $current_user = wp_get_current_user();
    if ($current_user->ID > 0) {
        if (in_array("administrator", $current_user->roles)) {
            $login_screen = false;
        }
    }
    if ($login_screen) {
        header("location: " . site_url() . "/wp-login.php");
        exit();
    }
}

add_action("template_redirect", "SDARDOURCOM_FORCE_LOGIN_TEMPLATE_REDIRECT");

/* --- */

function SDARDOURCOM_FORCE_LOGIN_LOGIN_REDIRECT()
{
    return site_url();
}

add_filter("login_redirect", "SDARDOURCOM_FORCE_LOGIN_LOGIN_REDIRECT");

/* --- */
