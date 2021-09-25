<?php

    $servername = "200.18.128.50"; 
    $username = "presencaescolar"; 
    $password = "2021@Presencaescolar"; 
    $dbname = "presencaescolar"; 

    $conn = new mysqli($servername, $username, $password, $dbname);

    //checar conexão
    if($conn->connect_error){
        die("Falha na conexão: " . $conn->connect_error);
    }    

?>