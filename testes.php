<?php
    include_once("arquivosPHP/conexao.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    /*
        // Determina o número de resultados por página
        $results_per_page = 10;

        //Descobrir o número de dados no banco de dados
        $sql = "SELECT * FROM Turma";
        $result = $conn->query($sql);
        $number_of_results =  mysqli_num_rows($result);

        //Determinar o total de páginas disponíveis 
        $number_of_pages = ceil($number_of_results/$results_per_page);
        

        //Determinar qual página o usuário está
        if (!isset($_GET['page'])) {
            $page =1;
        }
        else{
            $page = $_GET['page'];
        }

        //Determinar o limite inicial de dados mostrados na página
        $this_page_first_result = ($page-1)*$results_per_page;

        //Recuperar dados para mostrar na página
        $sql = "SELECT * FROM Turma LIMIT " . $this_page_first_result. ',' . $results_per_page;
        $result = $conn->query($sql);
        //echo $number_of_results =  mysqli_num_rows($result);
        //echo "<br>";

        while($exibir = $result->fetch_assoc()){
            echo $exibir["nome"];
            echo " | ";
            echo $exibir["ano"];
            echo "<br>";

        }

        //Mostrar os links entre as páginas
        for ($page=1; $page <= $number_of_pages; $page++) { 
            echo '<a href="testes.php?page= ' . $page . '">' . $page  . '</a>';
        }
        */
?>

        <?php
            $sql = "SELECT idDisciplina, nome FROM Disciplina";

            $disciplina = $conn -> query($sql);


            while ($rowDisciplina = $disciplina->fetch_assoc()) {
                $vetor [] = (object) $rowDisciplina;
            }

            print_r($vetor);

            
                                    
            for ($i=0; $i < 3 ; $i++) { 
                ?>
                <select name="" id="" style="font-size: 1em; ">
                <option value="" selected disabled hidden>Selecionar</option>
                <?php
                    foreach ($vetor as $key => $val) {
                        ?>
                        <option value="<?php print($vetor[$key]->idDisciplina) ?>"><?php print($vetor[$key]->nome) ?></option>
                        <?php
                    }
            }
    ?>
    
</body>
</html>