<?php

    include('includes/psl-config.php');

    class Database_connexion{

        private $error;
        private $connection;

        public function __construct(){
            $dsn = 'mysql:host=' . HOST . ';dbname=' . DATABASE;
            try {
                $this->connection = new PDO($dsn, USER, PASSWORD);
            }
            catch(PDOExcpetion $e) {
                $this->error = $e->getMessage();
            }
        }

        public function connexion_string(){
            return $this->connection;
        }
    }
?>