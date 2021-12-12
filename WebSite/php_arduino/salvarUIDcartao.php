<?php
    include_once("../conexao.php");

    $uid = $_GET["uid"];


    $sql = "INSERT INTO cartoesDisponivel (uid, disponivel) values ('$uid', 1) ";
    
    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        echo "sucesso";
    }
    else{
        echo "erro";
    }


?>