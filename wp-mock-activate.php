<?php
define('WPINC', true);
function register_activation_hook($file, $function)
{
    echo "Registering activation $function\n";
    call_user_func($function);
}
function register_deactivation_hook($file, $function)
{
}
function plugin_dir_path($f)
{
    return dirname($f) . '/';
}
function plugin_dir_url()
{
    return 'http://localhost/';
}
function is_admin()
{
    return true;
}
function add_action($tag, $function_to_add, $priority = 10, $accepted_args = 1)
{
}
function add_filter()
{
}
function load_plugin_textdomain()
{
}

// WP wraps plugin inclusion in ob_start to catch output
ob_start();
require 'spintax.php';
$output = ob_get_clean();

if (strlen(trim($output)) > 0) {
    echo "FATAL ERROR: Unexpected output: '$output'\n";
    exit(1);
}
echo "SUCCESS!\n";
