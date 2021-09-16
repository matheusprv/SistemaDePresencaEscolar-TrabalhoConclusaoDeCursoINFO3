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


    <div class = "divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Funcionários</h2>
            <form name="filtrar" action="" method="POST">
                <div class="cadastro">
                    <input type="text" name="txtpesquisa" id="txtPesquisa" style="width: 800px; cursor: text;" placeholder="Digite o nome ou e-mail">
                    <input type="submit" value="Pesquisar">
                </div>
                
            </form>
            

            <div class="tabela">
                <table>
                    <tr>
                        <!--<th style="width: 41%;">Nome</th>-->
                        <th>Nome</th>
                        <th>Email</th>  
                        <th style="width: 18%;">Ações</th>  
                    </tr>
                    <?php
                        $sql = "SELECT Nome, email FROM Funcionario WHERE verificado = 1 ";
                        $dadosFunc = $conn->query($sql);

                        if ($dadosFunc -> num_rows > 0) {
                            while($exibir = $dadosFunc->fetch_assoc()){
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
            </div>

            <div class="divBotaoCadastro" style="text-align: right;">
                <a href="FuncionarioCadastro.php" class="botaoCadastro">Cadastrar funcionário</a>
                <a href="FuncionarioLiberarAcesso.php" class="botaoCadastro" style="margin-right: 10dp;">Liberar acesso de funcionário</a>
            </div>

            
            
        </div>   
    </div>
</body>

</html>