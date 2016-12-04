<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of aluno
 *
 * @author Felipe
 */
class aluno {

    private $nome;
    private $cpf;
    private $dataNasc;
    private $genero;
    private $altura;
    private $biotipo;
    private $frequenciaSem;
    private $codigo;

    function __get($prop) {
        return $this->$prop;
    }

    function cadastrarAluno($nome, $cpf, $dataNasc, $genero, $altura, $biotipo, $frequenciaSem, $codigo) {
        $this->nome = $nome;
        $this->cpf = $cpf;
        $this->dataNasc = $dataNasc;
        $this->genero = $genero;
        $this->altura = $altura;
        $this->biotipo = $biotipo;
        $this->frequenciaSem = $frequenciaSem;
        $this->codigo = $codigo;

        $dados = ['nome' => $nome, 'cpf' => $cpf, 'dataNasc' => $dataNasc, 'genero' => $genero, 'altura' => $altura, 'biotipo' => $biotipo, 'frequenciaSem' => $frequenciaSem, 'codigo' => $codigo];
        $insert = new insert();
        $insert->doInsert('aluno', $dados);
        return TRUE;
    }

    function buscarAluno($tipo, $valor) {
        switch ($tipo) {
            case 'nome': {
                    $termos = 'WHERE nome like :nome';
                    $dados = 'nome=' . $valor;
                    break;
                }
            case 'cpf': {
                    $termos = 'WHERE cpf like :cpf';
                    $dados = 'cpf=' . $valor;
                    break;
                }
            case 'dataNasc': {
                    $termos = 'WHERE dataNasc like :dataNasc';
                    $dados = 'dataNasc=' . $valor;
                    break;
                }
            case 'genero': {
                    $termos = 'WHERE genero like :genero';
                    $dados = 'genero=' . $valor;
                    break;
                }
            case 'altura': {
                    $termos = 'WHERE altura like :altura';
                    $dados = 'altura=' . $valor;
                    break;
                }
            case 'biotipo': {
                    $termos = 'WHERE biotipo like :biotipo';
                    $dados = 'biotipo=' . $valor;
                    break;
                }
            case 'frequenciaSem': {
                    $termos = 'WHERE frequenciaSem like :frequenciaSem';
                    $dados = 'frequenciaSem=' . $valor;
                    break;
                }
            case 'codigo': {
                    $termos = 'WHERE codigo like :codigo';
                    $dados = 'codigo=' . $valor;
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
            $resultado = $select->doSelect('aluno', $termos, $dados);
            if (count($resultado) == 1) {
                $this->nome = $resultado[0]['nome'];
                $this->cpf = $resultado[0]['cpf'];
                $this->dataNasc = $resultado[0]['dataNasc'];
                $this->genero = $resultado[0]['genero'];
                $this->altura = $resultado[0]['altura'];
                $this->biotipo = $resultado[0]['biotipo'];
                $this->frequenciaSem = $resultado[0]['frequenciaSem'];
                $this->codigo = $resultado[0]['codigo'];
            } else {
                foreach ($resultado as $valor) {
                    $this->nome[] = $valor['nome'];
                    $this->cpf[] = $valor['cpf'];
                    $this->dataNasc[] = $valor['dataNasc'];
                    $this->genero[] = $valor['genero'];
                    $this->altura[] = $valor['altura'];
                    $this->biotipo[] = $valor['biotipo'];
                    $this->frequenciaSem[] = $valor['frequenciaSem'];
                    $this->codigo[] = $valor['codigo'];
                }
            }
        }
    }

}
