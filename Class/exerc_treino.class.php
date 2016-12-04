<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of exerc_treino
 *
 * @author Felipe
 */
class exerc_treino {

    private $exercicio;
    private $treino;
    private $series;
    private $repeticoes;
    private $carga;
    private $tempo;
    private $equipamento;
    private $id;

    function __get($prop) {
        return $this->$prop;
    }

    function adicionarExercTreino($exercicio, $treino, $series = null, $repeticoes = null, $carga = null, $tempo = null, $equipamento = null) {
        $this->exercicio = $exercicio;
        $this->treino = $treino;
        $this->series = $series;
        $this->repeticoes = $repeticoes;
        $this->carga = $carga;
        $this->tempo = $tempo;
        $this->equipamento = $equipamento;

        $dados = ['exercicio' => $exercicio, 'treino' => $treino, 'series' => $series, 'repeticoes' => $repeticoes, 'carga' => $carga, 'tempo' => $tempo, 'equipamento' => $equipamento];
        $insert = new insert();
        $insert->doInsert('exerc_treino', $dados);
        var_dump($insert);
    }

    function buscarExercTreino($tipo, $valor) {
        switch ($tipo) {
            case 'exercicio': {
                    $termos = 'WHERE exercicio=:exercicio';
                    $dados = 'exercicio=' . $valor;
                    break;
                }
            case 'treino': {
                    $termos = 'WHERE treino=:treino';
                    $dados = 'treino=' . $valor;
                    break;
                }
            case 'id': {
                    $termos = 'WHERE id=:id';
                    $dados = 'id=' . $valor;
                    break;
                }
            default: {
                    $query = $tipo;
                    $dados = $valor;
                    break;
                }
        }
        $select = new select();
        if (isset($query)) {
            return $select->doSelectManual($query, $dados);
        } else {
            $resultado = $select->doSelect('exerc_treino', $termos, $dados);
            if (count($resultado) == 1) {
                $this->exercicio = $resultado[0]['exercicio'];
                $this->treino = $resultado[0]['treino'];
                $this->series = $resultado[0]['series'];
                $this->repeticoes = $resultado[0]['repeticoes'];
                $this->carga = $resultado[0]['carga'];
                $this->tempo = $resultado[0]['tempo'];
                $this->equipamento = $resultado[0]['equipamento'];
                $this->id = $resultado[0]['id'];
            } else {
                foreach ($resultado as $valor) {
                    $this->exercicio[] = $valor['exercicio'];
                    $this->treino[] = $valor['treino'];
                    $this->series[] = $valor['series'];
                    $this->repeticoes[] = $valor['repeticoes'];
                    $this->carga[] = $valor['carga'];
                    $this->tempo[] = $valor['tempo'];
                    $this->equipamento[] = $valor['equipamento'];
                    $this->id[] = $valor['id'];
                }
            }
        }
    }

    function excluirExercTreinoPorId($id) {
        $this->id = $id;

        $delete = new delete();
        $delete->doDelete('exerc_treino', 'WHERE id=:id', 'id=' . $id);
    }

    function excluirExercTreinoPorTreino($treino) {
        $this->treino = $treino;

        $delete = new delete();
        $delete->doDelete('exerc_treino', 'WHERE treino=:treino', 'treino=' . $treino);
    }

}
