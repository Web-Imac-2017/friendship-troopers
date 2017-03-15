<?php
/**
* ////////////////////////////
* @var StardustController
* ////////////////////////////
*/
namespace Controllers;

class Avatar extends Controller {
    public function __construct() {
      $this->loadModel('Avatar');
      $this->loadModel('User_Avatar');
    }

            /***********************************
                   ADMINISTRATION FUNCTIONS
            ***********************************/

    /**
     * add an avatar into the database
     * @param  array $post datas from view
     */
    public function create($post) {
        if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
        if(\Utils\Session::user('roleId') != 1){
            throw new \Utils\RequestException('FORBIDDEN', 403);
        }
        $required = ['imagePath', 'altText', 'description', 'price'];
        if (!empty($this->checkRequired($required, $post))) {
			throw new \Utils\RequestException('MISSING_FIELDS', 400);
		}
        $fields = [
            'imagePath' => $post['imagePath'],
            'altText' => $post['altText'],
            'description' => $post['description'],
            'price' => $post['price'],
        ];
        if(array_key_exists('pack', $post)) {
            $fields['pack'] = $post['pack'];
        }
        try {
            $this->Avatar->save($this->filterXSS($fields));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('erreur BDD', 400);
        }
        $this->response('ok',200);
    }
    /**
     * update the infos of an avatar
     * admin only
     * @param  int $id      id of the avatar
     * @param  array $patches data send by the front
     * @return json          null if success
     */
    public function update ($id, $patches)
    {
        if (!\Utils\Session::isLoggedIn()) {
            throw new \Utils\RequestException('operation reservee aux membres', 401);
        }
        if (!in_array(\Utils\Session::user('roleId'), [1, 2])) {
            throw new \Utils\RequestException('action reservee aux administeurs', 403);
        }
        $updates = ['id' => $id];
        foreach ($patches as $patch) {
            switch ($patch['op']) {
            case 'replace':
                $updates[explode('/',$patch['path'])[1]] = $patch['value'];
                break;
            default:
                throw new \Utils\RequestException('bad op', 400);
                break;
            }
        }
        try {
            $this->Avatar->save($this->filterXSS($updates));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('erreur BDD', 400);
        }

        $this->response(null, 200);
    }
            /***********************************
                       USER FUNCTIONS
            ***********************************/

    /**
     *  set the current avatar of the user
     */
    public function setCurrentAvatar($avatarId) {
        if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
        $userId = \Utils\Session::user('id');
        $ownAvatar = $this->User_Avatar->find([
            'fields' => ['avatarId'],
            'conditions' => [
                'userId' => $userId,
                'avatarId' => $avatarId,
            ],
        ]);

        if(empty($ownAvatar)){
            throw new \Utils\RequestException('Vous ne possédez pas cette avatar', 400);
        }
        $oldAvatarId = $this->User_Avatar->findFirst([
            'fields' => ['avatarId'],
            'conditions' => [
                'userId' => $userId,
                'currentAvatar' => 1,
            ],
        ]);
        $addKeysNew = $this->filterXSS([
            'userId' => $userId,
            'avatarId' => $avatarId,
        ]);
        $addKeysOld = $this->filterXSS([
            'avatarId' => $oldAvatarId['avatarId'],
        ]);
        try {
            $this->User_Avatar->save([
                'userId' => $userId,
                'currentAvatar' => '0',
            ], $addKeysOld);
            $this->User_Avatar->save([
                'userId' => $userId,
                'currentAvatar' => '1',
            ], $addKeysNew);
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('erreur BDD', 400);
        }
        $this->response(null, 200);
    }

    /**
     * The list of avatar the user own (include the default avatar)
     * need some thinking on the processus
     */
    public function listUserAvatar() {
        if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
        $userId = \Utils\Session::user('id');

        $request = $this->Avatar->find([
            'fields' => ['DISTINCT avatar.id', 'avatar.imagePath', 'avatar.description', 'avatar.altText', 'currentAvatar'],
            'leftJoin'=> [
                [
                'table' => 'user_avatar',
                		'alias' => 'user_avatar',
                		'from' => 'avatarId',
                		'to' => 'id',
                        'JoinTable' => 'avatar',
                ],
                [
                'table' => 'user',
                		'alias' => 'user',
                		'from' => 'id',
                		'to' => 'userId',
                        'JoinTable' => 'user_avatar',
                ],
            ],
            'conditions' => ["or" => [
                'user.id' => $userId,
                'avatar.pack' => 0
                ]
            ],
        ]);

        $this->response($request, 200);
    }

    /**
     * add an avatar  to the user
     * @param  int $idAvatar the avatar id
     * @return json           
     */
    public function gainAvatar($idAvatar){
        if(\Utils\Session::isLoggedIn() == NULL){
            throw new \Utils\RequestException('NOT_LOGGED', 401);
        }
        $userId = \Utils\Session::user('id');

        try {
            $this->User_Avatar->insert($idAvatar, $userId);
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('erreur BDD', 400);
        }
        $this->response(null,200);
    }
}
