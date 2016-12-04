<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of exercicio
 *
 * @author Felipe
 */
class exercicio {

    private $nome;
    private $id;

    function __get($prop) {
        return $this->$prop;
    }

    function adicionarExercicio($nome) {
        $this->nome = $nome;

        $dados = ['nome' => $nome];
        $insert = new insert();
        $insert->doInsert('exercicio', $dados);
        var_dump($insert);
    }

    function buscarExercicio($tipo, $valor) {
        switch ($tipo) {
            case 'nome': {
                    $termos = 'WHERE nome like :nome';
                    $dados = 'nome=' . $valor;
                    break;
                }
        }
        $select = new select();
        $resultado = $select->doSelect('exercicio', $termos, $dados);
        if (count($resultado) == 1) {
            $this->nome = $resultado[0]['nome'];
            $this->id = $resultado[0]['id'];
        } else {
            foreach ($resultado as $valor) {
                $this->nome[] = $valor['nome'];
                $this->id[] = $valor['id'];
            }
        }
    }

}
