<?php

DEFINE('HOSTNAME', 'localhost');
DEFINE('USER', 'root');
DEFINE('PASSWD', '');
DEFINE('DATABASE', 'marketiger');

class Conexao
{
    public static $conn;
    public static function get_instance()
    {
        //Conectar ao banco de dados
        
        self::$conn = new mysqli(HOSTNAME, USER, PASSWD, DATABASE);
        

        return self::$conn;
    }
}
