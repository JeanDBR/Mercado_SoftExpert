<?php
ini_set('display_errors', 1);

class Conexao
{
    private static $host = "localhost";
    private static $porta = "5432";
    private static $nomebanco = "Mercado_SoftExpert";
    private static $usuario = "postgres";
    private static $senha = "123456";
    public static $instance;

    public function __construct()
    {
        //
    }

    public static function AbrirConexao()
    {

        if (!isset(self::$instance)) {
            try {
                $conn = "pgsql:host=".self::$host.";port=".self::$porta.";dbname=".self::$nomebanco .";user=". self::$usuario .";password=".self::$senha;
                self::$instance = new PDO($conn);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }

        return self::$instance;
    }
}
