<?php

namespace Krusty\Model;
/**
* Abstract model with some utility methods
*/
abstract class AbstractModel implements \JsonSerializable
{
	
	public function fromArray(array $data)
	{
		$attrs = get_object_vars($this);

		foreach ($data as $key => $value) {
			if(array_key_exists($key, $attrs)){
				$this->$key = $value;
			}
		}
		return $this;
	}

	public function toArray()
	{
		return get_object_vars($this);	
	}

	public function jsonSerialize()
	{
		return $this->toArray();
	}
}