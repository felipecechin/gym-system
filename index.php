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
                <div class="linha-input2">
                    <label id="lembrar-txt">
                        <table>
                            <tr>
                                <td>
                                    <input type="checkbox" id="check"> 
                                </td> 
                                <td> 
                                    Lembrar usuário
                                </td>
                            </tr>
                        </table>
                    </label>
                </div>
                <input type="submit" value="Entrar" id="btn-entrar">
            </form>
            <a href="#" id="esqueci-txt">Esqueci minha senha</a>
            <br>
            <br>
            <?php
            if ($_POST) {
                require_once './Class/conexao.class.php';
                require_once './Class/insert.class.php';
                require_once './Class/select.class.php';
                require_once './Class/update.class.php';
                require_once './Class/delete.class.php';
                require_once './Class/aluno.class.php';
                require_once './Class/instrutor.class.php';
                require_once './Class/exerc_treino.class.php';
                require_once './Class/treino.class.php';
                $login = $_POST['login'];
                $senha = $_POST['senha'];

                $instrutor = new instrutor();
                $instrutor->buscarInstrutor('login', $login);
                $senha2 = $instrutor->__get('senha');

                $aluno = new aluno();
                $aluno->buscarAluno('codigo', $login);
                $senha3 = $aluno->__get('dataNasc');
                $nomeAluno = $aluno->__get('nome');
                if (!empty($senha3[0])) {
                    $divide = explode("-", $senha3[0]);
                    $dia = $divide[2];
                    $mes = $divide[1];
                    $ano = $divide[0];
                    $senha4 = $dia . $mes . $ano;
                }
                if (!empty($senha2) || !empty($senha3[0])) {
                    $hash = $senha2;
                    if (crypt($senha, $hash) === $hash) {
                        session_start();
                        $_SESSION['tipoUsuario'] = '1';
                        header('location:inicio.php');
                    } else if (isset($senha4) && $senha == $senha4) {
                        session_start();
                        $_SESSION['tipoUsuario'] = '2';
                        $_SESSION['nomeAluno'] = $nomeAluno[0];
                        header('location:verTreino.php');
                    } else {
                        echo '<div id="erro">Senha inválida</div>';
                    }
                } else {
                    echo '<div id="erro">Login e senha inválidos</div>';
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
