<?php

/**
 * WooCommerce Fiscalitá Italiana
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Codeat <support@codeat.co>
 * @copyright 2016 GPL 2.0+
 * @license   GPL-2.0+
 * @link      http://codeat.it
 */

/**
 * Order export
 */
class WFI_Order_Export {

	/**
	 * Initialize the class
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		// Order Export system
		add_action( 'add_meta_boxes', array( $this, 'export_order_box' ) );
		add_action( 'current_screen', array( $this, 'export_order_action' ) );
	}

	/**
	 * Add the metabox for export the order
	 *
	 * @param integer $post_id Post ID.
	 *
	 * @return void
	 */
	public function export_order_box( $post_id ) {
		add_meta_box(
				'woo-fiscalita-italiana-export', __( 'Export the order as CSV', WFI_TEXTDOMAIN ), array( $this, 'button_export_order_csv' ), 'shop_order', 'side', 'high'
		);
	}

	/**
	 * Export button
	 *
	 * @param object $post Post object.
	 *
	 * @return void
	 */
	public function button_export_order_csv( $post ) {
		echo '<a href="' . add_query_arg( 'export_order', true ) . '" class="button button-primary">' . __( 'Export!', WFI_TEXTDOMAIN ) . '</a>';
	}

	/**
	 * Get the csv content of an order
	 *
	 * @param integer $order_id ID Order.
	 *
	 * @return string
	 */
	public static function generate_order( $order_id = '' ) {
		$order = new WC_Order( $order_id );
		$user_values = wfi_get_order_fields( $order );
		$order_meta = get_post_meta( $order_id );
		$custom_order_number = self::get_real_number( $order_id );
		$text = '';

		$csv[] = array( __( 'Order ID', WFI_TEXTDOMAIN ), $custom_order_number );
		$csv[] = array( __( 'WooCommerce Order ID', WFI_TEXTDOMAIN ), $order_id );
		$csv[] = array( __( 'Order Date', WFI_TEXTDOMAIN ), $user_values[ 'order_date' ] );
		$csv[] = array( __( 'Completed Date', WFI_TEXTDOMAIN ), $user_values[ 'order_completed_date' ] );
		$csv[] = array( __( 'Paid Date', WFI_TEXTDOMAIN ), $user_values[ 'order_paid_date' ] );
		$csv[] = array( __( 'Order Status', WFI_TEXTDOMAIN ), $user_values[ 'order_status' ] );
		$csv[] = array( __( 'Order Currency', WFI_TEXTDOMAIN ), $order_meta[ '_order_currency' ][ 0 ] );
		$csv[] = array( __( 'Payment Method', WFI_TEXTDOMAIN ), $order_meta[ '_payment_method_title' ][ 0 ] );
		$csv[] = array( __( 'Order Tax', WFI_TEXTDOMAIN ), $order_meta[ '_order_tax' ][ 0 ] );
		$csv[] = array( __( 'Order Total', WFI_TEXTDOMAIN ), $order_meta[ '_order_total' ][ 0 ] );
		$csv[] = array( __( 'Customer User ID', WFI_TEXTDOMAIN ), $user_values[ 'user_id' ] );
		$csv[] = array( __( 'Customer VAT', WFI_TEXTDOMAIN ), $user_values[ 'vat' ] );
		$csv[] = array( __( 'Customer SSN', WFI_TEXTDOMAIN ), $user_values[ 'ssn' ] );
		$csv[] = array( __( 'Customer Note', WFI_TEXTDOMAIN ), $user_values[ 'order_note' ] );
		$csv[] = array( __( 'Billing First Name', WFI_TEXTDOMAIN ), $order_meta[ '_billing_first_name' ][ 0 ] );
		$csv[] = array( __( 'Billing Last Name', WFI_TEXTDOMAIN ), $order_meta[ '_billing_last_name' ][ 0 ] );
		$csv[] = array( __( 'Billing Company', WFI_TEXTDOMAIN ), $order_meta[ '_billing_company' ][ 0 ] );
		$csv[] = array( __( 'Billing Address 1', WFI_TEXTDOMAIN ), $order_meta[ '_billing_address_1' ][ 0 ] );
		$csv[] = array( __( 'Billing Address 2', WFI_TEXTDOMAIN ), $order_meta[ '_billing_address_2' ][ 0 ] );
		$csv[] = array( __( 'Billing City', WFI_TEXTDOMAIN ), $order_meta[ '_billing_city' ][ 0 ] );
		$csv[] = array( __( 'Billing Postcode', WFI_TEXTDOMAIN ), $order_meta[ '_billing_postcode' ][ 0 ] );
		$csv[] = array( __( 'Billing Country', WFI_TEXTDOMAIN ), $order_meta[ '_billing_country' ][ 0 ] );
		$csv[] = array( __( 'Billing State', WFI_TEXTDOMAIN ), $order_meta[ '_billing_state' ][ 0 ] );
		$csv[] = array( __( 'Billing Email Address', WFI_TEXTDOMAIN ), $order_meta[ '_billing_email' ][ 0 ] );
		$csv[] = array( __( 'Billing Country', WFI_TEXTDOMAIN ), $order_meta[ '_billing_country' ][ 0 ] );
		$csv[] = array( __( 'Customer Account Email Address', WFI_TEXTDOMAIN ), $user_values[ 'user_email' ] );
		$csv[] = array( __( 'Billing Phone', WFI_TEXTDOMAIN ), $order_meta[ '_billing_phone' ][ 0 ] );
		$csv[] = array( __( 'Shipping First Name', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_first_name' ][ 0 ] );
		$csv[] = array( __( 'Shipping Last Name', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_last_name' ][ 0 ] );
		$csv[] = array( __( 'Shipping Company', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_company' ][ 0 ] );
		$csv[] = array( __( 'Shipping Address 1', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_address_1' ][ 0 ] );
		$csv[] = array( __( 'Shipping Address 2', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_address_2' ][ 0 ] );
		$csv[] = array( __( 'Shipping City', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_city' ][ 0 ] );
		$csv[] = array( __( 'Shipping Postcode', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_postcode' ][ 0 ] );
		$csv[] = array( __( 'Shipping Country', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_country' ][ 0 ] );
		$csv[] = array( __( 'Shipping State', WFI_TEXTDOMAIN ), $order_meta[ '_shipping_state' ][ 0 ] );
		$csv[] = array( __( 'Transaction ID', WFI_TEXTDOMAIN ), $user_values[ 'transaction' ] );
		$csv[] = array( __( 'Prices Include Tax', WFI_TEXTDOMAIN ), $order_meta[ '_prices_include_tax' ][ 0 ] );
		$csv[] = array( __( 'Cart Discount', WFI_TEXTDOMAIN ), $order_meta[ '_cart_discount' ][ 0 ] );
		$csv[] = array( __( 'Cart Discount Tax', WFI_TEXTDOMAIN ), $order_meta[ '_cart_discount_tax' ][ 0 ] );
		$csv[] = array( __( 'Order Shipping Method', WFI_TEXTDOMAIN ), $order->get_shipping_method() );
		$csv[] = array( __( 'Order Shipping Amount', WFI_TEXTDOMAIN ), $order_meta[ '_order_shipping' ][ 0 ] );
		$csv[] = array( __( 'Order Shipping Tax', WFI_TEXTDOMAIN ), $order_meta[ '_order_shipping_tax' ][ 0 ] );

		foreach ( $csv as $row ) {
			$text .= $row[ 0 ] . ',' . $row[ 1 ] . "\n";
		}
		$text .= "\n";

		$csv_products = array();
		$csv_products[] = array( __( 'Product Name', WFI_TEXTDOMAIN ), __( 'Product ID', WFI_TEXTDOMAIN ), __( 'Product SKU', WFI_TEXTDOMAIN ), __( 'Product Variation ID', WFI_TEXTDOMAIN ), __( 'Quantity', WFI_TEXTDOMAIN ), __( 'Line Subtotal', WFI_TEXTDOMAIN ), __( 'Line Total', WFI_TEXTDOMAIN ), __( 'Line Subtotal Tax', WFI_TEXTDOMAIN ), __( 'Line Tax', WFI_TEXTDOMAIN ) );

		$items = $order->get_items();
		foreach ( $items as $item ) {
			$product = new WC_Product( $item[ 'product_id' ] );
			$csv_products[] = array( $item[ 'name' ], $item[ 'product_id' ], $product->get_sku(), $item[ 'variation_id' ], $item[ 'qty' ], $item[ 'line_subtotal' ], $item[ 'line_total' ], $item[ 'line_subtotal_tax' ], $item[ 'line_tax' ] );
		}

		foreach ( $csv_products as $row ) {
			$text .= $row[ 0 ] . ',' . $row[ 1 ] . ',' . $row[ 2 ] . ',' . $row[ 3 ] . ',' . $row[ 4 ] . ',' . $row[ 5 ] . ',' . $row[ 6 ] . ',' . $row[ 7 ] . ',' . $row[ 8 ] . "\n";
		}

		return $text;
	}

	/**
	 * Generate a CSV
	 *
	 * @return void
	 */
	public function export_order_action() {
		$screen = get_current_screen();

		if ( !isset( $_GET[ 'export_order' ] ) ) { // Input var okay.
			return;
		}

		if ( empty( $_GET[ 'export_order' ] ) || empty( $_GET[ 'post' ] ) ) { // Input var okay.
			return;
		}

		if ( $screen->id !== 'shop_order' ) {
			return;
		}

		if ( !current_user_can( 'manage_woocommerce' ) ) {
			return;
		}

		$order_id = absint( $_GET[ 'post' ] ); // Input var okay.

		ignore_user_abort( true );

		nocache_headers();
		header( 'Content-Type: application/json; charset=utf-8' );
		header( 'Content-Disposition: attachment; filename=order-export-' . $this->get_real_number( $order_id ) . '.csv' );
		header( 'Expires: 0' );

		echo $this->generate_order( $order_id );

		exit;
	}

	/**
	 * Get real number order
	 *
	 * @param integer $order_id ID Order.
	 *
	 * @return integer
	 */
	public static function get_real_number( $order_id ) {
		return str_replace( '/', '-', get_post_meta( $order_id, '_order_number', true ) );
	}

}

new WFI_Order_Export();
