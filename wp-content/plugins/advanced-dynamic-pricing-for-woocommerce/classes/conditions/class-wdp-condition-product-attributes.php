<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class WDP_Condition_Product_Attributes extends WDP_Condition_Cart_Items_Abstract {
	protected $filter_type = 'product_attributes';
}