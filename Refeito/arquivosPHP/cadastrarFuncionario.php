<?php

    //Verificar se o usuário está logado ou se é um novo
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        $logado =false;
    }

    //Incluindo arquivo de conexão com o banco de dados
    include_once("conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $senha = $_POST["txtSenha"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Funcionario (Nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        
        //Envia para a pagina inicial se não está logado
        if($logado){
            header("Location: ../criar/cadastrarFuncionario.php");
            exit();
        }
        else{
            header("Location: ../index.php");
            exit();
        }

    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            //Envia para outra página
            window.history.back();
        </script>
        
        <?php
    }

?>