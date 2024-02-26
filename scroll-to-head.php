<?php

/**
 * Plugin Name:         Scroll To Head
 * Plugin URI:          https://wordpress.org/plugins/scroll-to-head/ 
 * Description:         Page scroll to head is a fully featured plugin which replaces browser’s “jumping” behavior with a smooth scrolling animation
 * Version:             1.0.0
 * Requires at least:   5.2
 * Requires PHP:        7.2
 * Author:              Rasel Miah
 * Author URI:          https://circularjobsbd.com
 * Licence URI:         https://gnu.org/licenses/gpl-2.0.html
 * Update URI:          https://github.com/raselsiu
 * Text Domain:         stoh
 * 
 */ 




//  including css

    function stoh_enqueue_style(){
        wp_enqueue_style('stoh-plugin-style',plugins_url('css/stoh-style.css',__FILE__));
    }

    add_action('wp_enqueue_scripts','stoh_enqueue_style');





    function stoh_enqueue_scripts(){

        wp_enqueue_script( 'jquery');   
        wp_enqueue_script('stoh-plugin-scripts',plugins_url('js/stoh-plugin.js',__FILE__),array(),'1.0.0',true);
    }

    add_action('wp_enqueue_scripts','stoh_enqueue_scripts');


    function jquery_activate_scroll_to_head(){
        ?>
        <script>
            jQuery(document).ready(function () {
             jQuery.scrollUp();
            });
        </script>
        <?php
    }

    
    add_action('wp_footer','jquery_activate_scroll_to_head');


// Plugin Customization Settings

add_action('customize_register','stoh_scrl_to_top');

function stoh_scrl_to_top($wp_customize){
    $wp_customize->add_section('stoh_scrl_to_top_section',array(
        'title' => __('Scroll To Top','rasel_miah'),
        'description' => 'Simple scroll to top plugin',
    ));

    $wp_customize->add_setting('stoh_default_clr',array(
        'default' => '#000000',
    ));

    $wp_customize->add_control('stoh_default_clr',array(
        'label' => 'Background Color',
        'section' => 'stoh_scrl_to_top_section',
        'type' => 'Color',
    ));


    $wp_customize->add_setting('stoh_border_radius_clr',array(
        'default' => '5px',
    ));

    $wp_customize->add_control('stoh_border_radius_clr',array(
        'label' => 'Rounded Corner',
        'section' => 'stoh_scrl_to_top_section',
        'type' => 'text',
    ));

}

// Scroll to head Theme color

    function stoh_theme_color(){
        ?>
        <style>
        #scrollUp {
            background-color: <?php print get_theme_mod("stoh_default_clr") ?>;
            border-radius: <?php print get_theme_mod("stoh_border_radius_clr") ?>;
        }
        </style>
        <?php
    }

    add_action("wp_head","stoh_theme_color");



?>