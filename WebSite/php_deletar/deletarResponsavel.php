<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["id"])){
        $idResponsavel = $_GET["id"];
        $sql = "DELETE FROM Responsavel WHERE id = $idResponsavel";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    alert("Registro excluído com sucesso")
                    window.location= "../tela_listar/responsaveis.php"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert("Erro ao excluir o registro\n\nVerifique se há algum aluno relacionado a esse responsável")
                    window.location= "../tela_listar/responsaveis.php"
                </script>
            <?php
        }
    }

?>