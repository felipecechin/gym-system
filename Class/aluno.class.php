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

}
