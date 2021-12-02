<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $professor = $_POST["txtProf"];
    $numeroAulas = $_POST["numAulas"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Disciplina (nome, professor, numeroAulas) VALUES ('$nome', '$professor', '$numeroAulas')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            //Envia para outra página
            window.location = "../tela_listar/disciplinas.php?resposta=1";
        </script>

        <?php
    }
    else{
        ?>
        <script>
            window.location = "../tela_listar/disciplinas.php?resposta=2";
        </script>
        
        <?php
    }

?>