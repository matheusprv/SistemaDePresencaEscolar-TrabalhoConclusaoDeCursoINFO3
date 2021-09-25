<?php
    include_once("../arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>


    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../pesquisa/pesquisa.css">
        
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho.html");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Alunos</h1>
    <br>

    <?php
        include_once("../pesquisa/pesquisa.html");
        echo "<br>"
    ?>

    <div style="width: 1200px;  margin: 0 auto; text-align: center;">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th >Nome</th>
                    <th>Nº Matrícula</th>
                    <th>Turma</th>
                    <th>Responsável</th>
                    <th>Ações</th>
                </tr>
            </tr>
            <?php
                $sql = "SELECT * FROM Aluno";
                $dadosAlunos = $conn->query($sql);

                if ($dadosAlunos -> num_rows > 0) {
                    while($alunos = $dadosAlunos->fetch_assoc()){
                        ?>
                        <tr>
                            <td>
                                <?php echo $alunos["nome"]?>
                            </td>
                            <td>
                                <?php echo $alunos["matricula"]?>
                            </td>
                            <td>
                                <?php echo $alunos["turma_idTurma"]?>
                            </td>
                            <td>
                                <?
                                    $sqlResponsavel = "SELECT * FROM Responsavel WHERE id = $alunos['Responsavel_id'] ";
                                    $responsavel = $conn->query($sqlResponsavel);

                                    echo $responsavel["id"];
                                ?>
                                <?php ?>
                            </td>
                            <td>
                                <input type="submit" value="Editar" class="BotaoEditar">
                                <input type="submit" value="Deletar"  class="BotaoDeletar">
                            </td>
                        </tr>
                        <?php
                    }
                }
                else{
                    ?>
                        <h2 style="color: red;">Nenhum dado encontrado</h2>
                    <?php
                }
            ?>
            </thead>
        </table>
        <div class="divBotaoCadastro">
            <a href="../criar/cadastrarAluno.php" class="botaoCadastro">Adicionar aluno</a>
        </div>
    </div>
    

</body>


</html>