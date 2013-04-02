<?php

namespace Krusty\Model;

class ProducedPallet extends AbstractModel
{
	public $pallet_id;
	public $order_id;
	public $cookie;
	public $produced;
	public $customer;
	
	public function isDelivered()
	{
// 		return (empty($this->description)) ? 'N/A' : $this->description;
	}
	
	public function getCustomer()
	{
// 		return (empty($this->description)) ? 'N/A' : $this->description;
	}
	
	public function getLocation()
	{
		// 		return (empty($this->description)) ? 'N/A' : $this->description;
	}
}