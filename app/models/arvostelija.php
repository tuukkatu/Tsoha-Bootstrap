<?php

class Arvostelija extends BaseModel{
    public $id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelija');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $arvostelijat = array();
        
        foreach($rows as $row){
            $arvostelijat[] = new Arvostelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
                    ));
        }
        
        return $arvostelijat;
        
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelija WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $arvostelija = new Arvostelija(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            
            return $arvostelija;
        }
        return null;
    }
}

