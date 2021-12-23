<?php
    include_once("../conexao.php");


    $matricula = $_GET["matricula"];
    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];
    $cartao = $_POST["cartaoRFID"];


    //Verificando se o aluno já possui um cartão
    $verificarCartaoSQL = "SELECT * FROM Cartao Where matriculaAluno = $matricula";
    $verificarCartao = $conn -> query($verificarCartaoSQL);
    $possuiCartao = mysqli_num_rows($verificarCartao);
    while ($rowCartao = $verificarCartao->fetch_assoc()) {
        $cartaoCadastrado = $rowCartao["uid"];
    }

    
    //Verificar se o aluno irá ficar sem cartão
    if($cartao=='0'){
        //Verificar se o aluno já possui algum cartão registrado
        //Altera dados e remove o cartão
        if($possuiCartao > 0){
            $sql = array(
                "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel', uidCartao = null WHERE matricula = $matricula",
                "UPDATE Cartao SET matriculaAluno = null, disponivel = 1 WHERE uid = '$cartaoCadastrado'"
            );
        }
        else{
            //Altera dados que não são o cartão quando o launo não o possui
            $sql = array(
                "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel' WHERE matricula = $matricula"
            );
        }
    }
    else{
        //Atualiza somente os dados que não são os do cartão
        if($possuiCartao>0 && $cartaoCadastrado == $cartao ){
            $sql = array(
                "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel', uidCartao = '$cartao' WHERE matricula = $matricula",
            );
        }

        //Troca de cartões
        else if($possuiCartao > 0){
            $sql = array(
                "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel', uidCartao = '$cartao' WHERE matricula = $matricula",
                "UPDATE Cartao SET matriculaAluno = null, disponivel = 1 WHERE uid = '$cartaoCadastrado'", //Cartão antigo
                "UPDATE Cartao SET matriculaAluno = $matricula, disponivel = 0  WHERE uid = '$cartao'" //Cartão novo
            );
        }
        //Adciona cartão
        else{
            $sql = array(
                "UPDATE Aluno SET nome = '$nome', Turma_idTurma = '$turma', Responsavel_id = '$responsavel', uidCartao = '$cartao' WHERE matricula = $matricula",
                "UPDATE Cartao SET matriculaAluno = $matricula, disponivel = 0  WHERE uid = '$cartao'" //Cartão novo
            );
        }
        
        
    }

    $todosValoresAtualizados = TRUE;
    $repeticoes = count($sql);
    for($i = 0; $i< $repeticoes; $i++){
        if($conn -> query($sql[$i]) === FALSE ){
            $todosValoresAtualizados = FALSE;
        }
    }


    if($todosValoresAtualizados == TRUE){
        echo "Sucesso";
        ?>
            <script>
                window.location = "../tela_listar/alunos.php?resposta=3";
            </script>
        <?php
    }
    else{
        echo "Erro";
        ?>
            <script>
               window.location = "../tela_listar/alunos.php?resposta=4";
            </script>
        <?php
    }
    

?>