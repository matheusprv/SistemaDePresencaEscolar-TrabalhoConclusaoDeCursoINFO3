<?php
    include_once("arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disciplinas</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>
<body>
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Disciplinas</h2>
            <form name="filtrar" action="" method="POST">
                <div class="cadastro">
                    <label for="txtPesquisar"></label>
                    <input type="text" name="txtPesquisa" id="txtPesquisa" style="width: 700px; cursor:text" placeholder="Nome, professor ou código">
                    <input type="submit" value="Pesquisar">
                </div>
            </form>
            

            <div class="tabela">
                <?php
                    // Determina o número de resultados por página
                    $numResultadosPorPagina = 10;

                    //Descobrir o número de dados no banco de dados
                    $sql = "SELECT * FROM Disciplina";
                    $disciplina = $conn->query($sql);
                    $numeroDeResultados =  mysqli_num_rows($disciplina);

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
                    $sql = "SELECT * FROM Disciplina LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
                    $disciplina = $conn->query($sql);
                        
                ?>
                <table>
                    <tr>
                        <th style="width: 30%;">Nome</th>
                        <th>Professor</th>
                        <th style="width: 10%;">Código</th>
                        <th style="width: 10%;">Nº aulas</th>
                        <th style="width: 20%;">Ações</th>
                    </tr>
                    <?php
                        while($exibir = $disciplina->fetch_assoc()){
                            ?>
                            <tr>
                                <td>
                                    <?php echo $exibir["nome"]?>
                                </td>
                                <td>
                                    <?php echo $exibir["professor"]?>
                                </td>
                                <td>
                                    <?php echo $exibir["idDisciplina"]?>
                                </td>
                                <td>
                                    <?php echo $exibir["numeroAulas"]?>
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
                        <a href="<?php echo 'Disciplinas.php?pagina='.$pagina; ?>"> <?php echo $pagina;?></a>
                        <?php
                    }
                ?>
            </div>
            <div class="divBotaoCadastro">
                <a href="DisciplinasCadastro.php" class="botaoCadastro">Cadastrar disciplina</a>
            </div>
            
              
        </div>
    </div>
</body>
</html>