<?php

class Olut extends BaseModel{
    public $id, $nimi, $panimo, $tyyppi_id;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT * FROM Olut');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $oluet = array();
        
        foreach($rows as $row){
            $oluet[] = new Olut(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'panimo' => $row['panimo'],
                'tyyppi_id' => $row['tyyppi_id']
                    ));
        }
        
        return $oluet;
        
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT * FROM Olut WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $olut = new Olut(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'panimo' => $row['panimo'],
                'tyyppi_id' => $row['tyyppi_id']
            ));
            
            return $olut;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Olut (nimi, panimo, tyyppi_id) VALUES (:nimi, :panimo, :tyyppi_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'panimo' => $this->panimo, 'tyyppi' => $this->tyyppi_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
}

