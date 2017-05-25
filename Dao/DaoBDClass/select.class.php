<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class select extends conexao {

    private $select;
    private $places;
    private $conexao;
    private $query;
    private $resultado;

    public function doSelect($tabela, $termos = null, $dados = null) {
        $this->query = 'SELECT * FROM ' . $tabela . ' ' . $termos;
        parse_str($dados, $this->places);
        return $this->executar();
    }

    public function doSelectManual($query, $dados = null) {
        $this->query = $query;
        parse_str($dados, $this->places);
        return $this->executar();
    }

    private function conectando() {
        $this->conexao = parent::getConexao();
    }

    private function getSintaxe() {
        foreach ($this->places as $indice => $valor) {
            $this->select->bindValue(':' . $indice, $valor, (is_int($valor)) ? PDO::PARAM_INT : PDO::PARAM_STR);
        }
    }

    private function executar() {
        try {
            $this->conectando();
            $this->select = $this->conexao->prepare($this->query);
            $this->select->setFetchMode(PDO::FETCH_ASSOC);
            $this->getSintaxe();
            $this->select->execute();
            $this->resultado = $this->select->fetchAll();
            return $this->resultado;
        } catch (PDOException $e) {
            echo 'Erro - ' . $e->getMessage();
        }
    }

}
