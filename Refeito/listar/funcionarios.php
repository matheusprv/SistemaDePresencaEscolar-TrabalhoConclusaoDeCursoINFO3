<?php
    include_once("../arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>

    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../pesquisa/pesquisa.css">
    <link rel="stylesheet" href="../cabecalho/styleCabecalho.css">
    
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.html");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Funcionários</h1>
    <br>

    <?php
        include_once("../pesquisa/pesquisa.html");
        echo "<br>"
    ?>

    <div style="width: 1200px;  margin: 0 auto; text-align: center;">
        <?php
            // Determina o número de resultados por página
            $numResultadosPorPagina = 10;

            //Descobrir o número de dados no banco de dados
            $sql = "SELECT * FROM Funcionario WHERE verificado = 1";
            $funcionarios = $conn->query($sql);
            $numeroDeResultados =  mysqli_num_rows($funcionarios);

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
                $sql = "SELECT * FROM Funcionario WHERE verificado = 1 LIMIT " . $primeiroResultadoDaPagina. ',' . $numResultadosPorPagina;
                $funcionarios = $conn->query($sql);

                ?>
                <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </tr>
                <?php    
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
                                <input type="submit" value="Editar" class="botaoEditar editarDeletar">
                                <input type="submit" value="Deletar"  class="botaoDeletar editarDeletar">
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
                <a class="nums-paginacao" href="<?php echo 'funcionarios.php?pagina='.$pagina; ?>"> <?php echo $pagina;?></a>
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
            <a href="../listar/funcionariosAprovar.php" class="botaoCadastro" style="margin-right: 15px;">Aprovar funcionários</a>
            <a href="../criar/cadastrarFuncionario.php" class="botaoCadastro">Adicionar funcionário</a>
        </div>
    </div>
    

</body>


</html>