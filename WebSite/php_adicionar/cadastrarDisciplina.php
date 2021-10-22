<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $nome = $_POST["txtNome"];
    $professor = $_POST["txtProf"];
    $numeroAulas = $_POST["numAulas"];

    //Inserindo valores no banco
    $sql = "INSERT INTO Disciplina (nome, professor, numeroAulas) VALUES ('$nome', '$professor', '$numeroAulas')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            //Envia para outra página
            window.location = "../tela_criar/cadastrarDisciplina.php";
            //window.history.back();
        </script>

        <?php
    }
    else{
        ?>
        <script>
            alert("Erro ao inserir registro");
            window.location = "../tela_criar/cadastrarDisciplina.php";
        </script>
        
        <?php
    }

?>