<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["matricula"])){
        $matricula = $_GET["matricula"];
        $sql = "DELETE FROM Aluno WHERE matricula = $matricula";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    alert("Registro excluído com sucesso")
                    window.location= "../tela_listar/alunos.php"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert("Erro ao excluir o registro")
                    window.location= "../tela_listar/alunos.php"
                </script>
            <?php
        }
    }

?>