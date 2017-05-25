<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class conexao {

    private static $host = 'localhost';
    private static $user = 'root';
    private static $pass = '';
    private static $bd = 'academia';
    private static $connect;

    private static function conectar() {
        try {
            $options = [PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'];
            $dsn = 'mysql:host=' . self::$host . ';dbname=' . self::$bd;
            self::$connect = new PDO($dsn, self::$user, self::$pass, $options);
        } catch (PDOException $e) {
            echo 'ERRO: --' . $e->getMessage() . '-- na linha --' . $e->getLine() . '--';
        }
        return self::$connect;
    }

    public static function getConexao() {
        return self::conectar();
    }
    
}
