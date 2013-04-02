<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Customer,
	\Krusty\Model\Mapper\AbstractMapper;

class CustomerMapper extends AbstractMapper
{
	public function save(Customer $c)
	{
		throw new \Exception('Not implemented.');
	}

	public function delete(Customer $c)
	{
		throw new \Exception('Not implemented.');
	}

	// return collection of customers
	public function fetchAll()
	{
		$sql = 'SELECT * FROM Customers';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Customer");
	}
}