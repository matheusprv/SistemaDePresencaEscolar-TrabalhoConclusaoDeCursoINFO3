<?php
    include_once("../conexao.php");
    session_start();


    $idTurmaPesquisa = $_POST["pesquisa"];

    echo $_POST["pesquisa"];

    if(isset($_GET['pagina'])){
        $pagina = $_GET['pagina'];
    }


    // Determina o número de resultados por página
    $numResultadosPorPagina = 10;

    //Descobrir o número de dados no banco de dados
    //Verificar se são so dados de todas as turmas ou de somente uma
    if($idTurmaPesquisa == 0){
        $sql = "SELECT * FROM Aluno ";
    }
    else{
        $sql = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurmaPesquisa";
    }

    $alunos = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($alunos);

    if($numeroDeResultados>0){
        //Determinar o total de páginas disponíveis 
        $numeroDePaginas = ceil($numeroDeResultados/$numResultadosPorPagina);
        
        //Determinar qual página o usuário está
        if (!isset($_GET['pagina'])) {
            $pagina =1;
        }
        else{
            $pagina = $_GET['pagina'];
        }

        //Determinar o limite inicial de dados mostrados na página
        $primeiroResultadoDaPagina = ($pagina-1)*$numResultadosPorPagina;

        //Recuperar dados para mostrar na página
        $sql = "SELECT * FROM Aluno ORDER BY nome LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
        if($idTurmaPesquisa != 0){
            $sql = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurmaPesquisa ORDER BY nome LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
        }
        $alunos = $conn->query($sql);

        ?>
        <table id="table" class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Nº Matrícula</th>
                    <th>Turma</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php

                while($exibir = $alunos->fetch_assoc()){
                    ?>
                    <tr>
                        <td>
                            <?php echo $exibir["nome"]?>
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
                                $sqlResponsavel = "SELECT nome FROM Responsavel WHERE id = $idDoResponsavel ";

                                $responsavel = $conn->query($sqlResponsavel);

                                $exibirResponsavel = $responsavel->fetch_assoc();

                                echo $exibirResponsavel["nome"];
                            ?>
                        </td>
                        <td>
                            <a href="../tela_editar/editarAluno.php?matricula=<?php echo $exibir["matricula"]?>"><input type="submit" value="Editar" class="botaoEditar editarDeletar"></a>
                            <input type="submit" value="Deletar"  class="botaoDeletar editarDeletar" onclick="confirmarExclusao('<?php echo $exibir["matricula"]?>', '<?php echo $exibir["nome"]?>')">
                        </td>
                    </tr>
                    <?php
                }
                
            ?>
            </thead>
        </table>


        <?php
        //Mostrar os links entre as páginas
        for ($pagina=1; $pagina <= $numeroDePaginas; $pagina++) { 
            ?>
            <a class="nums-paginacao" href="<?php echo 'alunos.php?pagina='.$pagina; ?>"> <?php echo $pagina;?></a>
            <?php
        }
    }
    else{
        ?>
            <h2 style="color: red;">Nenhum dado encontrado</h2>
        <?php
    }   
    
?>
    
</div>


