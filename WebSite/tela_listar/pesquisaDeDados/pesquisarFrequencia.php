<?php
    include_once("../../conexao.php");
    session_start();

    $idTurmaTESTE = $_POST["turma"];
    $nomePesquisa = $_POST["pesquisa"];

    //Pegando os Id's das disciplinas que estão cadastradas no horário da turma
    $sqlIdDisciplinas = "SELECT DISTINCT Disciplina_idDisciplina FROM Aula WHERE Turma_idTurma = $idTurmaTESTE";

    $idDisciplinasBanco = $conn -> query($sqlIdDisciplinas);

    $numeroDeDisciplinas = mysqli_num_rows($idDisciplinasBanco);

    if($numeroDeDisciplinas){

        while($rowIdDisciplinas = $idDisciplinasBanco->fetch_assoc()){
            $idDisciplinas[] = $rowIdDisciplinas["Disciplina_idDisciplina"];
        }

        //Procurando o nome das disciplinas no Banco de Dados
        //Gerando um único sql para pegar todos os dados de uma só vez e em ordem alfabética
        $sqlNomeDisciplinas = "SELECT * FROM Disciplina WHERE";

        for($i = 0; $i<$numeroDeDisciplinas; $i++){
            $sqlNomeDisciplinas .= " idDisciplina = $idDisciplinas[$i] ";

            if($i != ($numeroDeDisciplinas-1)){
                $sqlNomeDisciplinas .= " OR ";
            }
        }
        $sqlNomeDisciplinas .= "ORDER BY nome";

        //Pegando o nome das disciplinas no banco
        $nomeDisciplinasBanco = $conn -> query($sqlNomeDisciplinas);
        
        while ($rowDisciplina = $nomeDisciplinasBanco->fetch_assoc()) {
            $nomeDisciplinas[] = $rowDisciplina["nome"];
            $idDisciplinasTabela[] = $rowDisciplina["idDisciplina"];
        }
    }

    //Pegando os dados dos alunos
    $sqlAlunos = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurmaTESTE AND nome like '%$nomePesquisa%' ORDER BY nome";
    $dadosAlunos = $conn -> query($sqlAlunos);
    $numeroAlunos = mysqli_num_rows($dadosAlunos);
    //echo $numeroAlunos;

    if($numeroAlunos>0){
        ?>     
        <div class="scrollHorizontal">
            <table class="table-bordered" style="width: 98%; margin-left: 15px;">
                <thead class="thead-dark">
                    <!--Linha com o nome das disciplinas-->
                    <tr>
                        <th>Nome</th>
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

                                //Exibindo o nome do aluno
                                ?>
                                    <tr>
                                    <td><?php echo $nomeAluno[$i] ?></td>
                                <?php


                                while($rowPresencaAluno = $dadosPresencaAlunoBanco->fetch_assoc()){
                                    $idDisciplinaPresenca[] = $rowPresencaAluno["Disciplina_idDisciplina"];
                                }

                                //Conta quantas vezes uma disciplina se repetiu no banco, tendo 0 como valor padrão para caso ela não se repita
                                $repeticoesDisciplinas[] = array();
                                $repeticoesDisciplinas = array_fill(0, ($numeroDeDisciplinas), 0 );

                                //Verificando se o aluno possui algum dado na presença. Se não, sua presença padrão será 0
                                if(mysqli_num_rows($dadosPresencaAlunoBanco)>0){
                                    //Varre todos os dados de presença a procura de reptições nos ids das disciplinas para computar a presença
                                    for($contadorDisciplinaAtual=0; $contadorDisciplinaAtual < $numeroDeDisciplinas; $contadorDisciplinaAtual++){
                                        //Verifica todos os ID's das presenças dos alunos para encontrar dados iguais ao da coluna da tabela exibida ao usuário
                                        for($cont=0; $cont<count($idDisciplinaPresenca); $cont++){
                                            if($idDisciplinaPresenca[$cont] == $idDisciplinasTabela[$contadorDisciplinaAtual]){
                                                $repeticoesDisciplinas[$contadorDisciplinaAtual] ++;
                                            }
                                        }
                                        
                                    }
                                    /*
                                    echo "<br><br>";
                                    print_r($repeticoesDisciplinas);
                                    echo "<br><br>";
                                    print_r($idDisciplinasTabela);
                                    echo "<br><br>";
                                    print_r($idDisciplinaPresenca);
                                    */
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
                    ?>
                    
                </thead>
                        
                </thead>
            </table>
        </div>  
        <?php
    }
    else{
        ?>
        <p style="color: red; margin-top: 25px; margin-bottom: 20px; font-size: 20px;" >Não há dados cadastrados para essa turma</p>
        <?php
    }
