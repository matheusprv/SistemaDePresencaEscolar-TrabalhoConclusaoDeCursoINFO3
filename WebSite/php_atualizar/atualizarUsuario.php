<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    include_once("../dados_login.php");

    $email = $_POST["txtEmail"];
    $senhaAtual = $_POST["txtSenhaAtual"];
    $novaSenha = $_POST["txtSenha"];
    $senhaConfirmada = $_POST["txtSenhaConfirmar"];
    /*
    echo $email;
    echo "<br>";
    echo $senhaAtual;
    echo "<br>";
    echo  $_SESSION['senha'];
    echo "<br>";
    echo $novaSenha;
    echo "<br>";
    */
    //Verificar se a senha atual está correta
    if($senhaAtual == $_SESSION['senha']){
        
        //Executar sql
        $sql = "UPDATE Funcionario SET senha = '$novaSenha' WHERE email = '$email'";
        //echo $sql;
        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            $_SESSION['senha'] = $novaSenha;
            ?>
                <script>
                    //alert("Senha alterada com sucesso");
                    window.location = "../tela_listar/usuario.php?resposta=1";
                </script>
            <?php
        }
        else{
            ?>
            <script>
                window.location = "../tela_listar/usuario.php?resposta=3";
            </script>
            
            <?php
        }
    }
    else{
        ?>
        <script>
            //alert("Senha atual incorreta");
            window.location = "../tela_listar/usuario.php?resposta=2";
            //window.history.back();
        </script>
        <?php
    }


    


?>