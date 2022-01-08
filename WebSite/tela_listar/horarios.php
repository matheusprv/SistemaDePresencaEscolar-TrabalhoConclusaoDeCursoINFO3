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
    <title>Horários</title>
    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <?php
    include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Horários</h1>
    <br>


    <div style="margin: 20px; text-align: center;">
        <div style="width: 1200px;  margin: 0 auto; text-align: center;">
            <div class="resposta"> </div>
            <?php
                include_once("respostasServicos.php");
                $atualizar =0; //0-> Salvar um novo horário || 1-> Atualizar horário atual
            ?>
        </div>

        
        <!--
        <form action= <?php echo ($atualizar==0)?"../php_adicionar/cadastrarHorario.php":"../php_atualizar/atualizarHorario.php?idAula1=$primeiroValorIdAulas&idAulaFim=$ultimoValorIdAulas" ?> method="POST" id="salvarHorarios">
-->
        <form action="" method="POST" id="salvarHorarios">

            <!--Selecionar turma-->
            <ul>
                <li style="display: inline-block; margin-right: 15px;" >
                    <label for="listAnoTurma">Ano:</label>
                    <select name="listAnoTurma" id="listAnoTurma" required onchange="listarRegistrosTurmas()" style="margin-right: 15px;">
                        <?php
                            
                            $sql = "SELECT distinct ano from Turma ORDER BY ano DESC;";

                            $turma = $conn->query($sql);

                            while ($rowTurma = $turma->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rowTurma["ano"]; ?>"><?php echo $rowTurma["ano"]; ?></option>
                                <?php
                            }

                        ?>
                    </select>
                </li>
                <li style="display: inline-block; margin-right: 15px;" >
                    <div class="resultados-turmas"></div>   
                </li>
            </ul>

            <br>

            <div class="resultados"></div>
            
        </form>
    </div>

</body>

<script>
    $(document).ready(function() {
        listarRegistrosTurmas(); // Chamar a função assim que carregar a página
       
        $("#salvarHorarios").submit(function(evento) {
            evento.preventDefault();
            salvarDados(); //Chamar a função ao clicar no botão de pesquisa
        })

    });

    function listarRegistrosTurmas() {
        let ano = $("#listAnoTurma").val();
        let dados = {
            ano: ano
        }

        $.post("pesquisaDeDados/pesquisarHorarios-Turmas.php", dados, function(retorna) {
            $(".resultados-turmas").html(retorna);
            listarRegistros();
        });
        

    }

    function listarRegistros() {
        
        let turma = $("#listTurma").val();
        let dados = {
            idTurma: turma
        }

        $.post("pesquisaDeDados/pesquisarHorario.php", dados, function(retorna) {
            $(".resultados").html(retorna);
        });

    }


    function salvarDados(){
        let valorAtualizacao = document.getElementById('valorAtualizacao').textContent;
        console.log("Atualizar: "+valorAtualizacao);

        let turma = document.getElementById("listTurma");
        let opcaoTurma = turma.options[turma.selectedIndex].value;
        

        let disciplinaEscolhida0 = document.getElementById('disciplinaEscolhida0').value;
        let disciplinaEscolhida1 = document.getElementById('disciplinaEscolhida1').value;
        let disciplinaEscolhida2 = document.getElementById('disciplinaEscolhida2').value;
        let disciplinaEscolhida3 = document.getElementById('disciplinaEscolhida3').value;
        let disciplinaEscolhida4 = document.getElementById('disciplinaEscolhida4').value;
        let disciplinaEscolhida5 = document.getElementById('disciplinaEscolhida5').value;
        let disciplinaEscolhida6 = document.getElementById('disciplinaEscolhida6').value;
        let disciplinaEscolhida7 = document.getElementById('disciplinaEscolhida7').value;
        let disciplinaEscolhida8 = document.getElementById('disciplinaEscolhida8').value;
        let disciplinaEscolhida9 = document.getElementById('disciplinaEscolhida9').value;
        let disciplinaEscolhida10 = document.getElementById('disciplinaEscolhida10').value;
        let disciplinaEscolhida11 = document.getElementById('disciplinaEscolhida11').value;
        let disciplinaEscolhida12 = document.getElementById('disciplinaEscolhida12').value;
        let disciplinaEscolhida13 = document.getElementById('disciplinaEscolhida13').value;
        let disciplinaEscolhida14 = document.getElementById('disciplinaEscolhida14').value;
        let disciplinaEscolhida15 = document.getElementById('disciplinaEscolhida15').value;
        let disciplinaEscolhida16 = document.getElementById('disciplinaEscolhida16').value;
        let disciplinaEscolhida17 = document.getElementById('disciplinaEscolhida17').value;
        let disciplinaEscolhida18 = document.getElementById('disciplinaEscolhida18').value;
        let disciplinaEscolhida19 = document.getElementById('disciplinaEscolhida19').value;
        let disciplinaEscolhida20 = document.getElementById('disciplinaEscolhida20').value;
        let disciplinaEscolhida21 = document.getElementById('disciplinaEscolhida21').value;
        let disciplinaEscolhida22 = document.getElementById('disciplinaEscolhida22').value;
        let disciplinaEscolhida23 = document.getElementById('disciplinaEscolhida23').value;
        let disciplinaEscolhida24 = document.getElementById('disciplinaEscolhida24').value;

        let inicio1 = document.getElementById('inicio1').value;
        let inicio2 = document.getElementById('inicio2').value;
        let inicio3 = document.getElementById('inicio3').value;
        let inicio4 = document.getElementById('inicio4').value;
        let inicio5 = document.getElementById('inicio5').value;

        let fim1 = document.getElementById('fim1').value;
        let fim2 = document.getElementById('fim2').value;
        let fim3 = document.getElementById('fim3').value;
        let fim4 = document.getElementById('fim4').value;
        let fim5 = document.getElementById('fim5').value;



        let dados ={
            listTurma : opcaoTurma,

            disciplinaEscolhida0 : disciplinaEscolhida0,
            disciplinaEscolhida1 : disciplinaEscolhida1,
            disciplinaEscolhida2 : disciplinaEscolhida2,
            disciplinaEscolhida3 : disciplinaEscolhida3,
            disciplinaEscolhida4 : disciplinaEscolhida4,
            disciplinaEscolhida5 : disciplinaEscolhida5,
            disciplinaEscolhida6 : disciplinaEscolhida6,
            disciplinaEscolhida7 : disciplinaEscolhida7,
            disciplinaEscolhida8 : disciplinaEscolhida8,
            disciplinaEscolhida9 : disciplinaEscolhida9,
            disciplinaEscolhida10 : disciplinaEscolhida10,
            disciplinaEscolhida11 : disciplinaEscolhida11 ,
            disciplinaEscolhida12 : disciplinaEscolhida12,
            disciplinaEscolhida13 : disciplinaEscolhida13,
            disciplinaEscolhida14 : disciplinaEscolhida14,
            disciplinaEscolhida15 : disciplinaEscolhida15,
            disciplinaEscolhida16 : disciplinaEscolhida16,
            disciplinaEscolhida17 : disciplinaEscolhida17,
            disciplinaEscolhida18 : disciplinaEscolhida18,
            disciplinaEscolhida19 : disciplinaEscolhida19,
            disciplinaEscolhida20 : disciplinaEscolhida20,
            disciplinaEscolhida21 : disciplinaEscolhida21,
            disciplinaEscolhida22 : disciplinaEscolhida22,
            disciplinaEscolhida23 : disciplinaEscolhida23,
            disciplinaEscolhida24 : disciplinaEscolhida24,
            
            inicio1 : inicio1,
            inicio2 : inicio2,
            inicio3 : inicio3,
            inicio4 : inicio4,
            inicio5 : inicio5,

            fim1 : fim1,
            fim2 : fim2,
            fim3 : fim3,
            fim4 : fim4,
            fim5 : fim5,
            
        }

        if(valorAtualizacao == 0){
            $.post("../php_adicionar/cadastrarHorario.php", dados, function(retorna) {
                $(".resposta").html(retorna);
                listarRegistros();
            });
        }
        else{
            let primeiroValorIdAulas = document.getElementById('primeiroValorIdAulas').textContent;
            let ultimoValorIdAulas = document.getElementById('ultimoValorIdAulas').textContent;
            //alert("Primeiro valor: "+primeiroValorIdAulas+"\nÚltimo valor: "+ultimoValorIdAulas);
            $.post("../php_atualizar/atualizarHorario.php?idAula1="+primeiroValorIdAulas+"&idAulaFim="+ultimoValorIdAulas+"", dados, function(retorna) {
                $(".resposta").html(retorna);
        });
        }
    }

    function deletarHorario(){
        let turma = document.getElementById("listTurma");
        let opcaoTurma = turma.options[turma.selectedIndex].value;
        if(window.confirm("Deseja realmente deletar os horários dessa turma?")){
            window.location = "../php_deletar/deletarHorario.php?idTurma="+opcaoTurma;
        }
    }
</script>

</html>