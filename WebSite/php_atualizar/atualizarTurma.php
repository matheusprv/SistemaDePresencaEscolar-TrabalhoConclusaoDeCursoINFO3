<?php
    
    include_once("../conexao.php");


    $idTurma = $_GET['idTurma'];
    $nome = $_POST["txtNome"];
    $ano = $_POST["numAno"];
    

    $sql = "UPDATE Turma SET nome = '$nome', ano = '$ano' WHERE idTurma = $idTurma";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                window.location= "../tela_listar/turmas.php?resposta=3"
            </script>
        <?php
    }
    else{
        echo $sql;
        ?>
            <script>
                window.location= "../tela_listar/turmas.php?resposta=4"
            </script>
        <?php
    }
    

?>