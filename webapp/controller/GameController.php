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
                'limit'=>10,
                'joins'=>'LEFT JOIN users on (scoreboards.user_id = users.id)',
                'select'=>'users.username , scoreboards.total_points , scoreboards.total_wins , scoreboards.total_loses'
                ];
            $ranks = Scoreboards::all($options);
            foreach ($ranks as $rank){
                $scores[]=[
                    'username'=>$rank->username,
                    'total_points'=>$rank->total_points,
                    'total_wins'=>$rank->total_wins,
                    'total_loses'=>$rank->total_loses,
                ];
    
            }
    
            return View::make('game.scoreboard', ['scores' => $scores]);
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