<?php

    include_once("../../conexao.php");

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $idTurma = $_POST["turma"];

    //Descobrir o número de dados no banco de dados
    //Verificando se algum valor de turma foi setado
    $sql = "SELECT * FROM Aluno ";
    if($idTurma != 0){
        $sql .= " WHERE Turma_idTurma = $idTurma AND (nome like '%$pesquisa%' OR matricula like '%$pesquisa%')"; 
    }
    else{
        $sql .= " WHERE nome like '%$pesquisa%' OR matricula like '%$pesquisa%'"; 
    }
    //echo $sql;
    $alunos = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($alunos);

    // Determina o número de resultados por página
    $numResultadosPorPagina = 10;

    if($numeroDeResultados>0){
        //Determinar o total de páginas disponíveis 
        $numeroDePaginas = ceil($numeroDeResultados/$numResultadosPorPagina);
        
        //Determinar o limite inicial de dados mostrados na página
        $primeiroResultadoDaPagina = ($pagina-1)*$numResultadosPorPagina;

        //Recuperar dados para mostrar na página
        $sql .= " ORDER BY nome LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
        //echo "<br> SQL 2: ".$sql;

        $alunos = $conn->query($sql);

        ?>
        <table id="table" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Nº Matrícula</th>
                    <th>Turma</th>
                    <th>Responsável</th>
                    <th>Cartão RFID</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php

                while($exibir = $alunos->fetch_assoc()){
                    ?>
                    <tr>
                        <td>
                            <?php 
                                $nomeAluno = $exibir["nome"];
                                echo $exibir["nome"];
                            ?>
                        </td>
                        <td>
                            <?php echo $exibir["matricula"]?>
                        </td>
                        <td>
                            <?php
                                $idTurma = $exibir["Turma_idTurma"];

                                $sqlTurma = "SELECT nome FROM Turma WHERE idTurma = $idTurma ";

                                $turma = $conn->query($sqlTurma);

                                $exibirTurma = $turma->fetch_assoc();

                                echo $exibirTurma["nome"];
                            ?>
                        </td>
                        <td>
                            <?php
                                $idDoResponsavel = $exibir ['Responsavel_id'];
                                $sqlResponsavel = "SELECT * FROM Responsavel WHERE id = $idDoResponsavel ";

                                $responsavel = $conn->query($sqlResponsavel);

                                $exibirResponsavel = $responsavel->fetch_assoc();
                                $emailResponsavel = $exibirResponsavel["email"];
                                $nomeResponsavel = $exibirResponsavel["nome"];
                                echo $exibirResponsavel["nome"];
                            ?>
                        </td>
                        <td>
                            <?php 
                                if(empty($exibir["uidCartao"])){
                                    echo "Não possui";
                                }
                                else{
                                    echo $exibir["uidCartao"];
                                }
                            ?>
                        </td>
                        <td>
                            <a href="../tela_editar/editarAluno.php?matricula=<?php echo $exibir["matricula"]?>"><input type="submit" value="Editar" class="botaoEditar editarDeletar"></a>
                            <input type="submit" value="Deletar"  class="botaoDeletar editarDeletar" onclick="confirmarExclusao('<?php echo $exibir["matricula"]?>', '<?php echo $exibir["nome"]?>')">
                            <input type="submit" value="Acesso APP" onclick="acessoAPP('<?php echo $exibir["matricula"]?>', '<?php echo $nomeAluno?>', '<?php echo $emailResponsavel?>', '<?php echo $nomeResponsavel?>')">
                        </td>
                    </tr>
                    <?php
                }
                
            ?>
            </thead>
        </table>


        <?php
        //Mostrar os links entre as páginas

        $maxLinks = 2;
        echo "<ul>";
        //Página de início
        ?>
            <li style="display: inline-block; margin-right: 7px"><a href='#' onclick='listarRegistros(1)'>Início</a></li>
        <?php

        //Páginas anteriores a atual
        for ($paginaAnterior=$pagina-$maxLinks; $paginaAnterior < $pagina; $paginaAnterior++) { 
            if($paginaAnterior >= 1){
            ?>
            <li style="display: inline-block; margin-right: 7px"><a href='#' onclick='listarRegistros(<?php echo $paginaAnterior ?>)'><?php echo $paginaAnterior?></a></li>
            <?php
            }
        }
        //Página atual
        ?>
        <li style="display: inline-block; margin-right: 7px"><b><?php echo $pagina?></b></li>
        <?php

        //Páginas após a atual
        for ($paginaDepois=$pagina+1; $paginaDepois <= $pagina + $maxLinks; $paginaDepois++) { 
            if($paginaDepois <= $numeroDePaginas){
            ?>
            <li style="display: inline-block; margin-right: 7px"><a href='#' onclick='listarRegistros(<?php echo $paginaDepois ?>)'><?php echo $paginaDepois?></a></li>
            <?php
            }
        }
        //Página final
        ?>
            <li style="display: inline-block; margin-right: 7px"><a href='#' onclick='listarRegistros(<?php echo $numeroDePaginas ?>)'>Final</a></li>
        <?php
        echo "</ul>";
    }
    else{
        ?>
            <h2 style="color: red;">Nenhum dado encontrado</h2>
        <?php
    }   
    
?>