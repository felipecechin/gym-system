<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of instrutor
 *
 * @author Felipe
 */
class instrutor {

    private $login;
    private $senha;

    function __get($prop) {
        return $this->$prop;
    }

    function cadastrarInstrutor($login,$senha) {
        $this->login = $login;
        $this->senha = $senha;

        $dados = ['login' => $login, 'senha' => $senha];
        $insert = new insert();
        $insert->doInsert('instrutor', $dados);
    }

    function buscarInstrutor($tipo, $valor) {
        switch ($tipo) {
            case 'login': {
                    $termos = 'WHERE login=:login';
                    $dados = 'login=' . $valor;
                    break;
                }
        }
        $select = new select();
        $resultado = $select->doSelect('instrutor', $termos, $dados);
        if ($resultado) {
            $this->login = $resultado[0]['login'];
            $this->senha = $resultado[0]['senha'];
        }
    }

}
