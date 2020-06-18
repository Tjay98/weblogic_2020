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
             $usercheck=Users::find_by_username($_SESSION['username']);
                if(!empty($usercheck)){
                    $checkgame=Games::find_by_id_user_and_status($usercheck->id,1);
                    if(!empty($checkgame)){
                        if($checkgame->status==1){
                            $_SESSION['game']=$checkgame->id;
                            if($checkgame->point_1==1){
                                $_SESSION['point_1']=1;
                            }
                            if($checkgame->point_2==1){
                                $_SESSION['point_2']=1;
                            }
                            if($checkgame->point_3==1){
                                $_SESSION['point_3']=1;
                            }
                            if($checkgame->point_4==1){
                                $_SESSION['point_4']=1;
                            }
                            if($checkgame->point_5==1){
                                $_SESSION['point_5']=1;
                            }
                            if($checkgame->point_6==1){
                                $_SESSION['point_6']=1;
                            }
                            if($checkgame->point_7==1){
                                $_SESSION['point_7']=1;
                            }
                            if($checkgame->point_8==1){
                                $_SESSION['point_8']=1;
                            }
                            if($checkgame->point_9==1){
                                $_SESSION['point_9']=1;
                            }
                            if(!empty($checkgame_player_points)){
                                $_SESSION['game_points']=$checkgame->player_points;
                            }
                            return View::make('game.game');
                        }
                        else{

                            return View::make('game.game');
                        }
                    }else{
                        return View::make('game.game');
                    }
                    


                }


        }else{
            Redirect::toRoute('home/index');
        }
    }

    //função de inicio do jogo para enviar para o mysql
    public function gamestart(){
        if(!empty($_SESSION['username'])){  
            $usercheck=Users::find_by_username($_SESSION['username']);
            $checkgame=Games::find_by_id_user_and_status($usercheck->id,1);
            if(empty($checkgame)){
                $gamesdata=[
                    'id_user'=>$usercheck->id,
                    
                ];
                Games::create($gamesdata);
                $newgame=Games::find_by_id_user_and_status($usercheck->id,1);
                $_SESSION['game']=$newgame->id;
                Redirect::toRoute('game/game');
            }
            else{
                Redirect::toRoute('game/game');
            }
        }
        else{
            Redirect::toRoute('home/index');
        }
    }


    public function savepoints(){
         if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
            if(!empty($_SESSION['game'])){
                $checkgame=Games::find_by_id($_SESSION['game']);

                if(!empty($checkgame)){

                    $checkgame->player_points=0;
                    if(!empty($_POST['numberselected'][1])){
                        $checkgame->point_1=1;
                        
                    }
                    if(!empty($_POST['numberselected'][2])){
                        $checkgame->point_2=1;
                        
                    }
                    if(!empty($_POST['numberselected'][3])){
                        $checkgame->point_3=1;
                       
                    }
                    if(!empty($_POST['numberselected'][4])){
                        $checkgame->point_4=1;
                       
                    }
                    if(!empty($_POST['numberselected'][5])){
                        $checkgame->point_5=1;
                        
                    }
                    if(!empty($_POST['numberselected'][6])){
                        $checkgame->point_6=1;
                        
                    }
                    if(!empty($_POST['numberselected'][7])){
                        $checkgame->point_7=1;
                        
                    }
                    if(!empty($_POST['numberselected'][8])){
                        $checkgame->point_8=1;
                        
                    }
                    if(!empty($_POST['numberselected'][9])){
                        $checkgame->point_9=1;
                        
                    }

                    if($checkgame->point_1==1){
                        $_SESSION['point_1']=1;
                    }
                    if($checkgame->point_2==1){
                        $_SESSION['point_2']=1;
                    }
                    if($checkgame->point_3==1){
                        $_SESSION['point_3']=1;
                    }
                    if($checkgame->point_4==1){
                        $_SESSION['point_4']=1;
                    }
                    if($checkgame->point_5==1){
                        $_SESSION['point_5']=1;
                    }
                    if($checkgame->point_6==1){
                        $_SESSION['point_6']=1;
                    }
                    if($checkgame->point_7==1){
                        $_SESSION['point_7']=1;
                    }
                    if($checkgame->point_8==1){
                        $_SESSION['point_8']=1;
                    }
                    if($checkgame->point_9==1){
                        $_SESSION['point_9']=1;
                    }
                            
                        
                    $checkgame->save();


                    
                }

                

            }
         } 
        

    }
    public function endgame(){

         if(!empty($_POST['finish'])){

            $checkgame=Games::find_by_id($_SESSION['game']);
            $checkgame->status=2;
            $checkgame->finish_date=date('Y-m-d H:i:s');
            $checkgame->save();

            $find_user=Users::find_by_username($_SESSION['username']);
            $scoreboard=Scoreboards::find_by_user_id($find_user->id);
/*             if(empty($scoreboard)){
                $scoreboardData=[
                    'user_id'=>$find_user->id,
                ];
                scoreboards::create($scoreboardData);
                $scoreboard=Scoreboards::find_by_user_id($find_user->id);
            }
             */


            $oldpoints=$scoreboard->total_points;
            $newpoints=$oldpoints + $checkgame->player_points;
            $scoreboard->total_points=$newpoints;
            $scoreboard->total_wins=$scoreboard->total_wins +1;

            $scoreboard->save();
            unset($_SESSION["game"]);
            unset($_SESSION["point_1"]);
            unset($_SESSION["point_2"]);
            unset($_SESSION["point_3"]);
            unset($_SESSION["point_4"]);
            unset($_SESSION["point_5"]);
            unset($_SESSION["point_6"]);
            unset($_SESSION["point_7"]);
            unset($_SESSION["point_8"]);
            unset($_SESSION["point_9"]);
            echo "game_end";
        }
        else{
            echo "ERRO";
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