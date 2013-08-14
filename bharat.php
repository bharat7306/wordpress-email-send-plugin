<?php
/*
Plugin Name: Email Send Plugin
Plugin URI: http://bharat1990.wordpress.com/category/wordpress-plugin/
Description: A simple plugin of the Wordpress.
Version: 1.0
Author: JivaniBhai
Author URI: http://bharat1990.wordpress.com
License: A "Slug" license name e.g. GPL2
*/
session_start();
function loadre_quire_file()
{
	require_once( plugin_dir_path( __FILE__ ) . 'function.php');
}
add_action( 'plugins_loaded','loadre_quire_file');

function my_custom_jsadd() 
{
	wp_register_script( 'bharatscriptmin', plugins_url('jquery.min.js', __FILE__ ));
	wp_enqueue_script( 'bharatscriptmin' );
	wp_register_script( 'bharatscript', plugins_url('bharat_scripts.js', __FILE__ ));
	wp_enqueue_script( 'bharatscript' );
}
add_action('admin_head', 'my_custom_jsadd');

function on_deactivation()
{ }
register_deactivation_hook( __FILE__, 'on_deactivation');

function on_activation()
{
	global $wpdb;
	$table_name21 = $wpdb->prefix . "bharat_plug_inquery"; 
    $_SESSION['tablenameset']= $table_name21;
	$sql = "CREATE TABLE ".$table_name21." (
          id bigint(20) unsigned NOT NULL auto_increment,
          fieldname varchar(50) NOT NULL default 'fieldname',
		  tablename varchar(50) NOT NULL default 'tablename',
		  wherefield varchar(50) NOT NULL default 'wherefieldname=0',
          PRIMARY KEY  (id)
          )ENGINE=MYISAM";		  
require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
dbDelta($sql);
$wpdb->query("insert into ".$table_name21." values();");
}
register_activation_hook( __FILE__, 'on_activation');

function on_uninstall()
{ 
	$table_name21 = $wpdb->prefix . "bharat_plug_inquery"; 
	$dropquery = " DROP TABLE ` ".$table_name21." ` ";
    //require_once(ABSPATH . 'wp-admin/upgrade-functions.php');
	//dbDelta($dropquery);
	global $wpdb;
	$wpdb->query($dropquery);
	require_once(ABSPATH .'wp-admin/includes/upgrade.php');
	dbDelta($dropquery);
}
register_uninstall_hook( __FILE__, 'on_uninstall');

function my_menu_pages()
{
    add_menu_page('My Page Title', 'Send Email', 'manage_options', 'bharat_email_list', 'bharat_email_list' );
	add_submenu_page('bharat_email_list', 'Submenu Page Title2', 'Setting', 0,'setting', 'setting' );

	//add_links_page('My Plugin Links', '', 'read', 'my-unique-identifier', 'my_plugin_function');
	//add_plugins_page('My Plugin Page', '', 'read', 'my-unique-identifier', 'my_plugin_function');
	//add_menu_page("My Menu", "My Menu", 0, "my-menu-slug", "myMenuPageFunction");
    //add_submenu_page("my-menu-slug", "My Submenu", "My Submenu", 0, "my-submenu-slug", "mySubmenuPageFunction");

}
add_action('admin_menu', 'my_menu_pages');




