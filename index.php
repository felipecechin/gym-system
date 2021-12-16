<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="estilo.css" rel="stylesheet">
</head>
<body style="padding-top: 50px;">
<center>
    <div id="div-login">
        <h1 id="titulo-txt">Login</h1>
        <form style="padding-bottom: 10px;" action="index.php" method="post">
            <div class="linha-input">
                <table width="100%" style="text-align: center;">
                    <tr>
                        <td>
                            <input type="text" placeholder="Login" name="login" style="width: 100%;border: 0px; font-size: 13pt;">
                        </td>
                        <td>
                            <img src="img/email-icon.png" height="35px">
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="linha-input">
                <table width="100%" style="text-align: center;">
                    <tr>
                        <td>
                            <input type="password" placeholder="Senha" name="senha" style="width: 100%;border: 0px; font-size: 13pt;">
                        </td>
                        <td>
                            <img src="img/senha-icon.png" height="30px">
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <br>
            <input type="submit" value="Entrar" id="btn-entrar">
        </form>
        <a href="#" id="esqueci-txt">Esqueci minha senha</a>
        <br>
        <br>
        <?php
        if ($_POST) {
            require_once './Class/aluno.class.php';
            require_once './Class/instrutor.class.php';
            require_once './Class/exerc_treino.class.php';
            require_once './Class/treino.class.php';
            require_once './Dao/dao.class.php';
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            $erro = 0;

            $dao = new dao();

            $aluno = new aluno();
            $aluno->setCodigo($login);
            $aluno = $dao->buscarObjetoUnico($aluno);

            $instrutor = new instrutor();
            $instrutor->setLogin($login);
            $instrutor = $dao->buscarObjetoUnico($instrutor);

            if ($aluno) {
                $divide = explode("-", $aluno->getDataNasc());
                $dia = $divide[2];
                $mes = $divide[1];
                $ano = $divide[0];
                $senhaFormatada = $dia . $mes . $ano;
                if ($senha == $senhaFormatada) {
                    session_start();
                    $_SESSION['tipoUsuario'] = '2';
                    $_SESSION['nomeAluno'] = $aluno->getNome();
                    header('location:verTreino.php');
                } else {
                    $erro = 1;
                }
            } else if ($instrutor) {
                $hash = $instrutor->getSenha();
                if (crypt($senha, $hash) === $hash) {
                    session_start();
                    $_SESSION['tipoUsuario'] = '1';
                    header('location:inicio.php');
                } else {
                    $erro = 1;
                }
            } else {
                echo '<div id="erro">Login e senha inválidos</div>';
            }
            if ($erro == 1) {
                echo '<div id="erro">Senha inválida</div>';
            }
        }
        ?>
    </div>
</center>
<?php
/*
  require_once './Class/conexao.class.php';
  require_once './Class/insert.class.php';
  require_once './Class/instrutor.class.php';
  $custo = '08';
  require_once './functions.php';
  $instrutor = new instrutor();
  $salt = geraSenha(22, true, true);
  $login = 'felipecechin';
  $senha = 'felipe10';
  // Gera um hash baseado em bcrypt
  $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
  if ($instrutor->cadastrarInstrutor($login, $hash)) {
  echo '<script>alert("Usuário cadastrado com sucesso."); cadastraUsuario();</script>';
  }
 */
?>
</body>
</html>
