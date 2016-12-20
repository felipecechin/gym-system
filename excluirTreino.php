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
    $id = $_GET['i'];
    $codigo = $_GET['c'];
    $treino = new treino();
    $treino->excluirTreino($id);
    header('location: verTreino.php?c=' . $codigo);
}
?>