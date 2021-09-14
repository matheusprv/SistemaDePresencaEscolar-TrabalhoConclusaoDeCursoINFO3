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
    
</head>

<body>
    <div class=cabecalho>
        <input type="checkbox" id="chec">
        <label for="chec" class="lblMenuLateral"><div class="hamburguer" style="margin-left: 20px;"></div></label>

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
                <img src="Imagens/logotipo.png" alt="Logotipo Ouro Branco" style="margin-top: 5px; padding-left: 133px;">
            </div>
            <h4 class="usuario" style="color: white;">Usuário</h4>
        </div>
    </div>
    
    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Responsáveis</h2>
            
            <form name="filtrar" action="" method="POST">
                <div class="cadastro pesquisa" >
                    <input type="text" name="txtPesquisa" id="txtPesquisa" style="width: 800px; cursor: text;" placeholder="Nome ou email">
                    <button style="cursor: pointer;">Pesquisar</button>
                </div>
            </form>


            <div class="tabela">
                <table style="width: 960px;">
                    <tr>
                        <th style="width: 40%;">Nome</th>
                        <th>Email</th>
                        <th style="width: 20%;">Ações</th>
                        
                    </tr>
                    <?php
                        $sql = "SELECT * FROM Responsavel";
                        $dadosResponsavel = $conn->query($sql);

                        if ($dadosResponsavel -> num_rows > 0) {
                            while($responsavel = $dadosResponsavel->fetch_assoc()){
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $responsavel["nome"]?>
                                    </td>
                                    <td>
                                        <?php echo $responsavel["email"]?>
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
            <div class="divBotaoCadastro">
                <a href="responsavelCadastrar.php" class="botaoCadastro">Cadastrar responsável</a>
            </div>
            
        </div>
    </div>
</body>

</html>