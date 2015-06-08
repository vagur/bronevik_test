<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 05.06.15
 * Time: 0:56
 */

abstract class Model {

    protected $_table;
    protected $_pkey;
    protected $_filedsLabel=[];
    protected $_fieldsRules=[];

    /**
     *
     * @var PDO
     */
    protected $_db = null;

    public function __construct()
    {
        $this->_db = Registry::get('db');
    }

    /**
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        $stm = $this->_db->query('SELECT * FROM '.$this->_table.' WHERE '.$this->_pkey.' = '.$id);
        $result = $stm->fetch(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;

    }

    /**
     * @return array
     */
    public function all()
    {
        $stm = $this->_db->query('SELECT * FROM '.$this->_table);
        $result = $stm->fetchAll(PDO::FETCH_ASSOC);
        $stm->closeCursor();
        return $result;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function create(Array $data)
    {
        $sql = 'INSERT INTO '.$this->_table.' SET ';
        $upd=[];
        foreach($data as $field=>$value) {
            $upd[]=$field.'=:'.$field;
            $values[':'.$field]=$value;
        }
        $sql.=join(',', $upd);

        $stm  = $this->_db->prepare($sql);


        if($stm->execute($values)){
            $id = $this->_db->lastInsertId();
            $this->afterCreate($id, $data);
            return $id;
        } else {
            return false;
        }

    }

    /**
     * @param $key - Primary key of row
     * @param array $data
     * @return bool
     */
    public function update($key, Array $data){
        $sql = 'UPDATE '.$this->_table.' SET ';
        $upd=[];
        $values = [':key'=>$key];
        foreach($data as $field=>$value) {
            $upd[]=$field.'=:'.$field;
            $values[':'.$field]=$value;
        }
        $sql.=join(',', $upd);

        $sql.=' WHERE '.$this->_pkey.'=:key';
        $stm  = $this->_db->prepare($sql);

        $this->afterUpade($key, $data);

        return $stm->execute($values);

    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $stm = $this->_db->query('DELETE FROM '.$this->_table.' WHERE '.$this->_pkey.' = '.$id);
        $result = $stm->execute();
        $stm->closeCursor();
        $this->afterDelete($id);
        return $result;
    }

    /**
     * @param $field
     * @return mixed
     */
    public function getFieldLable($field){
        return $this->_filedsLabel[$field];
    }

    /**
     * @param $field
     * @return bool
     */
    public function isFieldDefined($field) {
        return isset($this->_filedsLabel[$field]);
    }

    /**
     * @return array
     */
    public function getFields(){
        $result=[];
        foreach($this->_filedsLabel as $name=>$lable) $result[]=$name;
        return $result;
    }

    /**
     * @return mixed
     */
    public function getPKey()
    {
        return $this->_pkey;
    }

    public function getRules()
    {
        return $this->_fieldsRules;
    }


    public function afterUpade($key, Array $data){

    }

    public function afterDelete($key){

    }

    public function afterCreate($key, Array $data){

    }

}