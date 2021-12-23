<?php
    include_once("../conexao.php");


    //PEGAR AS DISCIPLINAS DO DIA

    
    $turma = $_POST["listTurma"];
    $aluno = $_POST["txtAluno"];
    $horas = $_POST["horas"];
    $data = $_POST["data"];
    $diaSemana = date('w', strtotime($data));

    echo $diaSemana;
    echo "<br>";
    //Buscar quais disciplinas deverão ser removidas
    $sqlDisciplinas = "SELECT * FROM Aula WHERE diaSemana = $diaSemana AND horasInicio > '$horas' AND Turma_idTurma= $turma";

    $dadosDisciplinas = $conn -> query($sqlDisciplinas);

    while($disciplinas = $dadosDisciplinas->fetch_assoc()){
        $idDisciplinas[] = $disciplinas["Disciplina_idDisciplina"];
        $idAula[] = $disciplinas["idAula"];
    }


    //Deletar a presença da tabela
    $sqlDeletarPresenca[] = array();

    for($disciplinasRemover = 0; $disciplinasRemover<mysqli_num_rows($dadosDisciplinas); $disciplinasRemover++){
        $sqlDeletarPresenca[$disciplinasRemover] = "DELETE FROM Presenca WHERE Aluno_matricula = $aluno AND Aula_idAula = $idAula[$disciplinasRemover] AND data = '$data'";
    }


    print_r ($sqlDeletarPresenca);

    $todasRemocoesCorretas = TRUE;
    for($disciplinasRemover = 0; $disciplinasRemover<mysqli_num_rows($dadosDisciplinas); $disciplinasRemover++){
        if($conn->query($sqlDeletarPresenca[$disciplinasRemover]) == FALSE){
            $todasRemocoesCorretas = FALSE;
        }        
    }

    if($todasRemocoesCorretas ){
        ?>
            <script>
                alert("Registro excluído com sucesso")
                window.location= "../tela_criar/removerPresencaParaAluno.php"
            </script>
        <?php
    }
    else{
        ?>
            <script>
                alert("Erro ao excluir o registro")
                window.location= "../tela_criar/removerPresencaParaAluno.php"
            </script>
        <?php
    }


?>
