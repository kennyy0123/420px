<?php
    function my_autoloader($classname) {
        include 'classes/'.$classname.'.class.php';
    } 
    
    spl_autoload_register('my_autoloader');
?>