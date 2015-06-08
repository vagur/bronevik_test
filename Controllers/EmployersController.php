<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 04.06.15
 * Time: 23:58
 */

class EmployersController extends ActionController
{
    public function _init()
    {
        $this->_layout->LocalMenu->add('<a href="/employers/create/">Добавить сотрудника</a>');
        //$this->_layout->LocalMenu->add('<a href="/employers/log/">История изменений</a>');
        $this->model = new EmployerModel();

    }

    public function IndexAction()
    {
        $this->_view->model = $this->model;
        $this->_view->employers = $this->model->all();
    }

    public function CreateAction()
    {

        if($this->getRequest()->isPost()) {

            foreach($this->model->getFields() as $field){
                $data[$field]=$this->getRequest()->getParam($field);
            }

            //filter
            $data['birthdate']=date('Y-m-d', strtotime($data['birthdate']));
            $data['passport'] = str_replace(" ", "", $data['passport']);
            $data['phone'] = preg_replace('/^\+7\((\d{3})\)(\d{3})-(\d{2})-(\d{2})$/i', '$1$2$3$4', $data['phone']);

            //validate
            $validationResult = Validator::validate($this->model, $data);

            //create
            if($validationResult['valid']) {
                if($this->model->create($data)) {
                    header('Location: /employers/');
                }
            } else {
                //ошибки
                $this->_view->errors = $validationResult['errors'];

            }

        }

        $this->_view->model = $this->model;
    }

    public function UpdateAction()
    {
        $id = intval($this->getRequest()->getParam('id'));
        $employer = $this->model->find($id);

        if(!$employer) {
            throw new Exception('Сотрудник не найден');
        }


        if($this->getRequest()->isPost()) {

            $data=[];
            foreach($this->model->getFields() as $field){
                $data[$field]=$this->getRequest()->getParam($field, $employer[$field]);
            }

            //filter
            $data['birthdate']=date('Y-m-d', strtotime($data['birthdate']));
            $data['passport'] = str_replace(" ", "", $data['passport']);
            $data['phone'] = preg_replace('/^\+7\((\d{3})\)(\d{3})-(\d{2})-(\d{2})$/i', '$1$2$3$4', $data['phone']);

            //validate
            $validationResult = Validator::validate($this->model, $data);

            //update
            if($validationResult['valid']) {
                if($this->model->update($id, $data)) {
                    header('Location: /employers/');
                }
            } else {
                //ошибки
                $this->_view->errors = $validationResult['errors'];

            }
        }

        $this->_view->model = $this->model;
        $this->_view->employer = $employer;
    }

    public function DeleteAction()
    {
        $this->model->delete(intval($this->getRequest()->getParam('id')));
        header('Location: /employers/');
    }

    public function LogAction()
    {

    }

}