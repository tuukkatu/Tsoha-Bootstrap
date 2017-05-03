<?php

class Olut extends BaseModel{
    public $id, $nimi, $panimo, $kuvaus, $tyyppi_id, $tyyppi;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_nimi', 'validate_panimo');
    }
    
    public function validate_nimi(){
        $errors = array();
        if($this->nimi == '' || $this->nimi == null){
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if(strlen($this->nimi) < 3 || strlen($this->nimi) > 50) {
            $errors[] = 'Nimen pituuden tulee olla vähintään 3 ja alle 50 merkkiä!';
        }
        return $errors;
    }
    
    public function validate_panimo(){
        $errors = array();
        if($this->panimo == '' || $this->panimo == null){
            $errors[] = 'Panimon nimi ei saa olla tyhjä!';
        }
        if(strlen($this->panimo) < 3) {
            $errors[] = 'Panimon nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        return $errors;
    }
    
    public static function all(){
        $query = DB::connection()->prepare('SELECT Olut.id AS id, Olut.nimi AS nimi, Olut.panimo AS panimo, Olut.kuvaus AS kuvaus, Olut.tyyppi_id AS tyyppi_id, Tyyppi.nimi AS tyyppi FROM Olut, Tyyppi WHERE Olut.tyyppi_id  = Tyyppi.id ORDER BY Olut.id');
        
        $query->execute();
        
        $rows = $query->fetchAll();
        
        $oluet = array();
        
        foreach($rows as $row){
            $oluet[] = new Olut(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'panimo' => $row['panimo'],
                'kuvaus' => $row['kuvaus'],
                'tyyppi_id' => $row['tyyppi_id'],
                'tyyppi' => $row['tyyppi']
                    ));
        }
        
        return $oluet;
        
    }
    
    public static function find($id){
        $query = DB::connection()->prepare('SELECT Olut.id AS id, Olut.nimi AS nimi, Olut.panimo AS panimo, Olut.kuvaus AS kuvaus, Olut.tyyppi_id AS tyyppi_id, Tyyppi.nimi AS tyyppi FROM Olut, Tyyppi WHERE Olut.tyyppi_id  = Tyyppi.id AND Olut.id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        
        if($row){
            $olut = new Olut(array(
                'id' => $row['id'],
                'nimi' => $row['nimi'],
                'panimo' => $row['panimo'],
                'kuvaus' => $row['kuvaus'],
                'tyyppi' => $row['tyyppi'],
                'tyyppi_id' => $row['tyyppi_id']
            ));
            
            return $olut;
        }
        return null;
    }
    
    public function save(){
        $query = DB::connection()->prepare('INSERT INTO Olut (nimi, panimo, kuvaus, tyyppi_id) VALUES (:nimi, :panimo, :kuvaus, :tyyppi_id) RETURNING id');
        $query->execute(array('nimi' => $this->nimi, 'panimo' => $this->panimo, 'kuvaus' => $this->kuvaus, 'tyyppi_id' => $this->tyyppi_id));
        $row = $query->fetch();
        $this->id = $row['id'];
    }
    
    public function update(){
        $query = DB::connection()->prepare('UPDATE Olut SET nimi = :nimi, panimo = :panimo, kuvaus = :kuvaus, tyyppi_id = :tyyppi_id WHERE id = :id');
        $query->execute(array('id' => $this->id, 'nimi' => $this->nimi, 'panimo' => $this->panimo, 'kuvaus' => $this->kuvaus, 'tyyppi_id' => $this->tyyppi_id));
    }
    
    public function destroy(){
        $query = DB::connection()->prepare('DELETE FROM Olut WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }
    
//    public static function OlutTyyppi($id){
//        $query = DB::connection()->prepare('SELECT Tyyppi.nimi AS tyyppi FROM Olut.tyyppi_id  = Tyyppi.id');
//        $query->execute(array('id' => $id));
//        $row = $query->fetch();
//        
//        $arvostelut = array();
//        
//        foreach($rows as $row){
//            $arvostelut[] = new Arvostelu(array(
//                'id' => $row['id'],
//                'nimi' => $row['nimi'],
//                'panimo' => $row['panimo'],
//                'kuvaus' => $row['kuvaus'],
//                'tyyppi_id' => $row['tyyppi_id'],
//                'tyyppi' => $row['tyyppi']
//                    ));
//        }
//    }
}

