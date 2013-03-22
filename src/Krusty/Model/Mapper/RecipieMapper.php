<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Recipie,
	\Krusty\Model\Cookie,
	\Krusty\Model\Mapper\AbstractMapper;

class RecipieMapper extends AbstractMapper
{
	public function fetchRecipie($cookie)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT ingredient, quantity FROM Recipies WHERE cookie = :cookie';
		$stmt = $db->prepare($sql);
		$stmt->execute(array('cookie' => $cookie));
		$ingredients = $stmt->fetchAll(\PDO::FETCH_ASSOC);

		if(count($ingredients) > 0){
			$recipie = new Recipie();
			$recipie->name = $cookie;
			$recipie->ingredients = $ingredients;
			return $recipie;
		}
		return null;
	}
}