<?php
namespace Krusty\Service;

use \Krusty\Model\Cookie,
	\Krusty\Model\Mapper\CookieMapper;

class CookieService
{
	private $model;
	private $mapper;

	public function fetchCookies($cookie = null)
	{
		$mapper = $this->getMapper();
		return $mapper->fetch($cookie);
	}

	public function addCookie(Cookie $cookie)
	{
		$cookie = $this->getModel();
	}

	public function deleteCookie(Cookie $cookie)
	{
		# code...
	}

	/**
	 * Lazy load model
	 * @return Order the model
	 */
	public function getModel()
	{
		if(is_null($model)) {
			$this->model = new Cookie();
		}
		return $this->model;
	}

	public function getMapper()
	{
		if(is_null($this->mapper)) {
			$this->mapper = new CookieMapper();
		}
		return $this->mapper;
	}
}