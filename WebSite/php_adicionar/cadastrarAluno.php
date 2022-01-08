<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];

    //Criar senha aleatoria
    $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    //o valor de senha será criptografado para enviar ao banco
    $senha = substr(str_shuffle($string),0,10);
    $senhaEnviar = $senha;

    //Criptografar senha
    include_once("../criptografarSenha/criptografarSenha.php");

    //Inserindo valores no banco
    //Verificando se vai ter dados de cartão para inserir no banco
    //Duas querys são executadas, uma cadastra o aluno e a outra referencia sua matricula no cartão
    $sqlCorretas = FALSE;
    if(isset($_POST["cartaoRFID"]) && $_POST["cartaoRFID"] != '0'){
        $cartao = $_POST["cartaoRFID"];
        $sql = "INSERT INTO Aluno (Responsavel_id, Turma_idTurma, nome, senha, uidCartao) VALUES ($responsavel, $turma, '$nome', ' $senha', '$cartao')";
        $sql2 = "UPDATE Cartao SET disponivel = 0 WHERE uid = $cartao";

        if($conn -> query($sql) === TRUE && $conn -> query($sql2) === TRUE ){
            $sqlCorretas = TRUE;
        }
    }
    else{
        $sql = "INSERT INTO Aluno (Responsavel_id, Turma_idTurma, nome, senha) VALUES ($responsavel, $turma, '$nome', '$senha')";
        if($conn -> query($sql) === TRUE ){
            $sqlCorretas = TRUE;
        }
    }

    //Executando o comando sql
    if($sqlCorretas){

        $matricula = $conn->insert_id;

        //Enviar email para o responsavel
        $sqlProcurarResponsavel = "SELECT * FROM Responsavel WHERE id = $responsavel";
        $dadosResponsavel = $conn->query($sqlProcurarResponsavel);
        while($rowResponsavel = $dadosResponsavel->fetch_assoc()){
            $destinatario = $rowResponsavel["email"];
            $nomeResponsavel = $rowResponsavel["nome"];
        }

        //Enviar email com acesso ao aplicativo
        $enviarDadosResponsavel = FALSE; //TRUE envia para responsável e FALSE envia para Aluno
        //include('../enviarEmail/enviarEmail.php');

        ?>
        <script>
            window.location = "../tela_listar/alunos.php?resposta=1";
        </script>

        <?php
    }
    else{
        
        ?>
        <script>
           window.location = "../tela_listar/alunos.php?resposta=2";
        </script>
        
        <?php
    }

?>