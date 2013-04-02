<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Order extends AbstractModel
{
	public $order_id;
	public $customer;
	public $deadline;
	public $delivered;
}