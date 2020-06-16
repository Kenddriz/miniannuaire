<?php

class Connexion {
    private $user;
    private $password;
    private $dbname;
    private $dbhost;
    private static $pdo;

    public function __construct($user, $password, $dbname = 'cartoffice', $dbhost = 'localhost') {
        $this->user = $user;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->dbhost = $dbhost;
    }
    public function getPdo() {
        if(self::$pdo === null) {
            try {
                $dsn = sprintf('mysql:dbname=%s;host=%s', $this->dbname, $this->dbhost);
                self::$pdo = new PDO($dsn, $this->user, $this->password);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo json_encode('Connexion faild: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }

}
?>