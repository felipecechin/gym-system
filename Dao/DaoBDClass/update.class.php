<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class update extends conexao {

    private $tabela;
    private $dados;
    private $termos;
    private $places;
    private $update;
    private $conexao;
    private $query;

    public function doUpdate($tabela, array $dados, $termos = null, $condicao = null) {
        $this->tabela = $tabela;
        $this->dados = $dados;
        $this->termos = $termos;
        parse_str($condicao, $this->places);
        $this->getSintaxe();
        return $this->executar();
    }

    private function conectando() {
        $this->conexao = parent::getConexao();
    }

    private function getSintaxe() {
        foreach ($this->dados as $indice => $valores) {
            $local[] = $indice . '=:' . $indice;
        }
        $local = implode(', ', $local);

        $this->query = 'UPDATE ' . $this->tabela . ' SET ' . $local . ' ' . $this->termos;
    }

    private function executar() {
        try {
            $this->conectando();
            $this->update = $this->conexao->prepare($this->query);
            return $this->update->execute(array_merge($this->dados, $this->places));
        } catch (PDOException $e) {
            echo 'Erro - ' . $e->getMessage();
        }
    }

}
