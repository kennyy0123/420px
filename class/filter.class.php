<?php
    class filter {
        
        public function filter_function ($path, $filter) 
        {       
            try{
                $image = new Imagick($path);
                switch($filter) 
                {
                    case "contraste-plus" :
                        $image->contrastImage(2);
                        $image->writeImage($path);
                        break;
                    case "contraste-minus" :
                        $image->contrastImage(0);
                        $image->writeImage($path);
                        break;
                    case "gauss" :
                        $image->gaussianBlurImage(10, 0.84);
                        $image->writeImage($path);
                        break;
                    case "sepia" :
                        $image->sepiaToneImage(80);
                        $image->writeImage($path);
                        break;
                    case "gray" :
                        $image->modulateImage(100.00, 0.00, 100.00);
                        $image->writeImage($path);
                        break;
                    case "contour" :
                        $image->edgeImage(0);
                        $image->writeImage($path);
                        break;
                    case "luminosite-plus" :
                        $image->modulateImage(200, 100, 100);
                        $image->writeImage($path);
                        break;
                    case "luminosite-minus" :
                        $image->modulateImage(50, 100, 100);
                        $image->writeImage($path);
                        break;
                }
            }
            catch (ImagickException $e){
                return false;
            }
        }
    }
?>