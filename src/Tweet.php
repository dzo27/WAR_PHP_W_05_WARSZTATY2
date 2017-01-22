<?php

class Tweet{
    private $id;
    private $userId;
    private $text;
    private $creationDate;
    
    public function __construct(){
        $this->id = -1;
        $this->userId = "";
        $this->text = "";
        $this->creationDate = "";
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getUserId(){
        return $this->userId;
    }
    
    public function getText(){
        return $this->text;
    }
    
    public function getCreationDate(){
        return $this->creationDate;
    }
    
    public function setUserId($userId){
        $this->userId =  $userId;
    }
    
    public function setText($text){
        if(is_string($text) && strlen($text) > 0){
            $this->text = $text;
        }
        if(strlen($text) > 140){
            echo 'Tweet może mieć tylko 140 znaków';
        }
    }
    
    public function setCreationDate($date){
        $this->creationDate = $date;
    }
    
    static public function loadTweetById(mysqli $conn, $id){
        $sql = "SELECT * FROM tweet WHERE id = $id";
        
        $result = $conn->query($sql);
        
        if($result == true && $result->num_rows > 0){
            $row = $result->fetch_object(); 
            
            $loadedTweet = new Tweet();
            $loadedTweet->id = $row->id;
            $loadedTweet->userId = $row->userId;
            $loadedTweet->text = $row->text;
            $loadedTweet->creationDate = $row->creationDate;
            
            return $loadedTweet;
        }
    return null;
    } 
    
    static public function loadAllTweet(mysqli $conn){
        
        $sql = "SELECT * FROM tweet ORDER BY creationDate DESC";
        $ret = [];
        
        $result = $conn->query($sql);
        
        if($result == true && $result->num_rows > 0){
            foreach($result as $row){
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                
                $ret[] = $loadedTweet;
            }            
        }
        return $ret;
    }
    
    static public function loadAllTweetsByUserId(mysqli $conn, $userId){
        
        $sql = "SELECT * FROM tweet WHERE userId = $userId";
        $ret = [];
        
        $result = $conn->query($sql);
        
        if($result == true && $result->num_rows > 0){
            foreach($result as $row){
                $loadedTweet = new Tweet();
                $loadedTweet->id = $row['id'];
                $loadedTweet->userId = $row['userId'];
                $loadedTweet->text = $row['text'];
                $loadedTweet->creationDate = $row['creationDate'];
                
                $ret[] = $loadedTweet;
            }            
        }
        return $ret;
    }
    
    public function saveToDB(mysqli $conn){
        if($this->id == -1){
            $sql = "INSERT INTO tweet(userId, text, creationDate)
                VALUES ('$this->userId', '$this->text', '$this->creationDate')";
            $result = $conn->query($sql);
            if($result == true){
                $this->id = $conn->insert_id;
                return true;
            }
        } else {

            $sql = "UPDATE tweet SET userId = '" . $this->userId .
                "', text = '" . $this->text .
                "', creationDate = '" . $this->creationDate . "'
                WHERE id = " . $this->id;

            $result = $conn->query($sql);

            if ($result == true) {
                return true;
            } 
        }
    return false;
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
}

