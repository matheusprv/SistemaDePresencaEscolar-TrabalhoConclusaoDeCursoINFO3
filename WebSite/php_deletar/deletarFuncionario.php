<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["id"], $_GET["telaAprovar"])){
        $id = $_GET["id"];
        $telaAprovar = $_GET["telaAprovar"];


        $sql = "DELETE FROM Funcionario WHERE id = $id";

        if($conn->query($sql)== TRUE){
            //Se o valor for 1, vai para a tela de aprovar funcionários
            if($telaAprovar == 1){
                header("Location: ../tela_listar/funcionariosAprovar.php");
            }
            else{
                header("Location: ../tela_listar/funcionarios.php");
            }
        }
        else{
            echo $sql;
            ?>
                <script>
                    alert("Erro ao excluir o registro")
                </script>
            <?php
            //Se o valor for 1, vai para a tela de aprovar funcionários
            if($telaAprovar == 1){
                header("Location: ../tela_listar/funcionariosAprovar.php");
            }
            else{
                header("Location: ../tela_listar/funcionarios.php");
            }
        }
    }

?>