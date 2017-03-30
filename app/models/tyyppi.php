<?php

class Tyyppi extends BaseModel{
    public $id, $nimi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Tyyppi');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $tyypit = array();
        
        foreach($rows as $row){
            $tyypit[] = new Tyyppi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
                    ));
        }
        
        return $tyypit;
        
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Tyyppi WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $tyyppi = new Tyyppi(array(
                'id' => $row['id'],
                'nimi' => $row['nimi']
            ));
            
            return $tyyppi;
        }
        return null;
    }
}

