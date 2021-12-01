<?php
    include_once("../conexao.php");


    $matricula = $_GET["matricula"];
    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];
    

    $sql = "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel' WHERE matricula = $matricula";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                window.location = "../tela_listar/alunos.php?respostaAdicionarAluno=1";
            </script>
        <?php
    }
    else{
        echo $sql;
        ?>
            <script>
                window.location = "../tela_listar/alunos.php?respostaAdicionarAluno=2";
            </script>
        <?php
    }
    

?>