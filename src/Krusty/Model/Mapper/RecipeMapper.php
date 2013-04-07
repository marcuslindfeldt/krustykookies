<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Recipe,
	\Krusty\Model\Cookie,
	\Krusty\Model\Mapper\AbstractMapper;

class RecipeMapper extends AbstractMapper
{
	public function fetch($cookie)
	{
		$db = $this->getAdapter();
		$sql = 'SELECT ingredient, quantity FROM recipes WHERE cookie = :cookie';
		$stmt = $db->prepare($sql);
		$stmt->execute(array('cookie' => $cookie));
		$ingredients = $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
		$recipe = new Recipe()	;
		$recipe->name = $cookie;
		$recipe->ingredients = $ingredients;
		return $recipe;

	}

	public function save(Recipe $r)
	{

		// cookie table sql
		$query1 = 'INSERT INTO cookies VALUES (:name, :desc)';
		// recipe table sql
		$query2 = 'INSERT INTO recipes VALUES (:cookie, :ingredient, :quantity)';

		$db = $this->getAdapter();

		try{
			$db->beginTransaction();

			$stmt = $db->prepare($query1);
			$stmt->execute(array('name' => $r->cookie->name,
								 'desc' => $r->cookie->description));
			
			$stmt = $db->prepare($query2);
			
			foreach($r->ingredients as $ingredient => $quantity){
				$stmt->execute(array(
					'cookie' => $r->cookie->name,
					'ingredient' => $ingredient,
					'quantity' => $quantity
				));
			}
			return $db->commit();
		}catch (\Exception $e){
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}
	}

	public function update(Recipe $r)
	{
		$sql  = 'UPDATE recipes SET quantity = :quantity ';
		$sql .= 'WHERE cookie = :cookie AND ingredient = :ingredient';

		$db = $this->getAdapter();

		try{
			$db->beginTransaction();
			
			$stmt = $db->prepare($sql);
			
			foreach($r->ingredients as $ingredient => $quantity){
				$stmt->execute(array(
					'cookie' => $r->cookie->name,
					'ingredient' => $ingredient,
					'quantity' => $quantity
				));
			}
			return $db->commit();
		}catch (\Exception $e){
			$db->rollBack();
			throw new \Exception($e->getMessage());
		}
	}
}