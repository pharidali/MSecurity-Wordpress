<?php
/**
 * MSecurity
 *
 * @package       MSECURITY
 * @author        MSecurity Lab Pvt. Ltd.
 * @version       1.0.8
 *
 * @wordpress-plugin
 * Plugin Name:   MSecurity
 * Description:   Start Selling the most powerful Antivirus in the planet. 
 * Version:       1.0.8
 * Author:        MSecurity Lab Pvt. Ltd.
 * Author URI:    https://msecurity.app
 * Text Domain:   msecurity
 * Domain Path:   /languages
 */

 
 // Exit if accessed directly
 if ( ! defined( 'ABSPATH' ) ) {
     exit;
 }
 
 // Add settings page
 function msecurity_add_admin_menu() {
     add_options_page(
         'MSecurity Settings',
         'MSecurity',
         'manage_options',
         'msecurity',
         'msecurity_options_page'
     );
 }
 add_action( 'admin_menu', 'msecurity_add_admin_menu' );
 
 // Settings page callback
 function msecurity_options_page() {
     $options = get_option('msecurity_options');
     $commission_set = isset($options['msecurity_commission_percentage']) && !empty($options['msecurity_commission_percentage']);
     ?>
     <div class="wrap">
         <h1>MSecurity Settings</h1>
         <form action="options.php" method="post" id="msecurity-settings-form">
             <?php
             settings_fields('msecurity_options');
             do_settings_sections('msecurity');
             submit_button();
             ?>
         </form>
         <div class="msecurity-extra-actions">
             <button onclick="window.location.href='https://msecurity.app/auth/register'" class="button button-secondary">Get Partner Account</button>
             <p>When registering, choose your currency and set the user type to "Partner".</p>
         </div>
         <style>
             #msecurity-settings-form {
                 background: #fff;
                 padding: 20px;
                 box-shadow: 0 1px 3px rgba(0,0,0,0.1);
                 transition: transform 0.3s ease-in-out;
             }
             #msecurity-settings-form:hover {
                 transform: scale(1.02);
             }
             .wrap h1 {
                 margin-bottom: 20px;
             }
             .msecurity-extra-actions {
                 margin-top: 20px;
             }
             .msecurity-extra-actions .button {
                 margin-right: 10px;
             }
             .msecurity-extra-actions p {
                 margin-top: 10px;
                 color: #0073aa;
             }
             .msecurity-import-notice {
                 color: #ff0000;
                 margin-top: 10px;
             }
             #msecurity-import-loading {
                 display: none;
                 margin-top: 10px;
                 color: #0073aa;
             }
         </style>
         <?php if (!$commission_set): ?>
             <div class="msecurity-import-notice">
                 <strong>Note:</strong> Please set the commission percentage to enable product import.
             </div>
         <?php endif; ?>
         <div id="msecurity-import-loading">Importing products, please wait...</div>
     </div>
     <?php
 }
 
 // Register settings
 function msecurity_settings_init() {
     register_setting('msecurity_options', 'msecurity_options');
 
     add_settings_section(
         'msecurity_section_api',
         __('API Settings', 'msecurity'),
         'msecurity_settings_section_callback',
         'msecurity'
     );
 
     add_settings_field(
         'msecurity_api_secret_key',
         __('X-API-SECRET-KEY', 'msecurity'),
         'msecurity_api_secret_key_render',
         'msecurity',
         'msecurity_section_api'
     );
 
     add_settings_field(
         'msecurity_api_public_key',
         __('X-API-PUBLIC-KEY', 'msecurity'),
         'msecurity_api_public_key_render',
         'msecurity',
         'msecurity_section_api'
     );
 
     add_settings_field(
         'msecurity_commission_percentage',
         __('Commission Percentage', 'msecurity'),
         'msecurity_commission_percentage_render',
         'msecurity',
         'msecurity_section_api'
     );
 
     add_settings_section(
         'msecurity_section_import',
         __('Import Products', 'msecurity'),
         'msecurity_import_section_callback',
         'msecurity'
     );
 
     add_settings_field(
         'msecurity_import_products',
         __('Import Products', 'msecurity'),
         'msecurity_import_products_render',
         'msecurity',
         'msecurity_section_import'
     );
 }
 add_action('admin_init', 'msecurity_settings_init');
 
 // Settings section callback
 function msecurity_settings_section_callback() {
     echo __('Enter your API keys and commission percentage below.', 'msecurity');
 }
 
 function msecurity_import_section_callback() {
     echo __('Import products from MSecurity API.', 'msecurity');
 }
 
 // Render API Secret Key field
 function msecurity_api_secret_key_render() {
     $options = get_option('msecurity_options');
     ?>
     <input type='text' name='msecurity_options[msecurity_api_secret_key]' value='<?php echo $options['msecurity_api_secret_key']; ?>'>
     <?php
 }
 
 // Render API Public Key field
 function msecurity_api_public_key_render() {
     $options = get_option('msecurity_options');
     ?>
     <input type='text' name='msecurity_options[msecurity_api_public_key]' value='<?php echo $options['msecurity_api_public_key']; ?>'>
     <?php
 }
 
 // Render Commission Percentage field
 function msecurity_commission_percentage_render() {
     $options = get_option('msecurity_options');
     ?>
     <input type='number' name='msecurity_options[msecurity_commission_percentage]' value='<?php echo isset($options['msecurity_commission_percentage']) ? $options['msecurity_commission_percentage'] : ''; ?>' step='0.01'>
     <?php
 }
 
 // Render Import Products button
 function msecurity_import_products_render() {
     $options = get_option('msecurity_options');
     $commission_set = isset($options['msecurity_commission_percentage']) && !empty($options['msecurity_commission_percentage']);
     ?>
     <button type="button" id="msecurity-import-products" class="button button-primary" <?php echo !$commission_set ? 'disabled' : ''; ?>>Import Products</button>
     <div id="msecurity-import-response"></div>
     <script>
         jQuery(document).ready(function($) {
             $('#msecurity-import-products').click(function() {
                 $(this).prop('disabled', true);
                 $('#msecurity-import-loading').show();
                 $.post(ajaxurl, {action: 'msecurity_import_products'}, function(response) {
                     $('#msecurity-import-response').html(response);
                     $('#msecurity-import-products').prop('disabled', false);
                     $('#msecurity-import-loading').hide();
                 });
             });
         });
     </script>
     <?php
 }
 
 // AJAX handler for importing products
 function msecurity_import_products() {
     $options = get_option('msecurity_options');
     $secret_key = $options['msecurity_api_secret_key'];
     $public_key = $options['msecurity_api_public_key'];
     $commission_percentage = isset($options['msecurity_commission_percentage']) ? floatval($options['msecurity_commission_percentage']) : 0;
 
     $response = wp_remote_get('https://msecurity.app/api/v3/services', array(
         'headers' => array(
             'X-API-SECRET-KEY' => $secret_key,
             'X-API-PUBLIC-KEY' => $public_key
         )
     ));
 
     if (is_wp_error($response)) {
         echo 'Error: ' . $response->get_error_message();
     } else {
         $body = wp_remote_retrieve_body($response);
         $data = json_decode($body, true);
         if ($data['success']) {
             foreach ($data['platform'] as $service) {
                 $cost = $service['cost'];
                 if ($commission_percentage > 0) {
                     $cost += ($cost * $commission_percentage / 100);
                 }
 
                 // Check if product with SKU already exists
                 $product_id = wc_get_product_id_by_sku($service['sku']);
                 if ($product_id) {
                     // Update existing product
                     wp_update_post(array(
                         'ID' => $product_id,
                         'post_title' => $service['title'],
                         'post_content' => implode("\n", json_decode($service['description'], true))
                     ));
                 } else {
                     // Insert new product
                     $product_id = wp_insert_post(array(
                         'post_title' => $service['title'],
                         'post_content' => implode("\n", json_decode($service['description'], true)),
                         'post_status' => 'publish',
                         'post_type' => 'product'
                     ));
                 }
 
                 if ($product_id) {
                     wp_set_object_terms($product_id, 'simple', 'product_type');
                     update_post_meta($product_id, '_regular_price', $cost);
                     update_post_meta($product_id, '_price', $cost); // Ensure price is set
                     update_post_meta($product_id, '_sku', $service['sku']);
                     update_post_meta($product_id, '_virtual', 'no');
                     update_post_meta($product_id, '_downloadable', 'yes');
                     update_post_meta($product_id, '_stock_status', 'instock');
 
                     // Set the product image
                     $image_url = $service['image'];
                     $image_id = msecurity_upload_image($image_url);
                     if ($image_id) {
                         set_post_thumbnail($product_id, $image_id);
                     }
                 }
             }
             echo 'Products imported successfully.';
         } else {
             echo 'Unable to import products.';
         }
     }
 
     wp_die();
 }
 add_action('wp_ajax_msecurity_import_products', 'msecurity_import_products');
 
 // Function to upload image from URL
 function msecurity_upload_image($image_url) {
     require_once(ABSPATH . 'wp-admin/includes/file.php');
     require_once(ABSPATH . 'wp-admin/includes/media.php');
     require_once(ABSPATH . 'wp-admin/includes/image.php');
 
     $tmp = download_url($image_url);
     if (is_wp_error($tmp)) {
         return false;
     }
 
     $file = array(
         'name'     => basename($image_url),
         'type'     => mime_content_type($tmp),
         'tmp_name' => $tmp,
         'error'    => 0,
         'size'     => filesize($tmp),
     );
 
     $sideload = wp_handle_sideload($file, array('test_form' => false));
     if (isset($sideload['error'])) {
         return false;
     }
 
     $attachment_id = wp_insert_attachment(array(
         'guid'           => $sideload['url'],
         'post_mime_type' => $sideload['type'],
         'post_title'     => sanitize_file_name($sideload['file']),
         'post_content'   => '',
         'post_status'    => 'inherit',
     ), $sideload['file']);
 
     if (is_wp_error($attachment_id)) {
         return false;
     }
 
     require_once(ABSPATH . 'wp-admin/includes/image.php');
     $attach_data = wp_generate_attachment_metadata($attachment_id, $sideload['file']);
     wp_update_attachment_metadata($attachment_id, $attach_data);
 
     return $attachment_id;
 }
 
 // Add dashboard widget
 function msecurity_add_dashboard_widget() {
     wp_add_dashboard_widget(
         'msecurity_dashboard_widget',
         'MSecurity Balance',
         'msecurity_dashboard_widget_render'
     );
 
     // Move our widget to the top
     global $wp_meta_boxes;
 
     $dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
     $widget_backup = array('msecurity_dashboard_widget' => $dashboard['msecurity_dashboard_widget']);
     unset($dashboard['msecurity_dashboard_widget']);
     $sorted_dashboard = array_merge($widget_backup, $dashboard);
     $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
 }
 add_action('wp_dashboard_setup', 'msecurity_add_dashboard_widget');
 
 // Render dashboard widget
 function msecurity_dashboard_widget_render() {
     $options = get_option('msecurity_options');
     $secret_key = $options['msecurity_api_secret_key'];
     $public_key = $options['msecurity_api_public_key'];
 
     $response = wp_remote_get('https://msecurity.app/api/v3/balance', array(
         'headers' => array(
             'X-API-SECRET-KEY' => $secret_key,
             'X-API-PUBLIC-KEY' => $public_key
         )
     ));
 
     if (is_wp_error($response)) {
         echo 'Error: ' . $response->get_error_message();
     } else {
         $body = wp_remote_retrieve_body($response);
         $data = json_decode($body, true);
         if (isset($data['balance'])) {
             echo '<div class="msecurity-balance-widget"><h2>Balance: ' . $data['balance'] . '</h2></div>';
         } else {
             echo 'Unable to retrieve balance.';
         }
     }
     ?>
     <button onclick="window.location.href='https://msecurity.app/auth/login'" class="button button-secondary">Deposit Balance</button>
     <style>
         .msecurity-balance-widget {
             padding: 20px;
             background: #0073aa;
             color: #fff;
             border-radius: 8px;
             text-align: center;
             margin-bottom: 10px;
         }
         .msecurity-balance-widget h2 {
             margin: 0;
         }
         .button.button-secondary {
             background: #ffba00;
             color: #fff;
             border: none;
             padding: 10px 20px;
             cursor: pointer;
             text-align: center;
             display: inline-block;
             border-radius: 5px;
             transition: background 0.3s ease-in-out;
         }
         .button.button-secondary:hover {
             background: #e6a700;
         }
     </style>
     <?php
 }
 
 // Purchase product
 function msecurity_purchase_product($email, $sku, $reference) {
     $options = get_option('msecurity_options');
     $secret_key = $options['msecurity_api_secret_key'];
     $public_key = $options['msecurity_api_public_key'];
 
     // Check balance first
     $balance_response = wp_remote_get('https://msecurity.app/api/v3/balance', array(
         'headers' => array(
             'X-API-SECRET-KEY' => $secret_key,
             'X-API-PUBLIC-KEY' => $public_key
         )
     ));
 
     if (is_wp_error($balance_response)) {
         return array('error' => 'Error: ' . $balance_response->get_error_message());
     } else {
         $balance_body = wp_remote_retrieve_body($balance_response);
         $balance_data = json_decode($balance_body, true);
         if (isset($balance_data['balance']) && $balance_data['balance'] > 0) {
             // Proceed to purchase
             $purchase_response = wp_remote_post('https://msecurity.app/api/v3/services/buy/mail', array(
                 'headers' => array(
                     'X-API-SECRET-KEY' => $secret_key,
                     'X-API-PUBLIC-KEY' => $public_key,
                     'Content-Type' => 'application/json'
                 ),
                 'body' => json_encode(array(
                     'email' => $email,
                     'sku' => $sku,
                     'reference' => $reference
                 ))
             ));
 
             if (is_wp_error($purchase_response)) {
                 return array('error' => 'Error: ' . $purchase_response->get_error_message());
             } else {
                 $purchase_body = wp_remote_retrieve_body($purchase_response);
                 $purchase_data = json_decode($purchase_body, true);
                 if (isset($purchase_data['message']) && $purchase_data['message'] === 'License purchased successfully.') {
                     return array('success' => true, 'message' => $purchase_data['message'], 'license' => $purchase_data['license']);
                 } else {
                     return array('error' => 'Unable to purchase product.');
                 }
             }
         } else {
             return array('error' => 'Insufficient balance. Please recharge your account.');
         }
     }
 }
 
 // Add custom order meta for license key
 function msecurity_add_license_key_to_order($order_id, $email, $sku, $reference) {
     $purchase_response = msecurity_purchase_product($email, $sku, $reference);
 
     if (isset($purchase_response['success'])) {
         $order = wc_get_order($order_id);
         $order->add_order_note('License Key: ' . $purchase_response['license']);
         update_post_meta($order_id, '_license_key', $purchase_response['license']);
     } else {
         // Handle error
         $order = wc_get_order($order_id);
         $order->add_order_note('Error: ' . $purchase_response['error']);
         $order->update_status('pending', 'Error: ' . $purchase_response['error']);
     }
 }
 
 // Display license key on user's order page
 function msecurity_display_license_key_in_order($order_id) {
     $license_key = get_post_meta($order_id, '_license_key', true);
     if ($license_key) {
         echo '<p><strong>' . __('License Key') . ':</strong> ' . $license_key . '</p>';
     }
 }
 add_action('woocommerce_order_details_after_order_table', 'msecurity_display_license_key_in_order');
 
 // Display license key on order page
 function msecurity_display_license_key_in_order_meta($order) {
     $license_key = get_post_meta($order->get_id(), '_license_key', true);
     if ($license_key) {
         echo '<p><strong>' . __('License Key') . ':</strong> ' . $license_key . '</p>';
     }
 }
 add_action('woocommerce_admin_order_data_after_order_details', 'msecurity_display_license_key_in_order_meta');
 
 // Hook into WooCommerce order processing
 function msecurity_process_woocommerce_order($order_id) {
     $order = wc_get_order($order_id);
 
     if ($order->get_status() === 'completed') {
         $items = $order->get_items();
 
         foreach ($items as $item) {
             $product_id = $item->get_product_id();
             $product = wc_get_product($product_id);
             $sku = $product->get_sku();
             $email = $order->get_billing_email();
             $reference = uniqid('ms_');
 
             $purchase_response = msecurity_add_license_key_to_order($order_id, $email, $sku, $reference);
 
             if (isset($purchase_response['error'])) {
                 $order->update_status('pending', 'Error: ' . $purchase_response['error']);
             }
         }
     }
 }
 add_action('woocommerce_order_status_completed', 'msecurity_process_woocommerce_order');
 