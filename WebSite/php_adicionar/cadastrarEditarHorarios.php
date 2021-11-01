<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $professor = $_POST["txtProf"];
    $numeroAulas = $_POST["txtCodigo"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Disciplina (nome, professor, numeroAulas) VALUES ('$nome', '$professor', '$numeroAulas')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../DisciplinasCadastro.html";
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            window.location = "../DisciplinasCadastro.html";
        </script>
        
        <?php
    }

?>