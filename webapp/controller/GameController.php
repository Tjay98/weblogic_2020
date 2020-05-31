<?php
use ArmoredCore\WebObjects\Data;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{

    public function game(){
        if(!empty($_SESSION['username'])){
            return View::make('game.game');
        }else{
            Redirect::toRoute('home/index');
        }
    }

    public function scoreboard(){
        if(!empty($_SESSION['username'])){
            $options=[
                'order'=>'total_points desc',
                'limit'=>10
                ];
                $scoreboard = scoreboard::find('all');
               
                die();
                View::make('game.scoreboard', ['ranks' => $ranks]);
                
            return View::make('game.scoreboard');
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    public function story(){
        if(empty($_SESSION['username'])){
            return View::make('game.story');
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

}