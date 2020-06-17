<?php
use ArmoredCore\WebObjects\Data;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{

    public function game(){
       /* if(!empty($_SESSION['username'])){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return View::make('game.game');
            }
            else{
                Session::set('game','1');*/
                return View::make('game.game');

          /*  }
        }else{
            Redirect::toRoute('home/index');
        }*/
    }


    public function randomdice(){

       //$_SESSION['pontos']=$_POST['playerpoints'];
       /*foreach (){

       }*/
       print_r($_POST);

    }
    

//buscar dado 1 do games
    public function dice1($dado1){
    $dado1 = new Games();
    $dado1->dice1($dado1);
    return $dado1;
    }
//buscar dado 2 do games
    public function dice2($dado2){
    $dado2 = new Games();
    $dado2->dice2($dado2);
    return $dado2;
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