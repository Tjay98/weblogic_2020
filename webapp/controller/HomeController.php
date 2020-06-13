<?php
use ArmoredCore\WebObjects\Data;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\WebObjects\View;

class HomeController extends BaseController
{

    public function index(){

        return View::make('home.index');
    }

    public function login(){
        if(empty($_SESSION['username'])){
            //verifica qual o tipo de metodo e age adequadamente
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                Session::destroy();
                return View::make('home.login');
            }
            else{
                $username=$_POST['username'];
                $password=$_POST['password'];

                $usercheck=Users::find_by_username($username);
                if(!empty($usercheck)){
                    if(password_verify($password, $usercheck->password)){
                        if($usercheck->status==1){
                            Session::set('username',$username);
                        
                            if($usercheck->role==1){
                                Session::set('role','1');
                                Redirect::toRoute('home/index');

                            }
                            else{
                                Session::set('role','2');
                                Redirect::toRoute('home/index');
                            }
                        }else{
                            echo "banned";
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
        else{
            Redirect::toRoute('home/index');
        }
    }

    public function register(){
        if(empty($_SESSION['username'])){
        //if(!empty(Data::get('success'))){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                Session::destroy();
                return View::make('home.register');
            }
            else{
                $username=$_POST['username'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $nome_completo=$_POST['nome_completo'];
                $birthday=$_POST['birthday'];

                $usercheck=Users::find_by_username($username);

                if(empty($usercheck)){

                    $emailcheck=Users::find_by_email($email);

                    if(empty($emailcheck)){

                        $passwordhash=password_hash ($password,PASSWORD_BCRYPT);
                        $userdata = [
                            'username' => $username, 
                            'email' => $email,
                            'nome_completo'=>$nome_completo, 
                            'birthday'=>$birthday,
                            'password' => $passwordhash,
                        ];
                        $insert = new Users($userdata);
                        $insert->save();
                        
                        Session::set('success','success');
                    }
                    else{
                        echo "email error";
                    }   
                    
                    
                }
                else{
                    echo "username error";
                }
            }

        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    public function logout(){

        Session::destroy();
        Redirect::toRoute('home/index');
    }


    public function profile(){
        if(!empty($_SESSION['username'])){
            $userinfo=Users::find_by_username($_SESSION['username']);
            $user=[
                'username'=>$userinfo->username,
                'email'=>$userinfo->email,
                'nome_completo'=>$userinfo->nome_completo,
                'birthday'=>$userinfo->birthday,
                'created_date'=>$userinfo->creation_date,
            ];
            View::make('home.profile', ['users' => $user]);
        }
        else{
            Redirect::toRoute('home/index');
        }

    }

    public function editprofile(){
        if(!empty($_SESSION['username'])){

            

            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                $usercheck=Users::find_by_username($_SESSION['username']);
                $user=[
                    'nome_completo'=>$usercheck->nome_completo,
                    'email'=>$usercheck->email,
                    'birthday'=>$usercheck->birthday,
                ];
                return View::make('home.editprofile', ['users' => $user]);
                
            }
            else{
                $allinfo=Post::getAll();
                $usercheck=Users::find_by_username($_SESSION['username']);
                $email=Users::find_by_email($allinfo['email']);

                if(empty($email)||($allinfo['email']==$usercheck->email)){
                    
                    $usercheck->update_attributes(
                        [
                            'email'=>$allinfo['email'],
                            'nome_completo'=>$allinfo['nome_completo'],
                            'birthday'=>$allinfo['birthday'],
                        ]
                    );

                    $user=[
                        'username'=>$usercheck->username,
                        'email'=>$usercheck->email,
                        'nome_completo'=>$usercheck->nome_completo,
                        'birthday'=>$usercheck->birthday,
                        'created_date'=>$usercheck->creation_date,
                    ];
                    View::make('home.profile', ['users' => $user]);
                }
                else{
                    $user=[
                        'nome_completo'=>$usercheck->nome_completo,
                        'email'=>$usercheck->email,
                        'birthday'=>$usercheck->birthday,
                        'error'=>'email_invalid',
                    ];
                    return View::make('home.editprofile', ['users' => $user]);
                    
                }

            }
            
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    public function changepassword(){
        if(!empty($_SESSION['username'])){
            if ($_SERVER['REQUEST_METHOD'] === 'GET') {
                return View::make('home.changepassword');
            }else{
                $user=Users::find_by_username($_SESSION['username']);
                $newpass=password_hash ($_POST['password'],PASSWORD_BCRYPT);
                $user->password=$newpass;
                $user->save();
                Redirect::toRoute('home/profile');
            }
            
        }else{
            Redirect::toRoute('home/index');
        }

    }

/*
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
*/



}