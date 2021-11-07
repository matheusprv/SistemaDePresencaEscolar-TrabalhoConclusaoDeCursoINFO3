<?php
    
    include_once("../conexao.php");


    $idTurma = $_GET['idTurma'];
    $nome = $_POST["txtNome"];
    $ano = $_POST["numAno"];
    

    $sql = "UPDATE Turma SET nome = '$nome', ano = '$ano' WHERE idTurma = $idTurma";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                alert("Registro atualizado com sucesso")
                window.location= "../tela_listar/turmas.php"
            </script>
        <?php
    }
    else{
        echo $sql;
        ?>
            <script>
                alert("Erro ao atualizar dados do aluno")
                window.location= "../tela_listar/turmas.php"
            </script>
        <?php
    }
    

?>