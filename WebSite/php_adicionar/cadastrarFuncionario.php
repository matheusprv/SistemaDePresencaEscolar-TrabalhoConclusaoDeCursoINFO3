<?php

    //Verificar se o usuário está logado ou se é um novo
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;

    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $senha = $_POST["txtSenha"];


    //verificar se o emai já está cadastrado
    $sql = "SELECT * FROM Funcionario WHERE email = '$email' ";
    //$sql = "SELECT * FROM Funcionario WHERE verificado = 0";
    $funcionarios = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($funcionarios);

    if($numeroDeResultados>0){
        ?>
            <script>
                alert("ERRO! \nEmail já cadastrado");
                window.history.back();
            </script>
        <?php
    }
    else{
        //Inserindo valores no banco
        $sql = "INSERT INTO Funcionario (Nome, email, senha) VALUES ('$nome', '$email', '$senha')";

        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            //Envia para a pagina inicial ao criar uma conta nova, se não está logado
            if(session_status() === PHP_SESSION_NONE){
                header("Location: ../index.php");
                exit();
            }
            
            else{
                header("Location: ../tela_criar/cadastrarFuncionario.php");
            }

        }
        else{
            ?>
            <script>
                alert("Erro ao inserir registro");
                window.history.back();
            </script>
            
            <?php
        }
    }
?>