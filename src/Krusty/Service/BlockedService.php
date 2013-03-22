<?php
namespace Krusty\Service;

use \Krusty\Model\Blocked,
	\Krusty\Model\Mapper\BlockedMapper;

class BlockedService
{
	private $model;
	private $mapper;

	public function fetchBlocked($cookie = null)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($cookie);
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