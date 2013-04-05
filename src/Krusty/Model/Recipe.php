<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Recipe extends AbstractModel
{
	public $cookie;
	public $ingredients;

	public function fromArray(array $data)
	{
		parent::fromArray($data);

		//filter empty ingredients
		$this->ingredients = array_filter($this->ingredients, function($quantity){
			return $quantity > 0;
		});
		return $this;
	}
}