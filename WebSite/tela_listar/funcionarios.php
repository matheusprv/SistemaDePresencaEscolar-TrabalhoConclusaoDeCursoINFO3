<?php
    include_once("../conexao.php");
    include_once ('../dados_login.php');
    $logged = $_SESSION['logged'] ?? null;
    if(!$logged){
        die(header("Location: ../index.php"));
    }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionários</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">
    <style>
        tr:hover{
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <?php
        include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Funcionários</h1>
    <br>

    <div style="width: 1200px;  margin: 0 auto; text-align: center;">
        <?php
            //Importando quadro de respostas do CRUD
            include_once("respostasServicos.php");
        ?>

        <form action="" id="form-pesquisa" method="post">
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Nome ou email" style="padding: 3px;"> 
            <input type="submit" name="enviar" value="Pesquisar" style="cursor: pointer; padding: 3px;">
        </form>

        <div class="resultados"></div>

        <div class="divBotaoCadastro">
            <a href="funcionariosAprovar.php" class="botaoCadastro" style="margin-right: 15px;">Aprovar funcionários</a>
            <a href="../tela_criar/cadastrarFuncionario.php" class="botaoCadastro">Adicionar funcionário</a>
        </div>


    </div>
    <script>

        $(document).ready(function(){

            var pagina = 1;

            listarRegistros(pagina); // Chamar a função assim que carregar a página

            $("#form-pesquisa").submit(function(evento){
                evento.preventDefault();
                listarRegistros(pagina); //Chamar a função ao clicar no botão de pesquisa
            })
            
        });

        function listarRegistros(pagina ){
            let pesquisa = $("#pesquisa").val();
            let dados ={
                pesquisa : pesquisa,
                pagina : pagina,
            }

            $.post("pesquisaDeDados/pesqusiarFuncionarios.php", dados, function(retorna){
                $(".resultados").html(retorna);
            });

        }

        function confirmarExclusao(id, email, nome){
            if(window.confirm("Deseja realmente excluir o registro: \nEmail: "+email+"\nNome: " + nome)){
                window.location = "../php_deletar/deletarFuncionario.php?id=" +id+"&telaAprovar=0";
            }
        }
    </script>

</body>


</html>