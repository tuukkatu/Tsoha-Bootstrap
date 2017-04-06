<?php

class Arvostelija extends BaseModel{
    public $id, $username, $password;
    
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
                'username' => $row['username'],
                'password' => $row['password']
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
                'username' => $row['username'],
                'password' => $row['password']
            ));
            
            return $arvostelija;
        }
        return null;
    }
    
    public static function authenticate(){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelija WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if($row){
            //käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            return $arvostelija;
        }else{
            //käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }
}

