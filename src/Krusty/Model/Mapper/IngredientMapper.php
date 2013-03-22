<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Ingredient,
\Krusty\Model\Mapper\AbstractMapper;

class IngredientMapper extends AbstractMapper
{
	
	// Should return an ingredient object
	public function fetch($ingredient = null)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT * FROM Ingredients';
		if($ingredient === null) {
			return $db->query($sql)->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Ingredient");
		}
		
		$stmt = $db->prepare($sql . ' WHERE ingredient = :ingredient');
		
		$stmt->execute(['ingredient' => $ingredient]);
		return $stmt->fetchAll(\PDO::FETCH_CLASS, "\Krusty\Model\Ingredient");

	}
}