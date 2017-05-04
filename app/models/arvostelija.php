<?php

class Arvostelija extends BaseModel{
    public $id, $username, $password;
    
    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('validate_username', 'validate_password');
    }
    
    public function validate_username(){
        $errors = array();
        if($this->username == '' || $this->username == null){
            $errors[] = 'Käyttäjänimi ei saa olla tyhjä!';
        }
        if(strlen($this->username) < 5 || strlen($this->username) > 10){
            $errors[] = 'Käyttäjänimen tulee olla vähintään 5 ja enintään 10 merkkiä!';
        }
        return $errors;
    }
    
    public function validate_password(){
        $errors = array();
        if($this->password == '' || $this->password == null){
            $errors[] = 'Salasana ei saa olla tyhjä!';
        }
        if(strlen($this->password) < 6 || strlen($this->password) > 10){
            $errors[] = 'Salasanan tulee olla vähintään 6 ja enintään 10 merkkiä!';
        }
        return $errors;
    }

        public function save(){
        $query = DB::connection()->prepare('INSERT INTO Arvostelija (username, password) VALUES (:username, :password) RETURNING id');
        $query->execute(array('username' => $this->username, 'password' => $this->password));
        $row = $query->fetch();
        $this->id = $row['id'];
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
    
    public static function authenticate($username, $password){
        $query = DB::connection()->prepare('SELECT * FROM Arvostelija WHERE username = :username AND password = :password LIMIT 1');
        $query->execute(array('username' => $username, 'password' => $password));
        $row = $query->fetch();
        if($row){
            $arvostelija = new Arvostelija(array(
                'id' => $row['id'],
                'username' => $row['username'],
                'password' => $row['password']
                 ));   
            //käyttäjä löytyi, palautetaan löytynyt käyttäjä oliona
            return $arvostelija;
        }else{
            //käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }
}

