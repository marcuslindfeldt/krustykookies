<?php
namespace Krusty\Service;

use \Krusty\Model\Blocked,
	\Krusty\Model\Mapper\BlockedMapper;

class BlockedService
{
	private $model;
	private $mapper;

	public function fetchBlocked($block_id = null)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($block_id);
	}
	public function block(array $data) {
		$mapper = $this->getMapper();
		$model = $this->getModel();
		var_dump( $data);
		//validate end date
		$date = explode('-', $data['end']);
		if(count($date) != 3 || 
		   !checkdate($date[1], $date[2], $date[0])) 
		{
			return false;
		}
		print 'woo';
		$model->fromArray($data);
		var_dump($model);
		return $mapper->block($model);
	}
	public function unblock($blocked_id){
		$mapper=$this->getMapper();
		return $mapper->unblock($blocked_id);
	}
	/**
	 * Lazy load model
	 * @return Order the model
	 */
	public function getModel()
	{
		if(is_null($this->model)) {
			$this->model = new Blocked();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new BlockedMapper();
		}
		return $this->mapper;
	}
}