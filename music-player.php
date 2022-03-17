<?php 

/**
 * Plugin Name:       Music Player
 * Plugin URI:        https://gifted-fermat-f7e371.netlify.app/
 * Description:       Music Player Test.
 * Version:           1.0
 * Requires at least: 5.2
 * Requires PHP:      7.4
 * Author:            Vitaliy Nosov
 * Author URI:        https://www.linkedin.com/in/vitaliy-nosov-5543a8173/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       plugin-test
 * Domain Path:       /languages
 */


// Basic plugin protection:

if( !defined('ABSPATH')){
    die;
}

// An alternative to this notation, you can use any:

// defined('ABSPATH') || exit;

// Display function in the admin panel menu

function music_player_show_item(){
    add_menu_page(
        esc_html__( 'Welcome to plugin page', 'music-palyer'),
        esc_html__('Music Player', 'music-palyer'),
        'manage_options',
        'music-player-options',
        'music_player_content',
        'dashicons-media-audio',
        6
    );
}

add_action('admin_menu','music_player_show_item');


// The function of displaying the plugin page in the admin panel

function music_player_content(){
    echo '<div class="block">
        <button class="button">block button</button>
    </div>';
    
}

// Style and Script Registration Function

function plugin_register_assets(){
    wp_enqueue_style('music-player_styles', plugins_url('assets/css/plugin-style.css', __FILE__));
    wp_register_script('music-player_jquery', plugins_url('assets/js/jquery.min.js', __FILE__));
    wp_enqueue_script('music-player_scripts', plugins_url('assets/js/admin.js', __FILE__));
}

add_action('admin_enqueue_scripts','plugin_register_assets');


// Connecting styles for display on the frontend

function music_player_scripts() {
	wp_enqueue_style( 'style', plugins_url('assets/css/plugin-style.css', __FILE__));
  	wp_enqueue_script( 'jquery', plugins_url('assets/js/jquery.min.js', __FILE__), array(), true );
    wp_enqueue_script('music-player_front', plugins_url('assets/js/music-player-script.js', __FILE__), array(), true);
}

add_action( 'wp_enqueue_scripts','music_player_scripts' );

// The function of connecting styles and scripts

function music_load_assets($hook){
    if($hook != 'toplevel_page_music-player-options'){
        return;
    }
    wp_enqueue_style('music-player_styles');
    wp_enqueue_script('music-player_scripts');

    // If you need to use styles or scripts that are already built into WordPress: 
    // wp_enqueue_script('jquery-ui-tabs');
}

add_action('admin_enqueue_scripts','music_load_assets');

// We connect our shortcode:

require_once( dirname(__FILE__) . '/shortcode/music-player-front.php');