<?php

class HelloWorldController extends BaseController {

//    public static function index(){
//      // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
//   	  echo 'Tämä on etusivu!';
//    }
//
    public static function sandbox() {
//      // Testaa koodiasi täällä
//      //View::make('helloworld.html');
//      $Koff = Olut::find(1);
//      $olut = Olut::all();
//      
//      Kint::dump($olut);
//      Kint::dump($Koff);
        $doom = new Olut(array(
            'nimi' => 'd',
            'panimo' => 'e'
        ));
        $errors = $doom->errors();

        Kint::dump($errors);
    }
//    
//    public static function esittely(){
//      View::make('suunnitelmat/esittely.html');  
//    }
//    
//    public static function listaussivu(){
//      View::make('suunnitelmat/listaussivu.html');  
//    }
//    
//    public static function login(){
//      View::make('suunnitelmat/login.html');  
//    }
//    public static function edit(){
//      View::make('suunnitelmat/edit.html');  
//    }
//    
//    public static function frontpage(){
//      View::make('suunnitelmat/frontpage.html');  
//    }
}
