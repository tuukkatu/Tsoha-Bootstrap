<?php

class Arvostelu extends BaseModel{
    public $id, $arvosana, $arvostelupaiva, $olut_id, $arvostelija_id, $nimi, $panimo, $username;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_arvosana');
    }
    
    public function validate_arvosana(){
        $errors = array();
        if($this->arvosana == '' || $this->arvosana == null){
            $errors[] = 'Arvosana ei saa olla tyhjä!';
        }
        if(($this->arvosana) < 1 || ($this->arvosana) > 100) {
            $errors[] = 'Arvosanan tulee olla numero välillä 1-100!';
        }
        return $errors;
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT Arvostelu.id AS id, arvosana, arvostelupaiva, olut_id, arvostelija_id, Olut.nimi, Olut.panimo, Arvostelija.username FROM Arvostelu, Olut, Arvostelija WHERE Arvostelu.olut_id = Olut.id AND Arvostelija.id = Arvostelu.arvostelija_id');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $arvostelut = array();
        
        foreach($rows as $row){
            $arvostelut[] = new Arvostelu(array(
                'id' => $row['id'],
                'arvosana' => $row['arvosana'],
                'arvostelupaiva' => $row['arvostelupaiva'],
                'olut_id' => $row['olut_id'],
                'arvostelija_id' => $row['arvostelija_id'],
                'nimi' => $row['nimi'],
                'panimo' => $row['panimo'],
                'username' => $row['username']
                    ));
        }
        
        return $arvostelut;
        
    }
    
//    public static function arvosteluJoinOlut($id){
//        $query = DB::connection()->prepare('SELECT * FROM Arvostelu INNER JOIN Olut ON (arvostelu.olut_id = olut.id) WHERE arvostelu.arvostelija_id = :id');
//        $query->execute(array('id' => $id));
//        $row = $query->fetch();
//        
//        $arvostelut = array();
//        
//        foreach($rows as $row){
//            $arvostelut[] = new Arvostelu(array(
//                'id' => $row['id'],
//                'arvosana' => $row['arvosana'],
//                'arvostelupaiva' => $row['arvostelupaiva'],
//                'olut_id' => $row['olut_id'],
//                'arvostelija_id' => $row['arvostelija_id'],
//                'nimi' => $row['nimi']
//                    ));
//        }
//    }


    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $arvostelu = new Arvostelu(array(
                'id' => $row['id'],
                'arvosana' => $row['arvosana'],
                'arvostelupaiva' => $row['arvostelupaiva'],
                'olut_id' => $row['olut_id'],
                'arvostelija_id' => $row['arvostelija_id']
            ));
            
            return $arvostelu;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Arvostelu (arvosana, arvostelupaiva, olut_id, arvostelija_id) VALUES (:arvosana, NOW(), :olut_id, :arvostelija_id) RETURNING id');
        $query->execute(array('arvosana' => $this->arvosana, 'olut_id' => $this->olut_id, 'arvostelija_id' => $this->arvostelija_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}

