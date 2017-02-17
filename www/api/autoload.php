<?php 
class autoloader{
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
		$path_parts = explode('\\', $class);
		$real_path  = implode('/', $path_parts);
		$file=$_SERVER['DOCUMENT_ROOT'].'api/' . $real_path ;
		switch ($path_parts[0]) {
			case 'controllers':
				$file .='controller.class.php';
				break;
			case 'models':
				$file .='model.class.php';
				break;
			default:
				$file='null';
				break;
		}
		if (!file_exists($file)) {
			return false;
		}
		require_once $file;
	}
}
	
?>