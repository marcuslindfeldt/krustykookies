<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Customer,
	\Krusty\Model\Mapper\AbstractMapper;

class CustomerMapper extends AbstractMapper
{
	public function save(Customer $id)
	{
		# code...
	}

	public function delete($id)
	{
		# code...
	}

	// return customer or collection of customers
	public function fetch($id = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Customers';
		if($id === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Customer");
		}
		$stmt = $db->prepare($sql . ' WHERE order_id = :id');
		$stmt->execute(['id' => $id]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Customer");
	}
}