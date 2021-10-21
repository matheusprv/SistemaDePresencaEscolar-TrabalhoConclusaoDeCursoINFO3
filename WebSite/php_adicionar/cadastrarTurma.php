<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("conexao.php");

    $nome = $_POST["txtNome"];
    $ano = $_POST["txtAno"];


    //Inserindo valores no banco
    $sql = "INSERT INTO Turma (nome, ano) VALUES ('$nome', '$ano')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../criar/cadastrarTurma.php";
            //window.history.back();
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            //Envia para outra página
            //window.history.back();
        </script>
        
        <?php
    }

?>