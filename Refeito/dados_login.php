<?php

    //https://www.youtube.com/watch?v=Gc72ZYSZPSc&ab_channel=Ot%C3%A1vioMiranda


    session_start();
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;
    
    $usuario = $_POST['txtUsuario'] ?? NULL;
    $senha = $_POST['txtSenha'] ?? NULL;

    //Procurar dados no banco

    if(isset($_POST['Entrar'])){
        include_once("arquivosPHP/conexao.php");
        $sql = "SELECT * FROM Funcionario WHERE verificado = 1 AND email = '$usuario' ";
        $funcionarios = $conn->query($sql);
        $verificar = $funcionarios->fetch_assoc();


        if($usuario == $verificar['email'] && $senha == $verificar['senha']){
            $_SESSION['usuario'] = $verificar['Nome'];
            $_SESSION['senha'] = $verificar["senha"];
            $_SESSION['email'] = $verificar["email"];
            $_SESSION['logged'] = True;

            header("Location: menus.php");
            exit();
        }
        else{
            echo "<p> Usuário não encontrado </p>";
        }
    }

    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        $_SESSION = array();
        session_destroy();
        header('Location: /');
    }
    /*
    else if (isset($_GET['logout']) && $_GET['logout'] == 2) {
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }*/
    
?>