<?php

/**
 * Woo Fiscalità Italiana
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Mte90 <mte90net@gmail.com>
 * @copyright 2016-2017
 * @license   GPL-2.0+
 * @since     1.2.0
 */

/**
 * Provide Import and Export of the settings of the plugin
 */
class WFI_ImpExp {

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Add the export settings method
		add_action( 'admin_init', array( $this, 'settings_export' ) );
		// Add the import settings method
		add_action( 'admin_init', array( $this, 'settings_import' ) );
	}

	/**
	 * Process a settings export from config
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings_export() {

		if ( empty( $_POST[ 'wfi_action' ] ) || 'export_settings' !== $_POST[ 'wfi_action' ] ) {
			return;
		}

		if ( !wp_verify_nonce( $_POST[ 'wfi_export_nonce' ], 'wfi_export_nonce' ) ) {
			return;
		}

		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}
		$settings[ 0 ] = get_wfi_info();
		$settings[ 1 ] = get_wfi_settings();
		$settings[ 2 ] = get_option( WFI_TEXTDOMAIN . '-tax-settings' );

		ignore_user_abort( true );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=wfi-settings-export-' . date( 'm-d-Y' ) . '.json' );
		header( 'Expires: 0' );
		if ( version_compare( PHP_VERSION, '5.4.0', '>=' ) ) {
			echo wp_json_encode( $settings, JSON_PRETTY_PRINT );
		} else {
			echo wp_json_encode( $settings );
		}
		exit;
	}

	/**
	 * Process a settings import from a json file
	 *
	 * @since 1.0.0
	 *
	 * @return void
	 */
	public function settings_import() {

		if ( empty( $_POST[ 'wfi_action' ] ) || 'import_settings' !== $_POST[ 'wfi_action' ] ) {
			return;
		}

		if ( !wp_verify_nonce( $_POST[ 'wfi_import_nonce' ], 'wfi_import_nonce' ) ) {
			return;
		}

		if ( !current_user_can( 'manage_options' ) ) {
			return;
		}
		$extension = end( explode( '.', $_FILES[ 'import_file' ][ 'name' ] ) );

		if ( $extension !== 'json' ) {
			wp_die( __( 'Please upload a valid .json file', WFI_TEXTDOMAIN ) );
		}

		$import_file = $_FILES[ 'import_file' ][ 'tmp_name' ];

		if ( empty( $import_file ) ) {
			wp_die( __( 'Please upload a file to import', WFI_TEXTDOMAIN ) );
		}

		// Retrieve the settings from the file and convert the json object to an array.
		$settings = (array) json_decode( file_get_contents( $import_file ) );

		update_option( WFI_TEXTDOMAIN . '', get_object_vars( $settings[ 0 ] ) );
		update_option( WFI_TEXTDOMAIN . '-settings', get_object_vars( $settings[ 1 ] ) );
		update_option( WFI_TEXTDOMAIN . '-tax-settings', get_object_vars( $settings[ 2 ] ) );

		wp_safe_redirect( admin_url( 'options-general.php?page=' . WFI_TEXTDOMAIN ) );
		exit;
	}

}

new WFI_ImpExp();
