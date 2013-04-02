<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Blocked,
\Krusty\Model\Mapper\AbstractMapper;

class BlockedMapper extends AbstractMapper
{
	//fetch all blocks
	public function fetchAll()
	{
		$sql  = 'SELECT * FROM Blocked';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}

	public function block(Blocked $block)
	{
		$sql  = 'INSERT INTO Blocked ';
		$sql .= 'VALUES (NULL, :cookie, CURDATE(), :end)';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$result = $stmt->execute(array(
			'cookie' => $block->cookie, 
			'end' => $block->end
		));

		return ($result) ? $block : false;
	}

	public function unblock($blocked_id)
	{
		$sql  = 'DELETE FROM Blocked ';
		$sql .= 'WHERE blocked_id=:blocked_id';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		return $stmt->execute(array(
			'blocked_id' => $blocked_id
		));
	}
}