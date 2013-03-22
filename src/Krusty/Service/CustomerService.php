<?php
namespace Krusty\Service;

use \Krusty\Model\Customer,
	\Krusty\Model\Mapper\CustomerMapper;

class CustomerService
{
	private $model;
	private $mapper;

	public function fetchCustomers($id = null)
	{
		$mapper = $this->getMapper();

		// Validate id ..
		// See if data model is cached .. (Don't implement)
		// let data mapper fetch the data model
		return $mapper->fetch($id);
	}

	public function putCustomer(Customer $Customer)
	{
		$Customer = $this->getModel();
		//init Customer mapper
		//let mapper put Customer in the db
		//return status
	}

	public function deleteCustomer(Customer $Customer)
	{
		# code...
	}

	/**
	 * Lazy load model
	 * @return Customer the model
	 */
	public function getModel()
	{
		if(is_null($model)) {
			$this->model = new Customer();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new CustomerMapper();
		}
		return $this->mapper;
	}
}