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

	public function putOrder(Order $order)
	{
		throw new \Exception('Not implemented.');
	}

	public function deleteOrder(Order $order)
	{
		throw new \Exception('Not implemented.');
	}
}