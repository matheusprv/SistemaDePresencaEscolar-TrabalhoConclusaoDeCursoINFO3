<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: ../index.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequência</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Frequência</h1>
    <br>

    <?php
        //include_once("../pesquisa/pesquisa.html");
        //echo "<br>";
    ?>

    <div style="margin: 20px; text-align: center;">

        <div style="margin: 0 auto;">
            <label for="listTurma">Turma:</label>
            <select name="listTurma" id="listTurma" required style="margin-left: 5px;">
                <option value="" selected disabled hidden>Selecionar</option>
                <?php
                    
                    $sql = "SELECT idTurma, nome FROM Turma";

                    $turma = $conn -> query($sql);

                    while ($rowTurma = $turma->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                        <?php
                    }

                ?>
            </select>

            <label for="disciplina" style="margin-left: 25px; margin-right: 5px;">Disciplina:</label>
            <select name="disciplina" id="disciplina">
                <option value="" selected disabled hidden>Selecionar</option>
                    <?php

                        $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";

                        $disciplina = $conn -> query($sql);

                        while ($rowDisciplina = $disciplina->fetch_assoc()) {
                            $vetor [] = (object) $rowDisciplina;
                        }

                        foreach ($vetor as $key => $val) {
                            ?>
                            <option value="<?php print($vetor[$key]->idDisciplina) ?>"><?php print($vetor[$key]->nome) ?></option>
                            <?php
                        }

                    ?>
            </select>
        </div>

       
        <div class="scrollHorizontal">
            <table class="table-bordered" style="width: 98%; margin-left: 15px;">
                <thead class="thead-dark">
                    <tr>
                        <th >Nome</th>
                        <?php
                        foreach ($vetor as $key => $val) {
                            ?>
                            <th>
                                <?php print($vetor[$key]->nome) ?>
                            </th>
                            <?php
                        }
                        ?>
                    </tr>
                    <tr>
                        <td>Aluno 1</td>
                        <?php
                            for($i=0; $i<mysqli_num_rows($disciplina); $i++){
                                ?>
                                <td>
                                    <?php
                                        echo(rand(0,10));
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>
                    <tr>
                        <td>Aluno 2</td>
                        <?php
                            for($i=0; $i<mysqli_num_rows($disciplina); $i++){
                                ?>
                                <td>
                                    <?php
                                        echo(rand(0,10));
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>
                    <tr>
                        <td>Nome composto</td>
                        <?php
                            for($i=0; $i<mysqli_num_rows($disciplina); $i++){
                                ?>
                                <td>
                                    <?php
                                        echo(rand(0,10));
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>
                    <tr>
                        <td>Nome composto dois</td>
                        <?php
                            for($i=0; $i<mysqli_num_rows($disciplina); $i++){
                                ?>
                                <td>
                                    <?php
                                        echo(rand(0,10));
                                    ?>
                                </td>
                                <?php
                            }
                        ?>
                    </tr>
                </thead>
                        
                </thead>
            </table>
        </div>    

        <a href="../tela_criar/presencaParaAluno.php">Adicionar presença</a>

</body>


</html>
