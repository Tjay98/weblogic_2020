<?php
use ActiveRecord\Model;

class Box  extends Model
{
    protected $_boxes=[];
    protected $_sumSelectedNumers = 0;
    protected $_selectedNumbersArray;

    


    public function __construct(){
        $this->_dice = new Dice();

    }
    
    
	  
   
    
}