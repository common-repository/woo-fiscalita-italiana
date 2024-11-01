<?php

/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   Woo_Fiscalita_Italiana
 * @author    Codeat <support@codeat.co>
 * @copyright 2016
 * @license   GPL-2.0+
 * @link      http://codeat.co
 */
?>

<div class="wrap">

    <h2><?php 
echo  esc_html( get_admin_page_title() ) ;
?></h2>

    <div id="tabs" class="settings-tab">
        <ul>
            <li id="tab-info-pointer"><a href="#tabs-info"><?php 
_e( 'Info' );
?></a></li>
            <li id="tab-settings"><a href="#tabs-settings"><?php 
_e( 'Settings' );
?></a></li>
            <li id="tab-check-pointer"><a href="#tabs-check"><?php 
_e( 'Store Check System', WFI_TEXTDOMAIN );
?></a></li>
			<?php 
do_action( 'wfi_settings_tabs' );
?>
            <li id="tab-impexp"><a href="#tabs-impexp"><?php 
_e( 'Import/Export', WFI_TEXTDOMAIN );
?></a></li>
			<?php 
?>
            <li id="tab-upgrade"><a href="#tabs-upgrade"><?php 
_e( 'Upgrade', WFI_TEXTDOMAIN );
?></a></li>
        </ul>
        <div id="tabs-info" class="wrap">
			<div class="postbox">
				<div style="margin-left:10px;">
					<h3><?php 
_e( 'For a complete documentation about first steps <a target="_blank" href="https://docs.codeat.co/woopiva/primipassi/">click here</a>!', WFI_TEXTDOMAIN );
?></h3>
				</div>
			</div>
			<?php 
$cmb = new_cmb2_box( array(
    'id'         => WFI_TEXTDOMAIN . '_options',
    'hookup'     => false,
    'show_on'    => array(
    'key'   => 'options-page',
    'value' => array( WFI_TEXTDOMAIN ),
),
    'show_names' => true,
) );
$cmb->add_field( array(
    'name' => __( 'VAT', WFI_TEXTDOMAIN ),
    'id'   => 'piva',
    'type' => 'text',
) );
$cmb->add_field( array(
    'name' => __( 'SSN', WFI_TEXTDOMAIN ),
    'id'   => 'cf',
    'type' => 'text',
) );
$cmb->add_field( array(
    'name' => __( 'Address', WFI_TEXTDOMAIN ),
    'id'   => 'indirizzo',
    'type' => 'text',
) );
$cmb->add_field( array(
    'name' => __( 'Postal Code', WFI_TEXTDOMAIN ),
    'id'   => 'cap',
    'type' => 'text',
) );
$cmb->add_field( array(
    'name' => __( 'Phone', WFI_TEXTDOMAIN ),
    'id'   => 'phone',
    'type' => 'text',
) );

if ( is_italian_base_shop() ) {
    $cmb->add_field( array(
        'name' => __( 'REA', WFI_TEXTDOMAIN ),
        'desc' => __( 'VAT Register Number', WFI_TEXTDOMAIN ),
        'id'   => 'rea',
        'type' => 'text',
    ) );
    $cmb->add_field( array(
        'name' => __( 'Registration Office Location', WFI_TEXTDOMAIN ),
        'desc' => __( 'The italian city where your VAT number belongs to', WFI_TEXTDOMAIN ),
        'id'   => 'camcom',
        'type' => 'text',
    ) );
}

cmb2_metabox_form( WFI_TEXTDOMAIN . '_options', WFI_TEXTDOMAIN );
?>
        </div>
        <div id="tabs-settings" class="wrap">
			<div class="postbox">
				<div style="margin-left:10px;">
					<h3><?php 
_e( 'For a complete documentation about settings <a target="_blank" href="https://docs.codeat.co/woopiva/impostazioni/">click here</a>!', WFI_TEXTDOMAIN );
?></h3>
				</div>
			</div>
			<?php 
$cmb = new_cmb2_box( array(
    'id'         => WFI_TEXTDOMAIN . '_options-second',
    'hookup'     => false,
    'show_on'    => array(
    'key'   => 'options-page',
    'value' => array( WFI_TEXTDOMAIN ),
),
    'show_names' => true,
) );
$cmb->add_field( array(
    'name' => __( 'Data Entering Check', WFI_TEXTDOMAIN ),
    'id'   => 'title-check',
    'type' => 'title',
) );
$cmb->add_field( array(
    'name'        => __( 'I\'ve provided all the required data', WFI_TEXTDOMAIN ),
    'description' => __( 'Your VAT, Address and your Company Name must be in the footer or in a visible area of front-end', WFI_TEXTDOMAIN ),
    'id'          => 'info_done',
    'type'        => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Additional User Fields', WFI_TEXTDOMAIN ),
    'id'   => 'title-user-fields',
    'type' => 'title',
) );
$cmb->add_field( array(
    'name' => __( 'Add VAT/SSN also on registration form', WFI_TEXTDOMAIN ),
    'id'   => 'user_fields_reg',
    'type' => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Show VAT field only for italian customers', WFI_TEXTDOMAIN ),
    'desc' => __( 'It is not mandatory if the PRO Ask Invoice feature is enabled', WFI_TEXTDOMAIN ),
    'id'   => 'vat_only_italian',
    'type' => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Show SSN field only for italian customers', WFI_TEXTDOMAIN ),
    'desc' => __( 'It is not mandatory if the PRO Ask Invoice feature is enabled', WFI_TEXTDOMAIN ),
    'id'   => 'fc_only_italian',
    'type' => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Shipping Options', WFI_TEXTDOMAIN ),
    'id'   => 'title-shipping2',
    'type' => 'title',
) );
$cmb->add_field( array(
    'name' => __( 'Free shipping for customers in the same ZIP code of the shop', WFI_TEXTDOMAIN ),
    'id'   => 'shipping_samepc',
    'type' => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Online Dispute resolution', WFI_TEXTDOMAIN ),
    'id'   => 'title-resolution',
    'type' => 'title',
) );
$cmb->add_field( array(
    'name'        => __( 'ODR Link for shortcode', WFI_TEXTDOMAIN ),
    'id'          => 'odr',
    'type'        => 'textarea',
    'default'     => '<a href="http://ec.europa.eu/consumers/odr/" target="_blank">http://ec.europa.eu/consumers/odr/</a>',
    'description' => __( 'Leave untouched for the default EU link. Shortcode: <b>[wfi_site_odr]</b>', WFI_TEXTDOMAIN ),
) );
$cmb->add_field( array(
    'name'        => __( 'Shortcode placed', WFI_TEXTDOMAIN ),
    'description' => __( 'I\'ve provided to place the ODR shortcode in a visible area on front-end', WFI_TEXTDOMAIN ),
    'id'          => 'odr_done',
    'type'        => 'checkbox',
) );
$cmb->add_field( array(
    'name' => __( 'Extra Italian VAT Operations', WFI_TEXTDOMAIN ),
    'id'   => 'title-no-tax',
    'type' => 'title',
) );
$cmb->add_field( array(
    'name'        => __( 'Add "Operazione fuori campo IVA" to invoices', WFI_TEXTDOMAIN ),
    'description' => __( 'If your customer comes from a country whitout tax set in your woocommerce backend, apply the necessary invoice\'s caption', WFI_TEXTDOMAIN ),
    'id'          => 'dpr633-72',
    'type'        => 'checkbox',
) );
do_action( 'wfi_add_other_fields', $cmb );
cmb2_metabox_form( WFI_TEXTDOMAIN . '_options-second', WFI_TEXTDOMAIN . '-settings' );
?>
            <div class="settings-button">
<?php 
$system = new WFI_System_Check();
$actions = $system->actions();
foreach ( $actions as $key => $value ) {
    $system->generate_button( $key, $value['name'] );
}
?>
            </div>
        </div>
        <div id="tabs-check" class="metabox-holder">
			<div class="postbox">
				<div>
					<h3><?php 
_e( 'For a complete documentation about system check <a target="_blank" href="https://docs.codeat.co/woopiva/monitoraggio/">click here</a>!', WFI_TEXTDOMAIN );
?></h3>
				</div>
			</div>
<?php 
$system->generate_check_system();
?>
        </div>
        <?php 
do_action( 'wfi_settings_panels' );
?>
        <div id="tabs-impexp" class="metabox-holder">
            <div class="postbox">
                <h3 class="hndle"><span><?php 
_e( 'Export Settings', WFI_TEXTDOMAIN );
?></span></h3>
                <div class="inside">
                    <p><?php 
_e( 'Export the plugin\'s settings for this site as a .json file. This will allows you to easily import the configuration to another installation.', WFI_TEXTDOMAIN );
?></p>
                    <form method="post">
                        <p><input type="hidden" name="wfi_action" value="export_settings" /></p>
                        <p>
                            <?php 
wp_nonce_field( 'wfi_export_nonce', 'wfi_export_nonce' );
?>
                            <?php 
submit_button(
    __( 'Export', WFI_TEXTDOMAIN ),
    'secondary',
    'submit',
    false
);
?>
                        </p>
                    </form>
                </div>
            </div>

            <div class="postbox">
                <h3 class="hndle"><span><?php 
_e( 'Import Settings', WFI_TEXTDOMAIN );
?></span></h3>
                <div class="inside">
                    <p><?php 
_e( 'Import the plugin\'s settings from a .json file. This file can be retrieved by exporting the settings from another installation.', WFI_TEXTDOMAIN );
?></p>
                    <form method="post" enctype="multipart/form-data">
                        <p>
                            <input type="file" name="wfi_import_file"/>
                        </p>
                        <p>
                            <input type="hidden" name="wfi_action" value="import_settings" />
                            <?php 
wp_nonce_field( 'wfi_import_nonce', 'wfi_import_nonce' );
?>
                            <?php 
submit_button(
    __( 'Import', WFI_TEXTDOMAIN ),
    'secondary',
    'submit',
    false
);
?>
                        </p>
                    </form>
                </div>
            </div>
        </div>
        <?php 
?>
        <div id="tabs-upgrade" class="metabox-holder">
            <?php 

if ( wfi_fs()->is_not_paying() ) {
    ?>
                <div class="postbox">
                    <h3 class="hndle"><span><?php 
    _e( 'Upgrade to Professional Plan', WFI_TEXTDOMAIN );
    ?></span></h3>
                    <div class="inside">
                        <h3><?php 
    _e( 'Start selling in Italy without legal and fiscal issues from today!', WFI_TEXTDOMAIN );
    ?></h3>
<?php 
    _e( 'Switch to our <strong>Pro Plan</strong> and get the full feature for your e-commerce website:</br></br>
<strong>Support for PDF Invoice</strong> (Sequential order number and extra checkout fields added)</br><strong>Terms & Conditions will be always added to your communication</strong> (art. 51, co. 2 & art. 49, co. 1, lett. a, e, q ed r)</br><strong>VAT validation</strong> (check on the fly if your customer insert a valid VIES VAT)</br><strong>Cash on Delivery supplement</strong></br><strong>Shipping to island supplement</strong></br><strong>Shortcodes</strong> (an handy way to display and manage all of your shop informations)', WFI_TEXTDOMAIN );
    ?>
                        <?php 
    _e( '<h3>What are you waiting for? Start selling without worries!</h3>', WFI_TEXTDOMAIN );
    ?>
                        <?php 
    _e( '<strong>We guarantee one year of full support and legal update directly from your WordPress Dashboard</strong>', WFI_TEXTDOMAIN );
    ?>
                        </br></br>
                        <a href="<?php 
    echo  wfi_fs()->get_upgrade_url() ;
    ?>" target="_blank" class="button button-primary upgrade-button">Upgrade your plan now!</a>
                        <a href="https://codeat.co/woo-fiscalita-italiana" target="_blank" class="button button-primary discover-button">Discover all the features!</a></br>
                    </div>
                </div>
            <?php 
}

?>
            <div class="postbox">
                <h3 class="hndle"><span><?php 
_e( 'Are you selling Digital Products?', WFI_TEXTDOMAIN );
?></span></h3>
                <div class="inside">
                    <?php 
_e( '<h3>Install our digital goods addon and sell your products in Europe without issues.</h3>', WFI_TEXTDOMAIN );
?>
                    <?php 
_e( '<strong>We calculate and apply the right VAT TAX for your digital product category in every order. No code is needed and no other plugins or services like TAXAMO are required. Just Install our addon and start selling as usual!</strong>', WFI_TEXTDOMAIN );
?><br><br>
<?php 
_e( 'Addon Features:<br><br>
Support of EU Digital Goods Law with double check<br>
Auto sync european countries rates<br>
Automatically verify and handle the EXTRA VAT operations (E.G. EU to USA invoices without taxes).', WFI_TEXTDOMAIN );
?>
                    <br><br>
                    <a href="<?php 
echo  wfi_fs()->addon_url( WFI_TEXTDOMAIN ) ;
?>" target="_blank" class="button button-primary">Get the addon!</a>
                </div>
            </div>
        </div>
    </div>
</div>
