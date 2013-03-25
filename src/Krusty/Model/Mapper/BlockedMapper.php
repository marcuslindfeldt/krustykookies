<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Blocked,
\Krusty\Model\Mapper\AbstractMapper;

class BlockedMapper extends AbstractMapper
{
	//fetch all blocks
	public function fetch($cookie = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Blocked';
		if($cookie === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
		}
		$stmt = $db->prepare($sql . ' WHERE cookie = :cookie');
		$stmt->execute(array('cookie' => $cookie));
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Blocked");
	}
	public function block($cookie, $end){
		try {
			if($cookie != null && $end!=null){
				$db = $this->getAdapter();
				$sql = 'INSERT INTO Blocked ';
				$start = date('Y-m-d H:i:s', strtotime('today midnight'));
				$stmt = $db->prepare($sql . 'values(:cookie, :start, :end)');
				return $stmt->execute(array('cookie' => $cookie, 'start'=> $start, 'end' => $end));
			}
		}catch (Exception $e){
			return 0;
		}
	}
	public function unblock($cookie, $start, $end){
		try {
			if($cookie != null && $end!=null){
				$db = $this->getAdapter();
				$sql = 'DELETE FROM Blocked ';
				$stmt = $db->prepare($sql . 'where cookie=:cookie and  start=:start and end=:end');
				return $stmt->execute(array('cookie' => $cookie, 'start'=> $start, 'end' => $end));
			}
		}catch (Exception $e){
			return 0;
		}
	}
}