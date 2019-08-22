<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class treino {

    private $nome;
    private $id;
    private $aluno;
    private $objetivo;

    function getNome() {
        return $this->nome;
    }

    function getId() {
        return $this->id;
    }

    function getAluno() {
        return $this->aluno;
    }

    function getObjetivo() {
        return $this->objetivo;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setAluno($aluno) {
        $this->aluno = $aluno;
    }

    function setObjetivo($objetivo) {
        $this->objetivo = $objetivo;
    }

}
