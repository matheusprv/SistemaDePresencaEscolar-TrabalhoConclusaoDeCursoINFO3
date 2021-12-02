<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["idDisciplina"])){
        $idDisciplina = $_GET["idDisciplina"];
        $sql = "DELETE FROM Disciplina WHERE idDisciplina = $idDisciplina";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    window.location= "../tela_listar/disciplinas.php?resposta=5"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location= "../tela_listar/disciplinas.php?resposta=6"
                </script>
            <?php
        }
    }

?>