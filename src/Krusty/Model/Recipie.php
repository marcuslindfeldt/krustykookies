<?php

namespace Krusty\Model;

class Recipie
{
	public $name;
	public $ingredients;

	public function fromArray(array $data)
	{
		$attrs = get_object_vars($this);

		foreach ($data as $key => $value) {
			if(array_key_exists($key, $attrs)){
				$this->$key = $value;
			}
		}

		$this->ingredients = array_filter($this->ingredients, function($quantity){
			return $quantity > 0;
		});
	}
}