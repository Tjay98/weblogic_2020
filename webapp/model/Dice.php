<?php
use ActiveRecord\Model;


class Dice extends Model
{
    protected $dice1;
    protected $dice2;
    protected $total = 0;


    public function __construct()
    {
        $this->SumDice();
    }
    protected function dice1($dado1){
        $dado1 = rand(1,6);
        return $dado1;
    }
    protected function dice2($dado2){
        $dado2 = rand(1,6);
        return $dado2;
    }

  

    protected function SumDice($total){
        $totalDice = $dado1 + $dado2;
        return $total;
    }

   
}