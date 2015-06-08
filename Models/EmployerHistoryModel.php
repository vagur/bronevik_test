<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 08.06.15
 * Time: 15:49
 */

class EmployerHistoryModel extends Model {

    protected $_table = 'employers_history';
    protected $_pkey = 'id';


    protected $_filedsLabel = [
        "employer_id" => "ID сотрдника",
        "version" => "Версия изменений",
        "lastname" => "Фамилия",
        "firstname" => "Имя",
        "pname" => "Отчество",
        "jobtitle" => "Должность",
        "gender" => "Пол",
        "birthdate" => "Дата рождения",
        "passport" => "Паспорт",
        "phone" => "Телефон",
        "email" => "E-mail"
    ];



}