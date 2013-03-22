<?php
namespace Krusty\Service;

use \Krusty\Model\Ingredient,
	\Krusty\Model\Mapper\IngredientMapper;

class IngredientService
{
	private $model;
	private $mapper;

	public function fetchIngredients($ingredient)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($ingredient);
	}

	/**
	 * Lazy load model
	 * @return Order the model
	 */
	public function getModel()
	{
		if(is_null($model)) {
			$this->model = new Ingredient();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new IngredientMapper();
		}
		return $this->mapper;
	}
}