=== MSecurity ===
Contributors: MSecurity Lab Pvt. Ltd.
Tags: security, antivirus, api, products, woocommerce, msecurity, partner
Requires at least: 4.6
Tested up to: 6.5.4
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A comprehensive security plugin for MSecurity Partners to sell antivirus products through WooCommerce.

== Description ==

MSecurity is a comprehensive security plugin designed for MSecurity Partners who want to sell antivirus products through their WooCommerce-enabled WordPress websites. The plugin integrates with the MSecurity API to allow partners to import products, display balance, and manage licenses directly from the WordPress admin panel.

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/msecurity` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Make sure you have WooCommerce installed and activated.
4. Use the Settings -> MSecurity screen to configure the plugin.

== Frequently Asked Questions ==

= How do I get my API keys? =

You can obtain your API keys by registering for a partner account on the MSecurity website. Choose your currency and set the user type to "Partner".

= How do I import products? =

After configuring your API keys and commission percentage, go to the MSecurity settings page and click the 'Import Products' button. The plugin will import the products from the MSecurity API.

= What happens if the API keys are incorrect? =

If the API keys are incorrect, the plugin will display an error message. Please ensure your API keys are correct.

= How do I manage licenses? =

The plugin automatically handles the purchase of licenses when an order is marked as completed. The license key will be displayed in the order details.

== Screenshots ==

1. The settings page where you can configure your API keys and commission percentage.
2. The dashboard widget displaying your MSecurity balance.
3. The import products button in the settings page.

== Changelog ==

= 1.0 =
* Initial release of MSecurity plugin.

== Upgrade Notice ==

= 1.0 =
* Initial release of MSecurity plugin.

== Configuration ==

1. Go to Settings -> MSecurity.
2. Enter your X-API-SECRET-KEY and X-API-PUBLIC-KEY.
3. Set the commission percentage.
4. Click 'Save Changes'.
5. Click 'Import Products' to import the products from MSecurity.

== Features ==

* Import products from MSecurity API.
* Display balance in the WordPress admin dashboard.
* Manage licenses directly from the order page.
* Seamless integration with WooCommerce.

== License ==

This plugin is licensed under the GPLv2 or later.

MSecurity WordPress Plugin
==========================

Overview
--------

The MSecurity WordPress Plugin allows MSecurity partners to sell antivirus products through their WordPress websites using the WooCommerce plugin. This plugin integrates MSecurity services into WooCommerce, enabling automatic product setup, license purchasing, and product management.

Features
--------

- Import MSecurity products into WooCommerce
- Automatically set up products as soon as the first payment is received
- Purchase licenses automatically upon order payment
- Display license keys on the user's order page
- Manage commission percentages for products

Requirements
------------

- WordPress 5.0 or later
- WooCommerce 4.0 or later
- MSecurity partner account with API credentials

Installation
------------

1. **Download the Plugin**

   Download the plugin files and extract them to your WordPress installation directory.

2. **Upload Files**

   Ensure the following directory structure in your WordPress installation:

   wp-content/
   └── plugins/
       └── msecurity/
           ├── msecurity.php
           ├── includes/
           │   ├── functions.php
           │   └── api.php
           ├── assets/
           │   └── admin-style.css
           └── templates/
               └── admin-settings.php

3. **Activate the Plugin**

   - Log in to your WordPress admin area.
   - Navigate to Plugins > Installed Plugins.
   - Find MSecurity and click the Activate button.

4. **Configure the Plugin**

   - Navigate to MSecurity > Settings.
   - Enter your X-API-SECRET-KEY, X-API-PUBLIC-KEY, and Commission Percentage.
   - Click Save Changes.

Usage
-----

1. **Import Products**

   - Navigate to MSecurity > Settings.
   - Click the Import Products button to import products from MSecurity.

2. **Place an Order**

   - Customers can place an order for any MSecurity product.
   - Upon successful payment, the product will be automatically set up, and the license will be purchased from MSecurity.
   - The license key will be displayed on the user's order page under Order Details.

Video Tutorial
--------------

For a video tutorial on how to import products automatically, please watch [this video](https://msecurity.app/download/whmcs1.mp4).

Get Partner Account (Developer)
-------------------------------

To get API KEYS, please follow [this link](https://msecurity.app/auth/register) and register a new account as a Partner.

Troubleshooting
---------------

- Ensure your API keys are correctly configured.
- Check that the product SKU matches the SKU in MSecurity.
- Verify that the autosetup field is set to payment for automatic setup upon payment.

Support
-------

For support, please contact contact@msecurity.app or visit https://msecurity.app.

License
-------

This plugin is licensed under the GPLv2 or later.

Author: MSecurity Lab Pvt. Ltd.
Version: 1.0
