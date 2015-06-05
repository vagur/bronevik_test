<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 05.06.15
 * Time: 18:03
 */

class Validator {

    public static function validate(Model $model, $data)
    {
        $valid=true;
        $errors=[];
        $rules = $model->getRules();

        foreach($rules as $rule){
            $fields = $rule[0];
            $type = $rule[1];

            if($type=='required') {
                foreach($fields as $field) {
                    if(!isset($data[$field]) || empty($data[$field])){
                        $valid=false;
                        $errors[$field]='Поле обяхательно к заполнению';
                    }
                }
            }

            if($type=='string') {
                foreach($fields as $field) {
                    if(strlen($data[$field])>$rule['max']) {
                        $valid=false;
                        $errors[$field]='Максимальная длинна поля '.$rule['max'].' символов';

                    }
                }
            }

            if($type=='email') {
                foreach($fields as $field) {
                    if(!preg_match('/^[\w\.-]+@[\w\.-]+$/', $data[$field])) {
                        $valid=false;
                        $errors[$field]='Некоректный E-mail';

                    }
                }
            }


        }

        return ['valid'=>$valid, 'errors'=>$errors];
    }

}