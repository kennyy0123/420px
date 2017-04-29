<?php
    
    require('connexion.class.php');
    
    class User 
    {
        private $email;
        private $mdp;
        private $mdp_second;

        static public function create_user($email, $mdp, $mdp_second) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            if (empty($email) || empty($mdp) || empty($mdp_second))
                return false;
            if (!isset($mdp) || !isset($email) || !isset($mdp_second))
                return false;
            
            if (strcmp($mdp, $mdp_second) == 0) {
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
        }
    }
?>