<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("conexao.php");

    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    $senha = $_POST["txtSenha"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Funcionario (Nome, email, senha) VALUES ('$nome', '$email', '$senha')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            //alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../FuncionarioCadastro.html";

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