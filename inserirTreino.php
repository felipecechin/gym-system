<?php
require_once './functions.php';
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
                                    '<td>Número de exercícios do treino ' + (i + 1) + ':</td>' +
                                    '<td><input type="text" placeholder="Número de Exercícios" class="inpt" onkeyup="mostraInputsExercicios(this.value, ' + (i + 1) + ')"></td>' +
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
                                    '<td>Número de exercícios do treino ' + (i + 1) + ':</td>' +
                                    '<td><input type="text" placeholder="Número de Exercícios" class="inpt" onkeyup="mostraInputsExercicios(this.value, ' + (i + 1) + ')"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<center><div id="' + (i + 1) + '">' +
                                    '</div></center>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<table></div>';
                            ;
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
                                    '<h3>Exercício ' + (i + 1) + ' do treino ' + numTreino + '</h3>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número repetições:</td>' +
                                    '<td><input type="number" placeholder="Número de repetições" class="inpt"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número séries:</td>' +
                                    '<td><input type="number" placeholder="Número de séries" class="inpt"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Carga:</td>' +
                                    '<td><input type="number" placeholder="Carga" class="inpt"></td>' +
                                    '</tr>' +
                                    '<table>';
                        } else {
                            inputs = inputs + '<table>' +
                                    '<tr>' +
                                    '<td colspan="2" style="text-align: center;">' +
                                    '<h3>Exercício ' + (i + 1) + ' do treino ' + numTreino + '</h3>' +
                                    '</td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número repetições:</td>' +
                                    '<td><input type="number" placeholder="Número de repetições" class="inpt"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Número séries:</td>' +
                                    '<td><input type="number" placeholder="Número de séries" class="inpt"></td>' +
                                    '</tr>' +
                                    '<tr>' +
                                    '<td>Carga:</td>' +
                                    '<td><input type="number" placeholder="Carga" class="inpt"></td>' +
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
            <div id="breadcrumbs">Cliente > Felipe Cechin</div>
            <form>
                <h1 id="titulo-txt">Inserir Treino</h1>
                <table cellspacing="10" id="tbl-cadastro-cliente">
                    <tr>
                        <td>Número de treinos:</td>
                        <td>
                            <input type="number" name="tipo" class="inpt" placeholder="Número de treinos" onkeyup="adicionaForm(this.value)">                      
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div id="form1"></div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align: right">
                            <input type="reset" value="Limpar" id="btn-limpar"> <input type="submit" value="Salvar" id="btn-entrar">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </center>
    <?php
    // put your code here
    ?>
</body>
</html>
