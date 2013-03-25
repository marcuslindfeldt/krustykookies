<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\ProducedPallet,
	\Krusty\Model\Order,
	\Krusty\Model\Mapper\AbstractMapper;

class PalletMapper extends AbstractMapper
{
	public function fetchOrderedPallets(Order $order)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM OrderedPallets WHERE order_id = :order_id';
		$stmt = $db->prepare($sql);
		$stmt->execute(array('order_id' => $order->order_id));
		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\OrderedPallet');
	}

	public function fetchProducedPallets()
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM ProducedPallets left join Orders using(order_id)';
// 		$sql = 'SELECT * FROM ProducedPallets';
		$stmt = $db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\ProducedPallet');
	}
}