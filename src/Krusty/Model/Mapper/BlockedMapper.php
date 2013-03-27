<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Blocked,
\Krusty\Model\Mapper\AbstractMapper;

class BlockedMapper extends AbstractMapper
{
	//fetch all blocks
	public function fetch($blocked_id = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Blocked';
		if($blocked_id === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
		}
		$stmt = $db->prepare($sql . ' WHERE blocked_id = :blocked_id');
		$stmt->execute(array('blocked_id' => $blocked_id));
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}

	public function block(Blocked $block)
	{
		try {
			$db = $this->getAdapter();
			$sql = 'INSERT INTO Blocked VALUES(NULL, :cookie, CURDATE(), :end)';
			$stmt = $db->prepare($sql);
			return $stmt->execute(array(
				'cookie' => $block->cookie, 
				'end' => $block->end
			));
		}catch (\Exception $e){
			return null;
		}
	}

	public function unblock($blocked_id){
		try {
			if($blocked_id != null){
				$db = $this->getAdapter();
				$sql = 'DELETE FROM Blocked ';
				$stmt = $db->prepare($sql . 'where blocked_id=:blocked_id');
				return $stmt->execute(array('blocked_id' => $blocked_id));
			}
		}catch (\Exception $e){
			return null;
		}
	}
}