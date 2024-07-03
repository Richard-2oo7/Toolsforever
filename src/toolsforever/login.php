<?php
    // $servername = "docker-mysql-1";
    // $username = "root";
    // $password = "password";
    // $database = "toolsforever";
     
    // // Connectie maken met de database
    // $conn = new mysqli($servername, $username, $password, $database);

    // if ($conn->connect_error) {
    //     echo "niet conected";
    //     die("Connection failed: " . $conn->connect_error);
    // }
    $users = [
        [
            "naam" => "medewerker1",
            "wachtwoord" => "272728"
        ],
        [
            "naam" => "medewerker2",
            "wachtwoord" => "12123"
        ]
    ];

    if(isset($_POST['naam']) && isset($_POST['wachtwoord']) && isset($_POST['loginbtn'])){
        if(!empty($_POST['naam']) && !empty($_POST['wachtwoord'])){
            
            foreach($users as $user){
                if($user['naam'] === $_POST['naam'] && $user['wachtwoord'] == $_POST['wachtwoord']){
                    
                }
            }
        }
    }

    ?>