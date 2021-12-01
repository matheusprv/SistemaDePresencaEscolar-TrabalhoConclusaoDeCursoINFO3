<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["matricula"])){
        $matricula = $_GET["matricula"];
        $sql = "DELETE FROM Aluno WHERE matricula = $matricula";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    window.location = "../tela_listar/alunos.php?respostaAdicionarAluno=1";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location = "../tela_listar/alunos.php?respostaAdicionarAluno=2";
                </script>
            <?php
        }
    }

?>