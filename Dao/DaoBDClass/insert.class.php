<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class insert extends conexao {

    private $tabela;
    private $dados;
    private $insert;
    private $query;
    private $conexao;
    private $ultimoId;

    public function doInsert($tabela, array $dados, $ultimoId = false) {
        $this->tabela = (string) $tabela;
        $this->dados = $dados;

        $this->getSintaxe();
        if ($ultimoId) {
            return $this->executar($ultimoId);
        } else {
            return $this->executar();
        }
    }

    private function conectando() {
        $this->conexao = parent::getConexao();
    }

    private function getSintaxe() {
        $campos = implode(',', array_keys($this->dados));
        $valores = ':' . implode(',:', array_keys($this->dados));
        $this->query = "INSERT INTO $this->tabela ($campos) VALUES ($valores)";
    }

    private function executar($ultimoId = false) {
        try {
            $this->conectando();
            $this->insert = $this->conexao->prepare($this->query);
            $return = $this->insert->execute($this->dados);
            if ($ultimoId) {
                $conn = $this->conexao;
                $this->ultimoId = $conn->lastInsertId();
                if ($this->ultimoId != 0) {
                    $return = $this->ultimoId;
                }
            }
            return $return;
        } catch (Exception $e) {
            echo 'Erro - ' . $e->getMessage();
        }
    }

}
