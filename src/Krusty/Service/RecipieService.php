<?php
namespace Krusty\Service;

use \Krusty\Model\Recipie,
	\Krusty\Model\Mapper\RecipieMapper;

class RecipieService
{
	private $model;
	private $mapper;

	public function fetchRecipie($cookie)
	{
		$mapper = $this->getMapper();
		//validate $cookie
		return $mapper->fetch($cookie);
	}

	public function addRecipie(array $data)
	{
		$mapper = $this->getMapper();
		$model = $this->getModel();
		//validate post data..

		//build model
		$model->fromArray($data);
		return $mapper->save($model);
	}

	/**
	 * Lazy load model
	 * @return Customer the model
	 */
	public function getModel()
	{
		if(is_null($this->model)) {
			$this->model = new Recipie();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new RecipieMapper();
		}
		return $this->mapper;
	}
}