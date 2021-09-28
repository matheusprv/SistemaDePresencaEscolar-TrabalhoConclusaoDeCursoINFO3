<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Frequência</title>
    <link rel="stylesheet" href="geral.css">
    <link rel="stylesheet" href="cabecalho.css">
</head>

<body>
    <?php
        include_once("cabecalho.php");
    ?>
    
    <div class="divExterna">
        <div class="divInterna">
            <h2 style="width: 100%; text-align: center;">Frequência</h2>
            
            <form name="filtrar" action="" method="POST">
                <div class="filtrar">
                    <label for="listTurma" style="padding-left: 10px;">Turma</label>
                    <select name="listTurma" id="listTurma">
                        <option value="inf">6° Ano A</option>
                        <option value="inf">7° Ano B</option>
                        <option value="inf">8° Ano A</option>
                        <option value="inf">9° Ano B</option>
                    </select>

                    <label for="listDisciplina" style="padding-left: 10px;">Disciplina</label>
                    <select name="listDisciplina" id="listDisciplina">
                        <option value="mat">Matemática</option>
                        <option value="por">Português</option>
                        <option value="ing">Inglês</option>
                        <option value="cie">Ciências</option>
                        <option value="geo">Gografia</option>
                        <option value="his">História</option>
                    </select>

                    <label for="txtAluno" style="padding-left: 10px; ">Nome:</label>
                    <input type="text" name="txtAluno" id="txtAluno" style="width: 200px; cursor: text;">
                    <input type="submit" value="Pesquisar">
                </div>
            </form>
            <br>
            <div class="divInterna">
                <div class="divExterna">
                    <button style="cursor: pointer;">Baixar relatório</button>
                </div>
            </div>

            <div class="tabela">
                <table style="width: 900px;">
                    <tr>
                        <th style="width: 20%;">Aluno</th>
                        <th>Matemática</th>
                        <th>Português</th>
                        <th>Inglês</th>
                        <th>Ciências</th>
                        <th>Geografia</th>
                        <th>História</th>
                        
                    </tr>
                    <tr>
                        <td>Ana</td>
                        <td>2</td>
                        <td>1</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>João</td>
                        <td>0</td>
                        <td>0</td>
                        <td>1</td>
                        <td>1</td>
                        <td>0</td>
                        <td>2</td>
                    </tr>
                    <tr>
                        <td>José</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>
                    <tr>
                        <td>Lucas</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                        <td>0</td>
                    </tr>

                </table>
            </div>
        </div>
    </div>

</body>

</html>