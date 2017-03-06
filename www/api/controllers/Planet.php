<?php

/**
* ////////////////////////////
* @var PlanetController
* ////////////////////////////
*/
namespace Controllers;

class Planet extends Controller {

  const ADMIN = 1;
  const MODO = 2;
  const USER = 3;
  const BAN = 4;
  const ME = 5;

  public function getLastComment ($get) {
    $required = ['planetId'];
    $missingFields = $this->checkRequired($required, $_SESSION);

    if (array_key_exists($required, $missingFields)) {
      throw new \Utils\RequestException('planète introuvable', 404);
    }

    $CommentModel = new \Models\Comment();

    $request = $CommentModel->findFirst([
      'fields' => ['content', 'publishDate', 'userId', 'modified'],
      'conditions' => '',
    ]);

  }
}

  public function newPlanet($post){
    $_SESSION['user']=[];
    //$_SESSION['user']['id']= ME;
    // verifier que l'user est connecté
    if(!array_key_exists('user',$_SESSION)){
      //renvoyer une erreur
      echo "user not logged in";
      return 0;
    }

    // vérifier que c'est un ADMIN
    //$_SESSION['user']=[];
    $_SESSION['user']['roleId'] = self::ADMIN;

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
    $planet = new \Models\Planet();
    $request = ['fields' => ['id', 'name']];
    $reponse = $planet->save($request);
    var_dump($reponse);
  }

  public function deletePlanet($post){
    $_SESSION['user']=[];
    if(!array_key_exists('user',$_SESSION)){
      echo "user not logged in";
      return 0;
    }

    $_SESSION['user']['roleId'] = self::USER;
//var dump pour tester
//pas echo
//throw new
    if (!) {

    }

    $this->filterXSS([
      'name' => $post['name'],
      'id' => $post['id']
   ]);
    //recuperer la planete à supprimer ?
    //Supprimer la planete ?
    //delete();
  }
}
}
?>
