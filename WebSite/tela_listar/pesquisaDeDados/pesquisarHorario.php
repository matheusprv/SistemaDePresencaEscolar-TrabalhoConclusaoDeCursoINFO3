<?php
    include_once("../../conexao.php");
?>

<?php
    //Procurar as Disciplinas no banco de dados para adicionar em um vetor que será lido em todos os campos da tabela
    $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";
    $disciplina = $conn->query($sql);
    while ($rowDisciplina = $disciplina->fetch_assoc()) {
        $vetor[] = (object) $rowDisciplina;
    }

    //Saber se a página se adaptará para editar algum horário ou irá adicionar algum no BD
    $atualizar = 0;

    //Buscar horários no banco caso tenha sido passado algum id de turma
    if(isset($_POST["idTurma"])){
        $idTurma = $_POST["idTurma"];
        $sql = "SELECT * FROM Aula WHERE Turma_idTurma = $idTurma ";
        $resultados = $conn->query($sql);
        //Verifica se o ID passado já possui dados no sistema, se sim, adapta a página para editar o conteúdo
        $numeroDeResultados =  mysqli_num_rows($resultados);
        if($numeroDeResultados>0){
            while ($rowAulas = $resultados->fetch_assoc()) {
                $exibirDisciplina[] = $rowAulas["Disciplina_idDisciplina"];
                $exibirHorarioInicio[] = $rowAulas["horasInicio"];
                $exibirHorarioFim[] = $rowAulas["horaFim"];
                $idAulas[] = $rowAulas["idAula"];
            }
            $primeiroValorIdAulas = $idAulas[0];
            $ultimoValorIdAulas = end($idAulas);
            $atualizar = 1;
        }
        
    }

    
?>
<!--Salvar esse dado para recuperá-lo depois na hora de verificar a atualização ou salvamento dos dados, já que a variavel não terá seu valor atualizado na página de origem 
    Deixar o valor de atualizar invisível para o usuário não ver, mas permitindo o sistema de recuperar
-->
<label for="" id="valorAtualizacao" style="display: none;"><?php echo $atualizar ?></label>
<label for="" id="primeiroValorIdAulas" style="display: none;"><?php echo $primeiroValorIdAulas ?></label>
<label for="" id="ultimoValorIdAulas" style="display: none;"><?php echo $ultimoValorIdAulas ?></label>

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
            
            <?php
                $horasInicioPadrao = array ('07:00:00', '07:50:00', '08:40:00', '09:50:00', '10:40:00');
                $horasFinalPadrao = array ('07:50:00', '08:40:00', '09:30:00', '10:40:00', '11:30:00');
                $repeticoes = 0;
                for ($i=1; $i <= 5 ; $i++) { 
                    ?>
                    <tr>
                    <?php
                        if($atualizar==1){
                            ?>
                                <td><input type="time" value="<?php echo $exibirHorarioInicio[$repeticoes] ?>" id="inicio<?php echo $i ?>" name="inicio<?php echo $i ?>"></td>
                                <td><input type="time" value="<?php echo $exibirHorarioFim[$repeticoes] ?>" id="fim<?php echo $i ?>" name="fim<?php echo $i ?>"></td>
                            <?php
                        }
                        else{
                            ?>
                                <td><input type="time" value="<?php echo $horasInicioPadrao[$i-1] ?>" id="inicio<?php echo $i ?>" name="inicio<?php echo $i ?>"></td>
                                <td><input type="time" value="<?php echo $horasFinalPadrao[$i-1] ?>" id="fim<?php echo $i ?>" name="fim<?php echo $i ?>"></td>
                            <?php
                        }
                        for ($cont=1; $cont <= 5 ; $cont++) { 
                            ?>
                            <td>
                                <select name="disciplinaEscolhida<?php echo $repeticoes ?>" id="disciplinaEscolhida<?php echo $repeticoes ?>" style="font-size: 1em; ">
                                    <option value="" selected disabled hidden>Selecionar</option>
                                    <?php
                                        foreach ($vetor as $key => $val) {
                                            if($atualizar==0){
                                                ?>
                                                    <option value="<?php print($vetor[$key]->idDisciplina) ?>"><?php print($vetor[$key]->nome) ?></option>
                                                <?php
                                            }
                                            else{
                                                ?>
                                                    <option value="<?php print($vetor[$key]->idDisciplina) ?>" <?php echo($vetor[$key]->idDisciplina == $exibirDisciplina[$repeticoes])?"selected":"" ?>><?php print($vetor[$key]->nome) ?></option>
                                                <?php
                                            }
                                        }
                                    ?>
                                </select>
                            </td>
                            <?php
                            $repeticoes = $repeticoes +1;
                        }
                        ?>
                    </tr>
                    <?php
                }
            ?>
        </thead>

    </table>
</div>

<div style="text-align: center;">
    <input type="submit" value="<?php echo ($atualizar==1)?'Atualizar':'Adicionar' ?>" class="formBtn adicionar">
    <input type="reset" value="Deletar" class="formBtn limpar" onclick="deletarHorario()"> 
</div>