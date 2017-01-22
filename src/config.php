<?php

//define("DB_HOST", "localhost");
//define("DB_USER", "root");
//define("DB_PASSWORD", "coderslab");
//define("DB_DBNAME", "twitter");

$DB_HOST = "localhost";
$DB_USER = "root";
$DB_PASSWORD = "coderslab";
$DB_DBNAME = "twitter";

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DBNAME);

if ($conn->connect_error) {
    die("Połączenie nieudane. Bład: " . $conn->connect_error);
} 

/*
CREATE TABLE users (
    id int NOT NULL AUTO_INCREMENT,
    email varchar(255) NOT NULL UNIQUE,
    username varchar(255) NOT NULL,
    hashed_password varchar(60) NOT NULL,
    PRIMARY KEY (id)
    );
 * 
 CREATE TABLE tweet (
    id int NOT NULL AUTO_INCREMENT,
    userId int NOT NULL,
    text varchar(140) NOT NULL,
    creationDate date NOT NULL,
    PRIMARY KEY (id),
    FOREIGN KEY(userId)
    REFERENCES users(id) ON DELETE CASCADE
    );
 *  
*/    

$conn->close();
$conn = null;
?>