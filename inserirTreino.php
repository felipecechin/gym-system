<?php
require_once './functions.php';
require_once './Class/conexao.class.php';
require_once './Class/insert.class.php';
require_once './Class/select.class.php';
require_once './Class/update.class.php';
require_once './Class/delete.class.php';
require_once './Class/aluno.class.php';
require_once './Class/instrutor.class.php';
require_once './Class/exerc_treino.class.php';
require_once './Class/treino.class.php';
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
        <script>
            function adicionaForm(valor) {
                var i;
                var inputNtreino;
                if (valor == 0) {
                    var div = document.getElementById("form1");
                    div.innerHTML = '';
                } else {
                    for (i = 0; i < valor; i++) {
                        if (i == 0) {
                            inputNtreino = '<div style="border: 1px solid #2D79BB;"><table>' +
                                    '<tr>' +
                                    '<td>Nome do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Exemplo: A" class="inpt" name="nomeT' + (i + 1) + '" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Objetivo do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Exemplo: Hipertrofia" class="inpt" name="objetivoT' + (i + 1) + '" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número de exercícios do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Número de Exercícios" class="inpt" onkeyup="mostraInputsExercicios(this.value, ' + (i + 1) + ')" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<center><div id="' + (i + 1) + '">' +
                                    '</div></center>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<table></div>';
                        } else {
                            inputNtreino = inputNtreino + '<div style="border: 1px solid #2D79BB;"><table>' +
                                    '<tr>' +
                                    '<td>Nome do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Exemplo: A" class="inpt" name="nomeT' + (i + 1) + '" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Objetivo do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Exemplo: Hipertrofia" class="inpt" name="objetivoT' + (i + 1) + '" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número de exercícios do treino (' + (i + 1) + '):</td>' +
                                    '<td><input type="text" placeholder="Número de Exercícios" class="inpt" onkeyup="mostraInputsExercicios(this.value, ' + (i + 1) + ')" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<center><div id="' + (i + 1) + '">' +
                                    '</div></center>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<table></div>';
                        }
                    }
                    var div = document.getElementById("form1");
                    div.innerHTML = inputNtreino;
                }
            }
            function mostraInputsExercicios(qtdEx, numTreino) {
                var i;
                var inputs;
                if (qtdEx == 0) {
                    var lugar = document.getElementById(numTreino);
                    lugar.innerHTML = '';
                } else {
                    for (i = 0; i < qtdEx; i++) {
                        if (i == 0) {
                            inputs = '<table>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<h3>Exercício ' + (i + 1) + ' do treino (' + numTreino + ')</h3>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Nome:</td>' +
                                    '<td><input type="text" placeholder="Nome" class="inpt" name="nome' + numTreino + '[]" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número repetições:</td>' +
                                    '<td><input type="text" placeholder="Número de repetições" class="inpt" name="rep' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número séries:</td>' +
                                    '<td><input type="text" placeholder="Número de séries" class="inpt" name="series' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Carga:</td>' +
                                    '<td><input type="text" placeholder="Carga" class="inpt" name="carga' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Tempo:</td>' +
                                    '<td><input type="text" placeholder="Tempo" class="inpt" name="tempo' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Equipamento:</td>' +
                                    '<td><input type="text" placeholder="Equipamento" class="inpt" name="equip' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<table>';
                        } else {
                            inputs = inputs + '<table>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<h3>Exercício ' + (i + 1) + ' do treino (' + numTreino + ')</h3>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Nome:</td>' +
                                    '<td><input type="text" placeholder="Nome" class="inpt" name="nome' + numTreino + '[]" required=""></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número repetições:</td>' +
                                    '<td><input type="text" placeholder="Número de repetições" class="inpt" name="rep' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número séries:</td>' +
                                    '<td><input type="text" placeholder="Número de séries" class="inpt" name="series' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Carga:</td>' +
                                    '<td><input type="text" placeholder="Carga" class="inpt" name="carga' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Tempo:</td>' +
                                    '<td><input type="text" placeholder="Tempo" class="inpt" name="tempo' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Equipamento:</td>' +
                                    '<td><input type="text" placeholder="Equipamento" class="inpt" name="equip' + numTreino + '[]"></td>' +
                                    '</tr>' +
                                    '<table>';
                            ;
                        }
                    }
                    var lugar = document.getElementById(numTreino);
                    lugar.innerHTML = inputs;
                }
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
            $resultado = $aluno->buscarAluno('codigo', $_SESSION['codigo']);
            $nome = $aluno->__get('nome');
            $treino = new treino();
            $treino->buscarTreino('aluno', $_SESSION['codigo']);
            $nomeTreino = $treino->__get('nome');
            ?>
            <div id="breadcrumbs">Cliente > <?php echo $nome[0]; ?>
                <?php
                if (!empty($nomeTreino)) {
                    echo '(possui '. count($nomeTreino).' treinos associado(s))';
                }
                ?>
            </div>
            <form action="inserirTreino.php" method="post">
                <h1 id="titulo-txt">Inserir Treino</h1>
                <table cellspacing="10" id="tbl-cadastro-cliente">
                    <tr>
                        <td>Número de treinos:</td>
                        <td>
                            <input type="number" name="numTreinos" class="inpt" placeholder="Número de treinos" onkeyup="adicionaForm(this.value)"> 
                            <input type="hidden" name="codigo" value="<?php echo $_SESSION['codigo']; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="form1"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">
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
        $numTreinos = $_POST['numTreinos'];
        $codigo = $_POST['codigo'];

        for ($i = 0; $i < $numTreinos; $i++) {
            $treino = new treino();
            $numT = $i + 1;
            $nomeT = $_POST['nomeT' . $numT];
            $objetivoT = $_POST['objetivoT' . $numT];
            $idTreino[$i] = $treino->adicionarTreino($nomeT, $codigo, $objetivoT);
            $exercTreinoRep[$i] = $_POST['rep' . $numT];
            $exercTreinoSer[$i] = $_POST['series' . $numT];
            $exercTreinoCarga[$i] = $_POST['carga' . $numT];
            $exercTreinoNome[$i] = $_POST['nome' . $numT];
            $exercTreinoTempo[$i] = $_POST['tempo' . $numT];
            $exercTreinoEquip[$i] = $_POST['equip' . $numT];
        }
        for ($i = 0; $i < count($idTreino); $i++) {
            for ($j = 0; $j < count($exercTreinoNome[$i]); $j++) {
                $exercTreino = new exerc_treino();
                $exercTreino->adicionarExercTreino($exercTreinoNome[$i][$j], $idTreino[$i], $exercTreinoSer[$i][$j], $exercTreinoRep[$i][$j], $exercTreinoCarga[$i][$j], $exercTreinoTempo[$i][$j], $exercTreinoEquip[$i][$j]);
            }
        }
        header('location:verTreino.php?c=' . $codigo);
    }
    ?>
</body>
</html>
