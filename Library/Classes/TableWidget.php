<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 05.06.15
 * Time: 11:44
 */

class TableWidget {

    /**
     * @param Model $model
     * @param array $data
     * @param array $options
     * @return string
     */
    public static function grid(Model $model, Array $data, Array $options=[]){

        if(!isset($options['fields'])) $options['fields']=$model->getFields();
        if(!isset($options['edit'])) $options['edit']='./update?id=';
        if(!isset($options['edit'])) $options['edit']='./delete?id=';
        if(!isset($options['log'])) $options['log']='./employerlog?id=';


        $html = '<table class="'.((isset($options['class']))?$options['class']:'').'">';
        $html.='<thead>';
        $html.='<tr>';
        foreach($options['fields'] as $field) {
            if($model->isFieldDefined($field)) {
                $html.='<th>'.$model->getFieldLable($field).'</th>';
            }
        }
        $html.='<th></th>';
        $html.='</tr>';
        $html.='</thead>';
        foreach($data as $row) {
            $html.='<tr>';
            foreach($options['fields'] as $field) {
                if($model->isFieldDefined($field)) {
                    $html.='<td>';
                    if(isset($row[$field])) $html.=$row[$field];
                    $html.='</td>';
                }
            }
            $html.='<td>
                        <a href="'.$options['edit'].$row[$model->getPKey()].'" class="widget-table-grid-edit">редактировать</a>
                        <a href="'.$options['delete'].$row[$model->getPKey()].'" class="widget-table-grid-delete">удалить</a>
                        <a href="'.$options['log'].$row[$model->getPKey()].'" class="widget-table-grid-log">история</a>
                    </td>';
        $html.='</tr>';
        }


        $html.='<tbody>';
        $html.='</tbody>';
        $html.='</table>';

        return $html;

    }

}