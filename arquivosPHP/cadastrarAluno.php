<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("conexao.php");

    $nome = $_POST["txtNome"];
    $turma = $_POST["listTurma"];
    $responsavel = $_POST["txtResponsavel"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Aluno (Responsavel_id, Turma_idTurma, nome, senha) VALUES ($responsavel, $turma, '$nome', '123456')";
    print($sql);
    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            //Envia para outra página
            //window.location = "cadPessoa.php";
        </script>

        <?php
    }
    else{
        
        ?>
        <script>
            alert("Erro ao inserir registro");
            //Envia para outra página
            //window.history.back();
        </script>
        
        <?php
    }

?>