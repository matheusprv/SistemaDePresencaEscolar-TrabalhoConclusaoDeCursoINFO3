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
            //Procurar as Disciplinas no banco de dados para adicionar em um vetor que será lido em todos os campos da tabela
            $sql = "SELECT idDisciplina, nome FROM Disciplina ORDER BY nome";
            $disciplina = $conn->query($sql);
            while ($rowDisciplina = $disciplina->fetch_assoc()) {
                $vetor[] = (object) $rowDisciplina;
            }

            //Saber se a página se adaptará para editar algum horário ou irá adicionar algum no BD
            $atualizar = 0;

            //Buscar horários no banco caso tenha sido passado algum id de turma
            if(isset($_GET["idTurma"])){
                $idTurma = $_GET["idTurma"];
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

        <form action= <?php echo ($atualizar==0)?"../php_adicionar/cadastrarHorario.php":"../php_atualizar/atualizarHorario.php?idAula1=$primeiroValorIdAulas&idAulaFim=$ultimoValorIdAulas" ?> method="POST">
            <!--Selecionar turma-->
            <div style="margin: 0 auto;">
                <label for="listTurma">Turma:</label>
                <select name="listTurma" id="listTurma" required style="margin-left: 5px;" onchange="pegarTurma()">
                    <option value="" selected disabled hidden>Selecionar</option>
                    <?php

                    $sql = "SELECT idTurma, nome FROM Turma ORDER BY nome ";
                    $turma = $conn->query($sql);
                    while ($rowTurma = $turma->fetch_assoc()) {
                        //Verifica se algum valor foi dado para o idTurma. Se estiver nulo, define um valor default pedindo ao usuário que selecione uma turma
                        if(is_null($idTurma)){
                            ?>
                                <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                            <?php
                        }
                        else{
                            ?>
                                <option value="<?php echo $rowTurma["idTurma"]; ?>" <?php echo($rowTurma["idTurma"] == $idTurma)?"selected":"" ?>>  <?php echo $rowTurma["nome"]; ?></option>
                            <?php   
                        }
                                         
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
                
                <input type="submit" value="<?php echo ($atualizar==1)?'Atualizar':'Adicionar' ?>" class="formBtn adicionar" onclick="recuperarDadosTabela()">
                <input type="reset" value="Limpar" class="formBtn limpar">
            </div>
        </form>
        <!-- <button onclick="recuperarDadosTabela()">Adicionar </button> -->
        <p id="info"></p>
    </div>

</body>

<script>
    function pegarTurma(){
        let turma = document.getElementById("listTurma");
        let opcaoTurma = turma.options[turma.selectedIndex].value;
        let nomeTurma = turma.options[turma.selectedIndex].text;
        if(window.confirm("Deseja ir para os dados da turma "+nomeTurma+"?\n\n OBS: Todos os dados não salvos serão perdidos.")){
            window.location = "horarios.php?idTurma="+opcaoTurma;
        }
        
    }
</script>

</html>