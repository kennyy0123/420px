<?php
    
    require('connexion.class.php');
    
    class User 
    {
        private $email;
        private $mdp;
        private $mdp_second;
        private $error;

        static public function create_user($email, $mdp, $mdp_second) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            if (empty($email) || empty($mdp) || empty($mdp_second))
                return false;
            if (!isset($mdp) || !isset($email) || !isset($mdp_second))
                return false;
            if (strcmp($mdp, $mdp_second) != 0)
                return false;
            
            try {
                $prepa = $result->prepare("INSERT INTO user (pseudo, mdp) VALUES (?, ?)");
                $result = $prepa->execute(array($email, crypt($mdp, $email)));  
                    
                if ($result == false) {
                     return false;
                }

                return true;
                
                }
                catch(PDOExcpetion $e){
                    $this->error = $e->getMessage();
                }
        }

        static public function connect_user($email, $mdp) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            if (empty($email) || empty($mdp))
                return false;
            if (!isset($mdp) || !isset($email))
                return false;
            
            try {                
                $prepa = $result->prepare("SELECT * FROM user WHERE mdp = :search_mdp AND pseudo = :search_pseudo LIMIT 1");
                $result_synt = $prepa->execute(array('search_mdp'=> crypt($mdp, $email), 'search_pseudo' => $email));
                $result = $prepa->fetch(PDO::FETCH_OBJ);

                if (!$result) {
                     return false;
                }
                
                return true;
            }
            catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }
    }
?>