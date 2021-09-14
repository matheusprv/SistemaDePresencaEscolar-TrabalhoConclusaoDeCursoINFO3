<?php
    include_once("arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Turmas</title>
    <link rel="stylesheet" href="geral.css">
</head>
<body>
    <div class=cabecalho>
        <input type="checkbox" id="chec">
        <label for="chec" class="lblMenuLateral"><div class="hamburguer" style="margin-left: 20px;"></div></label>

        <nav>
            <ul style="position: absolute; top: 50px; width: 100%; font-size: 1em;">
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
            <h2 style="width: 100%; text-align: center;">Turmas</h2>

            <div class="cadastro pesquisa">
                <form name="filtrar" action="" method="POST">
                    <input type="text" name="txtPesquisa" id="txtPesquisa" style="width: 610px; cursor: text;" placeholder="Nome, Ano">
                    <input type="submit" value="Pesquisar">
                </form>
                
            </div>

            <div class="divExterna">
                <div class="divInterna">
                    <div class="tabela">
                        <?php
                            // Determina o número de resultados por página
                            $numResultadosPorPagina = 10;

                            //Descobrir o número de dados no banco de dados
                            $sql = "SELECT * FROM Turma";
                            $turmas = $conn->query($sql);
                            $numeroDeResultados =  mysqli_num_rows($turmas);

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
                            $sql = "SELECT * FROM Turma LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
                            $turmas = $conn->query($sql);
                            
                        ?>
                        <table>
                            <tr>
                                <th>Nome</th>
                                <th>Ano</th>
                                <th style="width: 25%;">Ações</th>
                            </tr>
                            <?php
                                while($exibir = $turmas->fetch_assoc()){
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $exibir["nome"]?>
                                        </td>
                                        <td>
                                            <?php echo $exibir["ano"]?>
                                        </td>
                                        <td>
                                            <input type="submit" value="Editar" class="BotaoEditar">
                                            <input type="submit" value="Deletar"  class="BotaoDeletar">
                                        </td>
                                    </tr>
                                    <?php
                                }
                            ?>
                        </table>
                        
                        <?php
                            //Mostrar os links entre as páginas
                            for ($pagina=1; $pagina <= $numeroDePaginas; $pagina++) { 
                                ?>
                                <a href="<?php echo 'Turma.php?pagina='.$pagina; ?>"> <?php echo $pagina;?></a>
                                <?php
                            }
                        ?>
                    </div>

                </div>
            </div>
                    
            <div class="divBotaoCadastro">
                <a href="TurmaCadastrar.php" class="botaoCadastro">Cadastrar turma</a>
            </div>
            
        </div>
    </div>

</body>
</html>

