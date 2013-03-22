<?php
namespace Krusty\Service;

use \Krusty\Model\ProducedPallet,
	\Krusty\Model\Order,
	\Krusty\Model\OrderedPallet,
	\Krusty\Model\Mapper\PalletMapper;

class PalletService
{
	private $mapper;

	public function fetchOrderedPallets(Order $order)
	{
		$mapper = $this->getMapper();
		return $mapper->fetchOrderedPallets($order);
	}

	public function fetchProducedPallets()
	{
		$mapper = $this->getMapper();
		return $mapper->fetchProducedPallets();
	}


	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new PalletMapper();
		}
		return $this->mapper;
	}
}