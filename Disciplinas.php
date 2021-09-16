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
                <table>
                    <tr>
                        <th style="width: 30%;">Nome</th>
                        <th>Professor</th>
                        <th style="width: 10%;">Código</th>
                        <th style="width: 10%;">Nº aulas</th>
                        <th style="width: 20%;">Ações</th>
                    </tr>
                    <?php
                        $sql = "SELECT * FROM Disciplina";
                        $dadosDisciplina = $conn->query($sql);

                        if ($dadosDisciplina -> num_rows > 0) {
                            while($exibir = $dadosDisciplina->fetch_assoc()){
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
                        }
                    ?>
<!--
                    <tr>
                        <td>Matemática</td>
                        <td>Alexandre</td>
                        <td>MAT-2021</td>
                        <td>
                            <input type="submit" value="Editar" class="BotaoEditar">
                            <input type="submit" value="Deletar" class="BotaoDeletar">
                        </td>   
                    </tr>
                    <tr>
                        <td>História</td>
                        <td>Rodolpho</td>
                        <td>HIST-2021</td>
                        <td>
                            <input type="submit" value="Editar" class="BotaoEditar">
                            <input type="submit" value="Deletar" class="BotaoDeletar">
                        </td>   
                    </tr>
                    <tr>
                        <td>Português</td>
                        <td>Ana Paula</td>
                        <td>POR-2021</td>
                        <td>
                            <input type="submit" value="Editar" class="BotaoEditar">
                            <input type="submit" value="Deletar"  class="BotaoDeletar">
                        </td>   
                    </tr>
-->
                </table>  
            </div>
            <div class="divBotaoCadastro">
                <a href="DisciplinasCadastro.php" class="botaoCadastro">Cadastrar disciplina</a>
            </div>
            
              
        </div>
    </div>
</body>
</html>