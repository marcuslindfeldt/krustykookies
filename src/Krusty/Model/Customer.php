<?php
namespace Krusty\Model;

class Customer
{
	private $name;

	private $address;

	public function setName($name)
	{
		if(!is_string($name)) {
			throw new \InvalidArgumentException();
		}

		$this->name = $name;
		return $this;
	}

	public function setAddress($addr)
	{
		if(!is_string($addr)) {
			throw new \InvalidArgumentException();
		}

		$this->address = $addr;
		return $this;
	}

	public function toArray()
	{
		$arr=array();
		$arr['name']=$name;
		$arr['address']=$address;
		return $arr;
	}

	public function toJson()
	{
		return json_encode($this->toArray());
	}
}