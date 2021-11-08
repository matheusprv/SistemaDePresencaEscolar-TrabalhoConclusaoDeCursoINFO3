<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    include_once("../dados_login.php");

    $email = $_POST["txtEmail"];
    $senhaAtual = $_POST["txtSenhaAtual"];
    $novaSenha = $_POST["txtSenha"];
    $senhaConfirmada = $_POST["txtSenhaConfirmar"];


    echo $senhaAtual;
    echo "<br>";
    echo  $_SESSION['senha'];
    //Verificar se a senha atual está correta
    if($senhaAtual == $_SESSION['senha']){
        
        //Executar sql
        $sql = "UPDATE Funcionario SET senha = '$novaSenha' WHERE email = '$email'";

        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            $_SESSION['senha'] = $novaSenha;
            ?>
                <script>
                    alert("Senha alterada com sucesso");
                    window.history.back();
                </script>
            <?php
            //header("Location: ../tela_listar/usuario.php");
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
    else{
        ?>
        <script>
            alert("Senha atual incorreta");
            window.history.back();
        </script>
        <?php
    }


    


?>