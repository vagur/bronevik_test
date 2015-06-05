<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 05.06.15
 * Time: 0:30
 */

class EmployerModel extends Model {

    protected $_table = 'employers';
    protected $_pkey = 'id';

    protected $_filedsLabel = [
        "id" => "ID",
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

    protected $_fieldsRules = [
        [['lastname', 'firstname', 'pname', 'jobtitle', 'passport', 'phone', 'email'], 'required'],
        [['lastname', 'firstname', 'pname', 'jobtitle', 'email'], 'string', 'max'=>255],
        [['passport', 'phone'], 'string', 'max'=>10],
        [['email'], 'email']
    ];



}