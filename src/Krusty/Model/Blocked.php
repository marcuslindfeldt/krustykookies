<?php
namespace Krusty\Model;

use \Krusty\Model\AbstractModel;

class Blocked extends AbstractModel
{
	public $blocked_id;
	public $cookie;
	public $start;
	public $end;
}