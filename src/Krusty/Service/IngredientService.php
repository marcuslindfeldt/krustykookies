<?php
namespace Krusty\Service;

use \Krusty\Model\Ingredient,
	\Krusty\Model\Mapper\IngredientMapper;

class IngredientService extends AbstractService
{
	public function fetchIngredients()
	{
		$mapper = $this->getMapper();
		$result = $mapper->fetchAll();
		return $this->createPaginator($result);
	}

	public function refillIngredient($data)
	{
		$ingredient = $this->getModel();
		$ingredient->fromArray($data);
		return $this->getMapper()->update($ingredient);
	}
}