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
            //alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../FuncionarioLiberarAcesso.php";

            alert("Registro salvo com sucesso");
            //window.history.back();
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            //Envia para outra página
            //window.history.back();
        </script>
        
        <?php
    }

?>