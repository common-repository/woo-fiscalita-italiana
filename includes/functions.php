<?php

/**
 * WooCommerce Fiscalita Italiana
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Codeat <support@codeat.co>
 * @copyright 2016 GPL 2.0+
 * @license   GPL-2.0+
 * @link      http://codeat.it
 */
/**
 * Check if the shop is located in Italy
 *
 * @return boolean
 */
function is_italian_base_shop()
{
    
    if ( function_exists( 'wc_get_base_location' ) ) {
        $location = wc_get_base_location();
        if ( $location['country'] === 'IT' ) {
            return true;
        }
    } else {
        // On PDF generation the function not exist -.-'
        $location = apply_filters( 'woocommerce_get_base_location', get_option( 'woocommerce_default_country' ) );
        $location = explode( ':', $location );
        if ( $location[0] === 'IT' ) {
            return true;
        }
    }
    
    return false;
}

/**
 * Get the array of information of WFI
 *
 * @return array
 */
function get_wfi_info()
{
    return apply_filters( 'wfi_info', get_option( 'woo-fiscalita-italiana', null ) );
}

/**
 * Get the array of settings of WFI
 *
 * @return array
 */
function get_wfi_settings()
{
    return apply_filters( 'wfi_settings', get_option( 'woo-fiscalita-italiana-settings', null ) );
}

/**
 * Get VAT of the shop
 *
 * @return string
 */
function get_site_vat()
{
    $value = get_wfi_info();
    if ( isset( $value['piva'] ) ) {
        return $value['piva'];
    }
    return '';
}

/**
 * Print the VAT
 *
 * @return void
 */
function the_site_vat()
{
    echo  get_site_vat() ;
}

/**
 * Get fiscal code of the shop
 *
 * @return string
 */
function get_site_fc()
{
    $value = get_wfi_info();
    return $value['cf'];
}

/**
 * Print the fiscal code
 *
 * @return void
 */
function the_site_fc()
{
    echo  get_site_fc() ;
}

/**
 * Get address of the shop
 *
 * @return string
 */
function get_site_address()
{
    $value = get_wfi_info();
    return $value['indirizzo'];
}

/**
 * Print the address
 *
 * @return void
 */
function the_site_address()
{
    echo  get_site_address() ;
}

/**
 * Get postalcode of the shop
 *
 * @return string
 */
function get_site_postalcode()
{
    $value = get_wfi_info();
    return $value['cap'];
}

/**
 * Print the postalcode
 *
 * @return void
 */
function the_site_postalcode()
{
    echo  get_site_postalcode() ;
}

/**
 * Get the phone of the shop
 *
 * @return string
 */
function get_site_phone()
{
    $value = get_wfi_info();
    return $value['phone'];
}

/**
 * Print the phone
 *
 * @return void
 */
function the_site_phone()
{
    echo  get_site_phone() ;
}

/**
 * Get REA of the shop
 *
 * @return string
 */
function get_site_rea()
{
    $value = get_wfi_info();
    return $value['rea'];
}

/**
 * Print the REA
 *
 * @return void
 */
function the_site_rea()
{
    echo  get_site_rea() ;
}

/**
 * Get the Camera di Commercio code
 *
 * @return string
 */
function get_site_camcom()
{
    $value = get_wfi_info();
    return $value['camcom'];
}

/**
 * Print Camera di Commercio code
 *
 * @return void
 */
function the_site_camcom()
{
    echo  get_site_camcom() ;
}

/**
 * Get ODR of the site
 *
 * @return string
 */
function get_site_odr()
{
    $value = get_wfi_info();
    if ( !isset( $value['odr'] ) ) {
        $value['odr'] = '';
    }
    if ( empty($value['odr']) ) {
        $value['odr'] = '<a href="http://ec.europa.eu/consumers/odr/" target="_blank">http://ec.europa.eu/consumers/odr/</a>';
    }
    $text = wpautop( $value['odr'] );
    return $text;
}

/**
 * Print ODR
 *
 * @return void
 */
function the_site_odr()
{
    echo  get_site_odr() ;
}

/**
 * Get type of company of the user
 *
 * @param integer $user_id User ID.
 *
 * @return string
 */
function get_user_pvtazd( $user_id = '' )
{
    if ( empty($user_id) ) {
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'pvtazd', true );
}

/**
 * Get VAT of the user
 *
 * @param integer $user_id User ID.
 *
 * @return string
 */
function get_user_vat( $user_id = '' )
{
    if ( empty($user_id) ) {
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'piva', true );
}

/**
 * Print the VAT of the user
 *
 * @return void
 */
function the_user_vat()
{
    echo  get_user_vat() ;
}

/**
 * Get the Fiscal code of the user
 *
 * @param integer $user_id User ID.
 *
 * @return string
 */
function get_user_fc( $user_id = '' )
{
    if ( empty($user_id) ) {
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'cf', true );
}

/**
 * Print the fiscal code of the user
 *
 * @return void
 */
function the_user_fc()
{
    echo  get_user_fc() ;
}

/**
 * Get the PEC of the user
 *
 * @param integer $user_id User ID.
 *
 * @return string
 */
function get_user_pec( $user_id = '' )
{
    if ( empty($user_id) ) {
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'pec', true );
}

/**
 * Print the pec of the user
 *
 * @return void
 */
function the_user_pec()
{
    echo  get_user_pec() ;
}

/**
 * Get the SDI of the user
 *
 * @param integer $user_id User ID.
 *
 * @return string
 */
function get_user_sdi( $user_id = '' )
{
    if ( empty($user_id) ) {
        $user_id = get_current_user_id();
    }
    return get_user_meta( $user_id, 'sdi', true );
}

/**
 * Print the sdi of the user
 *
 * @return void
 */
function the_user_sdi()
{
    echo  get_user_sdi() ;
}

/**
 * Get the path of the custom folder of WFI
 *
 * @return string
 */
function get_wfi_folder()
{
    $path = wp_upload_dir();
    return $path['basedir'] . '/wfi';
}

/**
 * Detect if the postal code is in islands
 *
 * @global object $woocommerce
 * @return boolean
 */
function is_shipping_for_islands()
{
    global  $woocommerce ;
    $pc_islands_2 = array(
        0  => '07',
        1  => '08',
        2  => '09',
        3  => '90',
        4  => '91',
        5  => '92',
        6  => '93',
        7  => '94',
        8  => '95',
        9  => '96',
        10 => '97',
        11 => '98',
        12 => '86',
        13 => '87',
        14 => '88',
    );
    $pc_islands = array(
        '04020',
        '04027',
        '06069',
        '19025',
        '22060',
        '23030',
        '25050',
        '28016',
        '30100',
        '30121',
        '30122',
        '30123',
        '30124',
        '30125',
        '30126',
        '30132',
        '30133',
        '30135',
        '30141',
        '30142',
        '45010',
        '57030',
        '57031',
        '57032',
        '57033',
        '57034',
        '57036',
        '57037',
        '57038',
        '57039',
        '58012',
        '58019',
        '71040',
        '80070',
        '80071',
        '80073',
        '80074',
        '80075',
        '80076',
        '80077',
        '80079'
    );
    $postalcode = apply_filters( 'wfi_customer_shipping_postcode', $woocommerce->customer->get_shipping_postcode(), $woocommerce->customer );
    foreach ( $pc_islands_2 as $pc_island ) {
        if ( $pc_island === substr( $postalcode, 0, 2 ) ) {
            return true;
        }
    }
    foreach ( $pc_islands as $pc_island ) {
        if ( $pc_island === $postalcode ) {
            return true;
        }
    }
    return false;
}

/**
 * Check if the user postalcode is the same of the shop
 *
 * @global object $woocommerce
 * @return boolean
 */
function is_same_postalcode()
{
    global  $woocommerce ;
    $pc_user = apply_filters( 'wfi_customer_shipping_postcode', $woocommerce->customer->get_shipping_postcode(), $woocommerce->customer );
    $postalcode = get_site_postalcode();
    if ( $pc_user === $postalcode ) {
        return true;
    }
    return false;
}

/**
 * Detect if the customer is italian by billing address
 *
 * @return boolean
 */
function detect_customer_italian_by_billing()
{
    $country = WC()->customer->get_billing_country();
    return (bool) (apply_filters( 'wfi_customer_country', $country ) === 'IT');
}

/**
 * Get the fields wrapper for WooCommerce 2/3
 *
 * @param WC_Order $order Order object.
 *
 * @return array
 */
function wfi_get_order_fields( $order )
{
    $attr = array();
    
    if ( gettype( $order ) !== 'object' ) {
        $attr['order_id'] = $order;
        $order = new WC_Order( $order );
    }
    
    $attr['order_id'] = $order->get_id();
    $vat_order = $order->get_meta( 'piva', true );
    if ( empty($vat_order) ) {
        $vat_order = get_post_meta( $attr['order_id'], 'piva', true );
    }
    $pvtazd_order = $order->get_meta( 'pvtazd', true );
    $ssn_order = $order->get_meta( 'cf', true );
    if ( empty($ssn_order) ) {
        $ssn_order = get_post_meta( $attr['order_id'], 'cf', true );
    }
    $pec_order = $order->get_meta( 'pec', true );
    $sdi_order = $order->get_meta( 'sdi', true );
    if ( empty($sdi_order) ) {
        $sdi_order = get_post_meta( $attr['order_id'], 'sdi', true );
    }
    if ( empty($pec_order) ) {
        $pec_order = get_post_meta( $attr['order_id'], 'pec', true );
    }
    $attr['order_date'] = date( 'd/m/Y' );
    if ( $order->get_date_created() ) {
        $attr['order_date'] = $order->get_date_created()->date_i18n( 'd/m/Y' );
    }
    $attr['order_completed_date'] = $order->get_date_completed();
    $attr['order_paid_date'] = '';
    if ( !empty($order->get_date_paid()) ) {
        $attr['order_paid_date'] = $order->get_date_paid()->date_i18n( 'd/m/Y' );
    }
    $attr['order_status'] = $order->get_status();
    $attr['user_id'] = $order->get_user_id();
    $attr['user_email'] = $order->get_billing_email();
    $comment = $order->get_customer_order_notes();
    
    if ( isset( $comment[0] ) ) {
        $comment = $comment[0]->comment_content;
    } else {
        $comment = '';
    }
    
    $attr['order_note'] = $comment;
    $attr['user_registered'] = get_user_by( 'email', $order->get_billing_email() );
    $attr['transaction'] = $order->get_transaction_id();
    $attr['vat'] = $vat_order;
    $attr['ssn'] = $ssn_order;
    $attr['pec'] = $pec_order;
    $attr['sdi'] = $sdi_order;
    $attr['pvtazd'] = $pvtazd_order;
    return $attr;
}

/**
 * Validate an italian fiscal code
 *
 * @param string $cf The italian fiscal code.
 *
 * @return boolean
 */
function is_valid_fc( $cf )
{
    if ( preg_match( '/^[a-z]{6}[0-9]{2}[a-z][0-9]{2}[a-z][0-9]{3}[a-z]$/i', $cf ) || preg_match( '/^[0-9]{11}$/', $cf ) || preg_match( '/^(IT){0,1}[0-9]{11}$/i', $cf ) ) {
        return true;
    }
    return false;
}

/**
 * Support for ajax checkout
 */
function wfi_get_post_data( $var, $default = '' )
{
    
    if ( isset( $_POST[$var] ) ) {
        return esc_html( sanitize_text_field( $_POST[$var] ) );
        // Input var okay.
    } else {
        if ( !isset( $_POST['post_data'] ) ) {
            return $default;
        }
        parse_str( sanitize_text_field( wp_unslash( $_POST['post_data'] ) ), $ajax_checkout );
        // Input var okay.
        if ( isset( $ajax_checkout[$var] ) ) {
            return esc_html( sanitize_text_field( $ajax_checkout[$var] ) );
        }
    }
    
    return $default;
}
