<?php
/****************************************************
 * Тестовое задание для оценки уроовня владения PHP *
 *                                                  *
 * @author    Антон Прибора                         *
 * @copyright Bronevik.com                          *
 ****************************************************/

class HttpRequest extends Request
{
	protected $_baseUrl = null;
	
	public function __construct($params = null)
	{
		$this->_params = $_REQUEST;
		
		if ( is_array($params) )
			$this->setParams($params);
		
		$this->setBaseUrl(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
	}
	
	public function setBaseUrl($baseUrl)
	{
		$this->_baseUrl = $baseUrl;
	}
	
	public function getBaseUrl()
	{
		return $this->_baseUrl;
	}
}