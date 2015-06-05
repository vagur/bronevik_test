<?php
/****************************************************
 * Тестовое задание для оценки уроовня владения PHP *
 *                                                  *
 * @author    Антон Прибора                         *
 * @copyright Bronevik.com                          *
 ****************************************************/

class Bootstrap extends BootstrapAbstract
{
	protected function _initDb()
	{
		// Инициализация базы данных
		$pdo = new PDO('mysql:host=localhost;dbname=bt;charset=utf8', 'root', 'aeshoago');
		$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		
		Db::setDriver($pdo);
		
		Registry::set('db', Db::driver());
	}
}