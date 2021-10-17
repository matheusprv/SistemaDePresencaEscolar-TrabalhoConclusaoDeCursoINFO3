<?php
    include_once("../arquivosPHP/conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["idDisciplina"])){
        $idDisciplina = $_GET["idDisciplina"];
        $sql = "DELETE FROM Disciplina WHERE idDisciplina = $idDisciplina";

        if($conn->query($sql)== TRUE){
            ?>
                <script>
                    alert("Registro excluído com sucesso")
                    window.location= "../listar/disciplinas.php"
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    //alert("Erro ao excluir o registro")
                    //window.location= "../listar/disciplinas.php"
                </script>
            <?php
        }
    }

?>