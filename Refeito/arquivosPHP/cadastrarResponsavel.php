<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];

    //Criar senha aleatoria
    $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $senha = substr(str_shuffle($string),0,10);


    //Inserindo valores no banco
    $sql = "INSERT INTO Responsavel (nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../criar/cadastrarResponsavel.php";
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