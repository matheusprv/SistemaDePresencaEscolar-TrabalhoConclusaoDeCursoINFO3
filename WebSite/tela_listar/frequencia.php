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
    <title>Frequência</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="icon" href="../imagens/icone_PrefeituraOuroBranco.png">

    <link rel="stylesheet" href="../css/style.css">

</head>

<body>
    <?php
    include_once("../cabecalho/cabecalho_listar.php");
    ?>
    <h1 style="text-align: center; margin-top: 20px;">Frequência</h1>
    <br>

    <?php
    //include_once("../pesquisa/pesquisa.html");
    //echo "<br>";
    ?>

    <div style="margin: 20px; text-align: center;">

        <form action="" id="form-pesquisa" method="post">

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

            
            
            <input type="text" name="pesquisa" id="pesquisa" placeholder="Nome do aluno" style="padding: 3px;">
            <input type="submit" name="enviar" value="Pesquisar" style="cursor: pointer; padding: 3px;">

        </form>

        <br>
        <button id="baixarDados" style="cursor: pointer; font-size: 1em; padding: 5px;"> Baixar dados</button>
        <br>

        <div class="resultados">
        </div>

        <br>

        <a href="../tela_criar/presencaParaAluno.php" style="margin-right:20px; font-size: 1.2em">Adicionar presença</a>

        <a href="../tela_criar/removerPresencaParaAluno.php" style="font-size: 1.2em">Remover presença</a>

</body>

<script>
    $(document).ready(function() {

        var pagina = 1;

        listarRegistrosTurmas(); // Chamar a função assim que carregar a página

        $("#form-pesquisa").submit(function(evento) {
            evento.preventDefault();
            listarRegistros(pagina); //Chamar a função ao clicar no botão de pesquisa
        })

    });

    function listarRegistrosTurmas() {
        let ano = $("#listAnoTurma").val();
        let dados = {
            ano: ano
        }

        $.post("pesquisaDeDados/pesquisarFrequencia-Turmas.php", dados, function(retorna) {
            $(".resultados-turmas").html(retorna);
            listarRegistros(1);
        });
        

    }

    function listarRegistros(pagina) {
        let pesquisa = $("#pesquisa").val();
        let turma = $("#listTurma").val();
        let dados = {
            pesquisa: pesquisa,
            pagina: pagina,
            turma: turma
        }

        $.post("pesquisaDeDados/pesquisarFrequencia.php", dados, function(retorna) {
            $(".resultados").html(retorna);
        });

    }


    function pesquisar() {

        let turma = document.getElementById("listTurma");
        let pesquisa = turma.options[turma.selectedIndex].value;

        let dados = {
            pesquisa: pesquisa
        }

        $.post("pesquisaDeDados/pesquisarFrequencia.php", dados, function(retorna) {
            $(".resultados").html(retorna);
        });

        document.getElementById("avisoPresenca").style.display = "none";
    }



    //https://yourblogcoach.com/export-html-table-to-csv-using-javascript/
    document.getElementById("baixarDados").addEventListener("click", function () {
        var html = document.querySelector("table").outerHTML;
        exportarDados(html, "students.csv");
    });

    //Baixar os dados da tabela em uma planilha CSV
    function exportarDados(html, filename){
        var data = [];
        var rows = document.querySelectorAll("table tr");
                
        //Recuperando todos os <tr> que serão as linhas da planilha
        for (var i = 0; i < rows.length; i++) {
            var row = [], cols = rows[i].querySelectorAll("td, th");
                    
            for (var j = 0; j < cols.length; j++) {
                    row.push(cols[j].innerText);
            }
                    
            data.push(row.join(",")); 		
        }

        downloadCSVFile(data.join("\n"), filename);
    }
    function downloadCSVFile(csv, filename) {
        var csv_file, download_link;

        csv_file = new Blob([csv], {type: "text/csv"});

        download_link = document.createElement("a");

        let turma = document.getElementById("listTurma");
        let nomeTurma = turma.options[turma.selectedIndex].text;
        let nomeArquivo = "Freuquência - " + nomeTurma;

        download_link.download = nomeArquivo;

        download_link.href = window.URL.createObjectURL(csv_file);

        download_link.style.display = "none";

        document.body.appendChild(download_link);

        download_link.click();
    }

    


</script>


</html>