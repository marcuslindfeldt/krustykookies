<?php
namespace Krusty\Service;

use \Krusty\Model\Blocked,
	\Krusty\Model\Mapper\BlockedMapper;

class BlockedService extends AbstractService
{
	public function fetchBlocked()
	{
		return $this->getMapper()->fetchAll();
	}

	public function block(array $data) 
	{
		$mapper = $this->getMapper();
		$model = $this->getModel();

		//validate end date
		$date = explode('-', $data['end']);
		if(count($date) != 3 || 
		   !checkdate($date[1], $date[2], $date[0])) 
		{
			return false;
		}

		$model->fromArray($data);
		
		return $mapper->block($model);
	}

	public function unblock($blocked_id)
	{
		//validate post data
		if (!intval($blocked_id)) {
			throw new Exception('Invalid input.');
		}

		return $this->getMapper()->unblock($blocked_id);
	}
}