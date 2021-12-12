<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];

    //Criar senha aleatoria
    $string = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $senha = substr(str_shuffle($string),0,10);

    //Inserindo valores no banco
    //Verificando se vai ter dados de cartão para inserir no banco
    if(isset($_POST["cartaoRFID"])){
        $cartao = $_POST["cartaoRFID"];
        $sql = "INSERT INTO Aluno (Responsavel_id, Turma_idTurma, nome, senha, uidCartao) VALUES ($responsavel, $turma, '$nome', ' $senha', '$cartao')";
    }
    else{
        $sql = "INSERT INTO Aluno (Responsavel_id, Turma_idTurma, nome, senha) VALUES ($responsavel, $turma, '$nome', ' $senha')";
    }

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
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