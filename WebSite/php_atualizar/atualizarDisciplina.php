<?php
    include_once("../conexao.php");


    $id = $_GET['idDisciplina'];
    $nome = $_POST["txtNome"];
    $professor = $_POST["txtProf"];
    $numeroAulas = $_POST["numAulas"];
    

    $sql = "UPDATE Disciplina SET nome = '$nome', professor = '$professor', numeroAulas = '$numeroAulas' WHERE idDisciplina = $id";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                alert("Registro atualizado com sucesso")
                window.location= "../tela_listar/disciplinas.php"
            </script>
        <?php
    }
    else{
        echo $sql;
        ?>
            <script>
                alert("Erro ao atualizar dados do aluno")
                window.location= "../tela_listar/disciplinas.php"
            </script>
        <?php
    }
    

?>