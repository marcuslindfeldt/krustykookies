<?php
namespace Krusty\Service;

use \Krusty\Model\ProducedPallet,
	\Krusty\Model\Order,
	\Krusty\Model\OrderedPallet,
	\Krusty\Model\Mapper\PalletMapper;

class PalletService extends AbstractService
{
	public function fetchPalletsForOrder(Order $order)
	{
		return $this->getMapper()->fetchPalletsForOrder($order);
	}

	public function fetchProducedPallets(array $filters=null)
	{
		$mapper = $this->getMapper();
		$result = $mapper->fetchProducedPallets($filters);

		return $this->createPaginator($result);
	}

	public function producePallets($data)
	{
		return $this->getMapper()->createPallets($data);
	}
}