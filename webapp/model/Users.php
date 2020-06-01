<?php
use ActiveRecord\Model;

class Users extends \ActiveRecord\Model {

    static $validates_presence_of = array(
        array('username', 'message' => 'campo username deve ser preenchido'),
        array('email', 'message' => 'campo email deve ser preenchido'),
        array('password', 'message' => 'campo password deve ser preenchido'),
        array('status', 'message' => 'campo status deve ser preenchido'),
        array('role', 'message' => 'campo role deve ser preenchido'),

    );


}