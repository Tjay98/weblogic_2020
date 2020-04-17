<?php
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;

/**
 * Created by PhpStorm.
 * User: smendes
 * Date: 09-05-2016
 * Time: 11:30
 */
class HomeController extends BaseController
{

    public function index(){

        return View::make('home.index');
    }

    public function start(){

        //View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'Quick Start']);
        return View::make('home.start');
    }

    public function login(){
        //verifica qual o tipo de metodo e age adequadamente
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return View::make('home.login');
        }
        else{
            $username=$_POST['username'];
            $password=$_POST['password'];

            $usercheck=Users::find_by_username_and_password($username,$password);
            if(!empty($usercheck)){
                Session::set('username',$username);
                
               if($usercheck->role==1){
                    Session::set('role','1');
                    return View::make('home.index');

                }
                else{
                    Session::set('role','2');
                    return View::make('home.index');
                }
                
                
            }
            else{
                return View::make('home.logout');
            }

        }
    }

    public function signup(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return View::make('home.login');
        }
        else{

        }
    }

    public function worksheet(){

        View::attachSubView('titlecontainer', 'layout.pagetitle', ['title' => 'MVC Worksheet']);

        return View::make('home.worksheet');
    }

    public function setsession(){
        $dataObject = MetaArmCoreModel::getComponents();
        Session::set('object', $dataObject);

        Redirect::toRoute('home/index');
    }

    public function showsession(){
        $res = Session::get('object');
        var_dump($res);
    }

    public function destroysession(){

        Session::destroy();
        Redirect::toRoute('home/index');
    }


}