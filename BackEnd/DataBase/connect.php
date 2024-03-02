<?php
namespace base;
use PDO;
use PDOException;

class Database{
    static protected $connection = false ;
    private static $server = 'localhost';
    private static $root = "root";
    private static $pass = "";
    private static $Db = "cafeteria";

    private function __construct(){}

    public static function connect(){
        if(!self::$connection){
            try {
                self::$connection = new PDO("mysql:host=".self::$server.";dbname=".self::$Db."", self::$root, self::$pass);
            } catch (PDOException $e) {
                die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
            }
        }
        return self::$connection;
    }
        
}

?>

