test.php 

<?php 

require_once($_SERVER['DOCUMENT_ROOT'].'/api/controllers/SignInController.class.php');

$controller = new SignIn(); 
$controller->inscription();
?>
