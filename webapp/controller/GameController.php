<?php
use ArmoredCore\WebObjects\Data;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{

    public function game(){

        return View::make('game.game');
    }

    public function dice1($dado1){
    $dado1 = new Games();
    $dado1->dice1($dado1);
    Redirect::toRoute('game/dice1');
    }

    public function dice2($dado2){
        $dado2 = new Games();
        $dado2->dice2($dado2);
        Redirect::toRoute('game/dice2');
        }


        public function rolldice(){
            $total = new Games();
            $total->SumDice($total);
            Redirect::toRoute('game/rolldice');
        }

    public function SumDice($total){
        $total = $dado1 + $dado2;
        
        Redirect::toRoute('game/sumdice');
    }

    public function scoreboard(){

        return View::make('game.scoreboard');
    }

    public function story(){

        return View::make('game.story');
    }

}