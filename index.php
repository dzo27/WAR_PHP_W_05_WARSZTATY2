<?php
        require_once __DIR__ . '/src/config.php';
        require_once __DIR__ . '/src/User.php';
        
        $user = new User();
        $user->setUsername('john_doe');
        $user->setHashedPassword('12345');
        $user->setEmail('john_doe@example.net');
        
        //var_dump($user);
        
        //$user = new User();
        //$user->setUsername('jenny_may');
        //$user->setHashedPassword('54321');
        //$user->setEmail('jenny_may@example.net');
        
        //var_dump($user);
        
        //$user = new User();
        //$user->setUsername('luck_moe');
        //$user->setHashedPassword('z12345z');
        //$user->setEmail('luck_moe@example.net');
        
        $conn = new mysqli($DB_HOST, $DB_USER, $DB_PASSWORD, $DB_DBNAME);

        if ($conn->connect_error) {
            die("Połączenie nieudane. Bład: " . $conn->connect_error);
        }
        
        $result = $user->saveToDB($conn);
        
        //var_dump($result);
        
        //var_dump($user);
        
        echo $user->loadUserById($result, 1);
        
?>