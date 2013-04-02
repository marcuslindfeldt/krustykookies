<?php

namespace Krusty\Model;

class ProducedPallet extends AbstractModel
{
	public $pallet_id;
	public $order_id;
	public $block_id;
	public $cookie;
	public $produced;
	public $customer;
	public $delivered;
	

	public function getStatus()
	{
		if(!is_null($this->delivered)){
			return array(
				'label' => 'success',
				'title' => 'Delivered'
			);
		}else if(!is_null($this->block_id)){
			return array(
				'label' => 'important',
				'title' => 'Blocked'
			);
		}else{
			return array(
				'label' => 'info',
				'title' => 'In storage'
			);
		}
	}
}