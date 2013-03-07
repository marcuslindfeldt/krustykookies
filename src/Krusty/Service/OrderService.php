<?php
namespace Krusty\Service;

use \Krusty\Model\Order,
	\Krusty\Model\Mapper\OrderMapper;

class OrderService
{
	private $model;
	private $mapper;

	public function fetchOrders($id = null)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($id);
	}

	public function putOrder(Order $order)
	{
		$order = $this->getModel();
		//init order mapper
		//let mapper put order in the db
		//return status
	}

	public function deleteOrder(Order $order)
	{
		# code...
	}

	/**
	 * Lazy load model
	 * @return Order the model
	 */
	public function getModel()
	{
		if(is_null($model)) {
			$this->model = new Order();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new OrderMapper();
		}
		return $this->mapper;
	}
}