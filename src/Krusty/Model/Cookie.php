<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Cookie extends AbstractModel
{
	public $name;
	public $description;
	public $block_id;
	public $in_store;
	public $selected;

	public function getDescription()
	{
		return (empty($this->description)) ? 'N/A' : $this->description; 
	}

	public function isBlocked()
	{
		return !is_null($this->block_id);
	}

	public function inStorage()
	{
		return !is_null($this->in_store);
	}

	public function getId()
	{
		return urlencode($this->name);
	}
}