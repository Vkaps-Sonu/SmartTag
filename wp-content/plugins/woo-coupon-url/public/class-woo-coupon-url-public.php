<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://personaldiscount.io
 * @since      1.0.0
 *
 * @package    Woo_Coupon_Url
 * @subpackage Woo_Coupon_Url/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woo_Coupon_Url
 * @subpackage Woo_Coupon_Url/public
 * @author     PersonalDiscount <conact@personaldicount.io>
 */
class Woo_Coupon_Url_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Coupon_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Coupon_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woo-coupon-url-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Woo_Coupon_Url_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woo_Coupon_Url_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woo-coupon-url-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Stores coupon code from URL query param in the session. 
	 *
	 * Based on LoicTheAztec's answer on Stack Overflow:
	 * https://stackoverflow.com/questions/48220205/get-a-coupon-code-via-url-and-apply-it-in-woocommerce-checkout-page/48225502
	 */
	public function capture_coupon_code() {
		$param_name = 'coupon';
		if( ! isset($_GET[$param_name]) ) {
			return;
		}
		
		$coupon_code = esc_attr( $_GET[$param_name] );

		if ( ! WC()->session->has_session() ) {
			WC()->session->set_customer_session_cookie( true );
		}
		
		WC()->session->set( 'coupon_code', $coupon_code ); // store the coupon code in session
	}

	public function add_discout_to_cart() {
		$coupon_code = WC()->session->get('coupon_code');

		if ( ! empty( $coupon_code ) && ! WC()->cart->has_discount( $coupon_code ) ){
			WC()->cart->add_discount( $coupon_code ); // apply the coupon discount
			WC()->session->__unset('coupon_code'); // remove coupon code from session
		}
	}
	

}
