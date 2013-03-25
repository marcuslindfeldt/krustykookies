<?php

namespace Krusty\Model;

class Order
{
	public $order_id;
	public $customer;
	public $deadline;
	public $delivered;

	public function test()
	{
		return $customer;
	}
	public function toArray()
	{
		return get_object_vars(this);
	}
}