<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: ../index"));
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

        

        <?php
            //Procurar as Disciplinas no banco de dados
            $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";

            $disciplina = $conn->query($sql);

            while ($rowDisciplina = $disciplina->fetch_assoc()) {
                $vetor[] = (object) $rowDisciplina;
            }

            

        ?>

        <form action="../php_adicionar/cadastrarHorario.php" method="POST">
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
            <div class="scrollHorizontal">
                <table class="table-bordered" id="tabelaHorarios"style="width: 98%; margin-left: 15px;">
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
                        
                        <tr>
                            <td><input type="time" value="07:00" id="inicio1" name="inicio1"></td>
                            <td><input type="time" value="07:50" id="fim1" name="fim1"></td>
                            
                            <td>
                                <select name="segunda1" id="segunda1" style="font-size: 1em; " required>
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
                            <td>
                                <select name="terca1" id="terca1" style="font-size: 1em; ">
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
                            <td>
                                <select name="quarta1" id="quarta1" style="font-size: 1em; ">
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
                            <td>
                                <select name="quinta1" id="quinta1" style="font-size: 1em; ">
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
                            <td>
                                <select name="sexta1" id="sexta1" style="font-size: 1em; ">
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
                        </tr>
                            
                        
                        <tr>
                            <td><input type="time" value="07:50" name="inicio2" id="inicio2"></td>
                            <td><input type="time" value="08:40" name="fim2" id="fim2"></td>
                            
                            <td>
                                <select name="segunda2" id="segunda2" style="font-size: 1em; ">
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
                            <td>
                                <select name="terca2" id="terca2" style="font-size: 1em; ">
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
                            <td>
                                <select name="quarta2" id="quarta2" style="font-size: 1em; ">
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
                            <td>
                                <select name="quinta2" id="quinta2" style="font-size: 1em; ">
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
                            <td>
                                <select name="sexta2" id="sexta2" style="font-size: 1em; ">
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
                        </tr>

                        <tr>
                            <td><input type="time" value="08:40" name="inicio3" id="inicio3"></td>
                            <td><input type="time" value="09:40" name="fim3" id="fim3"></td>
                            
                            <td>
                                <select name="segunda3" id="segunda3" style="font-size: 1em; ">
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
                            <td>
                                <select name="terca3" id="terca3" style="font-size: 1em; ">
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
                            <td>
                                <select name="quarta3" id="quarta3" style="font-size: 1em; ">
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
                            <td>
                                <select name="quinta3" id="quinta3" style="font-size: 1em; ">
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
                            <td>
                                <select name="sexta3" id="sexta3" style="font-size: 1em; ">
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
                        </tr>

                        <tr>
                            <td><input type="time" value="09:50" name="inicio4" id="inicio4"></td>
                            <td><input type="time" value="10:40" name="fim4" id ="fim4"></td>
                            
                            <td>
                                <select name="segunda4" id="segunda4" style="font-size: 1em; ">
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
                            <td>
                                <select name="terca4" id="terca4" style="font-size: 1em; ">
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
                            <td>
                                <select name="quarta4" id="quarta4" style="font-size: 1em; ">
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
                            <td>
                                <select name="quinta4" id="quinta4" style="font-size: 1em; ">
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
                            <td>
                                <select name="sexta4" id="sexta4" style="font-size: 1em; ">
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
                        </tr>

                        <tr>
                            <td><input type="time" value="10:40" name="inicio5" id="inicio5"></td>
                            <td><input type="time" value="11:30" name="fim5" id="fim5"></td>
                            
                            <td>
                                <select name="segunda5" id="segunda5" style="font-size: 1em; ">
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
                            <td>
                                <select name="terca5" id="terca5" style="font-size: 1em; ">
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
                            <td>
                                <select name="quarta5" id="quarta5" style="font-size: 1em; ">
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
                            <td>
                                <select name="quinta5" id="quinta5" style="font-size: 1em; ">
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
                            <td>
                                <select name="sexta5" id="sexta5" style="font-size: 1em; ">
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
                        </tr>
                    </thead>

                </table>
            </div>
            <div style="text-align: center;">
                
                <input type="submit" value="Adicionar" class="formBtn adicionar" onclick="recuperarDadosTabela()">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
        </form>
        <button onclick="recuperarDadosTabela()">Adicionar </button>
        <p id="info"></p>
    </div>

</body>

<script>
    function recuperarDadosTabela(){
        document.getElementById('info').innerHTML = "";
        var tabela = document.getElementById('tabelaHorarios');
        s1 = document.getElementById("segunda1")
        s2 = document.getElementById("segunda2")
        s3 = document.getElementById("segunda3")
        s4 = document.getElementById("segunda4")
        s5 = document.getElementById("segunda5")

        segunda1 = s1.options[s1.selectedIndex].value;
        segunda2 = s2.options[s2.selectedIndex].value;
        segunda3 = s3.options[s3.selectedIndex].value;
        segunda4 = s4.options[s4.selectedIndex].value;
        segunda5 = s5.options[s5.selectedIndex].value;

        t1 = document.getElementById("terca1")
        t2 = document.getElementById("terca2")
        t3 = document.getElementById("terca3")
        t4 = document.getElementById("terca4")
        t5 = document.getElementById("terca5")

        terca1 = t1.options[t1.selectedIndex].value;
        terca2 = t2.options[t2.selectedIndex].value;
        terca3 = t3.options[t3.selectedIndex].value;
        terca4 = t4.options[t4.selectedIndex].value;
        terca5 = t5.options[t5.selectedIndex].value;

        q1 = document.getElementById("quarta1")
        q2 = document.getElementById("quarta2")
        q3 = document.getElementById("quarta3")
        q4 = document.getElementById("quarta4")
        q5 = document.getElementById("quarta5")

        quarta1 = q1.options[q1.selectedIndex].value;
        quarta2 = q2.options[q2.selectedIndex].value;
        quarta3 = q3.options[q3.selectedIndex].value;
        quarta4 = q4.options[q4.selectedIndex].value;
        quarta5 = q5.options[q5.selectedIndex].value;

        quin1 = document.getElementById("quinta1")
        quin2 = document.getElementById("quinta2")
        quin3 = document.getElementById("quinta3")
        quin4 = document.getElementById("quinta4")
        quin5 = document.getElementById("quinta5")

        quinta1 = quin1.options[quin1.selectedIndex].value;
        quinta2 = quin2.options[quin2.selectedIndex].value;
        quinta3 = quin3.options[quin3.selectedIndex].value;
        quinta4 = quin4.options[quin4.selectedIndex].value;
        quinta5 = quin5.options[quin5.selectedIndex].value;

        se1 = document.getElementById("sexta1")
        se2 = document.getElementById("sexta2")
        se3 = document.getElementById("sexta3")
        se4 = document.getElementById("sexta4")
        se5 = document.getElementById("sexta5")

        sexta1 = se1.options[se1.selectedIndex].value;
        sexta2 = se2.options[se2.selectedIndex].value;
        sexta3 = se3.options[se3.selectedIndex].value;
        sexta4 = se4.options[se4.selectedIndex].value;
        sexta5 = se5.options[se5.selectedIndex].value;

        info.innerHTML = segunda1 + ' - ' + terca1 + ' - ' + quarta1 + ' - ' + quinta1+ ' - ' + sexta1 +'\n'+ segunda2 + ' - ' + terca2 + ' - ' + quarta2 + ' - ' + quinta2+ ' - ' + sexta2+'\n'+ segunda3 + ' - ' + terca3 + ' - ' + quarta3 + ' - ' + quinta3+ ' - ' + sexta3+'\n'+ segunda4 + ' - ' + terca4 + ' - ' + quarta4 + ' - ' + quinta4+ ' - ' + sexta4+'\n'+ segunda5 + ' - ' + terca5 + ' - ' + quarta5 + ' - ' + quinta5+ ' - ' + sexta5
        

        
        
    }
</script>




</html>