<?php

    //https://www.youtube.com/watch?v=Gc72ZYSZPSc&ab_channel=Ot%C3%A1vioMiranda


    session_start();
    $_SESSION['logged'] = $_SESSION['logged'] ?? false;
    
    $usuario = $_POST['txtUsuario'] ?? NULL;
    $senha = $_POST['txtSenha'] ?? NULL;

    
    //Procurar usuário no banco de dados
    if(isset($_POST['Entrar'])){
        include_once("conexao.php");
        $sql = "SELECT * FROM Funcionario WHERE verificado = 1 AND email = '$usuario' ";
        $funcionarios = $conn->query($sql);
        $verificar = $funcionarios->fetch_assoc();
        //Se encontrado, fazer login
        if($usuario == $verificar['email'] && $senha == $verificar['senha']){
            $_SESSION['usuario'] = $verificar['Nome'];
            $_SESSION['senha'] = $verificar["senha"];
            $_SESSION['email'] = $verificar["email"];
            $_SESSION['logged'] = True;

            header("Location: menus.php");
            exit();
        }
        else{
            ?>
            <script>
                /*
                const errorElement = document.getElementById('error');

                let messages = []
                messages.push(' Email ou senha inválidos')
                e.preventDefault();
                errorElement.innerText = messages.join(', ');
                */
                
            </script>
            <?php
            header("Location: indexErro.php");
            exit();
            
        }
    }

    //Fazer logout
    if (isset($_GET['logout']) && $_GET['logout'] == 1) {
        ?>
            <script>
                alert("Logout 1")
            </script>
        <?php
        $_SESSION = array();
        session_destroy();
        header('Location: /index.php');
    }


    
?>