<?php

namespace WPDesk\ShopMagic\Placeholder\Builtin\Order;

use WPDesk\ShopMagic\Placeholder\Builtin\WooCommerceOrderBasedPlaceholder;


final class OrderShippingCity extends WooCommerceOrderBasedPlaceholder {


	public static function get_slug() {
		return parent::get_slug() . '.shipping_city';
	}

	/**
	 * @param \WC_Order $order
	 * @param array $parameters
	 *
	 * @return string
	 */
	public function value( $order, array $parameters ) {
		return $order->get_shipping_city();
	}
}
