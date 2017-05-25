<?php

/**
 * Description of dao
 *
 * @author Felipe
 */
require_once 'DaoBDClass/conexao.class.php';
require_once 'DaoBDClass/delete.class.php';
require_once 'DaoBDClass/insert.class.php';
require_once 'DaoBDClass/select.class.php';
require_once 'DaoBDClass/update.class.php';

class dao {

    public function salvarObjeto($objeto, $termosUpdate = []) {
        if (!is_object($objeto)) {
            return false;
        }
        $reflectionObjeto = new ReflectionObject($objeto);
        $dados = [];
        foreach ($reflectionObjeto->getProperties() as $property) {
            $prop = $property->getName();
            if (!is_null($objeto->$prop)) {
                $dados[$prop] = $objeto->$prop;
            } else {
                $dados[$prop] = null;
            }
        }
        if (empty($termosUpdate)) {
            $insert = new insert();
            return $insert->doInsert(get_class($objeto), $dados, true);
        } else if (is_array($termosUpdate)) {
            $termosDoUpdate = $this->criarTermos($objeto, $termosUpdate);
            $condicao = $this->criarDadosParametros($objeto, $termosUpdate);
            if ($termosDoUpdate && $condicao) {
                foreach ($termosUpdate as $termo) {
                    unset($dados[$termo]);
                }
                $update = new update();
                return $update->doUpdate(get_class($objeto), $dados, $termosDoUpdate, $condicao);
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function buscarObjeto($objeto, $termos = []) {
        if (!is_object($objeto)) {
            return false;
        }
        if (empty($termos)) {
            $reflectionObjeto = new ReflectionObject($objeto);
            foreach ($reflectionObjeto->getProperties() as $property) {
                $prop[] = $property->getName();
            }
            $termosSelect = $this->criarTermos($objeto, $prop);
            $dados = $this->criarDadosParametros($objeto, $prop);
        } else if (is_array($termos)) {
            $termosSelect = $this->criarTermos($objeto, $termos);
            $dados = $this->criarDadosParametros($objeto, $termos);
        } else {
            return false;
        }
        if (!$termosSelect && !$dados) {
            return false;
        }
        $select = new select();
        $result = $select->doSelect(get_class($objeto), $termosSelect, $dados);
        if (!empty($result)) {
            return $this->criarObjetosBusca($result, $objeto);
        } else {
            return false;
        }
    }

    public function deletarObjeto($objeto, $termos = []) {
        if (!is_object($objeto)) {
            return false;
        }
        if (empty($termos)) {
            $reflectionObjeto = new ReflectionObject($objeto);
            foreach ($reflectionObjeto->getProperties() as $property) {
                $prop[] = $property->getName();
            }
            $termosDelete = $this->criarTermos($objeto, $prop);
            $condicao = $this->criarDadosParametros($objeto, $prop);
        } else if (is_array($termos)) {
            $termosDelete = $this->criarTermos($objeto, $termos);
            $condicao = $this->criarDadosParametros($objeto, $termos);
        } else {
            return false;
        }
        if ($termosDelete && $condicao) {
            $delete = new delete();
            return $delete->doDelete(get_class($objeto), $termosDelete, $condicao);
        } else {
            return false;
        }
    }

    public function buscarManual($query, $dados) {
        $select = new select();
        return $select->doSelectManual($query, $dados);
    }

    public function buscarTodosPorObjeto($objeto, $ordenacao = null) {
        $select = new select();
        $result = $select->doSelect(get_class($objeto), $ordenacao, null);
        if (!empty($result)) {
            return $this->criarObjetosBusca($result, $objeto);
        } else {
            return false;
        }
    }

    private function criarTermos($objeto, $termos) {
        $i = 0;
        $erro = 1;
        $reflectionObjeto = new ReflectionObject($objeto);
        foreach ($termos as $termo) {
            foreach ($reflectionObjeto->getProperties() as $property) {
                $prop = $property->getName();
                if ($prop == $termo) {
                    $erro = 0;
                }
            }
            if ($erro == 0 && !is_null($objeto->$termo)) {
                if ($i == 0) {
                    $termosRetorno = 'WHERE ' . $termo . '=:' . $termo;
                } else {
                    $termosRetorno .= ' AND ' . $termo . '=:' . $termo;
                }
                $i++;
            }
        }
        if ($erro == 1) {
            return false;
        } else {
            return $termosRetorno;
        }
    }

    private function criarDadosParametros($objeto, $termos) {
        $i = 0;
        $erro = 1;
        $reflectionObjeto = new ReflectionObject($objeto);
        foreach ($termos as $termo) {
            foreach ($reflectionObjeto->getProperties() as $property) {
                $prop = $property->getName();
                if ($prop == $termo) {
                    $erro = 0;
                }
            }
            if ($erro == 0 && !is_null($objeto->$termo)) {
                if ($i == 0) {
                    $dadosRetorno = $termo . '=' . $objeto->$termo;
                } else {
                    $dadosRetorno .= '&' . $termo . '=' . $objeto->$termo;
                }
                $i++;
            }
        }
        if ($erro == 1) {
            return false;
        } else {
            return $dadosRetorno;
        }
    }

    private function criarObjetosBusca($result, $objeto) {
        $classeObjeto = get_class($objeto);
        $objetoClasse = new $classeObjeto();
        $reflectionObjetoClasse = new ReflectionObject($objetoClasse);
        $retorno = [];
        foreach ($result as $valor) {
            foreach ($reflectionObjetoClasse->getProperties() as $property) {
                $prop = $property->getName();
                $retorno[$prop][] = $valor[$prop];
            }
        }
        $objetosRetorno = [];
        for ($i = 0; $i < count($retorno[$prop]); $i++) {
            $objetoRegistro = new $classeObjeto();
            $reflectionObjetoRegistro = new ReflectionObject($objetoRegistro);
            foreach ($reflectionObjetoRegistro->getProperties() as $property) {
                $prop = $property->getName();
                $method = $reflectionObjetoRegistro->getMethod("set" . $prop);
                $method->invoke($objetoRegistro, $retorno[$prop][$i]);
            }
            array_push($objetosRetorno, $objetoRegistro);
        }
        return $objetosRetorno;
    }

}
