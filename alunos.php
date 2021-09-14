<?php
    include_once("arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="stylesheet" href="geral.css">

</head>

<body>
    <div class=cabecalho>
        <input type="checkbox" id="chec">
        <label for="chec" class="lblMenuLateral">
            <div class="hamburguer" style="margin-left: 20px;"></div>
        </label>

        <nav>
            <ul style="position: absolute; top: 50px; width: 100%; font-size: 1.2em;">
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
                <img src="Imagens/logotipo.png" alt="Logotipo Ouro Branco"
                    style="margin-top: 5px; padding-left: 133px;">
            </div>
            <h4 class="usuario" style="color: white;">Usuário</h4>
        </div>
    </div>


    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Alunos</h2>

            <form name="filtrar" action="arquivosPHP/cadastrarAluno.php" method="POST">
                <div class="cadastro">
                    <input type="text" name="txtPesquisa" id="txtPesquisa" style="width: 1000px; cursor:text"
                        placeholder="Digite qualquer informação do usuário">
                    <input type="submit" value="Pesquisar">
                </div>
                
                <table style="width: 1160px;">
                    <tr>
                        <th style="width: 400px;">Nome</th>
                        <th style="width: 140px;">Nº Matrícula</th>
                        <th style="width: 100px;">Turma</th>
                        <th style="width: 400px;">Responsável</th>
                        <th style="width: 200px;">Ações</th>
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
                                            $sqlResponsavel = "SELECT * FROM Responsavel WHERE id = $alunos["Responsavel_id"] ";
                                            $responsavel = $conn->query($sqlResponsavel);

                                            echo $responsavel["id"]
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
                    ?>
                </table>
            </form>
            <div class="divBotaoCadastro">
                <a href="alunosCadastro.php" class="botaoCadastro">Adicionar aluno</a>
            </div>


        </div>

    </div>
</body>


</html>