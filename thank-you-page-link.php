<?php
/**
 * @wordpress-plugin
 * Plugin Name:       Order Thank You Page Link
 * Plugin URI:        https://github.com/mamunur105/wc-order-thankyou-page-link
 * Description:       Boiler
 * Version:           0.0.1
 * Author:            Mamunur Rashid
 * Author URI:        https://github.com/mamunur105/
 * Text Domain:       thank-you
 * Domain Path:       /languages
 * License:           GPLv3
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.html
 * @package TinySolutions\mlt
 */


if ( ! class_exists( 'WCOTP_Thank_You_Page_Link' ) ) {

	class WCOTP_Thank_You_Page_Link {

		// The single instance of the class
		private static $instance = null;

		/**
		 * Ensures only one instance is loaded.
		 *
		 * @return WCOTP_Thank_You_Page_Link
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * Constructor method.
		 */
		private function __construct() {
			add_action( 'woocommerce_order_item_add_action_buttons', [ $this, 'thank_you_page_metabox_callback' ] );
			// Post Type Shop Order.
			add_filter( 'manage_edit-shop_order_columns', [ $this, 'add_custom_order_column' ] );
			add_action( 'manage_shop_order_posts_custom_column', [ $this, 'populate_custom_order_column' ], 10, 2 );
			// HPOS
			add_filter( 'manage_woocommerce_page_wc-orders_columns', [ $this, 'add_wc_order_list_custom_columns' ] );
			add_action( 'manage_woocommerce_page_wc-orders_custom_column', [ $this, 'display_wc_order_list_custom_column_content' ], 10, 2 );
		}

		/**
		 * Callback to display the thank you page link.
		 *
		 * @param WC_Order $order WooCommerce order object.
		 */
		public function thank_you_page_metabox_callback( $order ) {
			$order_id         = $order->get_id();
			$order_key        = $order->get_order_key();
			$thankYouPageLink = wc_get_checkout_url() . 'order-received/' . $order_id . '/?key=' . $order_key;

			echo '<a target="_blank" href="' . esc_url( $thankYouPageLink ) . '">Visit</a>';
		}

		/**
		 * Add a new custom column to the WooCommerce Orders Table.
		 *
		 * @param array $columns Existing columns.
		 * @return array Modified columns.
		 */
		public function add_custom_order_column( $columns ) {
			$new_columns = [];
			// Insert the new column before the 'actions' column.
			foreach ( $columns as $key => $column ) {
				$new_columns[ $key ] = $column;
				if ( 'order_number' === $key ) {
					$new_columns['thankyou'] = 'Thank You Page Link';
				}
			}

			return $new_columns;
		}

		/**
		 * Populate the custom column with data.
		 *
		 * @param string $column Column key.
		 * @param int    $post_id Post ID (Order ID).
		 */
		public function populate_custom_order_column( $column, $post_id ) {
			if ( 'thankyou' === $column ) {
				$order            = wc_get_order( $post_id );
				$order_id         = $order->get_id();
				$order_key        = $order->get_order_key();
				$thankYouPageLink = wc_get_checkout_url() . 'order-received/' . $order_id . '/?key=' . $order_key;
				echo '<a target="_blank" href="' . esc_url( $thankYouPageLink ) . '">Visit Thank You Page</a>';
			}
		}

		/**
		 * Add custom columns to WooCommerce orders table.
		 *
		 * @param array $columns Existing columns.
		 * @return array Modified columns.
		 */
		public function add_wc_order_list_custom_columns( $columns ) {
			$reordered_columns = [];
			// Insert custom columns after the "Status" column.
			foreach ( $columns as $key => $column ) {
				$reordered_columns[ $key ] = $column;
				if ( $key === 'order_number' ) {
					$reordered_columns['thankyou'] = __( 'Thank You Page Link', 'wcotp' );
				}
			}

			return $reordered_columns;
		}

		/**
		 * Display content for custom columns in WooCommerce orders table.
		 *
		 * @param string $column Column key.
		 * @param int    $order_id WooCommerce order ID.
		 */
		public function display_wc_order_list_custom_column_content( $column, $order ) {
			switch ( $column ) {
				case 'thankyou':
					$order_key        = $order->get_order_key();
                    $order_id         = $order->get_id();
					$thankYouPageLink = wc_get_checkout_url() . 'order-received/' . $order_id . '/?key=' . $order_key;
					echo '<a target="_blank" href="' . esc_url( $thankYouPageLink ) . '">Visit Thank You Page</a>';
					break;
			}
		}

	}

	// Initialize the singleton class.
	WCOTP_Thank_You_Page_Link::get_instance();
}
