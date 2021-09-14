<!DOCTYPE html>
<html lang="pt-Br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro das turmas</title>
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
            <h2 style="width: 100%; text-align: center;">Cadastrar turma</h2>
            
            <form name= "cadastrarTurma" action="arquivosPHP/cadastrarTurma.php" method="POST">
                <div class="cadastro">
                    <label for="txtNome">Nome</label>
                    <input type="text" name="txtNome" style="width: 670px; cursor: text;" required>
                </div>
                <div class="cadastro"  style="padding-top: 10px;">
                    <label for="txtAno">Ano</label>
                    <input type="number" name="txtAno" style="width: 143px; cursor: text;" required>
                </div>   
                <div class="adicionarLimpar">
                    <input type="submit" name="btnSalvar" value="Adicionar">
                    <input type="reset" name="btnCancelar" value="Limpar">
                </div>           
            </form>

        </div>
    </div>

</body>
</html>