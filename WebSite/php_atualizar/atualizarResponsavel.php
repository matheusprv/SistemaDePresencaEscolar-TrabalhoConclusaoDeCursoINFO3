<?php
    
    include_once("../conexao.php");


    $id = $_GET['id'];
    $nome = $_POST["txtNome"];
    $email = $_POST["txtEmail"];
    

    $sql = "UPDATE Responsavel SET nome = '$nome', email = '$email' WHERE id = $id";

    if($conn->query($sql)== TRUE){
        ?>
            <script>
                window.location= "../tela_listar/responsaveis.php?resposta=3"
            </script>
        <?php
    }
    else{
        ?>
            <script>
                window.location= "../tela_listar/responsaveis.php?resposta=4"
            </script>
        <?php
    }
    

?>