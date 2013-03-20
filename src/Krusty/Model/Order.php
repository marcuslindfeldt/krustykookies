<?php

namespace Krusty\Model;

use Krusty\Model\Customer;

class Order
{
	private $id;
	private $customer;

	public function toArray()
	{
		$arr=array();
		$arr['id']=$id;
		$arr['customer']=$customer;
		return $arr;
	}

	public function toJson()
	{
		# code...
	}

}