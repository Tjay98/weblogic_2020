<?php
use ActiveRecord\Model;

class Users extends \ActiveRecord\Model {

    static $validates_presence_of = array(
        array('username', 'message' => 'YooaaH it must be provided'),
        array('email', 'message' => 'YooaaH it must be provided'),
        array('password', 'message' => 'YooaaH it must be provided')

    );


}