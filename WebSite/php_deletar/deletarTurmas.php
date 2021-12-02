<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["idTurma"])){
        $idTurma = $_GET["idTurma"];
        $sql = "DELETE FROM Turma WHERE idTurma = $idTurma";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    window.location= "../tela_listar/turmas.php"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location= "../tela_listar/turmas.php"
                </script>
            <?php
        }
    }

?>