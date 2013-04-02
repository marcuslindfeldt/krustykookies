<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Order extends AbstractModel
{
	public $order_id;
	public $customer;
	public $created;
	public $deadline;
	public $delivered;
	public $block_id;
	public $orderedPallets = array();

	public function hasOrderedPallets()
	{
		return count($this->orderedPallets) > 0;
	}

	public function fromArray(array $data)
	{
		parent::fromArray($data);
		if(isset($data['cookies']) && is_array($data['cookies'])){
			foreach (array_filter($data['cookies']) as $key => $value) {
				$orderedPallet = new OrderedPallet();
				$orderedPallet->order_id = $this->order_id;
				$orderedPallet->cookie = $key;
				$orderedPallet->quantity = $value;
				array_push($this->orderedPallets, $orderedPallet);
			}
		}
		return $this;
	}

	public function getStatus()
	{
		if(!is_null($this->delivered)){
			return array(
				'label' => 'success',
				'title' => 'Delivered'
			);
		}
		return array(
			'label' => 'info',
			'title' => 'proccessing'
		);
	}
}