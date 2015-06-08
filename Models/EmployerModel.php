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

        $sql = 'UPDATE '.$this->_table.' SET deleted = 1 WHERE '.$this->_pkey.'=:key';
        $stm  = $this->_db->prepare($sql);
        $res = $stm->execute([':key'=>$id]);
        $this->afterDelete($id);
        return $res;
    }

    private function createOrUpdateLog($version, $key, $data) {
        $verModel = new EmployerHistoryModel();
        unset($data['id']);
        $data['version'] = $version;
        $data['employer_id'] = $key;
        $verModel->create($data);

    }

    public function afterUpade($key, Array $data)
    {
        $log = new LogModel();
        $version = $log->create([
            "type" => LogModel::OPERATION_UPDATE,
            "employer_id" => $key,
            "dtime" => date('Y-m-d H:i:s')
        ]);

        $this->createOrUpdateLog($version, $key, $data);
    }

    public function afterDelete($key)
    {

        $log = new LogModel();
        $log->create([
            "type" => LogModel::OPERATION_DELETE,
            "employer_id" => $key,
            "dtime" => date('Y-m-d H:i:s')
        ]);
    }

    public function afterCreate($key, Array $data){

        $log = new LogModel();
        $version = $log->create([
            "type" => LogModel::OPERATION_CREATE,
            "employer_id" => $key,
            "dtime" => date('Y-m-d H:i:s')

        ]);
        $this->createOrUpdateLog($version, $key, $data);
    }

}