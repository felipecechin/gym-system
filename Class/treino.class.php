<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'exerc_treino.class.php';

class treino {

    private $nome;
    private $id;
    private $aluno;
    private $objetivo;

    function __get($prop) {
        return $this->$prop;
    }

    function adicionarTreino($nome, $aluno, $objetivo) {
        $this->nome = $nome;
        $this->aluno = $aluno;
        $this->objetivo = $objetivo;

        $dados = ['nome' => $nome, 'aluno' => $aluno, 'objetivo' => $objetivo];
        $insert = new insert();
        $insert->doInsert('treino', $dados);
        var_dump($insert);
    }

    function excluirTreino($id) {
        $this->id = $id;

        $exercTreino = new exerc_treino();
        $exercTreino->excluirExercTreinoPorTreino($id);
        $delete = new delete();
        $delete->doDelete('treino', 'WHERE id=:id', 'id=' . $id);
        var_dump($delete);
    }

    function editarTreino($id, $nome, $objetivo) {
        $this->nome = $nome;
        $this->id = $id;
        $this->objetivo = $objetivo;

        $update = new update();
        $dados = ['nome' => $nome, 'objetivo' => $objetivo];
        $update->doUpdate('treino', $dados, 'WHERE id=:id', 'id=' . $id);
        var_dump($update);
    }

    function buscarTreino($tipo, $valor) {
        switch ($tipo) {
            case 'nome': {
                    $termos = 'WHERE nome like :nome';
                    $dados = 'nome=' . $valor;
                    break;
                }
            case 'id': {
                    $termos = 'WHERE id=:id';
                    $dados = 'id=' . $valor;
                    break;
                }
            case 'aluno': {
                    $termos = 'WHERE aluno=:aluno';
                    $dados = 'aluno=' . $valor;
                    break;
                }
            case 'objetivo': {
                    $termos = 'WHERE objetivo like :objetivo';
                    $dados = 'objetivo=' . $valor;
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
            $resultado = $select->doSelect('treino', $termos, $dados);
            if (count($resultado) == 1) {
                $this->nome = $resultado[0]['nome'];
                $this->id = $resultado[0]['id'];
                $this->aluno = $resultado[0]['aluno'];
                $this->objetivo = $resultado[0]['objetivo'];
            } else {
                foreach ($resultado as $valor) {
                    $this->nome[] = $valor['nome'];
                    $this->id[] = $valor['id'];
                    $this->aluno[] = $valor['aluno'];
                    $this->objetivo[] = $valor['objetivo'];
                }
            }
        }
    }

}
