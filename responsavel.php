<?php
    include_once("arquivosPHP/conexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsável</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
    
</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>
    
    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Responsáveis</h2>
            
            <form name="filtrar" action="" method="POST">
                <div class="cadastro pesquisa" >
                    <input type="text" name="txtPesquisa" id="txtPesquisa" style="width: 800px; cursor: text;" placeholder="Nome ou email">
                    <button style="cursor: pointer;">Pesquisar</button>
                </div>
            </form>

            <div class="divExterna">
                <div class="divInterna">
                    <?php
                        // Determina o número de resultados por página
                        $numResultadosPorPagina = 10;

                        //Descobrir o número de dados no banco de dados
                        $sql = "SELECT * FROM Responsavel";
                        $responsavel = $conn->query($sql);
                        $numeroDeResultados =  mysqli_num_rows($responsavel);

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
                        $sql = "SELECT * FROM Responsavel LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
                        $responsavel = $conn->query($sql);
                        
                    ?>
                    <div class="tabela">
                        <table style="width: 960px;">
                            <tr>
                                <th style="width: 40%;">Nome</th>
                                <th>Email</th>
                                <th style="width: 20%;">Ações</th>
                                
                            </tr>
                            <?php
                                if ($responsavel -> num_rows > 0) {
                                    while($exibir = $responsavel->fetch_assoc()){
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $exibir["nome"]?>
                                            </td>
                                            <td>
                                                <?php echo $exibir["email"]?>
                                            </td>
                                            <td>
                                                <input type="submit" value="Editar" class="BotaoEditar">
                                                <input type="submit" value="Deletar"  class="BotaoDeletar">
                                            </td>
                                        </tr>
                                        <?php
                                    }
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
                <a href="responsavelCadastrar.php" class="botaoCadastro">Cadastrar responsável</a>
            </div>
            
        </div>
    </div>
</body>

</html>