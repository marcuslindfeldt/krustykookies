<?php
namespace Krusty\Service;

use \Krusty\Model\Ingredient,
	\Krusty\Model\Mapper\IngredientMapper;

class IngredientService extends AbstractService
{
	public function fetchIngredients($options = null)
	{
		$mapper = $this->getMapper();
		$result = $mapper->fetchAll();
		return $this->createPaginator($result);
	}

	public function addIngredient($data)
	{
		throw new \Exception('Not implemented.');
	}
}