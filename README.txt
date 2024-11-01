=== Strumenti Partita IVA per Woocommerce ===
Contributors: codeat, mte90, iGenius
Donate link: https://codeat.co/
Tags: codice fiscale, partita iva, fattura, pec, italiano
Requires at least: 5.9
Tested up to: 6.1.1
Stable tag: 1.3.34
WC Tested Up To: 6.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Campi (Partita IVA, Codice Fiscale, SDI, PEC) e molte altre opzioni per vendere con WooCommerce in Italia

== Description ==

Un negozio e-commerce, per rispettare la normativa italiana ed europea, deve riportare alcune informazioni aggiuntive rispetto a quelle che possono essere inserite tramite WooCommerce, che possono essere difficili da integrare e possono richiedere diversi plugin.

Strumenti Partita IVA per WooCommerce ti permette di aggiungere queste informazioni, risolvendo i principali problemi senza bisogno di mettere mano al codice, rendendo ogni passaggio semplice ed intuitivo.

La versione gratuita permette l’inserimento delle informazioni di base richieste dalla legge italiana ed europea, mentre la versione Pro agevola la personalizzazione del vostro e-commerce con funzionalità aggiuntive come ad esempio i campi per inserire l’indirizzo PEC o il codice SDI, spedizioni maggiorate per le isole, supplemento per contrassegno e molto altro.

Ti invitiamo a leggere la <a href="https://docs.codeat.co/woopiva/">documentazione completa a questo link.</a>

Funzionalità della versione Free:

* Campi extra nel checkout, riepilogo ordini e registrazione cliente
* Impostazione automatica tassazione italiana
* Shortcode per normativa ODR (Risoluzione delle dispute online)
* Shortcode informazioni societarie
* Opzione per spedizione e/o ritiro in sede gratuito per i clienti nello stesso codice postale del negozio
* Opzione richiedi Partita IVA e Codice Fiscale solo per i clienti italiani
* Supporto WPML / Polylang

Versione Pro:

* Supporto Premium
* Supporto nativo WooCommerce PDF Invoices & Packing Slips e YITH WooCommerce PDF Invoice and Shipping List (campi aggiuntivi P.IVA e C.F. in fattura e bolle)
* Opzione per numerazione fatture sequenziali
* Termini & condizioni allegati alle mail di ordine
* Opzione per supplemento pagamento in contrassegno
* Opzione per supplemento spedizione verso le isole
* Validazione con il VIES per le partite IVA dei tuoi clienti
* Esportazione degli ordini in CSV (singoli o come zip)
* Opzione per mostrare i campi Partita IVA e Codice Fiscale solo alla selezione della spunta "Richiedi fattura" nel checkout
* Opzione per richiedere Codice Fiscale e Partita IVA in base alla aliquota e/o al tipo di cliente (se privato o azienda)
* Supporto campo PEC e campo SDI (necessari alla fatturazione elettronica)

Addon Disponibili:

* Tassazioni europee per la vendita di Beni Digitali (per poterli vendere in europa)

== Installation ==

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'woo fiscalita italiana'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `woo-fiscalita-italiana.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `woo-fiscalita-italiana.zip`
2. Extract the `woo-fiscalita-italiana` directory to your computer
3. Upload the `woo-fiscalita-italiana` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

== Frequently Asked Questions ==

= How can I buy the pro version? =

Just install the free version and then go under the "Upgrade" tab, choose your plan and then you can pay and get support direclty from your dashboard.

== Screenshots ==

1. Informazioni negozio
2. Stato di sistema del plugin
3. Shortcode della versione pro
4. Personalizza il checkout sfruttando le imposte

== Changelog ==

= 1.3.34 =

* [PRO]Fix: Improved support for latest YITH WooCommerce PDF Invoices & Packing Slips Premium plugin version

= 1.3.33 =

* [PRO]Fix: Other issues with PEC/SDI fields to show when they are mandatory without invoice but only for company or private
* [PRO]Fix: Improved PEC/SDI fields managements on checkout

= 1.3.32 =

* [PRO]Fix: Issues with PEC/SDI fields to show when they are mandatory without invoice

= 1.3.31 =

* Fix: Improved VAT/SSN mandatory field verification
* Enhancement: PointerPlus updated to new version
* Enhancement: Use Woocommerce Order CRUD to update meta data

= 1.3.30 =

* [PRO] Fix: VIES updated to new European API
* [PRO] Enhancement: CMB2 updated to new version

= 1.3.29 =

* [PRO] Fix: issues from last update

= 1.3.28 =

* [PRO] Fix: Compatibility with YITH Subscription for Order number

= 1.3.27 =

* Fix: Issues from last update

= 1.3.26 =

* Fix: Last pointer close button was misplaced
* Enhancement: Support for Ajax checkout

= 1.3.25 =

* [PRO]Enhancement: user fields detection for alerts

= 1.3.24 =

* [PRO]Fix: support for Osterreich VAT is working now

= 1.3.23 =

* Enhancement: Inserted documentation links in the settings

= 1.3.22 =

* Enhancement: New plugin branding and documentation

= 1.3.21 =

* Enhancement: Improved text strings
* Fix: Confilicts with other plugins

= 1.3.20 =

* [PRO]Enhancement: Improved PEC/SDI fields labels
* Enhancement: Improved profile editing fields alerts

= 1.3.19 =

* [PRO]Enhancement: Improved Italian VAt detection for VIES

= 1.3.18 =

* [PRO]Enhancement: New filter `woofisco_required_by_tax` to customize the values to show pec/sdi

= 1.3.17 =

* [PRO]Fix: Emails now contains PEC/SDI

= 1.3.16 =

* [PRO]Fix: Rewritten the syste to disable the tax based by type of user

= 1.3.15 =

* Fix: Hide VAT/SSN better hiding based on settings and checkbox

= 1.3.14 =

* Fix: Hide VAT/SSN fixed when is not configured

= 1.3.13 =

* Fix: Hide VAT fixed when is not Italy and Mandatory SSN is not enabled

= 1.3.12 =

* Fix: Save VAT also when CF is mandatory

= 1.3.11 =

* [PRO] Fix: PEC/SDI are showed rightly when switching between private/company
*
= 1.3.10 =

* [PRO] Fix: If PEC/SDI are showed without asking for invoice and no specific company/private they was hidden
*
= 1.3.9 =

* [PRO] Fix: Hide PEC/SDA fields if company/private are not checked

= 1.3.8 =

* [PRO] Fix: Better PEC/SDI detection on checkout
*
= 1.3.7 =

* [PRO] Fix: Better PEC/SDI detection on checkout for validation

= 1.3.6 =

* [PRO] Enhancements: Show PEC/SDI fields without asking for invoice
* [PRO] Enhancements: Show PEC/SDI fields if company type is selected

= 1.3.5 =

* Enhancements: Removed the mandatory fields for PEC

= 1.3.4 =

* Fix: On checkout there was issue with auto show the VAT/SSN fields

= 1.3.3 =

* Fix: Integration of the filter of the previous version

= 1.3.2 =

* [PRO] Feature: New option to disable the VAT/SSN fields
* Enhancement: New filter `woofisco_checkout_ask_invoice_default` to define a default value for the Ask Invoice field

= 1.3.1 =

* Fix: Avoid notices on some payments during checkout process

= 1.3.0 =

* Enhancement: Adding more Cap of Italian islands
* [PRO] Feature: Disable the tax on supplements with an option
* Improvements: Fixed internal tests

= 1.2.32 =
* Fix: Fatal errors and other issues with GDPR

= 1.2.31 =
* Enhancement: Updated Freemius SDK to improve multisite support

= 1.2.30 =
* [PRO] Fix: Removed another error if no custom taxes are added

= 1.2.29 =
* [PRO] Fix: Removed error if no custom taxes are added
* Enhancement: Mark PEC for italians as mandatory if they want the invoice

= 1.2.28 =
* [PRO] Fix: Removed undefined on generating new invoices
* Feature: Ask for PEC/SDI to customers that want the invoice and Italian

= 1.2.27 =
* Enhancement: CMB2 included is updated to latest version
* [PRO]: Option to show only the SSN field for all the users

= 1.2.26 =
* Fix: Validation on Account Details wasn't working

= 1.2.25 =
* Enhancement: Italian language updated in the bundle
* Enhancement: Removed support for WooCommerce 2.7

= 1.2.24 =
* Enhancement: Added support in case of only Italy as country available on checkout

= 1.2.23 =
* Enhancement: New VAT detection system

= 1.2.22 =
* Enhancement: Freemius SDK updated

= 1.2.21 =
* Enhancement: Added support for GDPR on export/erase data

= 1.2.20 =
* [PRO] Fix: Better alignment on Terms PDF of data

= 1.2.19 =
* [PRO] Fix: on creating invoice from backend and custom order numbers
* [PRO] Enhancement: No print on PDF invoices CF/PIVA if they are not available
* Enhancement: No print on Email CF/PIVA if they are not available

= 1.2.18 =
* Fix: on creating invoice from backend

= 1.2.17 =
* Fix: Registration issue
* Fix: Error on ask invoice

= 1.2.16 =
* Fix: JS missing on registration
* Fix: Order data are not saved

= 1.2.15 =
* [PRO] Fix: JS error on checkout
* [PRO] Fix: Order data are not saved
* Updated: Freemius SDK

= 1.2.14 =
* Improvements: New code for detect SSN
* Improvements: Removed an internal library unused
* Updated: CMB2 updated

= 1.2.13 =
* Improvements: On the registration features of the plugin
* Support: WooCommerce 3.2 supported
* Improvements: Few unit tests improved

= 1.2.12 =
* Enhancement: Code improvements in quality
* [PRO] Fix; WPO PDF has a bug with specific payments so the invoice was attached also if disabled

= 1.2.11 =
* Fix: For free version there was an issue on VAT validation

= 1.2.10 =
* Fix: Support for Italian company SSN

= 1.2.9 =
* Fix: Fix on check of data
* [PRO] Fix: In few cases the data in the order was empty

= 1.2.8 =
* Fix: Rewritten all the system for check the fields on checkout
* Fix: All the javascript code on checkout now is external js files

= 1.2.7 =
* [PRO] Fix: New flag and filter `woofisco_disable_tax` to disable taxes by type of user

= 1.2.6 =
* Fix: On non-logged users the fields of SSN/VAT was visible
* [PRO] Fix: Italian language updated

= 1.2.5 =
* [PRO] Fix: Wrong vat and ssn on guest orders
* [PRO] Fix: Frontend with tax field based configuration was ignored

= 1.2.4 =
* [PRO] Fix: Wrong order number when the previous one wasn't without invoice
* Enhancement: Added `woofisco_private_label`, `woofisco_company_label`, `woofisco_arecompany_label` filters

= 1.2.3 =
* [PRO] Fix: For WooCommerce PDF Invoices & Packing Slips on credit notes
* [PRO] Fix: Few fixes for WooCommerce PDF Invoices & Packing Slips
* Feature: New filter `woofisco_checkout_pvtazd_default` to force the user by code on checkout as default
* Fix: Few fixes for WooCommerce 3

= 1.2.2 =
* [PRO] Fix: Hide VAT when Ask invoice is not enable by the user

= 1.2.1 =
* [PRO] Feature: Option to not attach terms and conditions to all the emails
* [PRO] Fix: Hide VAT when Ask invoice is not enable by the user
* [PRO] Fix: Don't change order number if user doesn't ask for the invoice

= 1.2.0 =
* [PRO] Feature: Tax settings for ask to the user SSN and/or VAT based by Tax and if is private or company
* Feature: Add Review remainder after few days of using the plugin

= 1.1.16 =
* One year of WooCommerce Fiscalità Italiana!
* Fix: Support for change country in checkout
* Fix: Internal fix for unit tests
* Feature: Ask VAT only to italian customers

= 1.1.15 =
* Fix: Registration ask for ssn also if disabled
* [PRO] Fix: Better support on guest orders on PDF invoices
* [PRO] Fix: Better support for WC 3 on order export

= 1.1.14 =
* Improvement: Better support for guest user on Order
* Feature: Change VAT and SSN of the Order

= 1.1.13 =
* [PRO] Feature; Settings to disable sequential order for invoice
* [PRO] Feature: Settings for SSN and VAT as mandatory for all the users

= 1.1.12 =
* Fix: Improved behaviour with guest orders
* Improvement: Better support for WooCommerce 3
* Update: Freemius

= 1.1.11 =
* Enhancement: Better UI for data on order emails
* Enhancement: Support for WooCommerce 3.0

= 1.1.10 =
* Fix: Support for guest user
* Fix: Various bugfix
* [PRO] Fix: Not add empty tax in the checkout

= 1.1.9 =
* Enhancement: New alert for tax system not enabled
* Enhancement: New non-mandatory alert for extract of tax on the cart/checkout
* [PRO] Fix: validation for VAT also on italian
* [PRO] Fix: SSN not required if the user not ask an invoice and the setting 'Show SSN field only for italian customers' is on
* [PRO] Enhancement: Improved support for WPO WCPDF Pro for ask invoice

= 1.1.8 =
* Fix: on user registration on my-account and checkout
* Fix: system check for guest users was not working right
* [PRO] Fix: disable credit notes if invoice not required

= 1.1.7 =
* [PRO] Fix for asking invoice on checkout
* [PRO] Fix Sequential Number is resetted every year
* Few internal fixes

= 1.1.6 =
* [PRO] Block generation of PDF invoice based from user/site needs
* [PRO] Bulk export of orders from actions
* Firsts code improvements with unit tests

= 1.1.5 =
* [PRO] Bugfix on asking VAT and invoice
* Improvements SSN validation
* Firsts code improvements with unit tests

= 1.1.4 =
* [PRO] Ask for invoice during the checkout setting
* [PRO] Order exporter contain the Shipping Method Name
* Fix PDF plugin detection
* Improvements in the code itself with new comments
* Improvements on VAT and SSN missing, now report if they are missing in the order backend

= 1.1.3 =
* [PRO] Custom Fixed Tax in orders
* [PRO] Ask for invoice during the checkout setting
* [PRO] Order exporter contain the Shipping Method Name
* Fix wrong behaviour when a user doesn't set Italian as country on checkout
* Fix PDF plugin detection
* Improvement Private or Company in checkout are inline
* Improvements in the code itself with new comments
* Improvements on VAT and SSN missing, now report if they are missing in the order backend

= 1.1.2 =
* [PRO] Few little fix in the exporter
* New check in Status monitor about the guest users

= 1.1.1 =
* [PRO] Few little fix in the exporter
* Improved check for Fiscal Code
* Fix for VAT and Fiscal Code on orders

= 1.1.0 =
* [PRO] Exporter of single order as CSV
* Field for VAT and SSN on the user profile in administration
* Little bugfixies

= 1.0.3 =
* Bug Fix on backend for missing Fiscal Code
* Code improvements
* Little bugfixies

= 1.0.2 =
* Bug Fix of multisite detection
* Improved validation of Fiscal Code and VAT
* Little bugfixies

= 1.0.1 =
* Fix translation loading
* Better Admin Settings View
* Minor fixes

= 1.0.0 =
* First public release
