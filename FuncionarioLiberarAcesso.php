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
</head>

<body style="font-size: 1.3em;">
    <div class=cabecalho>
        <input type="checkbox" id="chec">
        <label for="chec" class="lblMenuLateral">
            <div class="hamburguer" style="margin-left: 20px;"></div>
        </label>

        <nav>
            <ul style="position: absolute; top: 50px; width: 100%; font-size: 1.2em;">
                <li><a href="menus.php" class="menuLateral">Menus</a></li>
                <li><a href="alunos" class="menuLateral">Alunos</a></li>
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
            <h2 style="width: 100%; text-align: center;">Liberar acesso de funcionários</h2>
            <form name="filtrar" action="" method="POST">
                <div class="cadastro">
                    <input type="text" name="txtpesquisa" id="txtPesquisa" style="width: 800px; cursor: text;"
                        placeholder="Digite o nome ou e-mail">
                    <input type="submit" value="Pesquisar">
                </div>

            </form>


            <div class="tabela">
                <table>
                    <tr>
                        <th>Nome</th>
                        <th>Email</th>  
                        <th style="width: 18%;">Ações</th>  
                    </tr>
                    <?php
                        $sql = "SELECT Nome, email FROM Funcionario WHERE verificado = 0 ";
                        $dadosFunc = $conn->query($sql);

                        if ($dadosFunc -> num_rows > 0) {
                            while($exibir = $dadosFunc->fetch_assoc()){
                                ?>
                                <form action="arquivosPHP/aprovarFuncionario.php" method="post">
                                    <tr>
                                        <td>
                                            <?php echo $exibir["Nome"]?>
                                        </td>
                                        <td>
                                            <input type="hidden" name="txtEmail" value="<?php $exibir["email"] ?>"><?php echo $exibir["email"]?>
                                        </td>
                                        <td>
                                            <input type="submit" value="Aceitar" class="BotaoEditar">
                                            <input type="submit" value="Deletar"  class="BotaoDeletar">
                                        </td>
                                    </tr>
                                </form>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
            </div>

        </div>
    </div>
</body>

</html>