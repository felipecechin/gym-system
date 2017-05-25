<?php
require_once './functions.php';
require_once './Class/aluno.class.php';
require_once './Class/instrutor.class.php';
require_once './Class/exerc_treino.class.php';
require_once './Class/treino.class.php';
require_once './Dao/dao.class.php';
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
                $aluno->setCodigo($codigo);
                $dao = new dao();
                $aluno = $dao->buscarObjeto($aluno);
                $nomeAluno = $aluno[0]->getNome();
                $codigoAluno = $aluno[0]->getCodigo();
            } else {
                $aluno = new aluno();
                $aluno->setNome($_SESSION['nomeAluno']);
                $dao = new dao();
                $aluno = $dao->buscarObjeto($aluno);
                $nomeAluno = $aluno[0]->getNome();
                $codigoAluno = $aluno[0]->getCodigo();
            }
            $treino = new treino();
            $treino->setAluno($codigoAluno);
            $treino = $dao->buscarObjeto($treino);
            if (!$treino) {
                if ($_SESSION['tipoUsuario'] == 1) {
                    echo '<h1>Não há treino associado ao cliente ' . $nomeAluno . '.</h1>';
                    echo 'Clique <a href="inserirTreino.php?c=' . $codigoAluno . '">aqui</a> para inserir um treino.';
                    die();
                } else {
                    echo '<h1>Não há treino associado ao seu perfil. <br> Comunique um instrutor!</h1>';
                    die();
                }
            } else {
                echo '<p style="font-size: 16pt;">Treino de ' . $nomeAluno . '</p>';
            }
            ?>
        </div>
        <?php
        foreach ($treino as $treinoDados) {
            ?>
            <div class="div-cliente">
                <div id="breadcrumbs">
                    <?php
                    echo 'Treino ' . $treinoDados->getNome();
                    ?>
                    <a href="excluirTreino.php?i=<?php echo $treinoDados->getId(); ?>&c=<?php echo $codigoAluno; ?>" style="float: right;"><img src="img/excluir-icon.png" style="height: 20px;"></a></div>
                <br>
                <div style="display: table; padding: 20px;margin: auto;">
                    <table id="treino" class="table table-striped display nowrap" cellspacing="0" style="padding-top: 20px; padding-bottom: 20px; border: 0px; text-align: center;">
                        <thead style="background-color: #2D8CB7 !important; color: white !important;">
                            <tr>
                                <th style="border: 0.5px solid white !important;">Exercício</th>
                                <th style="border: 0.5px solid white !important;">Nº de séries</th>
                                <th style="border: 0.5px solid white !important;">Nº de repetições</th>
                                <th style="border: 0.5px solid white !important;">Carga</th>
                                <th style="border: 0.5px solid white !important;">Tempo de descanso</th>
                                <th style="border: 0.5px solid white !important;">Equipamento</th>
                            </tr>
                        </thead>
                        <?php
                        $exerctreino = new exerc_treino();
                        $exerctreino->setTreino($treinoDados->getId());
                        $dao = new dao();
                        $exerctreino = $dao->buscarObjeto($exerctreino);
                        ?>
                        <tbody>
                            <?php
                            foreach ($exerctreino as $exerctreinoDados) {
                                ?>
                                <tr style="background-color: #D2DEEA !important;">
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getExercicio())) ? '-' : $exerctreinoDados->getExercicio(); ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getSeries())) ? '-' : $exerctreinoDados->getSeries(); ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getRepeticoes())) ? '-' : $exerctreinoDados->getRepeticoes(); ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getCarga())) ? '-' : $exerctreinoDados->getCarga(); ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getTempo())) ? '-' : $exerctreinoDados->getTempo(); ?></td>
                                    <td style="border: 0.5px solid white !important;"><?php echo (empty($exerctreinoDados->getEquipamento())) ? '-' : $exerctreinoDados->getEquipamento(); ?></td>
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
            <button style="float: right" type="submit" id="btn-entrar" onclick="javascript:window.print()">Imprimir treino</button>
        </div>
        <br>
    </center>
</body>
</html>
