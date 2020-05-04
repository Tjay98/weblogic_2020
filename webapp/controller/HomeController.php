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

            $usercheck=Users::find_by_username($username);
            if(!empty($usercheck)){
                if(password_verify($password, $usercheck->password)){
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
                    echo "password error";
                }
                
                
            }
            else{
                echo "username and password error";
            }

        }
    }

    public function register(){
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            return View::make('home.register');
        }
        else{
            $username=$__POST['username'];
            $email=$_POST['email'];
            $password=$_POST['password'];
            $usercheck=Users::find_by_username($username);

            if(empty($usercheck)){

                $emailcheck=Users::find_by_email($email);

                if(empty($emailcheck)){

                    $passwordhash=password_hash ($password,PASSWORD_BCRYPT);
                    $userdata = [
                        'username' => $username, 
                        'email' => $email, 
                        'password' => $passwordhash,];
                    $insert = new Users($userdata);
                    $insert->save();
                    
                    Redirect::flashToRoute('home/index', ['sucessregister' => 'success']);
                    //Redirect::toRoute('home/index');
                }
                else{
                    echo "email already exists";
                }   
                
                
            }
            else{
                echo "username already exists";
            }
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

    public function logout(){

        Session::destroy();
        Redirect::toRoute('home/index');
    }


}