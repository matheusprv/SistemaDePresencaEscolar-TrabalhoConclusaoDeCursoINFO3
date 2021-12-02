<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["id"])){
        $idResponsavel = $_GET["id"];
        $sql = "DELETE FROM Responsavel WHERE id = $idResponsavel";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    window.location= "../tela_listar/responsaveis.php?resposta=5"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location= "../tela_listar/responsaveis.php?resposta=6"
                </script>
            <?php
        }
    }

?>