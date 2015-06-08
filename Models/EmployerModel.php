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


    /**
     * @return array
     */
    public function all()
    {
        $stm = $this->_db->query('SELECT * FROM '.$this->_table.' WHERE deleted=0');
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        return $this->update($id, ['deleted'=>1]);
    }


}