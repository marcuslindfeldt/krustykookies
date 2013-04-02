<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Cookie extends AbstractModel
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