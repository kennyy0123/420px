 <?php
 
    require('connexion.class.php');

    class Picture 
    {   
        static public function add_picture($path, $user) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            if (empty($path) || empty($user))
                return false;
            if (!isset($path) || !isset($user))
                return false;
            
            try {
                $prepa = $result->prepare("INSERT INTO picture (pseudo, path, date) VALUES (?, ?, ?)");
                $result = $prepa->execute(array($user, $path, time()));  
                
                if ($result == false) {
                     return false;
                }

                return true;
                
                }
                catch(PDOExcpetion $e){
                    $this->error = $e->getMessage();
                }
         }

        function GUID()
        {
            if (function_exists('com_create_guid') === true)
            {
                return trim(com_create_guid(), '{}');
            }

            return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
        }

        static public function get_picture($user) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();

            $user = htmlspecialchars($user);

            if (empty($user) || !isset($user))
                return false;
            
            try {
                $prepa = $result->prepare("SELECT * FROM picture WHERE pseudo like :search");
                $res_array = array();
                if(!$prepa->execute(array('search'=> $user)))
                    return false;
                
                while($student = $prepa->fetch(PDO::FETCH_OBJ) ) {
                    array_push($res_array, $student->path);
                }

                return $res_array;
            }
            catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }

        static public function delete_picture($path) {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();
            
            try {
                $prepa = $result->prepare("DELETE FROM picture WHERE path = ? ");
                $res_array = $prepa->execute(array($path));
            }
            catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }


         static public function get_allpicture() {
            $dbh = new Database_connexion();
            $result = $dbh->connexion_string();
            
            try {
                $prepa = $result->prepare("SELECT * FROM picture");
                $res_array = array();
                 if(!$prepa->execute(array()))
                    return false;

                while($student = $prepa->fetch(PDO::FETCH_OBJ) ) {
                    array_push($res_array, $student->path);
                }

                return $res_array;
            }
            catch (PDOException $e) {
                $this->error = $e->getMessage();
            }
        }

        static public function get_picturergb($rgb, $array_picture){
        $result_picture = [];
        
        foreach($array_picture as $value){
            $image = new Imagick($value);

            $histogramElement = $image->getImageHistogram();
            $res = [];
            
            foreach($histogramElement as $histogram_elements) {
                $color = $histogram_elements->getColor();
                $r = $color['r'];
                $g = $color['g'];
                $b = $color['b'];

                $res[$r . ',' . $g . ',' . $b] = $histogram_elements->getColorCount();
            }

            if (array_key_exists($rgb, $res)){
                array_push($result_picture, $value);
            }
        }
        
        return $result_picture;
        }
    }
?>