<?php
namespace Krusty\Service;

use \Krusty\Model\Cookie,
	\Krusty\Model\Mapper\CookieMapper;

class CookieService extends AbstractService
{
	public function fetchCookies($cookie = null)
	{
		$mapper = $this->getMapper();

		return (is_null($cookie))
			 ? $mapper->fetchAll()
			 : $mapper->fetch($cookie);
	}


	public function addCookie(Cookie $cookie)
	{
		throw new \Exception('Not implemented.');
	}

	public function deleteCookie(Cookie $cookie)
	{
		throw new \Exception('Not implemented.');
	}
}