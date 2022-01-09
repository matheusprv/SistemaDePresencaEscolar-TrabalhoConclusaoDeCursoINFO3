<?php
    include_once("../../conexao.php");

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];

    // Determina o número de resultados por página
    $numResultadosPorPagina = 10;

    //Descobrir o número de dados no banco de dados
    $sql = "SELECT * FROM Responsavel WHERE nome like '%$pesquisa%' OR email like '%$pesquisa%' ";
    $responsaveis = $conn->query($sql);
    $numeroDeResultados =  mysqli_num_rows($responsaveis);

    if ($numeroDeResultados > 0) {
        //Determinar o total de páginas disponíveis 
        $numeroDePaginas = ceil($numeroDeResultados / $numResultadosPorPagina);

        //Determinar o limite inicial de dados mostrados na página
        $primeiroResultadoDaPagina = ($pagina - 1) * $numResultadosPorPagina;

        //Recuperar dados para mostrar na página
        $sql = "SELECT * FROM Responsavel WHERE nome like '%$pesquisa%' OR email like '%$pesquisa%' ORDER BY nome LIMIT " . $primeiroResultadoDaPagina . ',' . $numResultadosPorPagina;
        $responsavel = $conn->query($sql);

    ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <?php
            while ($exibir = $responsavel->fetch_assoc()) {
            ?>
                <tr>
                    <td>
                        <?php echo $exibir["nome"] ?>
                    </td>
                    <td>
                        <?php echo $exibir["email"] ?>
                    </td>
                    <td>

                        <a href="../tela_editar/editarResponsavel.php?id=<?php echo $exibir["id"] ?>"><input type="submit" value="Editar" class="botaoEditar editarDeletar"></a>
                        <input type="submit" value="Deletar" class="botaoDeletar editarDeletar" onclick="confirmarExclusao('<?php echo $exibir["id"] ?>', '<?php echo $exibir["email"] ?>','<?php echo $exibir["nome"] ?>')">
                        <input type="submit" value="Acesso APP" onclick="acessoAPP('<?php echo $exibir["email"]?>', '<?php echo $exibir["nome"]?>')">
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
    else {
        ?>
        <h2 style="color: red;">Nenhum dado encontrado</h2>
    <?php
    }
?>
