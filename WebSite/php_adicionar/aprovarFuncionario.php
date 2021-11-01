<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $email = $_POST["txtEmail"];

    //Inserindo valores no banco
    $sql = "UPDATE Funcionario SET verificado = '1' WHERE email = '$email' ";
    
    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            //Envia para outra página
            alert("Registro salvo com sucesso");
            window.location = "../FuncionarioLiberarAcesso.php";
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            window.location = "../FuncionarioLiberarAcesso.php";
        </script>
        
        <?php
    }

?>