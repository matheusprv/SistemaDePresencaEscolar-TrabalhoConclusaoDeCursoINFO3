<?php

    //Verificar se o usuário está logado ou se é um novo
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;

    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $senha = $_POST["txtSenha"];
    include("../criptografarSenha/criptografarSenha.php");

    //verificar se o email já está cadastrado
    $sql = "SELECT * FROM Funcionario WHERE email = '$email' ";
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
        if (!$logged) {
            $sql = "INSERT INTO Funcionario (Nome, email, senha ) VALUES ('$nome', '$email', '$senha')";
        }
        else{
            $sql = "INSERT INTO Funcionario (Nome, email, senha, verificado) VALUES ('$nome', '$email', '$senha', 1)";
        }      

        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            //Envia para a pagina inicial ao criar uma conta nova, se não está logado
            if (!$logged) {
                header("Location: ../index.php");
                exit();
            }
            
            else{
                header("Location: ../tela_listar/funcionarios.php?resposta=1");
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