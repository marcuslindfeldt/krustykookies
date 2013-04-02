<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Ingredient extends AbstractModel
{
	public $ingredient;
	public $quantity;
	public $description;
	public $modified;
	public $lastAddition;
}