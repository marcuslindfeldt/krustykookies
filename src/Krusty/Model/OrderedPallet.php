<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class OrderedPallet extends AbstractModel
{
	public $order_id;
	public $cookie;
	public $quantity;
	public $block_id;
}