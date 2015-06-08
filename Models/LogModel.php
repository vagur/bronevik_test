<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 08.06.15
 * Time: 15:48
 */

class LogModel extends Model {

    protected $_table = 'log';
    protected $_pkey = 'id';

    const OPERATION_CREATE = 'C';
    const OPERATION_UPDATE = 'U';
    const OPERATION_DELETE = 'D';

    public function all()
    {

        $stm = $this->_db->query('SELECT '.$this->_table.'.id as version, type, DATE_FORMAT(dtime, "%d.%m.%Y %T") as dt, employers.* FROM '.$this->_table.' INNER JOIN employers ON (employers.id='.$this->_table.'.employer_id) ORDER BY '.$this->_table.'.dtime DESC');
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    }

    public function allByEmployer($id)
    {
        $stm = $this->_db->query('SELECT '.$this->_table.'.id as version, type, DATE_FORMAT(dtime, "%d.%m.%Y %T") as dt, employers.* FROM '.$this->_table.' INNER JOIN employers ON (employers.id='.$this->_table.'.employer_id) WHERE '.$this->_table.'.employer_id='.$id.' ORDER BY '.$this->_table.'.dtime DESC');
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;

    }

    public function getFirstVersion($emloyerId)
    {
        $employerModel = new EmployerModel();

        $stm = $this->_db->query("SELECT * FROM employers_history WHERE employer_id=$emloyerId ORDER BY version ASC LIMIT 0,1");
        $fv = $stm->fetchAll(PDO::FETCH_ASSOC)[0];
        $fv['id']=$fv['employer_id'];
        $res=[];
        foreach($employerModel->getFields() as $field) {
            $res[] = $employerModel->getFieldLable($field).": ".$fv[$field];
        }

        return $res;

    }

    public function getChanges($emloyerId, $version)
    {

        $employerModel = new EmployerModel();

        $stm = $this->_db->query("SELECT * FROM employers_history WHERE employer_id=$emloyerId AND version = $version ORDER BY version DESC LIMIT 0,1");
        $cur = $stm->fetchAll(PDO::FETCH_ASSOC)[0];

        $stm = $this->_db->query("SELECT * FROM employers_history WHERE employer_id=$emloyerId AND version < $version ORDER BY version DESC LIMIT 0,1");
        $prev = $stm->fetchAll(PDO::FETCH_ASSOC)[0];

        $diff = array_diff($cur, $prev);
        unset($diff['id']);
        unset($diff['version']);

        $res = [];
        foreach($diff as $field=>$val){
            $res[] = 'Изменено поле '.$employerModel->getFieldLable($field).'. Старое значение '.$prev[$field].'. Новое значение '.$val;
        }

        return $res;

    }

}