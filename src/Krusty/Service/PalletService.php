<?php
namespace Krusty\Service;

use \Krusty\Model\ProducedPallet,
	\Krusty\Model\Mapper\PalletMapper;

class PalletService
{
	private $mapper;

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