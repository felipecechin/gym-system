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
if ($_GET) {
    $codigo = $_GET['c'];
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link href="estilo.css" rel="stylesheet">
        <link href="css/dataTables.css" rel="stylesheet">
        <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">

        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript" src="js/jquery-1.12.0.min.js"></script>
        <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $('.table').DataTable();
            });
        </script>
    </head>
    <body>
        <ul>
            <?php
            if (isset($_SESSION)) {
                if ($_SESSION['tipoUsuario'] == 1) {
                    ?>
                    <li><a href="inicio.php">Home</a></li>
                    <li><a href="cliente.php">Clientes</a></li>
                    <?php
                } else {
                    echo '<li><a href="">Olá, ' . $_SESSION['nomeAluno'] . '!</a></li>';
                }
            }
            ?>
            <li id="sair"><a href="logout.php">Sair</a></li>
        </ul>
    <center>
        <div id="treino-pessoa">
            <?php
            if (isset($codigo)) {
                $aluno = new aluno();
                $aluno->buscarAluno('codigo', $codigo);
                $nomeAluno = $aluno->__get('nome');
                $treino = new treino();
                $treino->buscarTreino('aluno', $codigo);
                $codigoAluno = $codigo;
                $nome = $treino->__get('nome');
                $objetivo = $treino->__get('objetivo');
                $id = $treino->__get('id');
                $nomeAl = $nomeAluno[0];
            } else {
                $aluno = new aluno();
                $aluno->buscarAluno('nome', $_SESSION['nomeAluno']);
                $codigo = $aluno->__get('codigo');
                $treino = new treino();
                $treino->buscarTreino('aluno', $codigo[0]);
                $codigoAluno = $codigo[0];
                $nome = $treino->__get('nome');
                $objetivo = $treino->__get('objetivo');
                $id = $treino->__get('id');
                $nomeAl = $_SESSION['nomeAluno'];
            }
            if (empty($nome)) {
                echo '<h1>Não há treino associado ao cliente ' . $nomeAl . '.</h1>';
                echo 'Clique <a href="inserirTreino.php?c=' . $codigoAluno . '">aqui</a> para inserir um treino.';
                die();
            } else {
                echo '<p style="font-size: 16pt;">Treino de ' . $nomeAl . '</p>';
            }
            ?>
        </div>
        <?php
        for ($i = 0; $i < count($nome); $i++) {
            ?>
            <div class="div-cliente">
                <div id="breadcrumbs">
                    <?php
                    echo 'Treino ' . $nome[$i];
                    ?>
                    <a href="excluirTreino.php?i=<?php echo $id[$i]; ?>&c=<?php echo $codigoAluno; ?>" style="float: right;"><img src="img/excluir-icon.png" style="height: 20px;"></a></div>
                <br>
                <div style="width: 900px; padding-bottom: 20px;">
                    <table id="treino" class="table table-striped display nowrap" cellspacing="0" style="padding-top: 20px; padding-bottom: 20px; border: 0px; text-align: center;">
                        <thead style="background-color: #2D8CB7 !important; color: white !important;">
                            <tr>
                                <th style="border: 0.5px solid white !important;">Exercício</th>
                                <th style="border: 0.5px solid white !important;">Nº de séries</th>
                                <th style="border: 0.5px solid white !important;">Nº de repetições</th>
                                <th style="border: 0.5px solid white !important;">Carga</th>
                                <th style="border: 0.5px solid white !important;">Tempo</th>
                                <th style="border: 0.5px solid white !important;">Equipamento</th>
                            </tr>
                        </thead>
                        <?php
                        $exerctreino = new exerc_treino();
                        $exerctreino->buscarExercTreino('treino', $id[$i]);
                        $exercicio = $exerctreino->__get('exercicio');
                        $series = $exerctreino->__get('series');
                        $repeticoes = $exerctreino->__get('repeticoes');
                        $carga = $exerctreino->__get('carga');
                        $tempo = $exerctreino->__get('tempo');
                        $equipamento = $exerctreino->__get('equipamento');
                        ?>
                        <tbody>
                            <?php
                            for ($j = 0; $j < count($exercicio); $j++) {
                                ?>
                                <tr style="background-color: #D2DEEA !important;">
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exercicio[$j])) ? '-' : $exercicio[$j]; ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($series[$j])) ? '-' : $series[$j]; ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($repeticoes[$j])) ? '-' : $repeticoes[$j]; ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($carga[$j])) ? '-' : $carga[$j]; ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($tempo[$j])) ? '-' : $tempo[$j]; ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($equipamento[$j])) ? '-' : $equipamento[$j]; ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <?php
        }
        ?>
        <br>
        <div id="treino-pessoa">
            <button style="float: right" type="submit" id="btn-entrar">Imprimir Treino</button>
        </div>
        <br>
    </center>
</body>
</html>
