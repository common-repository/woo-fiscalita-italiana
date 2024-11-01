<?php

/**
 * WFI plugin
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Codeat <support@codeat.co>
 * @copyright 2016
 * @license   GPL-2.0+
 * @link      http://codeat.co
 */
/*
 * Plugin Name:       Italian VAT Kit for WooCommerce
 * Plugin URI:        https://wordpress.org/plugins/woo-fiscalita-italiana/
 * Description:       Easy Italian Fiscality for WooCommerce: checkout fields, invoices, digital goods and everything you need for a store based in Italy
 * Version:           1.3.34
 * Author:            Codeat
 * Author URI:        http://codeat.co
 * Text Domain:       woo-fiscalita-italiana
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * WC requires at least: 5.0
 * WC tested up to: 7.0.0
 * WordPress-Plugin-Boilerplate-Powered: v2.0.0
 *
 */
// If this file is called directly, abort.
if ( !defined( 'WPINC' ) ) {
    die;
}

if ( !function_exists( 'wfi_fs' ) ) {
    if ( !function_exists( 'woo_is_plugin_active' ) ) {
        /**
         * Check if WooCommerce is active
         *
         * @return boolean
         */
        function woo_is_plugin_active()
        {
            return in_array( 'woocommerce/woocommerce.php', (array) get_option( 'active_plugins', array() ), true ) || function_exists( 'is_plugin_active_for_network' ) && is_plugin_active_for_network( 'woocommerce/woocommerce.php' ) || array_key_exists( 'woocommerce/woocommerce.php', ( is_array( get_site_option( 'active_sitewide_plugins', array() ) ) ? get_site_option( 'active_sitewide_plugins', array() ) : array() ) );
        }
    
    }
    
    if ( woo_is_plugin_active() ) {
        define( 'WFI_VERSION', '1.3.34' );
        define( 'WFI_TEXTDOMAIN', 'woo-fiscalita-italiana' );
        /**
         * Create a helper function for easy SDK access.
         *
         * @global object $wfi_fs
         * @return object
         */
        function wfi_fs()
        {
            global  $wfi_fs ;
            
            if ( !isset( $wfi_fs ) ) {
                require_once dirname( __FILE__ ) . '/includes/freemius/start.php';
                $wfi_fs = fs_dynamic_init( array(
                    'id'             => '323',
                    'slug'           => 'woo-fiscalita-italiana',
                    'public_key'     => 'pk_b8c01da60ee2cb8916918a0fd7160',
                    'is_premium'     => false,
                    'has_addons'     => true,
                    'has_paid_plans' => true,
                    'menu'           => array(
                    'slug'   => 'woo-fiscalita-italiana',
                    'parent' => array(
                    'slug' => 'woocommerce',
                ),
                ),
                    'is_live'        => true,
                ) );
                function wfi_eur()
                {
                    return 'eur';
                }
                
                $wfi_fs->add_filter( 'default_currency', 'wfi_eur' );
            }
            
            return $wfi_fs;
        }
        
        // Init Freemius.
        wfi_fs();
        require_once plugin_dir_path( __FILE__ ) . 'includes/functions.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/shortcode.php';
        require_once plugin_dir_path( __FILE__ ) . 'includes/WFI_GDPR.php';
        require_once plugin_dir_path( __FILE__ ) . 'public/class-woo-fiscalita-italiana.php';
        require_once plugin_dir_path( __FILE__ ) . 'public/includes/WFI_ActDeact.php';
        /*
         * Register hooks that are fired when the plugin is activated or deactivated.
         * When the plugin is deleted, the uninstall.php file is loaded.
         */
        register_activation_hook( __FILE__, array( 'WFI_ActDeact', 'activate' ) );
        register_deactivation_hook( __FILE__, array( 'WFI_ActDeact', 'deactivate' ) );
        add_action( 'plugins_loaded', array( 'Woo_Fiscalita_Italiana', 'get_instance' ), 9999 );
        /*
         * -----------------------------------------------------------------------------
         * Dashboard and Administrative Functionality
         * -----------------------------------------------------------------------------
         */
        
        if ( is_admin() ) {
            require_once plugin_dir_path( __FILE__ ) . 'admin/class-woo-fiscalita-italiana-admin.php';
            add_action( 'plugins_loaded', array( 'Woo_Fiscalita_Italiana_Admin', 'get_instance' ) );
        }
        
        /**
         * Clean the system at uninstall of WFI
         *
         * @global object $wpdb
         * @return void
         */
        function wfi_fs_uninstall()
        {
            global  $wpdb ;
            
            if ( is_multisite() ) {
                $blogs = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );
                if ( $blogs ) {
                    foreach ( $blogs as $blog ) {
                        switch_to_blog( $blog['blog_id'] );
                        delete_option( 'woo-fiscalita-italiana' );
                        delete_option( 'woo-fiscalita-italiana-settings' );
                        restore_current_blog();
                    }
                }
            }
            
            delete_option( 'woo-fiscalita-italiana' );
            delete_option( 'woo-fiscalita-italiana-settings' );
        }
        
        wfi_fs()->add_action( 'after_uninstall', 'wfi_fs_uninstall' );
    }

}
