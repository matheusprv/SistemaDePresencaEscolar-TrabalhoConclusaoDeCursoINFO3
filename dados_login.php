<?php

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
        header('Location: index.php');
    }

    /*
    include_once("arquivosPHP/conexao.php");
    session_start();
        if(isset($_POST['btnEntrar'])){

            $usuario = $_POST['txtUsuario'] ?? NULL;
            $senha = $_POST['txtSenha'] ?? NULL;

           if(empty($usuario) || empty($senha)){
                //header("location:index.php?Empty= Please Fill in the Blanks");
           }
           else{
                $sql = "SELECT * FROM Funcionario WHERE verificado = 1 AND email = '$usuario' ";
                $resultado = $conn->query($sql);
    
                if(mysqli_fetch_assoc($resultado)){
                    $_SESSION['usuario']=$resultado['nome'];
                    header("location: menus.php");
                }
                else{
                    //header("location:index.php?Invalid= Please Enter Correct User Name and Password ");
                }
           }
        }
        else{
            //echo 'Not Working Now Guys';
        }
    */
?>