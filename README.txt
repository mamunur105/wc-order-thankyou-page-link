=== Order Thank You Page Link ===

Contributors: mamunur105
Donate link:
Tags: Elementor, Woocommerce Builder, Elementor Woocommerce Builder, Woocommerce, Woocommerce Product
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

WooCommerce Thank You Page Link and Custom Order Columns Plugin

== Description ==
This plugin adds a "Thank You Page Link" column to the WooCommerce orders table in the WordPress dashboard. It allows users to directly access the "Thank You" page for a particular order from the WooCommerce admin panel. The functionality is built in a class-based, singleton structure with WooCommerce HPOS (High-Performance Order Storage) compatibility.

== Features ==
- Adds a custom "Thank You Page Link" column to the WooCommerce Orders table.
- Displays a link to the "Thank You" page for each order directly in the WooCommerce admin.
- Supports WooCommerce HPOS (High-Performance Order Storage).
- Yoda condition comparisons for improved code consistency.
- Object-oriented, singleton pattern for better code organization and scalability.

== Installation ==
1. Upload the plugin files to the /wp-content/plugins/ directory, or install the plugin through the WordPress Plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. No further configuration is needed. The "Thank You Page Link" column will automatically appear in the WooCommerce Orders table in the WordPress admin.

== Usage ==
1. After installing and activating the plugin, go to **WooCommerce > Orders** in the WordPress admin dashboard.
2. You will see a new "Thank You Page Link" column in the orders table.
3. Click the "Visit Thank You Page" link for any order to be redirected to that order’s Thank You page.

== Code Structure ==
- **Main Class**: `WCOTP_Thank_You_Page_Link`
- **Singleton Pattern**: Ensures only one instance of the class is created.
- **WooCommerce Hooks**:
  - `woocommerce_order_item_add_action_buttons`: Adds the "Thank You" page link in the admin order actions.
  - `manage_edit-shop_order_columns`: Adds a custom column in the orders table.
  - `manage_shop_order_posts_custom_column`: Displays the "Thank You" page link in the custom column.
  - HPOS-compatible hooks for WooCommerce Orders Page.

== Custom Columns ==
- **Column Key**: `thankyou`
- **Column Value**: Displays a clickable link to the order's Thank You page.

== Compatibility ==
- **WooCommerce**: Tested with WooCommerce version 7.0 and above.
- **WordPress**: Requires WordPress version 5.8 or higher.
- **HPOS**: Fully compatible with WooCommerce’s High-Performance Order Storage (HPOS).

== Changelog ==
### 1.0.0
- Initial release with core functionality.
