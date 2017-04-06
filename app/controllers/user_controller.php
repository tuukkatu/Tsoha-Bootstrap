<?php

class UserController extends BaseController{
    
    public static function login(){
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $arvostelija = Arvostelija::authenticate($params['username'], $params['password']);

        if (!$arvostelija) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'username' => $params['username']));
        } else {
            $_SESSION['arvostelija'] = $arvostelija->id;

            Redirect::to('/', array('message' => 'Tervetuloa takaisin ' . $arvostelija->username . '!'));
        }
    }
}

