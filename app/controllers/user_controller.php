<?php

class UserController extends BaseController{
    
    public static function login(){
        View::make('user/login.html');
    }
    
    public static function register(){
        View::make('user/register.html');
    }
    
    public static function handle_register(){
        $params = $_POST;
        $attributes = array(
            'username' => $params['username'],
            'password' => $params['password']
        );
        $arvostelija = new Arvostelija($attributes);
        
        $errors = $arvostelija->errors();
        if (count($errors) == 0) {
            $arvostelija->save();
            $_SESSION['arvostelija'] = $arvostelija->id;
            Redirect::to('/olut/olutlista');
        }
        Redirect::to('/register', array('username' => $params['username'], 'errors' => $errors));

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
    
    public static function logout(){
        $_SESSION['arvostelija'] = null;
        Redirect::to('/login', array('message' => 'Olet kirjautunut ulos!'));
    }
}

