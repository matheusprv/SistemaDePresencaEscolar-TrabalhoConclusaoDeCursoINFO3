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
    <title>Alunos</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    
    <link rel="stylesheet" href="../css/style.css">
    
        
</head>

<body onload="esconderAdicao()">
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
        //Verificar se existe algum filtro para a turma
        if(!empty($_POST["listTurma"])){
            $idTurma=$_POST["listTurma"];
        }

    ?>
    <h1 style="text-align: center; margin-top: 20px;">Alunos</h1>
    <br>


    <div style="width: 1200px;  margin: 0 auto; text-align: center;">
        <form action="alunos.php" method="POST" name="form-filtrar" id="form-filtrar">
            <div style="margin: 0 auto;">
                <label for="listTurma">Turma:</label>
                <select name="listTurma" id="listTurma" required style="margin-left: 5px;" onchange="filtrar()">
                    
                    <option value="0" selected>Todas</option>
                    <?php
                        $sql = "SELECT idTurma, nome FROM Turma ORDER BY nome";

                        $turma = $conn -> query($sql);

                        while ($rowTurma = $turma->fetch_assoc()) {
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

        </form>

        <?php
            //Exibir mensagem de erro ou sucesso da inserção de um aluno
            if(isset($_GET["respostaAdicionarAluno"])){
                $resposta = $_GET["respostaAdicionarAluno"];
                if($resposta==1){
                    ?>
                        <br>
                        <div class="respostaAdicionar" name="adicionadoSucesso" id="adicionadoSucesso" style="background-color: #d7f8dc; padding: 15px;" >
                            <div style="margin-bottom: 10px; font-weight: bold;">Aluno adicionado com sucesso</div>
                            <div style="margin-bottom: 10px;">Nome: </div>
                            <div>Turma: </div>
                        </div>
                    <?php
                }
                else{
                    ?>
                        <br>
                        <div class="respostaAdicionar" name="adicionadoErro" id="adicionadoErro" style="background-color: #f8d7da; padding: 15px;" >
                            <div style="margin-bottom: 10px; font-weight: bold;">Erro ao adicionar aluno</div>
                            Verifique os dados e tente novamente mais tarde<br>
                        </div>
                    <?php
                }
            }


        ?>
        

        <?php
            // Determina o número de resultados por página
            $numResultadosPorPagina = 10;

            //Descobrir o número de dados no banco de dados
            //Verificando se algum valor de turma foi setado
            $sql = "SELECT * FROM Aluno ";
            if(isset($idTurma)){
                $sql = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurma"; 
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
                //Verificar se existe um filtro de turma para pesquisar somente com ela 
                if(isset($idTurma)){
                    $sql = "SELECT * FROM Aluno WHERE Turma_idTurma = $idTurma ORDER BY nome LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina; 
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
        
        <div class="divBotaoCadastro">
            <a href="../tela_criar/cadastrarAluno.php" class="botaoCadastro">Adicionar aluno</a>
        </div>
    </div>
    

    <script>
        //Esconder a mensagem que diz se o aluno foi adicionado com sucesso ou se teve algum erro
        function esconderAdicao(){
            
            <?php
                if(isset($_GET["respostaAdicionarAluno"])){
                    $resposta = $_GET["respostaAdicionarAluno"];
                    ?>
                        let esconder;
                        <?php
                            if($resposta == 1){
                                ?>
                                    esconder = document.getElementById("adicionadoSucesso");
                                <?php
                            }
                            else{
                                ?>
                                    esconder = document.getElementById("adicionadoErro");
                                <?php
                            }
                        ?>
                        setTimeout(function () {
                            esconder.style.display = "none";
                        }, 10000);
                    <?php
                }
            ?>

            
            
        }

        function confirmarExclusao(matricula, nome){
            if(window.confirm("Deseja realmente excluir o registro: \nMatrícula: "+matricula+"\nNome: " + nome)){
                window.location = "../php_deletar/deletarAluno.php?matricula=" + matricula;
            }
        }

        function filtrar(){
            document.getElementById('form-filtrar').submit();
        }

    </script>

</body>




</html>