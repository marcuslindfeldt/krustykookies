<?php

namespace Krusty\Model;

use Krusty\Model\Customer;

class Order
{
	private $order_id;
	private $customer;
	private $deadline;
		
	public function Order($id, $customer, $order_id){
		$this->order_id=$order_id;
		$this->customer=$customer;
		$this->deadline=$deadline;
	}
	
	public function toArray()
	{
		$arr=array();
		$arr['order_id']=$this->id;
		$arr['customer']=$this->customer;
		$arr['deadline']=$this->deadline;
		return $arr;
	}

	public function toJson()
	{
		return jason_encode($this->toArry());
	}

}