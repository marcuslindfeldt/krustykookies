<?php
namespace Krusty\Service;

use \Krusty\Model\Blocked,
	\Krusty\Model\Mapper\BlockedMapper;

class BlockedService extends AbstractService
{
	public function fetchPreviousBlocks()
	{
		return $this->getMapper()->fetchPrevious();
	}

	public function fetchUpcomingBlocks()
	{
		return $this->getMapper()->fetchUpcoming();
	}

	public function fetchActiveBlocks()
	{
		return $this->getMapper()->fetchActive();
	}

	public function block(array $data) 
	{
		$mapper = $this->getMapper();
		$model = $this->getModel();

		//filter
		$args = array(
			'start' => FILTER_SANITIZE_STRING,
			'end' => FILTER_SANITIZE_STRING,
			'cookie' => FILTER_SANITIZE_STRING,
		);
		$data = filter_var_array($data, $args);

		//validate
		if(count($data) != count(array_filter($data))){
			throw new \InvalidArgumentException('Required fields missing');
		}
		//regexp date
		//..

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