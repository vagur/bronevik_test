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

    const OPERATION_CREATE = 'c';
    const OPERATION_UPDATE = 'u';
    const OPERATION_DELETE = 'd';



}