<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: /..index"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../filtroPesquisa/pesquisa.css">

</head>

<body>
    <?php
    include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Horários</h1>
    <br>

    <?php
    //include_once("../filtroPesquisa/pesquisa.html");
    //echo "<br>";
    ?>

    <div style="margin: 20px; text-align: center;">

        <div style="margin: 0 auto;">
            <label for="listTurma">Turma:</label>
            <select name="listTurma" id="listTurma" required style="margin-left: 5px;">
                <option value="" selected disabled hidden>Selecionar</option>
                <?php

                $sql = "SELECT idTurma, nome FROM Turma";

                $turma = $conn->query($sql);

                while ($rowTurma = $turma->fetch_assoc()) {
                ?>
                    <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                <?php
                }

                ?>
            </select>


                
        </div>

        <?php
            //Procurar as Disciplinas no banco de dados
            $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";

            $disciplina = $conn->query($sql);

            while ($rowDisciplina = $disciplina->fetch_assoc()) {
                $vetor[] = (object) $rowDisciplina;
            }

            

        ?>

        <form>
            <div class="scrollHorizontal">
                <table class="table-bordered" style="width: 98%; margin-left: 15px;">
                    <thead class="thead-dark">
                        <tr>
                            <th colspan="2">Horários</th>
                            <th colspan="5">Dias da semana</th>
                        </tr>
                        <tr>
                            <th>Horário Inicio</th>
                            <th>Horário Fim</th>
                            <th>Segunda-feira</th>
                            <th>Terça-feira</th>
                            <th>Quarta-feira</th>
                            <th>Quinta-feira</th>
                            <th>Sexta-feira</th>
                        </tr>
                        <?php                       
                            for ($i=1; $i <= 5 ; $i++) { 
                                ?>
                                <tr>
                                    <td><input type="time" value=""></td>
                                    <td><input type="time" value=""></td>
                                    <?php
                                    for ($cont=1; $cont <= 5 ; $cont++) { 
                                        ?>
                                        <td>
                                            <select name="disciplinaEscolhida" id="disciplinaEscolhida" style="font-size: 1em; ">
                                                <option value="" selected disabled hidden>Selecionar</option>
                                                <?php
                                                    foreach ($vetor as $key => $val) {
                                                        ?>
                                                        <option value="<?php print($vetor[$key]->idDisciplina) ?>"><?php print($vetor[$key]->nome) ?></option>
                                                        <?php
                                                    }
                                                ?>
                                            </select>
                                        </td>
                                        <?php
                                    }
                                    ?>
                                </tr>
                                <?php

                            }
                        ?>
                    </thead>

                    </thead>
                </table>
            </div>

        </form>
        

    </div>


</body>


</html>