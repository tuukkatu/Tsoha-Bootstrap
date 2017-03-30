<?php

class BeerController extends BaseController {

    public static function index() {
        $oluet = Olut::all();
        View::make('suunnitelmat/frontpage.html', array('oluet' => $oluet));
    }

    public static function store() {
        $params = $_POST;
        $olut = new Olut(array(
            'nimi' => $params['nimi'],
            'panimo' => $params['panimo'],
            'tyyppi' => $params['tyyppi']
        ));
        //Kint::dump($params);

        $olut->save();

        Redirect::to('/suunnitelmat/' .$olut->id, array('message' => 'Olut on lisätty kirjastoon!'));
    }
    
    public static function create(){
        View::make('olut/new.html');
    }
    
    public static function show($id){
        $olut = Olut::find($id);
        View::make('suunnitelmat/esittely.html', array('olut' => $olut));
    }
    
    public static function edit($id){
        $olut = Olut::find($id);
        View::make('suunnitelmat/edit.html', array('olut' => $olut));
    }

}
