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

    function __get($name) {
        return $this->$name;
    }

    function getNome() {
        return $this->nome;
    }

    function getCpf() {
        return $this->cpf;
    }

    function getDataNasc() {
        return $this->dataNasc;
    }

    function getGenero() {
        return $this->genero;
    }

    function getAltura() {
        return $this->altura;
    }

    function getBiotipo() {
        return $this->biotipo;
    }

    function getFrequenciaSem() {
        return $this->frequenciaSem;
    }

    function getCodigo() {
        return $this->codigo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setCpf($cpf) {
        $this->cpf = $cpf;
    }

    function setDataNasc($dataNasc) {
        $this->dataNasc = $dataNasc;
    }

    function setGenero($genero) {
        $this->genero = $genero;
    }

    function setAltura($altura) {
        $this->altura = $altura;
    }

    function setBiotipo($biotipo) {
        $this->biotipo = $biotipo;
    }

    function setFrequenciaSem($frequenciaSem) {
        $this->frequenciaSem = $frequenciaSem;
    }

    function setCodigo($codigo) {
        $this->codigo = $codigo;
    }

    /* function getDados() {
        return $this->dados;
    }

    protected function setDados($dados) {
        $this->dados = $dados;
    }

    function getTermos() {
        return $this->termos;
    }

    protected function setTermos($termos) {
        $this->termos = $termos;
    }

    function getTabela() {
        return self::tabela;
    }

    function getResultado() {
        return $this->resultado;
    }

    function setResultado($resultado) {
        foreach ($resultado as $valor) {
            $nome[] = $valor['nome'];
            $cpf[] = $valor['cpf'];
            $dataNasc[] = $valor['dataNasc'];
            $genero[] = $valor['genero'];
            $altura[] = $valor['altura'];
            $biotipo[] = $valor['biotipo'];
            $frequenciaSem[] = $valor['frequenciaSem'];
            $codigo[] = $valor['codigo'];
        }
        $aluno = new aluno();
        $aluno->setNome($nome);
        $aluno->setCpf($cpf);
        $aluno->setDataNasc($dataNasc);
        $aluno->setGenero($genero);
        $aluno->setAltura($altura);
        $aluno->setBiotipo($biotipo);
        $aluno->setFrequenciaSem($frequenciaSem);
        $aluno->setCodigo($codigo);
        return $aluno;
    }

    function popularDadosInserir() {
        $dados = ['nome' => $this->getNome(),
            'cpf' => $this->getCpf(),
            'dataNasc' => $this->getDataNasc(),
            'genero' => $this->getGenero(),
            'altura' => $this->getAltura(),
            'biotipo' => $this->getBiotipo(),
            'frequenciaSem' => $this->getFrequenciaSem(),
            'codigo' => $this->getCodigo()];
        $this->setDados($dados);
    }

    function popularDadosBuscar() {
        $api = new ReflectionObject($this);
        $i = 0;
        foreach ($api->getProperties() as $property) {
            $prop = $property->getName();
            if (!empty($this->$prop)) {
                if ($i == 0) {
                    $termos = 'WHERE ' . $prop . ' like :' . $prop;
                    $dados = $prop . '=' . $this->$prop;
                } else {
                    $termos .= ' AND ' . $prop . ' like :' . $prop;
                    $dados .= ',' . $prop . '=' . $this->$prop;
                }
                $i++;
            }
        }
        $this->setTermos($termos);
        $this->setDados($dados);
    } */
    /*
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
        return true;
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
            case 'todos': {
                    $termos = 'ORDER BY nome ASC';
                    $dados = $valor;
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
    */
}

/*
$aluno = new aluno();
$aluno->setAltura(1.50);
$api = new ReflectionObject($aluno);
foreach ($api->getProperties() as $property) {
    $prop = $property->getName(); 
    echo $aluno->$prop;
}*/
