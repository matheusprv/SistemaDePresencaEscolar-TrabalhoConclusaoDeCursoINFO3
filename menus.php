<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menus</title>
    <link rel="stylesheet" href="menus.css">
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">

    <style>
        @media screen and (max-with:1000px) {

            .menu-lado,
            .opcoes {
                margin-left: 0px;
                margin-right: 0px;
            }
        }
    </style>

</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>
    <!--
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
                <img src="Imagens/logotipo.png" alt="Logotipo Ouro Branco" style="margin-top: 5px; padding-left: 133px;">
            </div>
            <h4 class="usuario" style="color: white;">Usuário</h4>
        </div>
        
    </div>
    -->
    <div class="divExterna">
        <div class="divInterna" style="border-radius: 25px;">
            <div class="conteudo">
                <ul>
                    <li class="opcoes">
                        <a href="alunos.php"><img class="imagem-menu" src="Imagens/aluno.jpg" alt="Alunos">
                            <br>
                            <div class="texto">Alunos</div>
                        </a>
                    </li>
                    <li class="menu-lado opcoes">
                        <a href="Disciplinas.php"><img class="imagem-menu" src="Imagens/disciplina.jpg" alt="Horários">
                            <br>
                            <div class="texto">Disciplinas</div>
                        </a>
                    </li>
                    <li class="menu-lado opcoes">
                        <a href="frequencia.php"><img class="imagem-menu" src="Imagens/frequencia.jpg" alt="Frequência">
                            <br>
                            <div class="texto">Frequência</div>
                        </a>
                    </li>
                    <li class="menu-lado opcoes" style="margin-right: 40px;">
                        <a href="Funcionario.php"><img class="imagem-menu" src="Imagens/funcionario.jpg" alt="Funcionários">
                            <br>
                            <div class="texto">Funcionários</div>
                        </a>
                    </li>

                </ul>


                <ul>
                    <li class=" opcoes">
                        <a href="horario.php"><img class="imagem-menu" src="Imagens/horario.jpg" alt="Horários">
                            <br>
                            <div class="texto">Horários</div>
                        </a>
                    </li>
                    <li class="menu-lado opcoes">
                        <a href="responsavel.php"><img class="imagem-menu" src="Imagens/responsaveis.jpg" alt="Responsáveis">
                            <br>
                            <div class="texto">Responsáveis</div>
                        </a>
                    </li>
                    <li class="menu-lado opcoes">
                        <a href="Turma.php"><img class="imagem-menu" src="Imagens/turmas.jpg" alt="Turmas">
                            <br>
                            <div class="texto">Turmas</div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

</body>

</html>