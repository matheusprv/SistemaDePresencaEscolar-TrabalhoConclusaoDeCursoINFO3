0
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <nav>
            <p class="logo" ><?php echo "Olá, {$_SESSION['usuario']}"; ?></p>

            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-list">
                <li><a href="menus.php" >Menus</a></li>
                <li><a href="alunos.php" >Alunos</a></li>
                <li><a href="Disciplinas.php" >Disciplinas</a></li>
                <li><a href="frequencia.php" >Frequência</a></li>
                <li><a href="Funcionario.php" >Funcionários</a></li>
                <li><a href="horario.php" >Horário</a></li>
                <li><a href="responsavel.php" >Responsável</a></li>
                <li><a href="Turma.php" >Turmas</a></li>
                <li><a href ="?logout=1"  id="sair">Sair</a></li>
            </ul>
        </nav>
    </header>

    <main></main>

    <script src="mobile-navbar.js"></script>

</body>
</html>