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
    </head>
    <body>
        <ul>
            <li><a href="inicio.php">Home</a></li>
            <li><a href="cliente.php">Clientes</a></li>
            <li id="sair"><a href="logout.php">Sair</a></li>
        </ul>
    <center>
        <img src="img/peso-icon.png">
        <p>(55) 9999-9999</p>
        <p>Av. Roraima, 10, Camobi</p>
        <p>CEP: 00000-000, Santa Maria, RS</p>
    </center>
    <?php
    // put your code here
    ?>
</body>
</html>
