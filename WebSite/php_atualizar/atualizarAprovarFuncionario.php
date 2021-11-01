<?php
    include_once("../conexao.php");


    if(isset($_GET["id"])){
        $id = $_GET["id"];
        

        $sql = "UPDATE Funcionario SET verificado = 1 WHERE id = $id";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    //alert("Funcionário aprovado com sucesso")
                    window.location= "../tela_listar/funcionariosAprovar.php"
                </script>
            <?php
        }
        else{
            echo $sql;
            ?>
                <script>
                    alert("Erro ao aprovar funcionário")
                    //window.location= "../tela_listar/funcionarios.php"
                    //window.history.back();
                </script>
            <?php
        }
    }

?>