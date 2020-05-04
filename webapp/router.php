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
Router::get('home/scoreboard','HomeController/scoreboard');
Router::get('home/game','HomeController/game');











/************** End of URLEncoder Routing Rules ************************************/