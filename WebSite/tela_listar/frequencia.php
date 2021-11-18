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
                <?php
                    
                    $sql = "SELECT idTurma, nome FROM Turma ORDER BY nome";

                    $turma = $conn -> query($sql);

                    while ($rowTurma = $turma->fetch_assoc()) {
                        ?>
                            <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                        <?php
                    }

                ?>
            </select>
        </div>

        <?php

            $idTurmaTESTE = 1;

            //Pegando os Id's das disciplinas que estão cadastradas no horário da turma
            $sqlIdDisciplinas = "SELECT DISTINCT Disciplina_idDisciplina FROM Aula WHERE Turma_idTurma = $idTurmaTESTE";

            $idDisciplinasBanco = $conn -> query($sqlIdDisciplinas);

            $numeroDeDisciplinas = mysqli_num_rows($idDisciplinasBanco);

            if($numeroDeDisciplinas){

                while($rowIdDisciplinas = $idDisciplinasBanco->fetch_assoc()){
                    $idDisciplinasTabela[] = $rowIdDisciplinas["Disciplina_idDisciplina"];
                }

                //Procurando o nome das disciplinas no Banco de Dados
                //Gerando um único sql para pegar todos os dados de uma só vez e em ordem alfabética
                $sqlNomeDisciplinas = "SELECT * FROM Disciplina WHERE";

                for($i = 0; $i<$numeroDeDisciplinas; $i++){
                    $sqlNomeDisciplinas .= " idDisciplina = $idDisciplinasTabela[$i] ";

                    if($i != ($numeroDeDisciplinas-1)){
                        $sqlNomeDisciplinas .= " OR ";
                    }
                }
                $sqlNomeDisciplinas .= "ORDER BY nome";

                //Pegando o nome das disciplinas no banco
                $nomeDisciplinasBanco = $conn -> query($sqlNomeDisciplinas);
                
                while ($rowDisciplina = $nomeDisciplinasBanco->fetch_assoc()) {
                    $nomeDisciplinas[] = $rowDisciplina["nome"];
                }
            }

            //Pegando os dados dos alunos
            $sqlAlunos = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurmaTESTE ORDER BY nome";
            $dadosAlunos = $conn -> query($sqlAlunos);
            $numeroAlunos = mysqli_num_rows($dadosAlunos);
            //echo $numeroAlunos;

        ?>     
       
        <div class="scrollHorizontal">
            <table class="table-bordered" style="width: 98%; margin-left: 15px;">
                <thead class="thead-dark">
                    <!--Linha com o nome das disciplinas-->
                    <tr>
                        <th >Nome</th>
                        <?php
                        for($i=0; $i<$numeroDeDisciplinas;$i++){
                            ?>
                            <th>
                                <?php echo $nomeDisciplinas[$i] ?>
                            </th>
                            <?php
                        }
                        ?>
                    </tr>
                    
                    <!--Linhas com as informações dos álunos-->
                    <?php
                        if($numeroAlunos>0){
                            //Pegando nome e matricula do aluno
                            while ($rowAluno = $dadosAlunos->fetch_assoc()) {
                                $nomeAluno[] = $rowAluno["nome"];
                                $matriculaAluno[] = $rowAluno["matricula"];
                            }

                            //Pegando todos os dados de presença do aluno
                            for($i=0; $i<$numeroAlunos; $i++){
                                $sqlPresenca = "SELECT * FROM Presenca WHERE Aluno_matricula = $matriculaAluno[$i]";
                                $dadosPresencaAlunoBanco = $conn -> query($sqlPresenca);

                                //Verificando se o aluno possui algum dado na presença
                                if(mysqli_num_rows($dadosPresencaAlunoBanco)>0){

                                    //Exibindo o nome do aluno
                                    ?>
                                        <tr>
                                        <td><?php echo $nomeAluno[$i] ?></td>
                                    <?php


                                    while($rowPresencaAluno = $dadosPresencaAlunoBanco->fetch_assoc()){
                                        $idDisciplinaPresenca[] = $rowPresencaAluno["Disciplina_idDisciplina"];
                                    }

                                    //O primeiro for delimita o tanto de disciplinas e o segundo o conta quantas vezes os dados repetiram                                    
                                    $repeticoesDisciplinas[] = array();
                                    //Colocando 0 em todas as posições do vetor
                                    $repeticoesDisciplinas = array_fill(0, ($numeroDeDisciplinas), 0 );
                                    //Varre todos os dados de presença a procura de reptições nos ids das disciplinas para computar a presença
                                    for($contadorDisciplinaAtual=0; $contadorDisciplinaAtual<$numeroDeDisciplinas; $contadorDisciplinaAtual++){
                                        //Verifica todos os ID's das presenças dos alunos para encontrar dados iguais ao da coluna da tabela exibida ao usuário
                                        for($cont=0; $cont<count($idDisciplinaPresenca); $cont++){
                                            if($idDisciplinaPresenca[$cont] == $idDisciplinasTabela[$contadorDisciplinaAtual]){
                                                echo $idDisciplinaPresenca[$cont] ." - ";
                                                $repeticoesDisciplinas[$contadorDisciplinaAtual] ++;
                                            }
                                        }
                                        
                                    }

                                    //Mostrar dados obtidos na tabela
                                    for($cont=0; $cont<count($repeticoesDisciplinas); $cont++){
                                        echo "<td>";
                                            echo $repeticoesDisciplinas[$cont];
                                        echo "</td>";
                                    } 


                                    ?>
                                        </tr>
                                    <?php
                                    
                                    unset($sqlPresenca);
                                    unset($dadosPresencaAlunoBanco);
                                    unset($rowPresencaAluno);
                                    unset($idDisciplinaPresenca);
                                    unset($repeticoesDisciplinas);


                                }

                            }

                        }
                    ?>
                    
                </thead>
                        
                </thead>
            </table>
        </div>    

        <a href="../tela_criar/presencaParaAluno.php">Adicionar presença</a>

</body>


</html>
