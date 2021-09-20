<?php
    include_once("arquivosPHP/conexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionário</title>
    <link rel="stylesheet" href="Funcionario.css">
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>

<body style="font-size: 1.3em;">
    <?php
        include_once("cabecalho.php");
    ?>

    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Liberar acesso de funcionários</h2>
            <form name="filtrar" action="" method="POST">
                <div class="cadastro">
                    <input type="text" name="txtpesquisa" id="txtPesquisa" style="width: 800px; cursor: text;"
                        placeholder="Digite o nome ou e-mail">
                    <input type="submit" value="Pesquisar">
                </div>

            </form>


            <div class="tabela">
                <?php
                    // Determina o número de resultados por página
                    $numResultadosPorPagina = 10;

                    //Descobrir o número de dados no banco de dados
                    $sql = "SELECT * FROM Funcionario WHERE verificado = 0";
                    $funcionarios = $conn->query($sql);
                    $numeroDeResultados =  mysqli_num_rows($funcionarios);

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
                    $sql = "SELECT * FROM Funcionario WHERE verificado = 0 LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
                    $funcionarios = $conn->query($sql);
                    
                ?>
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>  
                        <th style="width: 18%;">Ações</th>  
                    </tr>
                    <?php
                        if ($funcionarios -> num_rows > 0) {
                            while($exibir = $funcionarios->fetch_assoc()){
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $exibir["Nome"]?>
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
    </div>
</body>

</html>