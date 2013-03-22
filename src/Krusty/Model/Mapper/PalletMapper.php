<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\ProducedPallet,
	\Krusty\Model\Mapper\AbstractMapper;

class PalletMapper extends AbstractMapper
{
	public function fetchProducedPallets()
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM ProducedPallets WHERE cookie = :cookie';
		$stmt = $db->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(\PDO::FETCH_CLASS, '\Krusty\Model\ProducedPallet');
	}
}