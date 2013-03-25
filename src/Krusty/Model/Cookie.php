<?php
namespace Krusty\Model;

class Cookie
{
	public $cookie;
	public $description;

	public function getDescription()
	{
		return (empty($this->description)) ? 'N/A' : $this->description; 
	}

	public function getId()
	{
		return urlencode($this->cookie);
	}
}