<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Ingredient,
\Krusty\Model\Mapper\AbstractMapper;

class IngredientMapper extends AbstractMapper
{
	
	// return a collection of ingredients
	public function fetchAll()
	{
		$sql = 'SELECT * FROM Ingredients';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		
		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Ingredient");

	}

	public function update(Ingredient $i)
	{
		$sql  = 'UPDATE Ingredients ';
		$sql .= 'SET quantity = quantity + :quantity ';
		$sql .= 'WHERE ingredient = :ingredient';

		$db = $this->getAdapter();
		$stmt = $db->prepare($sql);
		
		$result = $stmt->execute($i->toArray(array(
             'quantity', 'ingredient')));
		return ($result) ? $i : null;
	}
}