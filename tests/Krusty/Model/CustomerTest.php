<?php
use Krusty\Model\Customer;

class CustomerTest extends PHPUnit_Framework_TestCase
{
	protected $c;

	protected function setUp()
	{
		$this->c = new Customer;
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetInvalidAddress()
	{
		$this->c->setAddress(2013);
	}

	/**
	 * @expectedException \InvalidArgumentException
	 */
	public function testSetInvalidName()
	{
		$this->c->setName(2013);
	}
}