<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");

    $aluno = $_POST["txtAluno"];
    $diaSemana = $_POST["DiaSemana"];
    $turma = $_POST["listTurma"];

    if($diaSemana == 6){
        date_default_timezone_set('America/Sao_Paulo');
        //Formato do Banco de dados
        $dataAula = date('Y-m-d');

        //1 - Segunda | 2 - Terça | 3 - Quarta | 4 -Quinta | 5 - Sexta
        $diaSemana = date("N");
    }
    date_default_timezone_set('America/Sao_Paulo');
    $dataAula = date('Y-m-d');


    //Pegar as aulas do dia no Banco de dados
    $aulasSQL = "SELECT * FROM Aula WHERE Turma_idTurma = $turma AND diaSemana = $diaSemana";
    $aulas = $conn->query($aulasSQL);
    while($rowAulas = $aulas->fetch_assoc()){
        $horario[] = $rowAulas["idAula"];
        $idDisciplina[] = $rowAulas["Disciplina_idDisciplina"];
    }

    $todosDadosInseridos =TRUE;
    for($i=0; $i<5; $i++){
        $inserirPresenca = "INSERT INTO Presenca (Aluno_matricula, Aula_idAula, data, Disciplina_idDisciplina, Turma_idTurma) values ($aluno, $horario[$i], '$dataAula', $idDisciplina[$i], $turma) ";
        
        if($conn -> query($inserirPresenca) === FALSE ){
            $todosDadosInseridos = FALSE;
        }
    }


    //Executando o comando sql
    if($todosDadosInseridos){
        ?>
        <script>
            window.location = "../tela_criar/presencaParaAluno.php?resposta=1";
        </script>

        <?php
    }
    else{
        
        ?>
        <script>
            alert("Verifique se os horários estão cadastrados para essa turma");
            window.location = "../tela_criar/presencaParaAluno.php?resposta=2";
        </script>
        
        <?php
    }

?>