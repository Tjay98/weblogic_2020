<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

class GameController extends BaseController
{

    public function game(){

        return View::make('game.game');
    }

    public function scoreboard(){

        return View::make('game.scoreboard');
    }

}