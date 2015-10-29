<?php
/*
Plugin Name: Gandi Hosting Manager
Plugin URI: https://github.com/Nekrofage/GandiHostingManager
Description: Gandi Hosting Manager
Version: 0.1
Author: Le Sanglier des Ardennes
Author URI: http://nekrocite.info/
License: GPL2 license
*/

/*
Copyright 2015  Le Sanglier des Ardennes  (email : lesanglierdesardennes@gmail.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
/*
Initialize/install or uninstall
*/

/* 
Runs when plugin is activated 
*/
register_activation_hook(__FILE__,'gandihosting_install'); 

/* 
Runs on plugin deactivation
*/
register_deactivation_hook( __FILE__, 'gandihosting_remove' );

/* 
The gandihosting_data field is created in wp_options table
Creates new database field 
*/
function gandihosting_install() {
    $default_option = array(
                    "'version'" => '0.1',
                    "'introduction'" => 'Gandi Hosting'
                    );
    add_option("gandihosting_data", $default_option, "", "yes");

    /* Ceate new table */
    require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );

    global $wpdb;
    $db_table_name = $wpdb->prefix . 'gandihosting';

    if( $wpdb->get_var( "SHOW TABLES LIKE '$db_table_name'" ) != $db_table_name ) {
        if ( ! empty( $wpdb->charset ) )
            $charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";
        if ( ! empty( $wpdb->collate ) )
            $charset_collate .= " COLLATE $wpdb->collate";
 
        $sql = "
                CREATE TABLE " . $db_table_name . " (
                    id int(11) NOT NULL AUTO_INCREMENT,
                    instance varchar(255) DEFAULT NULL, 
                    description varchar(255) DEFAULT NULL,
                    PRIMARY KEY (`id`)
                ) $charset_collate;
            ";
        dbDelta( $sql );
    }

    gandihosting_insert_data();

}

function gandihosting_insert_data() {
    global $wpdb;

    $wpdb->insert( 
        'wp_gandihosting', 
        array( 'id' => 1, 'instance' => 'test', 'description' => 'test'), 
        array( '%d', '%s', '%s', ) 
    );

}

/* Deletes the database field */
function gandihosting_remove() {
    delete_option('gandihosting_data');
    
    /* Delete table */
    global $wpdb;
    $thetable = $wpdb->prefix."gandihosting";
    $wpdb->query("DROP TABLE IF EXISTS $thetable");
}

/*
Display administration page
*/
if ( is_admin() ) {

    function gandihosting_menu() {
        add_options_page('Gandi Hosting Manager', 'Gandi Hosting Manager', 'administrator', basename(__FILE__), 'gandihosting_option');

        add_menu_page('Gandi Hosting Manager', 'Gandi Hosting Manager', 'manage_options', 'indexSimpleHosting', 'indexSimpleHosting');
        
        add_submenu_page('gandihosting_list', 'Add New Hosting', 'Add New', 'manage_options', 'createSimpleHosting', 'createSimpleHosting'); 
        
        //this submenu is HIDDEN, however, we need to add it anyways
        add_submenu_page(null, 'Update Simple Hosting', 'Update', 'manage_options', 'updateSimpleHosting', 'updateSimpleHosting');
        add_submenu_page(null, 'Config Simple Hosting', 'Update', 'manage_options', 'configSimpleHosting', 'configSimpleHosting');
        add_submenu_page(null, 'List Simple Hosting', 'Update', 'manage_options', 'listSimpleHosting', 'listSimpleHosting');



    }

    add_action('admin_menu','gandihosting_menu');

    function gandihosting_option() {
        include('admin/gandihosting_option.php');
    } 
}

/*
Add stylesheet and javascript in header
*/
function addHeader() {
   print '<link media="screen" type="text/css" href="/wp-content/plugins/gandihosting/css/style.css" rel="stylesheet">';
   print '<script type="text/javascript" src="/wp-content/plugins/gandihosting/js/main.js"></script>';
}
add_action('wp_head', 'addHeader');


/*
Get question from db by id
*/

function getGandiHostingById($id) {
    global $wpdb;

    $table_name = $wpdb->prefix . 'gandihosting';

    $row = $wpdb->get_row( $wpdb->prepare('SELECT * FROM '.$table_name.' WHERE id = %d', $id) );

    return $row;
}

/*
Shortcut : [gandihostingintro_shortcode]
*/
function displayGandiHostingManagerIntroShortCode() {
    $gandihosting_data = get_option('gandihosting_data');
    $version = $gandihosting_data["'version'"];
    $introduction = $gandihosting_data["'introduction'"];

    $default_gandihosting = "
        Le concours :  <br/>
        Version : <span class='gandihosting_title'> $version  </span> <br/>
        Introduction  : <span class='gandihosting_title'> $introduction  </span> <br/>
        <br/>
        Bonne chance !! <br/>
    ";
    return apply_filters('gandihosting', $default_gandihosting);
}
add_shortcode( 'gandihostingintro_shortcode', 'displayGandiHostingManagerIntroShortCode' );

/*
Shortcut : [gandihostingquestion_shortcode id="<question id>"]
*/
function displayGandiHostingManagerShortCode($id) {
    extract(shortcode_atts(array(
        'id' => 'id'
    ), $id));
    $gandihosting =  getGandiHostingById($id);
    $gandihosting = $gandihosting->instance;
    $default_gandihosting = "
        $gandihosting
    ";
    return apply_filters('gandihosting', $default_gandihosting);
}
add_shortcode( 'gandihosting_shortcode', 'displayGandiHostingManagerShortCode' );


/*
 Display a notice on top of the dashboard
*/
function displayAdminNotice(){
    echo "
    <p>
    Admin alert in dashboard
    </p>";
}
//add_action('admin_notices', 'displayAdminNotice');

/*
Display a text after a post in view post
*/
function displayTextAfterPost($content) {

 if ( is_single() ) {
    $content .= "
        <br/>
        <span class='gandihosting_title'> " . get_option('gandihosting_data'). " </span>
        ";
 }

  return $content;
}
//add_filter('the_content', 'displayTextAfterPost');

// Add settings link on plugin page
function gandihosting_settings_link($links) { 
  $settings_link = '<a href="options-general.php?page=gandihosting.php">Paramétres</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
 
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'gandihosting_settings_link' );


define('ROOTDIR', plugin_dir_path(__FILE__));
require_once(ROOTDIR . 'product/hosting/paas/simplehosting/indexSimpleHosting.php');
require_once(ROOTDIR . 'product/hosting/paas/simplehosting/configSimpleHosting.php');
require_once(ROOTDIR . 'product/hosting/paas/simplehosting/listSimpleHosting.php');
require_once(ROOTDIR . 'product/hosting/paas/simplehosting/createSimpleHosting.php');
require_once(ROOTDIR . 'product/hosting/paas/simplehosting/updateSimpleHosting.php');

?>
