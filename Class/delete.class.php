<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class delete extends conexao {

    private $tabela;
    private $termos;
    private $places;
    private $delete;
    private $conexao;
    private $query;

    public function doDelete($tabela, $termos, $dados) {
        $this->tabela = $tabela;
        $this->termos = $termos;
        parse_str($dados, $this->places);
        $this->getSintaxe();
        $this->executar();
    }

    private function conectando() {
        $this->conexao = parent::getConexao();
    }

    private function getSintaxe() {
        $this->query = 'DELETE FROM ' . $this->tabela . ' ' . $this->termos;
    }

    private function executar() {
        try {
            $this->conectando();
            $this->delete = $this->conexao->prepare($this->query);
            $this->delete->execute($this->places);
        } catch (PDOException $e) {
            echo 'Erro - ' . $e->getMessage();
        }
    }

}
