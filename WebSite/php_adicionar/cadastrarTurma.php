<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $ano = $_POST["txtAno"];


    //Inserindo valores no banco
    $sql = "INSERT INTO Turma (nome, ano) VALUES ('$nome', '$ano')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            window.location = "../tela_listar/turmas.php?resposta=1";
        </script>

        <?php
    }
    else{
        ?>
        <script>
            window.location = "../tela_listar/turmas.php?resposta=2";
        </script>
        
        <?php
    }

?>