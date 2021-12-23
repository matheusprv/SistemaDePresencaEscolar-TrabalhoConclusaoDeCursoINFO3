<?php
/*
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
    */
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        //Data atual no formato do Banco de dados
        date_default_timezone_set('America/Sao_Paulo');
        $dataAula = date('Y-m-d');
        //1 - Segunda | 2 - Terça | 3 - Quarta | 4 -Quinta | 5 - Sexta
        $diaSemana = date("N");
        $horario = date("h:i:sa");

        echo "Data: ".$dataAula;
        echo "<br>Dia da semana: ".$diaSemana;
        echo "<br>Horas: ".$horario;
    ?>
    
</body>
</html>


