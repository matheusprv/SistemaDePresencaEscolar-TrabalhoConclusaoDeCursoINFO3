<?php
include_once("../conexao.php");
include_once('../dados_login.php');
$logged = $_SESSION['logged'] ?? null;
if (!$logged) {
    die(header("Location: ../index.php"));
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alunos</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

    <style>
        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
    include_once("../cabecalho/cabecalho_listar.php");
    //Verificar se existe algum filtro para a turma
    if (!empty($_POST["listTurma"])) {
        $idTurma = $_POST["listTurma"];
    }

    ?>
    <h1 style="text-align: center; margin-top: 20px;">Alunos</h1>
    <br>


    <div style="width: 1200px;  margin: 0 auto; text-align: center;">
        

        <?php
        include_once("respostasServicos.php");
        ?>
        <div class="resultadoEmail"></div>

        <form action="" id="form-pesquisa" method="post">
            

            <label for="listTurma">Turma:</label>
            <select name="listTurma" id="listTurma" required style="margin-left: 5px;" onchange="listarRegistros(1)">

                <option value="0" selected>Todas</option>
                <?php
                $sql = "SELECT idTurma, nome FROM Turma ORDER BY nome";

                $turma = $conn->query($sql);

                while ($rowTurma = $turma->fetch_assoc()) {
                    if (is_null($idTurma)) {
                ?>
                        <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $rowTurma["idTurma"]; ?>" <?php echo ($rowTurma["idTurma"] == $idTurma) ? "selected" : "" ?>> <?php echo $rowTurma["nome"]; ?></option>
                <?php
                    }
                }

                ?>
            </select>
            <br><br>
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Aluno matrícula " style="padding: 3px;">
            <input type="submit" name="enviar" value="Pesquisar" style="cursor: pointer; padding: 3px;">

        </form>

        <div class="resultados"></div>

        <div class="divBotaoCadastro">
            <a href="../tela_criar/cadastrarAluno.php" class="botaoCadastro">Adicionar aluno</a>
        </div>
    </div>


    <script>
        $(document).ready(function() {

            var pagina = 1;

            listarRegistros(pagina); // Chamar a função assim que carregar a página

            $("#form-pesquisa").submit(function(evento) {
                evento.preventDefault();
                listarRegistros(pagina); //Chamar a função ao clicar no botão de pesquisa
            })

        });

        function listarRegistros(pagina) {
            let pesquisa = $("#pesquisa").val();
            let turma = $("#listTurma").val();
            let dados = {
                pesquisa: pesquisa,
                pagina: pagina,
                turma : turma
            }

            $.post("pesquisaDeDados/pesquisarAlunos.php", dados, function(retorna) {
                $(".resultados").html(retorna);
            });

        }

        function confirmarExclusao(matricula, nome) {
            if (window.confirm("Deseja realmente excluir o registro: \nMatrícula: " + matricula + "\nNome: " + nome)) {
                window.location = "../php_deletar/deletarAluno.php?matricula=" + matricula;
            }
        }

        function acessoAPP(matricula, nome, emailResponsavel, nomeResponsavel){
            let enviarDadosResponsavel = 0;
            let dados = {
                enviarDadosResponsavel : enviarDadosResponsavel,
                matricula: matricula,
                nome: nome,
                emailResponsavel : emailResponsavel,
                nomeResponsavel : nomeResponsavel
            }

            $.post("pesquisaDeDados/pesquisarEmail.php", dados, function(retorna) {
                $(".resultadoEmail").html(retorna);
            });
        }
        
    </script>

</body>




</html>