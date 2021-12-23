<?php
    include_once("../conexao.php");

    //verificar se foi setado algum valor para a exclusao
    if(isset($_GET["matricula"])){
        $matricula = $_GET["matricula"];

        $continuar = TRUE;
        //Verificando se o aluno tem algum cartão registrado e alterando-o para disponivel
        $procurarCartaoSQL = "SELECT * FROM Cartao WHERE matriculaAluno= $matricula";
        $cartao = $conn->query($procurarCartaoSQL);

        $possuiCartao = mysqli_num_rows($cartao);
        if($possuiCartao>0){
            while($numeroCartao = $cartao->fetch_assoc()){
                $uid = $numeroCartao["uid"];
            }

            $removerCartaoSQL = "UPDATE Cartao SET disponivel = 1, matriculaAluno = null WHERE uid= '$uid'";
            if($conn->query($removerCartaoSQL) == FALSE){
                $continuar = FALSE;
            }

            //echo $removerCartaoSQL;
        }


        //Verficar e deletar possiveis presenças
        $procurarPresenca = "SELECT * FROM Presenca WHERE Aluno_matricula= $matricula";
        $presenca = $conn->query($procurarPresenca);
        $possuiPresenca = mysqli_num_rows($presenca);
        if($possuiPresenca>0){

            $removerPresenca = "DELETE FROM Presenca WHERE Aluno_matricula = $matricula";
            if($conn->query($removerPresenca) == FALSE){
                $continuar = FALSE;
            }
        }


        $sql = "DELETE FROM Aluno WHERE matricula = $matricula";

        if($conn->query($sql) == TRUE && $continuar == TRUE){
            ?>
                <script>
                    window.location = "../tela_listar/alunos.php?resposta=5";
                </script>
            <?php
        }
        else{
            ?>
                <script>
                    window.location = "../tela_listar/alunos.php?resposta=6";
                </script>
            <?php
        }
    }

?>