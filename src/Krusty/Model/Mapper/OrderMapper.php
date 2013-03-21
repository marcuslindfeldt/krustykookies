<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Order,
\Krusty\Model\Mapper\AbstractMapper;

class OrderMapper extends AbstractMapper
{
	//sets the order with order id $id to delivered=1, does not check the input
	public function setDelivered($id){
		
	}
	//Adds a new order, does not check for foregin key constraint or check the input
	public function save($id, $customer, $deadline)
	{
		try {
			$db = $this->getAdapter();
			$stmt = $db->prepare('INSERT INTO Orders VALUES(:id, :customer, :deadline, null)');
			$stmtArray=array();
			$stmtArray['id']=$id;
			$stmtArray['customer']=$customer;
			$stmtArray['deadline']=$deadline;
			$stmt->execute($stmtArray);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	//Deletes an order with the specific id
	public function delete($id)
	{
		try {
			$db = $this->getAdapter();
			$stmt = $db->prepare('DELETE FROM Orders WHERE order_id = :id');
			$stmtArray=array();
			$stmtArray['id']=$id;
			$stmt->execute($stmtArray);
			return true;
		} catch (Exception $e) {
			return false;
		}
	}

	// Should return an order object that contains a Customer object
	public function fetch($id = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Orders';
		if($id === null) {
			return $db->query($sql)->fetchAll();
		}
		$stmt = $db->prepare($sql . ' WHERE order_id = :id');
		$stmtArray=array();
		$stmtArray['id']=$id;
		$stmt->execute($stmtArray);
		return $stmt->fetchAll();
	}
}