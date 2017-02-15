<?php 
spl_autoload_extensions('.php, .class.php'); 
function classLoader($class)
    {
        $filename = strtolower($class) . '.php';
        $file =$_SERVER['DOCUMENT_ROOT'].'api/models/' . $filename;
        if (!file_exists($file))
        {
            return false;
        }
        require_once $file;
    }
spl_autoload_register('classLoader');

?>