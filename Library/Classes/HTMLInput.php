<?php
/**
 * Created by PhpStorm.
 * User: vagur
 * Date: 05.06.15
 * Time: 16:29
 */

class HTMLInput {

    public static function text(Model $model, $attribute, $value='')
    {
        $html = self::getLabel($model, $attribute);
        $html.='<dd>';
        $html.='<input type="text" name="'.$attribute.'" id="'.$attribute.'" value="'.$value.'">';
        $html.='</dd>';

        return $html;

    }

    public static function submit($caption){
        $html='<dt></dt><dd>';
        $html.='<button type="submit">'.$caption.'</button>';
        $html.='</dd>';

        return $html;

    }

    public static function datepicker($model, $attribute, $value=''){

        if(!empty($value)) $value=date('d.m.Y', strtotime($value));
        $html = self::getLabel($model, $attribute);
        $html.='<dd>';
        $html.='<input type="text" name="'.$attribute.'" id="'.$attribute.'" value="'.$value.'">';
        $html.='</dd>';

        return $html;

    }

    public static function select($model, $attribute, $options, $value=''){
        $html = self::getLabel($model, $attribute);
        $html.='<dd>';
        $html.='<select name="'.$attribute.'" id="'.$attribute.'">';
        foreach($options as $val=>$txt){
            $html.='<option value="'.$val.'"'.($value==$val?'selected':'').'>'.$txt.'</option>';
        }
        $html.='</select>';
        $html.='</dd>';
        return $html;

    }

    public static function button(){

    }

    private static function getLabel(Model $model, $attribute){
        if($model->isFieldDefined($attribute)) {
            $label = $model->getFieldLable($attribute);
        } else {
            $label = '';
        }

        $html='<dt>'.$label.'</dt>';
        return $html;
    }
}