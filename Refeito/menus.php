<?php
    include_once 'dados_login.php';
    $logged = $_SESSION['logged'] ?? null;
    if (!$logged) {
        die(header("Location: index.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menus</title>

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/menus.css">
</head>

<body class="corpo-menus imagem-menu" style="margin: 0;">
    <nav>
        <p><?php echo "Olá, {$_SESSION['usuario']}"; ?></p>
        <img src="imagens/logotipo.png" alt="Prefeitura de Ouro Branco" style="height: 80%;">
    </nav>


    <div class="centro">
        <ul>
            <li class="lista-link">
                <a class="link-texto" href="listar/alunos.php" style="width: 100%;"><button>Alunos</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/disciplinas.php"><button>Disciplina</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/frequencia.php"><button>Frequência</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/funcionarios.php"><button>Funcionários</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto " href="listar/horarios.php"><button>Horários</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/responsaveis.php"><button>Responsáveis</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/turmas.php"><button>Turmas</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="listar/usuario.php"><button>Usuário</button></a>
            </li>

            <li class="lista-link">
                <a class="link-texto" href="?logout=1"><button id="sair-menu">Sair</button></a>
            </li>
        </ul>

    </div>
</body>

</html>