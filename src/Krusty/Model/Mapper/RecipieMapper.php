<?php

namespace Krusty\Model\Mapper;

use \Krusty\Model\Recipie,
	\Krusty\Model\Cookie,
	\Krusty\Model\Mapper\AbstractMapper;

class RecipieMapper extends AbstractMapper
{
	public function fetch($cookie)
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

	public function save(Recipie $r)
	{

		var_dump($r);
		// cookie table sql
		$query1 = 'INSERT INTO Cookies VALUES (:name, :desc)';
		// recipie table sql
		$query2 = 'INSERT INTO Recipies VALUES (:cookie, :ingredient, :quantity)';

		$db = $this->getAdapter();
		$cookie = $r->name;
		
		try{
			$db->beginTransaction();

			$stmt = $db->prepare($query1);
			$stmt->execute(array('name' => $cookie,
								 'desc' => ''));
			
			$stmt = $db->prepare($query2);
			
			foreach($r->ingredients as $ingredient => $quantity){
				$stmt->execute(array(
					'cookie' => $cookie,
					'ingredient' => $ingredient,
					'quantity' => $quantity
				));
			}
			return $db->commit();
		}catch (\Exception $e){
			$db->rollBack();
			return false;
		}
	}
}