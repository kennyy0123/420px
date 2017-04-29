<?php

    class Database_connexion{

        //PENSER à LIRE DEPUIS UN FICHIER LA CONFIG

        private $host = 'localhost';
        private $user = 'root';
        private $pass = 'root';
        private $dbname = 'mti_db';

        private $error;
        private $connection;

        public function __construct(){
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
            try {
                $this->connection = new PDO($dsn, $this->user, $this->pass);
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