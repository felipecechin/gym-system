<?php
require_once './functions.php';
require_once './Class/aluno.class.php';
require_once './Class/instrutor.class.php';
require_once './Class/exerc_treino.class.php';
require_once './Class/treino.class.php';
require_once './Dao/dao.class.php';
protection();
if ($_SESSION['tipoUsuario'] == 1) {
    if ($_GET) {
        $id = $_GET['i'];
        $codigo = $_GET['c'];
        $treino = new treino();
        $treino->setAluno($codigo);
        $treino->setId($id);
        $dao = new dao();
        $dao->deletarObjeto($treino);
        header('location: verTreino.php?c=' . $codigo);
    }
} else {
    header('location: verTreino.php');
}
?>