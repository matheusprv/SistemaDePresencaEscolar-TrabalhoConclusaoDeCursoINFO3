<?php
    session_start();
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;
    
    $usuario = $_POST['txtUsuario'] ?? NULL;
    $senha = $_POST['txtSenha'] ?? NULL;

    //Procurar dados no banco

    /*
    include_once("arquivosPHP/conexao.php");
    $sql = "SELECT * FROM Funcionario WHERE verificado = 1 AND email = '$usuario' ";
    $funcionarios = $conn->query($sql);

    $verificar = $funcionarios->fetch_assoc();

    if($usuario == $verificar["email"] && $senha == $verificar["senha"]){
        $_SESSION['usuario'] = $verificar["nome"];
        $_SESSION['senha'] = $verificar["senha"];
        $_SESSION['logged'] = True;

        header("Location: menus.php");
        exit();
    }
    else{
        echo "<p> Usuário não encontrado </p>";
    }
    */
    
    $usuarioDB = 'admin';
    $senhaDB = 'admin';

    $usuario = $_POST['txtUsuario'] ?? NULL;
    $senha = $_POST['txtSenha'] ?? NULL;

    if($usuario == $usuarioDB && $senha == $senhaDB){
        $_SESSION['usuario'] = $usuarioDB;
        $_SESSION['senha'] = $senhaDB;
        $_SESSION['logged'] = True;
        header("Location: menus.php");
        exit();
    }

?>