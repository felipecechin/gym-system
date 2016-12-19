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
                $('#treinoa').DataTable();
            });
            $(document).ready(function () {
                $('#treinob').DataTable();
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
                $resultado = $aluno->buscarAluno('codigo', $codigo);
                $nome = $aluno->__get('nome');
                echo '<p style="font-size: 16pt;">Treino de ' . $nome[0] . '</p>';
            } else {
                echo '<p style="font-size: 16pt;">Treino de ' . $_SESSION['nomeAluno'] . '</p>';
            }
            ?>
        </div>
        <div class="div-cliente">
            <div id="breadcrumbs">Treino A<a href="" style="float: right;"><img src="img/excluir-icon.png" style="height: 20px;"></a></div>
            <br>
            <div style="width: 900px; padding-bottom: 20px;">
                <table id="treinoa" class="table table-striped display nowrap" cellspacing="0" style="padding-top: 20px; padding-bottom: 20px; border: 0px;">
                    <thead style="background-color: #2D8CB7 !important; color: white !important;">
                        <tr>
                            <th style="border: 0.5px solid white !important;">Exercício</th>
                            <th style="border: 0.5px solid white !important;">Nº de séries</th>
                            <th style="border: 0.5px solid white !important;">Nº de repetições</th>
                            <th style="border: 0.5px solid white !important;">Carga (Kg)</th>
                            <th style="border: 0.5px solid white !important;">Tempo aproximado<br>(min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #D2DEEA !important;">
                            <td style="border: 0.5px solid white !important;">Rosca Direta</td>
                            <td style="border: 0.5px solid white !important;">3</td>
                            <td style="border: 0.5px solid white !important;">12</td>
                            <td style="border: 0.5px solid white !important;">7</td>
                            <td style="border: 0.5px solid white !important;">3</td>
                        </tr>
                        <tr style="background-color: #D2DEEA !important;">
                            <td style="border: 0.5px solid white !important;">Puxada Alta</td>
                            <td style="border: 0.5px solid white !important;">4</td>
                            <td style="border: 0.5px solid white !important;">10</td>
                            <td style="border: 0.5px solid white !important;">35</td>
                            <td style="border: 0.5px solid white !important;">4</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div class="div-cliente">
            <div id="breadcrumbs">Treino B<a href="" style="float: right;"><img src="img/excluir-icon.png" style="height: 20px;"></a></div>
            <br>
            <div style="width: 900px; padding-bottom: 20px;">
                <table id="treinob" class="table table-striped display nowrap" cellspacing="0" style="padding-top: 20px; padding-bottom: 20px; border: 0px;">
                    <thead style="background-color: #2D8CB7 !important; color: white !important;">
                        <tr>
                            <th style="border: 0.5px solid white !important;">Exercício</th>
                            <th style="border: 0.5px solid white !important;">Nº de séries</th>
                            <th style="border: 0.5px solid white !important;">Nº de repetições</th>
                            <th style="border: 0.5px solid white !important;">Carga (Kg)</th>
                            <th style="border: 0.5px solid white !important;">Tempo aproximado<br>(min)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #D2DEEA !important;">
                            <td style="border: 0.5px solid white !important;">Extensor</td>
                            <td style="border: 0.5px solid white !important;">3</td>
                            <td style="border: 0.5px solid white !important;">12</td>
                            <td style="border: 0.5px solid white !important;">50</td>
                            <td style="border: 0.5px solid white !important;">4</td>
                        </tr>
                        <tr style="background-color: #D2DEEA !important;">
                            <td style="border: 0.5px solid white !important;">Supino Reto</td>
                            <td style="border: 0.5px solid white !important;">3</td>
                            <td style="border: 0.5px solid white !important;">15</td>
                            <td style="border: 0.5px solid white !important;">12</td>
                            <td style="border: 0.5px solid white !important;">3</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <br>
        <div id="treino-pessoa">
            <button style="float: right" type="submit" id="btn-entrar">Imprimir Treino</button>
        </div>
        <br>
    </center>
    <?php
    // put your code here
    ?>
</body>
</html>
