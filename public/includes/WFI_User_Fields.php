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
 * The user fields
 */
class WFI_User_Fields
{
    /**
     * Initialize the plugin by setting localization and loading public scripts
     * and styles.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        if ( is_admin() ) {
            return false;
        }
        $this->settings = get_wfi_settings();
        // WooCommerce Registration Form
        
        if ( !empty($this->settings['user_fields_reg']) ) {
            add_action( 'woocommerce_register_form', array( $this, 'vatfc_fields' ) );
            add_action(
                'woocommerce_register_post',
                array( $this, 'validate_fields_profile' ),
                9999,
                3
            );
        }
        
        // WooCommerce Edit Account Form
        add_action( 'woocommerce_edit_account_form', array( $this, 'vatfc_fields' ) );
        add_action(
            'woocommerce_save_account_details_errors',
            array( $this, 'validate_fields_details_profile' ),
            9999,
            2
        );
        // WooCommerce save fields after submission
        add_action( 'woocommerce_created_customer', array( $this, 'save_fields_profile' ) );
        add_action( 'woocommerce_save_account_details', array( $this, 'save_fields_profile' ) );
        // WooCommerce Customer Profile Fields
        add_filter( 'woocommerce_customer_meta_fields', array( $this, 'filter_vatcf_fields' ) );
        // WooCommerce Checkout Billing Information Form
        add_action( 'woocommerce_checkout_billing', array( $this, 'vatfc_fields' ), 9999 );
        // WooCommerce validation of fields after submission
        add_action( 'woocommerce_checkout_process', array( $this, 'vatfc_validation_checkout' ) );
        // Force save on user information on WooCommerce checkout
        add_action( 'woocommerce_checkout_update_order_meta', array( $this, 'save_fields_checkout' ) );
        // Enqueue files only on checkout
        add_action( 'wp_enqueue_scripts', array( $this, 'checkout_enqueue' ), 99 );
        // Support for stripe
        add_filter(
            'wc_stripe_validate_checkout_all_fields',
            array( $this, 'stripe_validation' ),
            9999,
            1
        );
        add_filter(
            'wc_stripe_validate_checkout_required_fields',
            array( $this, 'stripe_validation' ),
            9999,
            1
        );
    }
    
    /**
     * Add vat and ssn field
     *
     * @return void
     */
    public function vatfc_fields()
    {
        $required = array(
            'vat' => true,
            'ssn' => true,
            'pec' => '',
            'sdi' => '',
        );
        if ( !empty($this->settings['required_vat_fields']) && !empty($this->settings['fc_only_italian']) && !detect_customer_italian_by_billing() ) {
            $required['ssn'] = false;
        }
        if ( empty($this->settings['required_vat_fields']) ) {
            woocommerce_form_field( 'pvtazd', array(
                'type'     => 'radio',
                'options'  => array(
                'azienda' => apply_filters( 'woofisco_company_label', __( 'Company', WFI_TEXTDOMAIN ) ),
                'privato' => apply_filters( 'woofisco_private_label', __( 'Private', WFI_TEXTDOMAIN ) ),
            ),
                'class'    => array( 'pvtazd form-row-wide' ),
                'required' => true,
                'label'    => apply_filters( 'woofisco_arecompany_label', __( 'Are you a company?', WFI_TEXTDOMAIN ) ),
            ), apply_filters( 'woofisco_checkout_pvtazd_default', get_user_pvtazd() ) );
        }
        if ( empty($this->settings['required_only_ssn']) ) {
            woocommerce_form_field( 'piva', array(
                'type'     => 'text',
                'class'    => array( 'piva form-row-wide' ),
                'label'    => __( 'VAT Number', WFI_TEXTDOMAIN ),
                'required' => $required['vat'],
                'default'  => ( isset( $_POST['piva'] ) ? sanitize_text_field( $_POST['piva'] ) : '' ),
            ), get_user_vat() );
        }
        woocommerce_form_field( 'cf', array(
            'type'     => 'text',
            'class'    => array( 'cf form-row-wide' ),
            'label'    => __( 'SSN', WFI_TEXTDOMAIN ),
            'default'  => ( isset( $_POST['cf'] ) ? sanitize_text_field( $_POST['cf'] ) : '' ),
            'required' => $required['ssn'],
        ), get_user_fc() );
        
        if ( !empty($this->settings['ask_invoice']) || !empty($this->settings['show_pecsdi_without_invoice']) || !empty($required['sdi']) || !empty($required['pec']) ) {
            woocommerce_form_field( 'pec', array(
                'type'     => 'email',
                'class'    => array( 'pec form-row-wide' ),
                'label'    => __( 'PEC (only for Italians)', WFI_TEXTDOMAIN ),
                'required' => $required['pec'],
                'default'  => ( isset( $_POST['pec'] ) ? sanitize_text_field( $_POST['pec'] ) : '' ),
            ), get_user_pec() );
            woocommerce_form_field( 'sdi', array(
                'type'     => 'text',
                'class'    => array( 'sdi form-row-wide' ),
                'label'    => __( 'SDI (only for Italians)', WFI_TEXTDOMAIN ),
                'required' => $required['sdi'],
                'default'  => ( isset( $_POST['sdi'] ) ? sanitize_text_field( $_POST['sdi'] ) : '' ),
            ), get_user_sdi() );
        }
        
        if ( empty($this->settings['required_vat_fields']) ) {
            echo  '<style>#pvtazd_field label, #pvtazd_field input {display: inline-block;vertical-align: middle;margin-right:5px;}</style>' ;
        }
    }
    
    /**
     * Add vat and ssn field in the profile backend
     *
     * @param array $profile_fields Array with all the fields.
     *
     * @return array
     */
    public function filter_vatcf_fields( $profile_fields )
    {
        if ( empty($this->settings['required_vat_fields']) ) {
            $profile_fields['fisco']['fields'] = array(
                'pvtazd' => array(
                'type'    => 'select',
                'label'   => __( 'Are a you a company?', WFI_TEXTDOMAIN ),
                'options' => array(
                'privato' => __( 'Private', WFI_TEXTDOMAIN ),
                'azienda' => __( 'Company', WFI_TEXTDOMAIN ),
            ),
            ),
                'piva'   => array(
                'label' => __( 'VAT Number', WFI_TEXTDOMAIN ),
            ),
            );
        }
        if ( !empty($this->settings['fc_only_italian']) && detect_customer_italian_by_billing() || empty($this->settings['fc_only_italian']) ) {
            $profile_fields['fisco']['fields']['cf'] = array(
                'label' => __( 'SSN', WFI_TEXTDOMAIN ),
            );
        }
        return $profile_fields;
    }
    
    /**
     * Validation in checkout
     *
     * @return booleaan
     */
    public function vatfc_validation_checkout()
    {
        $pvtazd = wfi_get_post_data( 'pvtazd' );
        $this->settings = get_wfi_settings();
        $valid = true;
        if ( wfi_get_post_data( 'ask_invoice' ) === 'no' ) {
            // Input var okay.
            return false;
        }
        $required = $this->get_required_fields();
        $show = false;
        if ( isset( $this->settings['required_vat_fields'] ) && $this->settings['required_vat_fields'] || !empty($this->settings['fc_only_italian']) && detect_customer_italian_by_billing() || (empty($this->settings['fc_only_italian']) || !isset( $this->settings['fc_only_italian'] )) ) {
            $show = true;
        }
        if ( isset( $this->settings['required_vat_fields'] ) && $this->settings['required_vat_fields'] && !empty($this->settings['fc_only_italian']) && !detect_customer_italian_by_billing() ) {
            $show = false;
        }
        
        if ( $show ) {
            $cf = wfi_get_post_data( 'cf' );
            if ( $required['ssn'] === true || $required['ssn'] ) {
                
                if ( empty($cf) ) {
                    wc_add_notice( __( 'SSN is empty.', WFI_TEXTDOMAIN ), 'error' );
                    $valid = false;
                } elseif ( !is_valid_fc( $cf ) ) {
                    wc_add_notice( __( 'SSN is not valid.', WFI_TEXTDOMAIN ), 'error' );
                    $valid = false;
                }
            
            }
        }
        
        
        if ( empty($this->settings['required_only_ssn']) ) {
            $piva = wfi_get_post_data( 'piva' );
            
            if ( !isset( $required['settings'] ) && $pvtazd === 'azienda' && $piva === '' || isset( $required['settings'] ) && ($required['vat'] === true || $required['vat']) && empty($piva) || isset( $this->settings['required_vat_fields'] ) && $this->settings['required_vat_fields'] && empty($piva) ) {
                wc_add_notice( __( 'VAT is empty.', WFI_TEXTDOMAIN ), 'error' );
                $valid = false;
            }
        
        }
        
        return $valid;
    }
    
    /**
     * Validate fields in the profile details
     *
     * @param object $errors The object for errors.
     * @param string $user  User.
     *
     * @return bool
     */
    public function validate_fields_details_profile( $errors, $user )
    {
        return $this->validate_fields_profile( '', '', $errors );
    }
    
    /**
     * Validate fields in the profile
     *
     * @param string $username  User.
     * @param string $email     The user email.
     * @param object $validation_errors The object for errors.
     *
     * @return bool
     */
    public function validate_fields_profile( $username, $email, $validation_errors )
    {
        $cf = sanitize_text_field( $_POST['cf'] );
        // Input var okay.
        $valid = true;
        $required = array(
            'vat' => true,
            'ssn' => true,
        );
        
        if ( isset( $_POST['pvtazd'] ) ) {
            // Input var okay.
            $pvtazd = sanitize_text_field( $_POST['pvtazd'] );
            // Input var okay.
            
            if ( $pvtazd === 'privato' ) {
                $required['ssn'] = true;
                $required['vat'] = false;
            }
        
        }
        
        if ( empty($this->settings['required_vat_fields']) && !isset( $_POST['pvtazd'] ) && ($required['ssn'] === true || $required['ssn']) ) {
            $validation_errors->add( 'pvtazd_is_empty', __( 'You didn\'t set if you are a Company or Private customer.', WFI_TEXTDOMAIN ) );
        }
        
        if ( empty($this->settings['required_only_ssn']) ) {
            $piva = sanitize_text_field( $_POST['piva'] );
            // Input var okay.
            $valid = true;
            if ( $required['vat'] === true || $required['vat'] ) {
                
                if ( empty($piva) ) {
                    $validation_errors->add( 'vat_is_empty', __( 'VAT is empty.', WFI_TEXTDOMAIN ) );
                    $valid = false;
                }
            
            }
        }
        
        if ( $required['ssn'] === true || $required['ssn'] ) {
            
            if ( empty($cf) ) {
                $validation_errors->add( 'ssn_is_empty', __( 'SSN is empty.', WFI_TEXTDOMAIN ) );
                $valid = false;
            } elseif ( !is_valid_fc( $cf ) ) {
                $validation_errors->add( 'ssn_not_valid', __( 'SSN is not valid.', WFI_TEXTDOMAIN ) );
                $valid = false;
            }
        
        }
        return $valid;
    }
    
    /**
     * Save fields in the profile
     *
     * @param integer $user_id The user ID.
     *
     * @return void
     */
    public function save_fields_profile( $user_id )
    {
        $cf = sanitize_text_field( $_POST['cf'] );
        // Input var okay.
        if ( empty($this->settings['required_vat_fields']) ) {
            
            if ( isset( $_POST['pvtazd'] ) ) {
                // Input var okay.
                $pvtazd = sanitize_text_field( $_POST['pvtazd'] );
                // Input var okay.
                update_user_meta( $user_id, 'pvtazd', $pvtazd );
            }
        
        }
        
        if ( empty($this->settings['required_only_ssn']) ) {
            $piva = sanitize_text_field( $_POST['piva'] );
            // Input var okay.
            update_user_meta( $user_id, 'piva', str_replace( array(
                ' ',
                '-',
                '_',
                '.'
            ), '', $piva ) );
        }
        
        
        if ( !empty($this->settings['ask_invoice']) || !empty($this->settings['show_pecsdi_without_invoice']) ) {
            $pec = sanitize_text_field( $_POST['pec'] );
            // Input var okay.
            $sdi = sanitize_text_field( $_POST['sdi'] );
            // Input var okay.
            update_user_meta( $user_id, 'pec', $pec );
            update_user_meta( $user_id, 'sdi', $sdi );
        }
        
        update_user_meta( $user_id, 'cf', $cf );
    }
    
    /**
     * Save fields in the order
     *
     * @param integer $order_id The Order ID.
     *
     * @return void
     */
    public function save_fields_checkout( $order_id )
    {
        
        if ( is_user_logged_in() ) {
            $user_id = get_current_user_id();
            $this->save_fields_profile( $user_id );
        }
        
        $cf = wfi_get_post_data( 'cf' );
        $pvtazd = wfi_get_post_data( 'pvtazd' );
        $order = wc_get_order( $order_id );
        if ( !empty($pvtazd) ) {
            $order->update_meta_data( 'pvtazd', $pvtazd );
        }
        
        if ( empty($this->settings['required_only_ssn']) ) {
            $piva = wfi_get_post_data( 'piva' );
            if ( !empty($piva) ) {
                $order->update_meta_data( 'piva', str_replace( array(
                    ' ',
                    '-',
                    '_',
                    '.'
                ), '', $piva ) );
            }
        }
        
        if ( !empty($this->settings['fc_only_italian']) && detect_customer_italian_by_billing() || empty($this->settings['fc_only_italian']) ) {
            $order->update_meta_data( 'cf', $cf );
        }
        $order->save();
    }
    
    /**
     * Enqueue JS files only on checkout
     */
    public function checkout_enqueue()
    {
        
        if ( is_checkout() || is_account_page() ) {
            wp_enqueue_script(
                WFI_TEXTDOMAIN . '-checkout',
                plugins_url( 'assets/js/checkout.js', dirname( __FILE__ ) ),
                array( 'jquery' ),
                WFI_VERSION
            );
            wp_localize_script( WFI_TEXTDOMAIN . '-checkout', 'wfiCheckout', array(
                'required'  => '<abbr class="required" title="' . esc_attr__( 'required', WFI_TEXTDOMAIN ) . '">*</abbr>',
                'fc'        => !empty($this->settings['fc_only_italian']),
                'vat'       => !empty($this->settings['vat_only_italian']),
                'mandatory' => !empty($this->settings['required_vat_fields']),
            ) );
        }
    
    }
    
    public function get_required_fields()
    {
        $this->settings = get_wfi_settings();
        $required = array(
            'vat' => true,
            'ssn' => true,
        );
        if ( isset( $this->settings['required_vat_fields'] ) && $this->settings['required_vat_fields'] ) {
            $required = array(
                'vat' => true,
                'ssn' => true,
            );
        }
        return $required;
    }
    
    public function stripe_validation( $all_fields )
    {
        
        if ( isset( $all_fields['ask_invoice'] ) ) {
            $ask_invoice = sanitize_text_field( $all_fields['ask_invoice'] );
            
            if ( $ask_invoice === 'no' ) {
                unset( $all_fields['cf'] );
                unset( $all_fields['piva'] );
                unset( $all_fields['pec'] );
                unset( $all_fields['sdi'] );
            }
        
        }
        
        return $all_fields;
    }

}
new WFI_User_Fields();