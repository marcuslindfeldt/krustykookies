<?php
namespace Krusty\Service;

use \Krusty\Model\Order,
	\Krusty\Model\Mapper\OrderMapper;

class OrderService extends AbstractService
{
	public function fetchOrders($id = null)
	{
		$mapper = $this->getMapper();

		return (is_null($id))
			 ? $mapper->fetchAll()
			 : $mapper->fetch($id);
	}

	public function putOrder(array $data)
	{
		$mapper = $this->getMapper();
		$order = $this->getModel();

		//validate input..
		$order->fromArray($data);

		if (!$order->hasOrderedPallets()) {
			throw new \Exception('Minimum order is 1 pallet');
		}

		return $mapper->save($order);
	}

	public function deliverOrder($id)
	{
		$mapper = $this->getMapper();
		$order = $this->getModel();

		//validate input..
		
		$order->order_id = $id;

		return $mapper->deliver($order);
	}

	public function deleteOrder($data)
	{
		$mapper = $this->getMapper();
		$order = $this->getModel();

		//validate input..

		return $mapper->delete($order->fromArray($data));
	}
}