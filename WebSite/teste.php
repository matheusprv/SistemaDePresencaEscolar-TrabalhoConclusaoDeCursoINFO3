<?php
    include_once("conexao.php");

    $sql = "SELECT * from Disciplina"; 
    $consulta = $conn->query($sql);
    $exibir = $consulta->fetch_assoc();
    print_r($exibir);

    echo "<br><br><br><br>";

    $sql = "SELECT * FROM Funcionario WHERE verificado = 1 ";
    $funcionarios = $conn->query($sql);
    $mostrar = $funcionarios->fetch_assoc();
    print_r($mostrar);

    echo "<br><br><br><br>";



    $sql = "SELECT * FROM Aula WHERE Turma_idTurma = 4";

    $resultados = $conn->query($sql);

    while ($rowAulas = $resultados->fetch_assoc()) {
        //$vetor[] = (object) $rowDisciplina;
        $exibirDisciplina[] = $rowAulas["Disciplina_idDisciplina"];

    }

    print_r($exibirDisciplina);

    echo "<br><br><br><br>";

    echo $exibirDisciplina[0];
?>