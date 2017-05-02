<?php

require('connexion.class.php');
    class RSS 
    {
     
        
        static public function create_rssfeed($user) {

            $xml = "";
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            if (empty($user) || !isset($user))
                return false;
            
            try {
                $prepa = $result->prepare("SELECT * FROM picture WHERE pseudo like :search");
                $res_array = array();
                
                if(!$prepa->execute(array('search'=> $user)))
                    echo 'ERROR';
                
                $xml .= '<?xml version="1.0" encoding="UTF-8" ?><rss version="2.0">';
                $xml .= '<picture><title>420 PX picture</title><link>https://www.420px.com</link><description>Free picture Gallery</description><pseudo>'.  $user .'</pseudo>';
                
                while($student = $prepa->fetch(PDO::FETCH_OBJ) ) {
                   $xml .= '<item><link>' . 'http://' . $_SERVER['HTTP_HOST'] . '/php_projet/' . $student->path . '</link></item>';
                }
                
                $xml .= '</picture></rss>';

                
                if ($result == false) {
                     return false;
                }

                echo $xml;
                return true;
                
                }
                catch(PDOExcpetion $e){
                    $this->error = $e->getMessage();
                }
        }
    }

?>