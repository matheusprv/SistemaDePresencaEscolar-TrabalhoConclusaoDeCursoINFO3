<?php
    include_once("arquivosPHP/conexao.php");
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Horários</title>
    <link rel="stylesheet" href="horario.css">
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>

<body style="font-size: 1.1em;">
    <?php
        include_once("cabecalho.php");
    ?>
    
    <div class="divExterna">
        <div class="divInterna">
            <div class="cadastro" >
                <h2 style="text-align: center"><b>Horários</b></h2>

                <label for="listTurma" style="padding-left: 15px; font-size: 1em;">Turma:</label>
                
                <select name="listTurma" id="listTurma" style="font-size: 1em;">
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

                <form name="alterarHorario" action="" method="POST">
                    <div>
                        <table>
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
                                <td><input type="time" value="07:00"></td>
                                <td><input type="time" value="07:50"></td>

                                <td><select name="segunda1" id="segunda1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="terca1" id="terca1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quarta1" id="quarta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quinta1" id="quinta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="sexta1" id="sexta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><input type="time" value="07:00"></td>
                                <td><input type="time" value="07:50"></td>

                                <td><select name="segunda1" id="segunda1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="terca1" id="terca1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quarta1" id="quarta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quinta1" id="quinta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="sexta1" id="sexta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><input type="time" value="07:00"></td>
                                <td><input type="time" value="07:50"></td>

                                <td><select name="segunda1" id="segunda1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="terca1" id="terca1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quarta1" id="quarta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quinta1" id="quinta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="sexta1" id="sexta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><input type="time" value="07:00"></td>
                                <td><input type="time" value="07:50"></td>

                                <td><select name="segunda1" id="segunda1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="terca1" id="terca1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quarta1" id="quarta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quinta1" id="quinta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="sexta1" id="sexta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>
                            </tr>
                            <tr>
                                <td><input type="time" value="07:00"></td>
                                <td><input type="time" value="07:50"></td>

                                <td><select name="segunda1" id="segunda1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="terca1" id="terca1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quarta1" id="quarta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="quinta1" id="quinta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>

                                <td><select name="sexta1" id="sexta1">
                                <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                    
                                        $sql = "SELECT idDisciplina, nome FROM Disciplina";

                                        $turma = $conn -> query($sql);

                                        while ($rowTurma = $turma->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $rowTurma["idDisciplina"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                                            <?php
                                        }

                                    ?>
                                </select></td>
                            </tr>

                        </table>
                        <input type="submit" value="Salvar" style="font-size: 1.2em; margin-left: 20px; margin-bottom: 20px;">
                    </div>
                </form>

            </div>
        </div>

</body>

</html>