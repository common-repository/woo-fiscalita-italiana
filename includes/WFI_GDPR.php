<?php

/**
 * WooCommerce Fiscalitá Italiana
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Codeat <support@codeat.co>
 * @copyright 2016
 * @license   GPL-2.0+
 * @link      http://codeat.co
 */

/**
 * GDPR support
 */
class WFI_GDPR {

	/**
	 * Initialize the class
	 */
	public function __construct() {
        // Export Order & Customer data
        add_filter( 'woocommerce_privacy_export_customer_personal_data', array( $this, 'export_customer_data' ), 9999, 2 );
        add_filter( 'woocommerce_privacy_export_order_personal_data', array( $this, 'export_order_data' ), 9999, 2 );
        // Remove Order & Customer data
        add_action( 'woocommerce_privacy_remove_order_personal_data', array( $this, 'erase_order_data' ), 9999 );
        add_action( 'woocommerce_privacy_erase_personal_data_customer', array( $this, 'erase_customer_data' ), 9999, 2 );
    }

    /**
     * Export order data.
     *
     * @param array  $personal_data Data.
     * @param object $order         Order object.
     *
     * @return array
     */
    public function export_order_data( $personal_data, $order ) {
        $personal_data[] = array(
            'name'  => __( 'VAT', WFI_TEXTDOMAIN ),
            'value' => get_post_meta( $order->get_id(), 'piva', true ),
        );
        $personal_data[] = array(
            'name'  => __( 'SSN', WFI_TEXTDOMAIN ),
            'value' => get_post_meta( $order->get_id(), 'cf', true ),
        );
        $personal_data[] = array(
            'name'  => __( 'Are you a company?', WFI_TEXTDOMAIN ),
            'value' => get_post_meta( $order->get_id(), 'pvtazd', true ),
        );
        $personal_data[] = array(
            'name'  => __( 'Do you need an invoice?', WFI_TEXTDOMAIN ),
            'value' => get_post_meta( $order->get_id(), 'ask_invoice', true ),
        );

        return $personal_data;
    }

    /**
     * Export customer data.
     *
     * @param array  $personal_data Data.
     * @param object $customer      Order object.
     *
     * @return array
     */
    public function export_customer_data( $personal_data, $customer ) {
        $personal_data[] = array(
            'name'  => __( 'VAT', WFI_TEXTDOMAIN ),
            'value' => get_user_meta( $customer->get_id(), 'piva', true ),
        );
        $personal_data[] = array(
            'name'  => __( 'SSN', WFI_TEXTDOMAIN ),
            'value' => get_user_meta( $customer->get_id(), 'cf', true ),
        );

        return $personal_data;
    }

    /**
     * Erase customer data.
     *
     * @param array  $response Data.
     * @param object $customer Customer object.
     *
     * @return void
     */
    public function erase_customer_data( $response, $customer ) {
        update_user_meta( $customer->get_id(), 'piva', '' );
        update_user_meta( $customer->get_id(), 'cf', '' );

        return $response;
    }

    /**
     * Erase order data.
     *
     * @param object $order Order object.
     *
     * @return void
     */
    public function erase_order_data( $order ) {
        $order->update_meta_data( 'piva', __( '[erased]', WFI_TEXTDOMAIN ) );
        $order->update_meta_data( 'cf', __( '[erased]', WFI_TEXTDOMAIN ) );
        $order->update_meta_data( 'pvtazd', __( '[erased]', WFI_TEXTDOMAIN ) );
        $order->update_meta_data( 'ask_invoice', __( '[erased]', WFI_TEXTDOMAIN ) );
        $order->save();
    }

}

new WFI_GDPR();

