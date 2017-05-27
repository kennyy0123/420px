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
            
            $email = htmlspecialchars($email);
            $mdp = htmlspecialchars($mdp);
            $mdp_second = htmlspecialchars($mdp_second);
            
            if (empty($email) || empty($mdp) || empty($mdp_second))
                return false;
            if (!isset($mdp) || !isset($email) || !isset($mdp_second))
                return false;
            if (strcmp($mdp, $mdp_second) != 0)
                return false;
            if (strlen($email) < 3 || strlen($mdp) < 3)
                return false;
            if(preg_match('/[A-Z]+[a-z]+[0-9]+/', $email) === false || !preg_match('/[A-Z]+[a-z]+[0-9]+/', $mdp)  === false|| preg_match('/[A-Z]+[a-z]+[0-9]+/', $mdp_second) === false)
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
            
            $email = htmlspecialchars($email);
            $mdp = htmlspecialchars($mdp);

            if (empty($email) || empty($mdp))
                return false;
            if (!isset($mdp) || !isset($email))
                return false;
            if (strlen($email) < 3 || strlen($mdp) < 3)
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