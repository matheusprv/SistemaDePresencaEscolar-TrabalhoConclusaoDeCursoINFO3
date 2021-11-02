<?php
/*
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $turma = $_POST["listTurma"];
    
    $segunda1 = $_POST["segunda1"];
    $terca1 = $_POST["terca1"];
    $quarta1 = $_POST["quarta1"];
    $quinta1 = $_POST["quinta1"];
    $sexta1 = $_POST["sexta1"];

    $segunda2 = $_POST["segunda2"];
    $terca2 = $_POST["terca2"];
    $quarta2 = $_POST["quarta2"];
    $quinta2 = $_POST["quinta2"];
    $sexta2 = $_POST["sexta2"];

    $segunda3 = $_POST["segunda3"];
    $terca3 = $_POST["terca3"];
    $quarta3 = $_POST["quarta3"];
    $quinta3 = $_POST["quinta3"];
    $sexta3 = $_POST["sexta3"];

    $segunda4 = $_POST["segunda4"];
    $terca4 = $_POST["terca4"];
    $quarta4 = $_POST["quarta4"];
    $quinta4 = $_POST["quinta4"];
    $sexta4 = $_POST["sexta4"];

    $segunda5 = $_POST["segunda5"];
    $terca5 = $_POST["terca5"];
    $quarta5 = $_POST["quarta5"];
    $quinta5 = $_POST["quinta5"];
    $sexta5 = $_POST["sexta5"];

    $inicio1 = $_POST["inicio1"];
    $inicio2 = $_POST["inicio2"];
    $inicio3 = $_POST["inicio3"];
    $inicio4 = $_POST["inicio4"];
    $inicio5 = $_POST["inicio5"];

    $fim1 = $_POST["fim1"];
    $fim2 = $_POST["fim2"];
    $fim3 = $_POST["fim3"];
    $fim4 = $_POST["fim4"];
    $fim5 = $_POST["fim5"];
    
    //Inserindo valores no banco
    //https://www.mysqltutorial.org/mysql-insert-multiple-rows/
    $sql = "INSERT INTO Aula 
        (Disciplina_idDisciplina, Turma_idTurma, horasInicio, horaFim, diaSemana) 
        VALUES 
        ($segunda1, $turma, '$inicio1', ' $fim1', 1),
        ($terca1, $turma, '$inicio1', ' $fim1', 2),
        ($quarta1, $turma, '$inicio1', ' $fim1', 3),
        ($quinta1, $turma, '$inicio1', ' $fim1', 4),
        ($sexta1, $turma, '$inicio1', ' $fim1', 5),

        ($segunda2, $turma, '$inicio2', ' $fim2', 1),
        ($terca2, $turma, '$inicio2', ' $fim2', 2),
        ($quarta2, $turma, '$inicio2', ' $fim2', 3),
        ($quinta2, $turma, '$inicio2', ' $fim2', 4),
        ($sexta2, $turma, '$inicio2', ' $fim2', 5),

        ($segunda3, $turma, '$inicio3', ' $fim3', 1),
        ($terca3, $turma, '$inicio3', ' $fim3', 2),
        ($quarta3, $turma, '$inicio3', ' $fim3', 3),
        ($quinta3, $turma, '$inicio3', ' $fim3', 4),
        ($sexta3, $turma, '$inicio3', ' $fim3', 5),

        ($segunda4, $turma, '$inicio4', ' $fim4', 1),
        ($terca4, $turma, '$inicio4', ' $fim4', 2),
        ($quarta4, $turma, '$inicio4', ' $fim4', 3),
        ($quinta4, $turma, '$inicio4', ' $fim4', 4),
        ($sexta4, $turma, '$inicio4', ' $fim4', 5),

        ($segunda5, $turma, '$inicio5', ' $fim5', 1),
        ($terca5, $turma, '$inicio5', ' $fim5', 2),
        ($quarta5, $turma, '$inicio5', ' $fim5', 3),
        ($quinta5, $turma, '$inicio5', ' $fim5', 4),
        ($sexta5, $turma, '$inicio5', ' $fim5', 5) ;";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            window.location = "../tela_listar/horarios3.php?idTurma=<?php $turma ?>";
        </script>

        <?php
    }
    else{
        echo $sql;
        ?>
        <script>
            alert("Erro ao inserir registro");
            //window.location = "../tela_listar/horarios2";
        </script>
        
        <?php
    }
*/

    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $turma = $_POST["listTurma"];

    $segunda1 = $_POST["disciplinaEscolhida0"];
    $terca1 = $_POST["disciplinaEscolhida1"];
    $quarta1 = $_POST["disciplinaEscolhida2"];
    $quinta1 = $_POST["disciplinaEscolhida3"];
    $sexta1 = $_POST["disciplinaEscolhida4"];

    $segunda2 = $_POST["disciplinaEscolhida5"];
    $terca2 = $_POST["disciplinaEscolhida6"];
    $quarta2 = $_POST["disciplinaEscolhida7"];
    $quinta2 = $_POST["disciplinaEscolhida8"];
    $sexta2 = $_POST["disciplinaEscolhida19"];

    $segunda3 = $_POST["disciplinaEscolhida10"];
    $terca3 = $_POST["disciplinaEscolhida11"];
    $quarta3 = $_POST["disciplinaEscolhida12"];
    $quinta3 = $_POST["disciplinaEscolhida13"];
    $sexta3 = $_POST["disciplinaEscolhida14"];

    $segunda4 = $_POST["disciplinaEscolhida15"];
    $terca4 = $_POST["disciplinaEscolhida16"];
    $quarta4 = $_POST["disciplinaEscolhida17"];
    $quinta4 = $_POST["disciplinaEscolhida18"];
    $sexta4 = $_POST["disciplinaEscolhida19"];

    $segunda5 = $_POST["disciplinaEscolhida20"];
    $terca5 = $_POST["disciplinaEscolhida21"];
    $quarta5 = $_POST["disciplinaEscolhida22"];
    $quinta5 = $_POST["disciplinaEscolhida23"];
    $sexta5 = $_POST["disciplinaEscolhida24"];

    $inicio1 = $_POST["inicio1"];
    $inicio2 = $_POST["inicio2"];
    $inicio3 = $_POST["inicio3"];
    $inicio4 = $_POST["inicio4"];
    $inicio5 = $_POST["inicio5"];

    $fim1 = $_POST["fim1"];
    $fim2 = $_POST["fim2"];
    $fim3 = $_POST["fim3"];
    $fim4 = $_POST["fim4"];
    $fim5 = $_POST["fim5"];

    //Inserindo múltiplo valores no banco
    //https://www.mysqltutorial.org/mysql-insert-multiple-rows/
    $sql = "INSERT INTO Aula 
        (Disciplina_idDisciplina, Turma_idTurma, horasInicio, horaFim, diaSemana) 
        VALUES 
        ($segunda1, $turma, '$inicio1', ' $fim0', 1),
        ($terca1, $turma, '$inicio1', ' $fim0', 2),
        ($quarta1, $turma, '$inicio1', ' $fim0', 3),
        ($quinta1, $turma, '$inicio1', ' $fim0', 4),
        ($sexta1, $turma, '$inicio1', ' $fim0', 5),

        ($segunda2, $turma, '$inicio2', ' $fim1', 1),
        ($terca2, $turma, '$inicio2', ' $fim1', 2),
        ($quarta2, $turma, '$inicio2', ' $fim1', 3),
        ($quinta2, $turma, '$inicio2', ' $fim1', 4),
        ($sexta2, $turma, '$inicio2', ' $fim1', 5),

        ($segunda3, $turma, '$inicio3', ' $fim2', 1),
        ($terca3, $turma, '$inicio3', ' $fim2', 2),
        ($quarta3, $turma, '$inicio3', ' $fim2', 3),
        ($quinta3, $turma, '$inicio3', ' $fim2', 4),
        ($sexta3, $turma, '$inicio3', ' $fim2', 5),

        ($segunda4, $turma, '$inicio4', ' $fim3', 1),
        ($terca4, $turma, '$inicio4', ' $fim3', 2),
        ($quarta4, $turma, '$inicio4', ' $fim3', 3),
        ($quinta4, $turma, '$inicio4', ' $fim3', 4),
        ($sexta4, $turma, '$inicio4', ' $fim3', 5),

        ($segunda5, $turma, '$inicio5', ' $fim4', 1),
        ($terca5, $turma, '$inicio5', ' $fim4', 2),
        ($quarta5, $turma, '$inicio5', ' $fim4', 3),
        ($quinta5, $turma, '$inicio5', ' $fim4', 4),
        ($sexta5, $turma, '$inicio5', ' $fim4', 5) ;";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        ?>
        <script>
            alert("Registro salvo com sucesso");
            window.location = "../tela_listar/horarios.php?idTurma=<?php echo $turma ?>";
        </script>

        <?php
    }
    else{
        echo $sql;
        ?>
        <script>
            alert("Erro ao inserir registro");
            window.location = "../tela_listar/horarios.php";
        </script>
        
        <?php
    }
?>