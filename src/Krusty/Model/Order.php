<?php

namespace Krusty\Model;

use Krusty\Model\Customer;

class Order
{
	private $id;
	private $customer;

	public function toArray()
	{
		return ['id'    => $id,
				'customer' => $customer];
	}

	public function toJson()
	{
		# code...
	}

}