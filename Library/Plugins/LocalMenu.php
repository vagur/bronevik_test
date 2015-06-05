<?php
/****************************************************
 * Тестовое задание для оценки уроовня владения PHP *
 *                                                  *
 * @author    Антон Прибора                         *
 * @copyright Bronevik.com                          *
 ****************************************************/

class LocalMenu extends Plugin
{
	protected $_menuList = [];
	
	public function add($html)
	{
		$this->_menuList[] = $html;
	}
}