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

    function getExercicio() {
        return $this->exercicio;
    }

    function getTreino() {
        return $this->treino;
    }

    function getSeries() {
        return $this->series;
    }

    function getRepeticoes() {
        return $this->repeticoes;
    }

    function getCarga() {
        return $this->carga;
    }

    function getTempo() {
        return $this->tempo;
    }

    function getEquipamento() {
        return $this->equipamento;
    }

    function getId() {
        return $this->id;
    }

    function setExercicio($exercicio) {
        $this->exercicio = $exercicio;
    }

    function setTreino($treino) {
        $this->treino = $treino;
    }

    function setSeries($series) {
        $this->series = $series;
    }

    function setRepeticoes($repeticoes) {
        $this->repeticoes = $repeticoes;
    }

    function setCarga($carga) {
        $this->carga = $carga;
    }

    function setTempo($tempo) {
        $this->tempo = $tempo;
    }

    function setEquipamento($equipamento) {
        $this->equipamento = $equipamento;
    }

    function setId($id) {
        $this->id = $id;
    }

}
