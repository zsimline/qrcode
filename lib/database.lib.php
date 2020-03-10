<?php
require 'config.lib.php';

class Moudle{
    
    private $dbms;
    private $host;
    private $dbname;
    private $user;
    private $password;
    private $options;
    private $dsn;
    private $pdo;
    
    function __construct(){
        $this->dbms = constant("DBMS");
        $this->host = constant("HOST");
        $this->dbname = constant("DBNAME");
        $this->user = constant("USER");
        $this->password = constant("PASSWORD");
        $this->options = array(PDO::MYSQL_ATTR_INIT_COMMAND => "set names utf8");
        $this->dsn = "$this->dbms:host=$this->host;dbname=$this->dbname";
        
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password,$this->options);
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
    }
    
    function executeQuery($statement){
        $result = null;
        try {
            $result = $this->pdo->prepare($statement);
            $result->execute();
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $result;
    }
    
    function executeUpdate($statement){
        $row = 0;
        try {
            $row = $this->pdo->exec($statement);
        } catch (PDOException $e) {
            die ("Error!: " . $e->getMessage() . "<br/>");
        }
        return $row;
    }
    
    function close($statement){
        $this->pdo = null;
    }
}
?>