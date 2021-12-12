<?php
    include_once("../conexao.php");


    $matricula = $_GET["matricula"];
    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];
    
    if(isset($_POST["cartaoRFID"])){
        $cartao = $_POST["cartaoRFID"];
        $sql = "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel', uidCartao = '$cartao' WHERE matricula = $matricula";
    }
    else{
        $sql = "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel' WHERE matricula = $matricula";
    }

    

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                window.location = "../tela_listar/alunos.php?resposta=3";
            </script>
        <?php
    }
    else{
        ?>
            <script>
                window.location = "../tela_listar/alunos.php?resposta=4";
            </script>
        <?php
    }
    

?>