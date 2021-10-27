<?php

    //Verificar se o usuário está logado ou se é um novo
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;

    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $id = $_GET["id"];
    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];

    //verificar se o emai já está cadastrado
    $sql = "SELECT * FROM Funcionario WHERE email = '$email' ";
    $funcionarios = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($funcionarios);


    //Atualizando valores no banco
    $sql = "UPDATE Funcionario SET Nome = '$nome' WHERE id = $id";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        header("Location: ../tela_listar/funcionarios.php");
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            window.history.back();
        </script>
        
        <?php
    }
    
?>