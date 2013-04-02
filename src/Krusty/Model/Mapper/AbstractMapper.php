<?php
namespace Krusty\Model\Mapper;

use \Krusty\Model\DbAdapter;

abstract class AbstractMapper
{

	protected function getAdapter() {
		return DbAdapter::instance()->getAdapter();
	}
}