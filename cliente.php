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
        <script src="js/jquery.maskedinput.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $('#example').DataTable({
                    "columnDefs": [{"targets": 7, "orderable": false, "searchable": false, "width": "6%"}]
                });
                $('#dataNasc').mask('99/99/9999');
                $('#altura').mask('9.99');
            });
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
        <div class="div-cliente">
            <form action="cliente.php" method="post">
                <h1 id="titulo-txt">Inserir cliente</h1>
                <table cellspacing="10" id="tbl-cadastro-cliente" align="center">
                    <tr>
                        <td>Nome:</td>
                        <td><input type="text" placeholder="Nome" class="inpt" name="nome"></td>
                    </tr>
                    <tr>
                        <td>CPF:</td>
                        <td><input type="text" placeholder="Apenas números" class="inpt" name="cpf" maxlength="20"></td>
                    </tr>
                    <tr>
                        <td>Gênero:</td>
                        <td>
                            <table align="center">
                                <tr> 
                                    <td> 
                                        <input type="radio" name="genero" value="M"> Masculino
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <input type="radio" name="genero" value="F"> Feminino
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>Biotipo:</td>
                        <td><input type="text" placeholder="Biotipo" class="inpt" name="biotipo"></td>
                    </tr>
                    <tr>
                        <td>Altura:</td>
                        <td><input type="text" placeholder="Altura" class="inpt" name="altura" id="altura"></td>
                    </tr>
                    <tr>
                        <td>Frequência:</td>
                        <td><input type="number" placeholder="Frequência (por mês)" class="inpt" name="frequencia"></td>
                    </tr>
                    <tr>
                        <td>Nascimento:</td>
                        <td><input type="text" placeholder="Data (dd/mm/aaaa)" class="inpt" name="dataNasc" id="dataNasc"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align: right"><input type="reset" value="Limpar" id="btn-limpar"> <input type="submit" value="Salvar" id="btn-entrar"></td>
                    </tr>
                </table>
            </form>
            <?php            
            if ($_POST) {
                $nome = $_POST['nome'];
                $cpf = $_POST['cpf'];
                $genero = $_POST['genero'];
                $biotipo = $_POST['biotipo'];
                $codigo = rand(100000, 999999);
                $altura = $_POST['altura'];
                $dataNasc = $_POST['dataNasc'];
                $frequencia = $_POST['frequencia'];

                $aluno = new aluno();
                $aluno->setCodigo($codigo);

                $dao = new dao();
                $alunoBusca = $dao->buscarObjeto($aluno, ['codigo']);
                while ($alunoBusca != false) {
                    $codigo = rand(100000, 999999);
                    $aluno->setCodigo($codigo);
                    $alunoBusca = $dao->buscarObjeto($aluno, ['codigo']);
                }

                $divide = explode('/', $dataNasc);
                $dia = $divide[0];
                $mes = $divide[1];
                $ano = $divide[2];
                $dataNascFormatada = $ano . '-' . $mes . '-' . $dia;

                $aluno->setNome($nome);
                $aluno->setCpf($cpf);
                $aluno->setDataNasc($dataNascFormatada);
                $aluno->setGenero($genero);
                $aluno->setAltura($altura);
                $aluno->setBiotipo($biotipo);
                $aluno->setFrequenciaSem($frequencia);

                if ($dao->salvarObjeto($aluno)) {
                    echo 'Aluno cadastrado com sucesso!';
                    echo '<br>';
                    echo 'O código do aluno cadastrado é <b>' . $codigo . '</b>.';
                    echo '<br>';
                    echo '<br>';
                }
            }
            ?>
        </div>
        <br>
        <div class="div-cliente">
            <div id="breadcrumbs">Clientes</div>
            <br>
            <div style="width: 1000px; padding-bottom: 20px;margin: auto;">
                <table id="example" class="table table-striped display nowrap" cellspacing="0" style="padding-top: 20px; padding-bottom: 20px; border: 0px; text-align: center;">
                    <thead style="background-color: #2D8CB7 !important; color: white !important;">
                        <tr>
                            <th style="border: 0.5px solid white !important;">Nome</th>
                            <th style="border: 0.5px solid white !important;">CPF</th>
                            <th style="border: 0.5px solid white !important;">Gênero</th>
                            <th style="border: 0.5px solid white !important;">Biotipo</th>
                            <th style="border: 0.5px solid white !important;">Altura</th>
                            <th style="border: 0.5px solid white !important;">Nascimento</th>
                            <th style="border: 0.5px solid white !important;">Frequência</th>
                            <th style="border: 0.5px solid white !important;"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $aluno = new aluno();
                        $dao = new dao();
                        $aluno = $dao->buscarTodosPorObjeto($aluno, 'ORDER BY nome ASC');

                        foreach ($aluno as $alunoDados) {
                            ?>
                            <tr style="background-color: #D2DEEA !important;">
                                <td style="border: 0.5px solid white !important;"><?php echo $alunoDados->getNome(); ?></td>
                                <td style="border: 0.5px solid white !important;"><?php echo $alunoDados->getCpf(); ?></td>
                                <td style="border: 0.5px solid white !important;"><?php echo ($alunoDados->getGenero() == 'M') ? 'Masculino' : 'Feminino'; ?></td>
                                <td style="border: 0.5px solid white !important;"><?php echo $alunoDados->getBiotipo() ?></td>
                                <td style="border: 0.5px solid white !important;"><?php echo number_format($alunoDados->getAltura(), 2, '.', ','); ?></td>
                                <?php
                                $divide = explode('-', $alunoDados->getDataNasc());
                                $dia = $divide[2];
                                $mes = $divide[1];
                                $ano = $divide[0];
                                $data = $dia . '/' . $mes . '/' . $ano;
                                ?>
                                <td style="border: 0.5px solid white !important;"><?php echo $data; ?></td>
                                <td style="border: 0.5px solid white !important;"><?php echo $alunoDados->getFrequenciaSem(); ?></td>
                                <td style="border: 0.5px solid white !important;">
                                    <a href="inserirTreino.php?c=<?php echo $alunoDados->getCodigo(); ?>"><img src="img/mais-icon.png" style="height: 20px;"></a>
                                    <a href="verTreino.php?c=<?php echo $alunoDados->getCodigo(); ?>"><img src="img/ver-icon.png" style="height: 25px;"></a>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </center>
    <br>
</body>
</html>
