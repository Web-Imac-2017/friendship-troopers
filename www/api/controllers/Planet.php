<?php

/**
* ////////////////////////////
* @var PublicationController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {
  const ADMIN = 1;
  const MODO = 2;
  const USER = 3;
  const BAN = 4;

  public function newPlanet($post){
    // verifier que l'user est connecté
    if(!$_SESSION['user']){
      //renvoyer une erreur
      echo "user not logged in";
      return 0;
    }

    // vérifier que c'est un ADMIN

    $_SESSION['user']['roleId'] = self::USER;

    $role = $_SESSION['user']['roleId'];
    if($role != self::ADMIN){
      //renvoyer une erreur
      echo "403 ACCESS DENIED";
      return 0;
    }
    //champs nécessaires
    $required = ['name', 'description','imagePath','history'];
    //vérifie que tous les champs requis sont présents
    if(count($this->checkRequired($required,$post)) > 0) {
      //return json_encode($array);
      echo "champs manquants";
      return 0;
    }
    if(empty($post['name']) || empty($post['description']) || empty($post['imagePath'])) {
      //retourne une erreur à la vue
      //return json_encode($array);
      echo "champs vides";
      return 0;
    }
    $data = ['name' => $post['name'],
             'description' => $post['description'],
             'imagePath' => $post['imagePath'],
             'history' => $post['history']
           ];
    //nettoyer data (éviter faille)
    $this->filterXSS($data);
    //$role = $_SESSION['user']['roleId'];
    $planet = new \Models\Planet();
    $request = ['fields' => ['id', 'name']];
    $reponse = $planet->save($request);
    var_dump($reponse);
  }


}
?>
