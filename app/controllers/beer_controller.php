<?php

class BeerController extends BaseController {

    public static function index() {
        $oluet = Olut::all();
        View::make('olut/frontpage.html', array('oluet' => $oluet));
    }
    public static function login() {
        View::make('olut/login.html');
    }
    
    public static function etusivu() {
        View::make('olut/etusivu.html');
    }
    
    public static function esittely() {
        View::make('olut/esittely.html');
    }
    
    public static function listaussivu() {
        self::check_logged_in();
        View::make('olut/listaussivu.html');
    }

    public static function store() {
        self::check_logged_in();
        $params = $_POST;
        $attributes = array(
            'nimi' => $params['nimi'],
            'panimo' => $params['panimo'],
            'kuvaus' => $params['kuvaus'],
            'tyyppi_id' => $params['tyyppi']
        );
        //Kint::dump($params);
        $olut = new Olut($attributes);
        $errors = $olut->errors();

        if (count($errors) == 0) {
            // Peli on validi, hyvä homma!
            $olut->save();

            Redirect::to('/olut' , array('message' => 'Olut on lisätty kirjastoosi!'));
        } else {
            // Pelissä oli jotain vikaa :(
            $tyyppi = Tyyppi::all();
            View::make('olut/new.html', array('errors' => $errors, 'attributes' => $attributes, 'tyypit' => $tyyppi));
        }

        //$olut->save();

        //Redirect::to('/suunnitelmat' .$olut->id, array('message' => 'Olut on lisätty kirjastoon!'));
    }
    
    public static function create(){
        self::check_logged_in();
        $tyyppi = Tyyppi::all();
        View::make('olut/new.html', array('tyypit' => $tyyppi));
    }
    
    public static function show($id){
        $olut = Olut::find($id);
        
        View::make('olut/esittely.html', array('olut' => $olut));
    }
    
    public static function edit($id){
        self::check_logged_in();
        $olut = Olut::find($id);
        $tyypit = Tyyppi::all();
        //Kint::dump($olut);
        View::make('olut/edit.html', array('olut' => $olut, 'tyypit' => $tyypit));
    }
    
    public static function update($id){
        self::check_logged_in();
        $params = $_POST;
        
        $attributes = array(
            'id' => $id,
            'nimi' => $params['nimi'],
            'panimo' => $params['panimo'],
            'kuvaus' => $params['kuvaus'],
            'tyyppi_id' => $params['tyyppi_id']
        );
        
        $olut = new Olut($attributes);
        $errors = $olut->errors();
        
        if(count($errors) > 0){
            View::make('olut/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }else{
            $olut->update();
            Redirect::to('/olut/' . $olut->id, array('message' => 'Olut on muokattu onnistuneesti!'));
        }
    }
    
    public static function destroy($id){
        self::check_logged_in();
        $olut = new Olut(array('id' => $id));
        $olut->destroy();
        
        Redirect::to('/olut/olutlista', array('message' => 'Olut on poistettu onnistuneesti!'));
    }

}
