<?php

namespace Utils;

class Autoloader {
    static function register() {
        spl_autoload_extensions('.php');
        spl_autoload_register([__CLASS__, 'classLoader']);
    }
    /**
     * récupère une class avec son namespace
     * ce que je sais pas si on peut faire un namespace
     * controllers et models ou si c'est de la grosse gruge \o/
     * (j'ai suivi un tuto de grafikart là dessus en fait)
     * (et un peu l'autoloadr que vous m'aviez envoyé)
     *
     * @param       $class  le nom de la class
     */
    static function classLoader($class) {
        $pathParts = array_map(function ($s) {
          return lcfirst($s);
        }, explode('\\', $class));
        $pathParts[count($pathParts) - 1] = ucfirst($pathParts[count($pathParts) - 1]);
        $realPath  = implode('/', $pathParts);
        $file = ROOT . "/api/$realPath.php";
        if (!file_exists($file)) {
            return false;
        }
        require_once $file;
    }
}
