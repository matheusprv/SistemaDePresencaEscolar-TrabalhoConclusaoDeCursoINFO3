<?php
    include_once("../../conexao.php");
    $ano = $_POST["ano"];
?>

<label for="listTurma">Turma:</label>
<select name="listTurma" id="listTurma" required style="margin-left: 5px;" onchange="listarRegistros()">
    <?php
    $sql = "SELECT idTurma, nome FROM Turma WHERE ano = $ano ORDER BY nome";

    $turma = $conn->query($sql);

    while ($rowTurma = $turma->fetch_assoc()) {
        ?>
            <option value="<?php echo $rowTurma["idTurma"]; ?>"><?php echo $rowTurma["nome"]; ?></option>
        <?php
    }

    ?>
</select>