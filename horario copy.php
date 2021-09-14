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
</head>

<?php
    function pegarDisciplinas(){
        $sql = "SELECT idDisciplina, nome FROM Disciplina";

        $disciplina = $conn -> query($sql);

        while ($rowDisciplina = $disciplina->fetch_assoc()) {
            ?>
                <option value="<?php echo $rowDisciplina["idDisciplina"]; ?>"><?php echo $rowDisciplina["nome"]; ?></option>
            <?php
        }
    }
?>

<body style="font-size: 1.1em;">
    <div class=cabecalho>
        <input type="checkbox" id="chec">
        <label for="chec" class="lblMenuLateral"><div class="hamburguer" style="margin-left: 20px;"></div></label>

        <nav>
            <ul style="position: absolute; top: 50px; width: 100%; font-size: 1.2em;">
                <li><a href="menus.php" class="menuLateral">Menus</a></li>
                <li><a href="alunos.php" class="menuLateral">Alunos</a></li>
                <li><a href="Disciplinas.php" class="menuLateral">Disciplinas</a></li>
                <li><a href="frequencia.php" class="menuLateral">Frequência</a></li>
                <li><a href="Funcionario.php" class="menuLateral">Funcionários</a></li>
                <li><a href="horario.php" class="menuLateral">Horário</a></li>
                <li><a href="responsavel.php" class="menuLateral">Responsável</a></li>
                <li><a href="Turma.php" class="menuLateral">Turmas</a></li>
            </ul>
        </nav>

        <div class="divExternaLogoUsuario">
            <div class="divInternaLogoUsuario">
                <img src="Imagens/logotipo.png" alt="Logotipo Ouro Branco" style="margin-top: 5px; padding-left: 133px;">
            </div>
            <h4 class="usuario" style="color: white;">Usuário</h4>
        </div>
    </div>
    
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


                <form>
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

                        <?php
                            $sql = "SELECT idDisciplina, nome FROM Disciplina";

                            $disciplina = $conn -> query($sql);

                            while ($i <= 10) {
                                # code...
                            }
                            $vetor = array($disciplina->fetch_assoc());
                        
                            for ($i=1; $i <= 5 ; $i++) { 
                                ?>
                                <tr>
                                    <td><input type="time" value="07:00"></td>
                                    <td><input type="time" value="07:50"></td>
                                    <?php
                                    for ($cont=1; $cont <= 5 ; $cont++) { 
                                        ?>
                                        <td>
                                            <select name="disciplinaEscolhida" id="disciplinaEscolhida" style="font-size: 1em; ">
                                                <option value="" selected disabled hidden>Selecionar</option>
                                                <?php
                                                    while ($rowDisciplina = $disciplina->fetch_assoc()) {
                                                        ?>
                                                        <option value="<?php echo $rowDisciplina["idDisciplina"]; ?>" style="background-color: #ebebeb;"><?php echo $rowDisciplina["nome"]; ?></option>
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
                        
                    </table>
                    <input type="submit" value="Salvar" style="font-size: 1.2em; margin-left: 20px; margin-bottom: 20px;">
                </form>
                
            </div>
        </div>

</body>
</html>