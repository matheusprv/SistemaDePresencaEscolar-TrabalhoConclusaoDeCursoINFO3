<?php
    include_once("../conexao.php");
    session_start();

    $turmaPesquisa = $_POST["pesquisa"];

?>


    <select name="txtAluno" id="txtAluno" style="width: 100%;" required>
        
        <?php
            
            $sql = "SELECT matricula, nome  FROM Aluno WHERE Turma_idTurma = $turmaPesquisa ORDER BY nome";

            echo $sql;

            $dadosAluno = $conn -> query($sql);

            while ($aluno = $dadosAluno->fetch_assoc()) {
                ?>
                    <option value="<?php echo $aluno["matricula"]; ?>"><?php echo $aluno["nome"]; ?></option>
                <?php
            }

        ?>
    </select>