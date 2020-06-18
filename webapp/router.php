<?php
/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 02-05-2016
 * Time: 11:18
 */
use ArmoredCore\Facades\Router;

/****************************************************************************
 *  URLEncoder/HTTPRouter Routing Rules
 *  Use convention: controllerName@methodActionName
 ****************************************************************************/

Router::get('/',			'HomeController/index');
Router::get('home/',		'HomeController/index');
Router::get('home/index',	'HomeController/index');
Router::get('home/start',	'HomeController/start');

Router::get('home/login',   'HomeController/login');
Router::post('home/loginvalidation', 'Homecontroller/login');
Router::get('home/register',   'HomeController/register');
Router::post('home/registervalidation', 'Homecontroller/register');
Router::get('home/logout',  'HomeController/logout');

Router::get('home/profile', 'HomeController/profile');
Router::get('home/editprofile', 'HomeController/editprofile');
Router::post('home/editvalidation', 'HomeController/editprofile');
Router::get('home/changepassword', 'HomeController/changepassword');
Router::post('home/changepasswordvalidation', 'HomeController/changepassword');

Router::get('game/scoreboard','GameController/scoreboard');

Router::resource('game', 'GameController');

Router::get('game/game','GameController/game');
Router::post('game/gamestart','GameController/gamestart');
Router::get('game/savepoints','GameController/savepoints');
Router::post('game/endgame','GameController/endgame');

Router::get('game/dice1', 'GameController/dice1');
Router::get('game/dice2', 'GameController/dice2');
Router::post('game/rolldice', 'GameController/rolldice');
Router::get('game/sumdice', 'GameController/SumDice');

Router::post('game/gameIndex', 'GameController/gameIndex');

Router::post('game/gameoverval','GameController/gameOver');


Router::get('game/SumDice', 'GameController/SumDice');
Router::get('game/story','GameController/story');
/* Router::resource('game','GameController'); */

Router::resource('backoffice', 'BackofficeController');
Router::get('backoffice/ban','BackofficeController/ban');
Router::post('backoffice/ban','BackofficeController/ban');










/************** End of URLEncoder Routing Rules ************************************/