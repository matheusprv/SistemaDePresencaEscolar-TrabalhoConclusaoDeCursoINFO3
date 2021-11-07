<?php
    
    include_once("../conexao.php");


    $id = $_GET['id'];
    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    

    $sql = "UPDATE Responsavel SET nome = '$nome', email = '$email' WHERE id = $id";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                alert("Registro atualizado com sucesso")
                window.location= "../tela_listar/responsaveis.php"
            </script>
        <?php
    }
    else{
        echo $sql;
        ?>
            <script>
                alert("Erro ao atualizar dados do aluno")
                window.location= "../tela_listar/responsaveis.php"
            </script>
        <?php
    }
    

?>