<?php
namespace Krusty\Service;

use \Krusty\Model\Ingredient,
	\Krusty\Model\Mapper\IngredientMapper,
	\Pagerfanta\Pagerfanta,
	\Pagerfanta\Adapter\ArrayAdapter;

/**
* Abstract Service
*/
abstract class AbstractService
{
	protected $page;
	protected $mapper;
	protected $model;
	
	function __construct(array $options = null)
	{
		if (!is_null($options)) {
			$this->setOptions($options);
		}		
	}

	public function setOptions(array $options)
	{
		$attrs = get_object_vars($this);

		foreach ($options as $key => $value) {
			if(array_key_exists($key, $attrs)){
				$this->$key = $value;
			}
		}
	}

	public function getModel()
	{
		if(is_null($this->model)) {
			$name  = '\\Krusty\\Model\\';
			$name .= $this->getName();
			$this->model = new $name();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$name  = '\\Krusty\\Model\\Mapper\\';
			$name .= $this->getName() . 'Mapper';
			$this->mapper = new $name();
		}
		return $this->mapper;
	}

	protected function getName(){
		$class = preg_replace("/.+\\\\/", '', get_class($this));
		return strstr($class, 'Service', true);
	}

	protected function createPaginator($data)
	{
		$paginator = new Pagerfanta(new ArrayAdapter($data));
		$paginator->setMaxPerPage(10);
		if(isset($this->page))
			$paginator->setCurrentPage($this->page);
		return $paginator;
	}
}