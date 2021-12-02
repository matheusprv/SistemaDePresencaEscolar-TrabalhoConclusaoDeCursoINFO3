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
                window.location= "../tela_listar/disciplinas.php?resposta=3"
            </script>
        <?php
    }
    else{
        ?>
            <script>
                window.location= "../tela_listar/disciplinas.php?resposta=4"
            </script>
        <?php
    }
    

?>