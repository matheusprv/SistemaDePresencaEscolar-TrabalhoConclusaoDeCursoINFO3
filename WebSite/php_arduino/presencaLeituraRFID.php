<?php
    include_once("../conexao.php");

    $uid = $_GET["uid"];

    //Recuperando a turma do aluno no banco de dados
    $sqlProcurarTurma = "SELECT * FROM Aluno WHERE uidCartao = $uid";
    $turmas = $conn->query($sqlProcurarTurma);
    while($rowTurma = $turmas->fetch_assoc()){
        $turma = $rowTurma["Turma_idTurma"];
        $aluno = $rowTurma["matricula"];
    }


    //Inserindo dados na tabela de presença

    date_default_timezone_set('America/Sao_Paulo');
    //Data atual no formato do Banco de dados
    $dataAula = date('Y-m-d');

    //1 - Segunda | 2 - Terça | 3 - Quarta | 4 -Quinta | 5 - Sexta
    $diaSemana = date("N");
    
    
    

    //Pegar as aulas do dia no Banco de dados
    $aulasSQL = "SELECT * FROM Aula WHERE Turma_idTurma = $turma AND diaSemana = 1";
    $aulas = $conn->query($aulasSQL);
    while($rowAulas = $aulas->fetch_assoc()){
        $horario[] = $rowAulas["idAula"];
        $idDisciplina[] = $rowAulas["Disciplina_idDisciplina"];
    }

    $todosDadosInseridos =TRUE;
    for($i=0; $i<5; $i++){
        $inserirPresenca = "INSERT INTO Presenca (Aluno_matricula, Aula_idAula, data, Disciplina_idDisciplina) values ($aluno, $horario[$i], '$dataAula', $idDisciplina[$i]) ";
        
        if($conn -> query($inserirPresenca) === FALSE ){
            $todosDadosInseridos = FALSE;
        }
    }


    //Executando o comando sql
    if($todosDadosInseridos){
        echo "sucesso";
    }
    else{
        echo "erro";
    }

?>