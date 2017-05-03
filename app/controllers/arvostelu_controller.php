<?php

Class ArvosteluController extends BaseController {


    public static function create() {
        $oluet = Olut::all();
        View::make('arvostelut/uusiArvostelu.html', array('oluet' => $oluet));
    }

    public static function index() {
        $arvostelut = Arvostelu::all();
        View::make('arvostelut/kaikki.html', array('arvostelut' => $arvostelut));
    }
    
    public static function store() {
        $params = $_POST;
        $arvostelija = self::get_user_logged_in();
        $attributes = array(
            'arvostelija_id' => $arvostelija->id,
            'arvosana' => $params['arvosana'],
            'olut_id' => $params['olut']
            //'arvostelupaiva' => $params['arvostelupaiva']
        );
        //Kint::dump($params);
        $arvostelu = new Arvostelu($attributes);
        $errors = $arvostelu->errors();
        $oluet = Olut::all();

        if (count($errors) == 0) {
            // Peli on validi, hyvä homma!
            $arvostelu->save();

            Redirect::to('/arvostelut' , array('message' => 'Arvostelu on lisätty!'));
        } else {
            // Pelissä oli jotain vikaa :(
            //Kint::dump($olut);
            View::make('arvostelut/uusiArvostelu.html', array('errors' => $errors, 'attributes' => $attributes, 'oluet' => $oluet));
        }       
    }

    public static function destroy($id){
        $arvostelu = new Arvostelu(array('id' => $id));
        $arvostelu->destroy();
        Redirect::to();
    }
    
}
