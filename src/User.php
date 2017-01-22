<?php

class User {
    private $id;
    private $username;
    private $hashedPassword;
    private $email;

    public function __construct() {
        $this->id = -1;
        $this->username = "";
        $this->email = "";
        $this->hashedPassword = "";
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUsername(){
        return $this->username;
    }
    
    public function getHashedPassword(){
        return $this->hashedPassword;
    }
    
    public function getEmail(){
        return $this->email;
    }

    public function setUsername($username) {
        if (empty($username)) {
        echo 'Błąd nie podano nazwy użytkownika';
        }
        $this->username = $username;
    }
    
    public function setEmail($email) {
        if (empty($email)) {
        echo 'Błąd nie podano nazwy użytkownika';
        }
        $this->email = $email;
    }
    
    public function setHashedPassword($hashedPassword) {
        $newHashedPassword = password_hash($hashedPassword, PASSWORD_BCRYPT);
        $this->hashedPassword = $newHashedPassword;
    }
    
    public function saveToDB(mysqli $conn){
        if($this->id == -1){
            $sql = "INSERT INTO users(username, email, hashed_password)
                VALUES ('$this->username', '$this->email', '$this->hashedPassword')";
            $result = $conn->query($sql);
            if($result == true){
                $this->id = $conn->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE users SET username = '" . $this->username .
                "', email = '" . $this->email .
                "', hashed_password = '" . $this->hashedPassword . "'
                WHERE id = " . $this->id;

            $result = $conn->query($sql);

            if ($result == true) {
                return true;
            } 
        }
    return false;
    }
    
    static public function loadUserById(mysqli $conn, $id){
        $sql = "SELECT * FROM users WHERE id = $id";
        
        $result = $conn->query($sql);
        
        if($result == true && $result->num_rows > 0){
            $row = $result->fetch_object(); 
            
            $loadedUser = new User();
            $loadedUser->id = $row->id;
            $loadedUser->username = $row->username;
            $loadedUser->hashedPassword = $row->hashed_password;
            $loadedUser->email = $row->email;
            
            return $loadedUser;
        }
    return null;
    }    
    
    static public function loadAllUsers(mysqli $conn){
        
        $sql = "SELECT * FROM users";
        $ret = [];
        
        $result = $conn->query($sql);
        
        if($result == true && $result->num_rows > 0){
            foreach($result as $row){
                $loadedUser = new User();
                $loadedUser->id = $row['id'];
                $loadedUser->username = $row['username'];
                $loadedUser->email = $row['email'];
                $loadedUser->hashedPassword = $row['hashed_password'];
                
                $ret[] = $loadedUser;
            }            
        }
        return $ret;
    }
    
    public function delete(mysqli $conn){
        if ($this->id != -1) {
            $sql = "DELETE FROM users WHERE id = " . $this->id;

            $result = $conn->query($sql);

            if ($result == true) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }    
}