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
Router::get('home/changepasswordvalidation', 'HomeController/changepassword');

Router::get('game/scoreboard','GameController/scoreboard');
Router::get('game/game','GameController/game');
Router::get('game/story','GameController/story');
/* Router::resource('game','GameController'); */

Router::resource('backoffice', 'BackofficeController');










/************** End of URLEncoder Routing Rules ************************************/