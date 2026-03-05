<?php
define('WPINC', true);
function register_activation_hook()
{
    echo "activation_hook\n";
}
function register_deactivation_hook()
{
    echo "deactivation_hook\n";
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
    echo "add_action $tag\n";
}
function add_filter()
{
}
function load_plugin_textdomain()
{
}
require 'spintax.php';
echo "SUCCESS\n";
