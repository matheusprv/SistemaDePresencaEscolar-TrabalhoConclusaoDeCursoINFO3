<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de funcionário</title>
    <link rel="stylesheet" href="FuncionarioCadastro.css">
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

            <form name="cadastrarFuncionario" action="arquivosPHP/cadastrarFuncionario.php" method="POST">
                <div class="cadastro">
                    <p><b>Cadastro de funcionários</b></p>
                    <label for="txtNome">Nome</label>
                    <input type="text" name="txtNome" id="txtNome"
                        style=" margin-left: 5px; width: 617px; cursor: text;" required>
                </div>

                <div class="cadastro">
                    <label for="txtEmail">Email</label>
                    <input type="email" name="txtEmail" id="txtEmail"
                        style="margin-left: 10px; width: 617px; cursor: text;" required><br>
                </div>

                <div class="cadastro">

                    <label for="txtSenha">Senha</label>
                    <input type="text" name="txtSenha" id="txtSenha" style="width: 615px; cursor: text;" required>
                </div>

                <div class="adicionarLimpar">
                    <input type="submit" value="Adicionar">
                    <input type="reset" value="Limpar">
                </div>
            </form>


        </div>
    </div>
</body>

</html>