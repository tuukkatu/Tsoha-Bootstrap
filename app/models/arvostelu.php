<?php

class Arvostelu extends BaseModel{
    public $id, $arvosana, $arvostelupaiva, $olut_id, $arvostelija_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $arvostelut = array();
        
        foreach($rows as $row){
            $arvostelut[] = new Arvostelu(array(
                'id' => $row['id'],
                'arvosana' => $row['arvosana'],
                'arvostelupaiva' => $row['arvostelupaiva'],
                'olut_id' => $row['olut_id'],
                'arvostelija_id' => $row['arvostelija_id']
                    ));
        }
        
        return $arvostelut;
        
    }
    
    public static function arvosteluJoinOlut($id){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelu INNER JOIN Olut ON (arvostelu.olut_id = olut.id) WHERE arvostelu.arvostelija_id = :id');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        $arvostelut = array();
        
        foreach($rows as $row){
            $arvostelut[] = new Arvostelu(array(
                'id' => $row['id'],
                'arvosana' => $row['arvosana'],
                'arvostelupaiva' => $row['arvostelupaiva'],
                'olut_id' => $row['olut_id'],
                'arvostelija_id' => $row['arvostelija_id'],
                'nimi' => $row['nimi']
                    ));
        }
    }


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
}

