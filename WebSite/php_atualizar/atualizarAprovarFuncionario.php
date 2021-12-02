<?php
    include_once("../conexao.php");


    if(isset($_GET["id"])){
        $id = $_GET["id"];
        

        $sql = "UPDATE Funcionario SET verificado = 1 WHERE id = $id";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    //alert("Funcionário aprovado com sucesso")
                    window.location= "../tela_listar/funcionariosAprovar.php?resposta=1"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location= "../tela_listar/funcionariosAprovar.php?resposta=2"
                    //window.location= "../tela_listar/funcionarios.php"
                    //window.history.back();
                </script>
            <?php
        }
    }

?>