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

	public function fetchProducedPallets($start=null, $end=null, $cookie=null)
	{
		
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM ProducedPallets left join Orders using(order_id)';
		if($start!=null&&$end!=null){
			$sql.=' where produced>=:start and produced<=:end';
			if($cookie!=null){
				$sql.=' and cookie=:cookie';
				$stmt = $db->prepare($sql);
				$stmt->execute(array('start' => $start, 'end' => $end, 'cookie' => $cookie));
			}else{
				$stmt = $db->prepare($sql);
				$stmt->execute(array('start' => $start, 'end' => $end));
			}
		}else{
			$stmt = $db->prepare($sql);
			$stmt->execute();
		}
		
// 		$sql = 'SELECT * FROM ProducedPallets';
		
		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\ProducedPallet');
	}

	// produce some new pallets
	public function createPallets($data)
		{
			throw new \Exception('Not implemented.');
		}	
}