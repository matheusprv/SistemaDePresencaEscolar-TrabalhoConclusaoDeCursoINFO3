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



    //Data atual no formato do Banco de dados
    date_default_timezone_set('America/Sao_Paulo');
    $dataAula = date('Y-m-d');
    //1 - Segunda | 2 - Terça | 3 - Quarta | 4 -Quinta | 5 - Sexta
    $diaSemana = date("N");
    $horas = date("H:i:sa");  

    //Verificar se o aluno já teve sua presença computada no dia. Caso tenha, remover a presença dos próximos horários
    $presencaMarcadaSQL = "SELECT * FROM Presenca WHERE Aluno_matricula = $aluno AND data = '$dataAula'";
    $aulasMarcadas = $conn->query($presencaMarcadaSQL);
    $possuiAulas = mysqli_num_rows($aulasMarcadas);

    $sqlExecutadas=TRUE;
    //Remover presenças
    if($possuiAulas>0){
        //Buscar quais disciplinas deverão ser removidas
        $sqlDisciplinas = "SELECT * FROM Aula WHERE diaSemana = $diaSemana AND horasInicio > '$horas' AND Turma_idTurma= $turma";



        $dadosDisciplinas = $conn -> query($sqlDisciplinas);

        while($disciplinas = $dadosDisciplinas->fetch_assoc()){
            $idDisciplinas[] = $disciplinas["Disciplina_idDisciplina"];
            $idAula[] = $disciplinas["idAula"];
        }
       
        $sqlDeletarPresenca= "DELETE FROM Presenca WHERE Aluno_matricula = $aluno AND data = '$dataAula' AND (";

        for($disciplinasRemover = 0; $disciplinasRemover<mysqli_num_rows($dadosDisciplinas); $disciplinasRemover++){
            if($disciplinasRemover == (mysqli_num_rows($dadosDisciplinas)-1)){
                $sqlDeletarPresenca .= " Aula_idAula = $idAula[$disciplinasRemover] )";
            }
            else{
                $sqlDeletarPresenca .= " Aula_idAula = $idAula[$disciplinasRemover] OR";
            }  
        }

        if($conn->query($sqlDeletarPresenca) == FALSE){
            $sqlExecutadas = FALSE;
        }   
        

    }
    
    else{
        //Adicionar presenças

        //Pegar as aulas do dia no Banco de dados
        $aulasSQL = "SELECT * FROM Aula WHERE Turma_idTurma = $turma AND diaSemana = $diaSemana AND horasInicio >= '$horas'";
        //$aulasSQL = "SELECT * FROM Aula WHERE Turma_idTurma = $turma AND diaSemana = $diaSemana";
        $aulas = $conn->query($aulasSQL);
        while($rowAulas = $aulas->fetch_assoc()){
            $horario[] = $rowAulas["idAula"];
            $idDisciplina[] = $rowAulas["Disciplina_idDisciplina"];
        }

        $numHorarios = count($horario);
        for($i=0; $i<$numHorarios; $i++){
            $inserirPresenca = "INSERT INTO Presenca (Aluno_matricula, Aula_idAula, data, Disciplina_idDisciplina) values ($aluno, $horario[$i], '$dataAula', $idDisciplina[$i]) ";
            
            if($conn -> query($inserirPresenca) === FALSE ){
                $sqlExecutadas = FALSE;
            }
        }
    }

    //Executando o comando sql
    if($sqlExecutadas){
        echo "sucesso";
    }
    else{
        echo "erro";
    }

?>