<?php
    include_once '../dados_login.php';
?>
<link rel="stylesheet" href="../cabecalho/styleCabecalho.css">
<link rel="stylesheet" href="cabecalho/styleCabecalho.css">
<link rel="stylesheet" href="styleCabecalho.css">

<body>
        <nav id="navCabecalho">
            <!--https://www.youtube.com/watch?v=bHRXRYTppHM&ab_channel=TigerCodes-->

            
            <!--<img src="imagens/logotipo.png" alt="Prefeitura de Ouro Branco" style="height: 70%;">-->

            <a href="usuario.php" class="logo"><p><?php echo "Olá, {$_SESSION['usuario']}"; ?></p></a>

            <div class="mobile-menu">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>

            <ul class="nav-list">
                <li><a class="link-cabecalho" href="../menus.php" >Menus</a></li>
                <li><a class="link-cabecalho" href="alunos.php" >Alunos</a></li>
                <li><a class="link-cabecalho" href="disciplinas.php" >Disciplinas</a></li>
                <li><a class="link-cabecalho" href="frequencia.php" >Frequência</a></li>
                <li><a class="link-cabecalho" href="funcionarios.php" >Funcionários</a></li>
                <li><a class="link-cabecalho" href="horarios.php" >Horário</a></li>
                <li><a class="link-cabecalho" href="responsaveis.php" >Responsável</a></li>
                <li><a class="link-cabecalho" href="turmas.php" >Turmas</a></li>
                <li><a class="link-cabecalho" href="usuario.php" >Usuário</a></li>
                <!--
                <li><a class="link-cabecalho" href ="?logout=2"  id="sair">Sair</a></li>
                -->
            </ul>
        </nav>

    <script src="../cabecalho/mobile-navbar.js"></script>

</body>
