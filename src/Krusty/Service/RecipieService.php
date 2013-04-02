<?php
namespace Krusty\Service;

use \Krusty\Model\Recipie,
	\Krusty\Model\Mapper\RecipieMapper;

class RecipieService extends AbstractService
{
	public function fetchRecipie($cookie)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($cookie);
	}

	public function addRecipie(array $data)
	{
		$mapper = $this->getMapper();
		$model = $this->getModel();

		//validate post data..
		
		return $mapper->save($model->fromArray($data));
	}
}