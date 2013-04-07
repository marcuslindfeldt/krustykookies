<?php
namespace Krusty\Service;

use \Krusty\Model\Recipe,
	\Krusty\Model\Cookie,
	\Krusty\Model\Mapper\RecipeMapper;

class RecipeService extends AbstractService
{
	public function fetchRecipe($cookie)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($cookie);
	}

	public function editRecipe($name, array $data)
	{
		$mapper = $this->getMapper();
		$recipe = $this->getModel();

		$cookie = new Cookie;
		$cookie->name = $name;

		$recipe->fromArray($data);
		$recipe->cookie = $cookie;

		//validate post data
		// ...
		
		return $mapper->update($recipe);
	}

	public function addRecipe(array $data)
	{
		$mapper = $this->getMapper();
		$recipe = $this->getModel();
		$cookie = new Cookie;

		$cookie->fromArray($data);
		$recipe->fromArray($data);
		$recipe->cookie = $cookie;

		//validate post data
		// ...
		
		return $mapper->save($recipe);
	}
}