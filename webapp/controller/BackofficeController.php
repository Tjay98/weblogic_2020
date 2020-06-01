<?php
use ArmoredCore\WebObjects\Data;
use ArmoredCore\Controllers\BaseController;
use ArmoredCore\WebObjects\Redirect;
use ArmoredCore\WebObjects\Session;
use ArmoredCore\WebObjects\View;
use ArmoredCore\WebObjects\Post;
use ArmoredCore\Interfaces\ResourceControllerInterface;

class BackofficeController extends BaseController implements ResourceControllerInterface 
{
    /**
     * @return mixed
     */
    public function index()
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){

            $users = Users::all();
            View::make('backoffice.index', ['users' => $users]);
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @return mixed
     */
    public function create()
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            View::make('backoffice.create');
        }else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @return mixed
     */
    public function store()
    {
        // create new resource (activerecord/model) instance
        // your form name fields must match the ones of the table fields
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            $user = new Users(Post::getAll());

            if($user->is_valid()){
                $user->save();
                Redirect::toRoute('backoffice/index');
            } else {
                // return form with data and errors
                Redirect::flashToRoute('backoffice/create', ['backoffice' => $user]);
            }
        }else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            $user = Users::find($id);

            \Tracy\Debugger::barDump($user);

            if (is_null($user)) {
                // redirect to standard error page
            } else {
                View::make('backoffice.show', ['backoffice' => $user]);
            }
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function edit($id)
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            $user = Users::find($id);

            if (is_null($user)) {
                // redirect to standard error page
            } else {
                View::make('backoffice.edit', ['backoffice' => $user]);
            }
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            $user = Users::find($id);
            $user->update_attributes(Post::getAll());

            if($user->is_valid()){
                $user->save();
                Redirect::toRoute('backoffice/index');
            } else {
                // return form with data and errors
                Redirect::flashToRoute('backoffice/edit', ['backoffice' => $user], $id);
            }
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    /**
     * @param $id
     * @return mixed
     */
    public function destroy($id)
    {
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
            $user = Users::find($id);
            $user->delete();
            Redirect::toRoute('backoffice/index');
        }
        else{
            Redirect::toRoute('home/index');
        }
    }

    public function ban($id){
        if(!empty($_SESSION['username'])&&($_SESSION['role']==2)){
        //IMPLEMENTAR BANIR UTILIZADOR -> ESTADO 2;
        }
        else{
            Redirect::toRoute('home/index');
        }
    }
}