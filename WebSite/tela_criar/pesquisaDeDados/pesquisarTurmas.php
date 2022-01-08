<?php
    include_once("../../conexao.php");
    $anoTurma = $_POST["anoTurma"];
    $sql = "SELECT idTurma, nome FROM Turma WHERE ano = $anoTurma ORDER BY nome";
    $turma = $conn -> query($sql);
?>
<label for="listTurma">Turma do aluno:</label> <br>
<select name="listTurma" id="listTurma" required style="width: 100%;">
    <option value="" selected disabled hidden>Selecionar</option>
    <?php

        while ($rowTurma = $turma->fetch_assoc()) {
            ?>
                <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
            <?php
        }

    ?>
</select>
