<?php
namespace Krusty\Service;

use \Krusty\Model\Customer,
	\Krusty\Model\Mapper\CustomerMapper;

class CustomerService extends AbstractService
{
	public function fetchCustomers()
	{
		return $this->getMapper()->fetchAll();
	}

	public function addCustomer(Customer $Customer)
	{
		throw new \Exception('Not implemented.');
	}

	public function deleteCustomer(Customer $Customer)
	{
		throw new \Exception('Not implemented.');
	}
}