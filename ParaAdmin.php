<?php
/*
Plugin Name: ParaAdmin Sample
Plugin URI: http://paratheme.com
Description: ParaAdmin
Version: 1.0
Author: paratheme
Author URI: http://paratheme.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

define('paraadmin_plugin_url', WP_PLUGIN_URL . '/' . plugin_basename( dirname(__FILE__) ) . '/' );

require_once( plugin_dir_path( __FILE__ ) . 'ParaAdmin/ParaAdminClass.php');

function paraadmin_init_scripts()
	{
		wp_enqueue_script('jquery');
		
		wp_enqueue_style('font-awesome', paraadmin_plugin_url.'css/font-awesome.css');
			
		//ParaAdmin
		wp_enqueue_style('ParaAdmin', paraadmin_plugin_url.'ParaAdmin/css/ParaAdmin.css');	
		wp_enqueue_script('ParaAdmin', plugins_url( 'ParaAdmin/js/ParaAdmin.js' , __FILE__ ) , array( 'jquery' ));
		
	}
add_action("init","paraadmin_init_scripts");


add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' ); 

// Admin setting page
add_action('admin_menu', 'paraadmin_menu_init');


function paraadmin_menu_settings(){
	include('paraadmin-settings-sample.php');	
}

function paraadmin_menu_init()
	{
		
		add_menu_page(__('ParaAdmin','Paraadmin'), __('ParaAdmin','Paraadmin'), 'manage_options', 'paraadmin_menu_settings', 'paraadmin_menu_settings');
		
		
	}