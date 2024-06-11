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
