<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Blocked,
\Krusty\Model\Mapper\AbstractMapper;

class BlockedMapper extends AbstractMapper
{

	public function fetchUpcoming()
	{
		$sql  = 'SELECT * FROM Blocked WHERE CURDATE() < start ORDER BY end DESC';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}

	public function fetchActive()
	{
		$sql  = 'SELECT * FROM Blocked WHERE CURDATE() BETWEEN start AND end ORDER BY cookie';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}

	public function fetchPrevious()
	{
		$sql  = 'SELECT * FROM Blocked WHERE CURDATE() > end ORDER BY end DESC';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}

	public function block(Blocked $block)
	{
		$sql  = 'INSERT INTO Blocked ';
		$sql .= 'VALUES (NULL, :cookie, :start, :end)';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		$result = $stmt->execute(array(
			'cookie' => $block->cookie, 
			'start' => $block->start,
			'end' => $block->end
		));

		return ($result) ? $block : false;
	}
}