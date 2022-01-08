<?php

    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $primeiroIdAula = $_GET["idAula1"];

    $ultimoValorIdAulas = $_GET["idAulaFim"];
    
    $diferenca = $ultimoValorIdAulas-$primeiroIdAula;


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
    
    $sql = array (
        "UPDATE Aula SET Disciplina_idDisciplina = $segunda1, horasInicio = '$inicio1', horaFim = '$fim1' WHERE idAula=$primeiroIdAula",
        "UPDATE Aula SET Disciplina_idDisciplina = $terca1, horasInicio = '$inicio1', horaFim = '$fim1' WHERE idAula=$primeiroIdAula+1",
        "UPDATE Aula SET Disciplina_idDisciplina = $quarta1, horasInicio = '$inicio1', horaFim = '$fim1' WHERE idAula=$primeiroIdAula+2",
        "UPDATE Aula SET Disciplina_idDisciplina = $quinta1, horasInicio = '$inicio1', horaFim = '$fim1' WHERE idAula=$primeiroIdAula+3",
        "UPDATE Aula SET Disciplina_idDisciplina = $sexta1, horasInicio = '$inicio1', horaFim = '$fim1' WHERE idAula=$primeiroIdAula+4",
        "UPDATE Aula SET Disciplina_idDisciplina = $segunda2, horasInicio = '$inicio2', horaFim = '$fim2' WHERE idAula=$primeiroIdAula+5",
        "UPDATE Aula SET Disciplina_idDisciplina = $terca2, horasInicio = '$inicio2', horaFim = '$fim2' WHERE idAula=$primeiroIdAula+6",
        "UPDATE Aula SET Disciplina_idDisciplina = $quarta2, horasInicio = '$inicio2', horaFim = '$fim2' WHERE idAula=$primeiroIdAula+7",
        "UPDATE Aula SET Disciplina_idDisciplina = $quinta2, horasInicio = '$inicio2', horaFim = '$fim2' WHERE idAula=$primeiroIdAula+8",
        "UPDATE Aula SET Disciplina_idDisciplina = $sexta2, horasInicio = '$inicio2', horaFim = '$fim2' WHERE idAula=$primeiroIdAula+9",
        "UPDATE Aula SET Disciplina_idDisciplina = $segunda3, horasInicio = '$inicio3', horaFim = '$fim3' WHERE idAula=$primeiroIdAula+10",
        "UPDATE Aula SET Disciplina_idDisciplina = $terca3, horasInicio = '$inicio3', horaFim = '$fim3' WHERE idAula=$primeiroIdAula+11",
        "UPDATE Aula SET Disciplina_idDisciplina = $quarta3, horasInicio = '$inicio3', horaFim = '$fim3' WHERE idAula=$primeiroIdAula+12",
        "UPDATE Aula SET Disciplina_idDisciplina = $quinta3, horasInicio = '$inicio3', horaFim = '$fim3' WHERE idAula=$primeiroIdAula+13",
        "UPDATE Aula SET Disciplina_idDisciplina = $sexta3, horasInicio = '$inicio3', horaFim = '$fim3' WHERE idAula=$primeiroIdAula+14",
        "UPDATE Aula SET Disciplina_idDisciplina = $segunda4, horasInicio = '$inicio4', horaFim = '$fim4' WHERE idAula=$primeiroIdAula+15",
        "UPDATE Aula SET Disciplina_idDisciplina = $terca4, horasInicio = '$inicio4', horaFim = '$fim4' WHERE idAula=$primeiroIdAula+16",
        "UPDATE Aula SET Disciplina_idDisciplina = $quarta4, horasInicio = '$inicio4', horaFim = '$fim4' WHERE idAula=$primeiroIdAula+17",
        "UPDATE Aula SET Disciplina_idDisciplina = $quinta4, horasInicio = '$inicio4', horaFim = '$fim4' WHERE idAula=$primeiroIdAula+18",
        "UPDATE Aula SET Disciplina_idDisciplina = $sexta4, horasInicio = '$inicio4', horaFim = '$fim4' WHERE idAula=$primeiroIdAula+19",
        "UPDATE Aula SET Disciplina_idDisciplina = $segunda5, horasInicio = '$inicio5', horaFim = '$fim5' WHERE idAula=$primeiroIdAula+20",
        "UPDATE Aula SET Disciplina_idDisciplina = $terca5, horasInicio = '$inicio5', horaFim = '$fim5' WHERE idAula=$primeiroIdAula+21",
        "UPDATE Aula SET Disciplina_idDisciplina = $quarta5, horasInicio = '$inicio5', horaFim = '$fim5' WHERE idAula=$primeiroIdAula+22",
        "UPDATE Aula SET Disciplina_idDisciplina = $quinta5, horasInicio = '$inicio5', horaFim = '$fim5' WHERE idAula=$primeiroIdAula+23",
        "UPDATE Aula SET Disciplina_idDisciplina = $sexta5, horasInicio = '$inicio5', horaFim = '$fim5' WHERE idAula=$primeiroIdAula+24",

    );

    $todosValoresAtualizados = TRUE;
    for($i=0; $i<25; $i++){
        if($conn -> query($sql[$i]) === FALSE ){
            $todosValoresAtualizados = FALSE;
        }
    }

    //Executando o comando sql e exibe a resposta
    if($todosValoresAtualizados){
        $resposta  = 3;
    }
    else{
        $resposta = 4;
    }

    include_once("../tela_listar/respostasHorarios.php");

?>