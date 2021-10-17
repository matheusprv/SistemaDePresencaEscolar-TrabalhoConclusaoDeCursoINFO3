<?php
    include_once("../arquivosPHP/conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["id"])){
        $idResponsavel = $_GET["id"];
        $sql = "DELETE FROM Responsavel WHERE id = $idResponsavel";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    alert("Registro excluído com sucesso")
                    window.location= "../listar/responsaveis.php"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    alert("Erro ao excluir o registro")
                    window.location= "../listar/responsaveis.php"
                </script>
            <?php
        }
    }

?>