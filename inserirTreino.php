<?php
require_once './functions.php';
require_once './Class/aluno.class.php';
require_once './Class/instrutor.class.php';
require_once './Class/exerc_treino.class.php';
require_once './Class/treino.class.php';
require_once './Dao/dao.class.php';
protection();
if (isset($_SESSION)) {
    if ($_SESSION['tipoUsuario'] == 2) {
        header('location:verTreino.php');
    }
}
if ($_GET) {
    $codigo = $_GET['c'];
    $_SESSION['codigo'] = $codigo;
} else {
    if (!isset($_SESSION['codigo'])) {
        header('location:cliente.php');
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="estilo.css" rel="stylesheet">
        <script src="js/jquery-1.12.0.min.js"></script>
        <script>
            function adicionaExercicio(valor) {
                var conteudo = '<table>' +
                        '<tr>' +
                        '<td><input type="text" placeholder="Nome" class="inptEx" name="nome' + valor + '[]" required=""></td>' +
                        '<td><input type="text" placeholder="Número de repetições" class="inptEx" name="rep' + valor + '[]"></td>' +
                        '<td><input type="text" placeholder="Número de séries" class="inptEx" name="series' + valor + '[]"></td>' +
                        '<td><input type="text" placeholder="Carga" class="inptEx" name="carga' + valor + '[]"></td>' +
                        '<td><input type="text" placeholder="Tempo de descanso" class="inptEx" name="tempo' + valor + '[]"></td>' +
                        '<td><input type="text" placeholder="Equipamento" class="inptEx" name="equip' + valor + '[]"></td>' +
                        '</tr>' +
                        '</table>';
                $('#acrescentaEx' + valor).append(conteudo);
            }
            function adicionaTreino() {
                var divs = document.getElementById('acrescentaTreino').querySelectorAll('div');
                var numTreino = (divs.length + 1);

                var conteudo = '<div style="border: 1px solid #2D79BB;">' +
                        '<table width="70%" align="center">' +
                        '<tr>' +
                        '<td width="200">Nome do treino (' + numTreino + '):</td>' +
                        '<td><input type="text" placeholder="Exemplo: A" class="inpt" name="nomeT[]" required=""></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td>Objetivo do treino (' + numTreino + '):</td>' +
                        '<td><input type="text" placeholder="Exemplo: Hipertrofia" class="inpt" name="objetivoT[]" required=""></td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td colspan="2" id="acrescentaEx' + numTreino + '">' +
                        '<table align="center">' +
                        '<tr>' +
                        '<td colspan="6" style="text-align: center;">' +
                        '<table align="center">' +
                        '<tr>' +
                        '<td>' +
                        '<h4 style="margin: 5px;">Exercícios do treino (' + numTreino + ')</h4>' +
                        '</td>' +
                        '<td>' +
                        '<a href="#" onclick="adicionaExercicio(' + numTreino + ');">' +
                        '<table>' +
                        '<tr>' +
                        '<td>' +
                        '<img src="img/mais-icon.png" style="height: 20px;">' +
                        '</td>' +
                        '<td style="color: #2D8CB7;">EXERCÍCIO</td>' +
                        '</tr>' +
                        '</table>' +
                        '</a>' +
                        '</td>' +
                        '</tr>' +
                        '</table>' +
                        '</td>' +
                        '</tr>' +
                        '<tr>' +
                        '<td><input type="text" placeholder="Nome" class="inptEx" name="nome' + numTreino + '[]" required=""></td>' +
                        '<td><input type="text" placeholder="Número de repetições" class="inptEx" name="rep' + numTreino + '[]"></td>' +
                        '<td><input type="text" placeholder="Número de séries" class="inptEx" name="series' + numTreino + '[]"></td>' +
                        '<td><input type="text" placeholder="Carga" class="inptEx" name="carga' + numTreino + '[]"></td>' +
                        '<td><input type="text" placeholder="Tempo de descanso" class="inptEx" name="tempo' + numTreino + '[]"></td>' +
                        '<td><input type="text" placeholder="Equipamento" class="inptEx" name="equip' + numTreino + '[]"></td>' +
                        '</tr>' +
                        '</table>' +
                        '</td>' +
                        '</tr>' +
                        '</table>' +
                        '</div>';

                $('#acrescentaTreino').append(conteudo);
            }
        </script>
    </head>
    <body>
        <ul>
            <li><a href="inicio.php">Home</a></li>
            <li><a href="cliente.php">Clientes</a></li>
            <li id="sair"><a href="logout.php">Sair</a></li>
        </ul>
    <center>
        <br>
        <div id="div-cadastro-treino">
            <?php
            $aluno = new aluno();
            $aluno->setCodigo($_SESSION['codigo']);
            $dao = new dao();
            $aluno = $dao->buscarObjeto($aluno);
            $nomeCliente = $aluno[0]->getNome();
            
            $treino = new treino();
            $treino->setAluno($_SESSION['codigo']);
            $dao = new dao();
            $treino = $dao->buscarObjeto($treino);
            ?>
            <div id="breadcrumbs">Cliente > <?php echo $nomeCliente; ?>
                <?php
                if ($treino) {
                    echo '(possui ' . count($treino) . ' treinos associado(s))';
                }
                ?>
            </div>
            <form action="inserirTreino.php" method="post">
                <input type="hidden" name="codigo" value="<?php echo $_SESSION['codigo']; ?>">
                <h1 id="titulo-txt">Inserir treino(s)</h1>
                <div id="acrescentaTreino">
                    <div style="border: 1px solid #2D79BB;">
                        <table width="70%" align="center">
                            <tr>
                                <td width="200">Nome do treino (1):</td>
                                <td><input type="text" placeholder="Exemplo: A" class="inpt" name="nomeT[]" required=""></td>
                            </tr>
                            <tr>
                                <td>Objetivo do treino (1):</td>
                                <td><input type="text" placeholder="Exemplo: Hipertrofia" class="inpt" name="objetivoT[]" required=""></td>
                            </tr>
                            <tr>
                                <td colspan="2" id="acrescentaEx1">
                                    <table align="center">
                                        <tr>
                                            <td colspan="6" style="text-align: center;">
                                                <table align="center">
                                                    <tr> 
                                                        <td> 
                                                            <h4 style="margin: 5px;">Exercícios do treino (1)</h4>
                                                        </td>
                                                        <td>
                                                            <a href="#" onclick="adicionaExercicio(1);">
                                                                <table> 
                                                                    <tr> 
                                                                        <td> 
                                                                            <img src="img/mais-icon.png" style="height: 20px;">
                                                                        </td> 
                                                                        <td style="color: #2D8CB7;">EXERCÍCIO</td> 
                                                                    </tr>
                                                                </table>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><input type="text" placeholder="Nome" class="inptEx" name="nome1[]" required=""></td>
                                            <td><input type="text" placeholder="Número de repetições" class="inptEx" name="rep1[]"></td>
                                            <td><input type="text" placeholder="Número de séries" class="inptEx" name="series1[]"></td>
                                            <td><input type="text" placeholder="Carga" class="inptEx" name="carga1[]"></td>
                                            <td><input type="text" placeholder="Tempo de descanso" class="inptEx" name="tempo1[]"></td>
                                            <td><input type="text" placeholder="Equipamento" class="inptEx" name="equip1[]"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <a href="#" onclick="adicionaTreino();" >
                    <table align="right"> 
                        <tr> 
                            <td> 
                                <img src="img/mais-icon.png" style="height: 20px;">
                            </td> 
                            <td style="color: #2D8CB7;">TREINO</td> 
                        </tr>
                    </table>
                </a>
                <br><br>
                <table style="height: 50px" align="right">
                    <tr>
                        <td> 
                            <input type="reset" value="Limpar" id="btn-limpar"> 
                            <input type="submit" value="Salvar" id="btn-entrar">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
    <?php
    if ($_POST) {
        $nomeTreino = $_POST['nomeT'];
        $objetivoTreino = $_POST['objetivoT'];
        $codigoCliente = $_POST['codigo'];

        for ($i = 0; $i < count($nomeTreino); $i++) {
            $numT = $i + 1;
            $exercTreinoRep[$i] = $_POST['rep' . $numT];
            $exercTreinoSer[$i] = $_POST['series' . $numT];
            $exercTreinoCarga[$i] = $_POST['carga' . $numT];
            $exercTreinoNome[$i] = $_POST['nome' . $numT];
            $exercTreinoTempo[$i] = $_POST['tempo' . $numT];
            $exercTreinoEquip[$i] = $_POST['equip' . $numT];
        }

        for ($i = 0; $i < count($nomeTreino); $i++) {
            $treino = new treino();
            $treino->setAluno($codigoCliente);
            $treino->setNome($nomeTreino[$i]);
            $treino->setObjetivo($objetivoTreino[$i]);
            $dao = new dao();
            $idTreinoSalvo = $dao->salvarObjeto($treino);
            for ($j = 0; $j < count($exercTreinoNome[$i]); $j++) {
                $exercTreino = new exerc_treino();
                $exercTreino->setCarga($exercTreinoCarga[$i][$j]);
                $exercTreino->setEquipamento($exercTreinoEquip[$i][$j]);
                $exercTreino->setExercicio($exercTreinoNome[$i][$j]);
                $exercTreino->setRepeticoes($exercTreinoRep[$i][$j]);
                $exercTreino->setSeries($exercTreinoSer[$i][$j]);
                $exercTreino->setTempo($exercTreinoTempo[$i][$j]);
                $exercTreino->setTreino($idTreinoSalvo);
                $dao->salvarObjeto($exercTreino);
            }
        }
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL=verTreino.php?c=" . $codigoCliente . "'>";
    }
    ?>
</body>
</html>
