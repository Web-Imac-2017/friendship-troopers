<?php
/**
* ////////////////////////////
* @var FriendController
* ////////////////////////////
*/
namespace Controllers;

class Friend extends Controller {
    public function __construct() {
		$this->loadModel('Friend');
	}
    /**
     * add a friend to the logged user
     * send a request to the potential 'friend' to be friend
     * @param $friendId The id of the user that will become friend with the logged user
     */
    public function addFriend($friendId){
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
        $userId = \Utils\Session::user('id');
        $userPlanetId  = \Utils\Session::user('planetId');
        if (is_array($friendId) || empty($friendId) || !is_numeric($friendId)) {
          throw new \Utils\RequestException('user inconnu', 400);
        }
        if ($friendId === $userId) {
            throw new \Utils\RequestException('SCHIZOPHRENIE', 400); //code
        }
        try {
            //the one asking for a friend
            $this->Friend->insert($this->filterXSS([
                'userId' => $userId,
                'friendId' => $friendId,
                'status' => 0,
                'seeker' => 1,
            ]));
            // the one being asked
            $this->Friend->insert($this->filterXSS([
                'userId' => $friendId,
                'friendId' => $userId,
                'status' => 0,
                'seeker' => 0,
            ]));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('Impossible', 400);
        }
        $this->response("SUCCESS", 200);
    }

    /**
     * The user gladly accept to be friend with a user (who wanna be friend tho)
     * @param  int $friendId The id of the friend the current user is aproving
     */
    public function confirmFriend ($friendId) {
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('USER_NOT_LOGGED', 401);
        }
        if(!is_string($friendId) || empty($friendId)){
            throw new \Utils\RequestException('MISSING_FIELDS', 400);
        }
        $userId = \Utils\Session::user('id');
        $addKeys = [
            'friendId' => $friendId,
        ];
        try {
            $this->Friend->save($this->filterXSS([
                'userId' => $userId,
                'status' => 1,
            ]),$addKeys);
            $addKeys['friendId'] = $userId;
            $this->Friend->save($this->filterXSS([
                'userId' => $friendId,
                'status' => 1,
            ]),$addKeys);
        } catch (\PDOException $e) {
            throw new \Utils\RequestException("erreur dans la BDD", 500); //code
        }
        $this->response("SUCCESS", 200);
    }

    /**
     * The user refuse to be friend with a user (who wanna be friend tho)
     * @param  int $friendId The id of someone who will never be the current user friend.
     */
    public function deleteFriend ($friendId) {
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('USER_NOT_LOGGED', 401);
        }
        if(!is_string($friendId) || empty($friendId)){
            throw new \Utils\RequestException('MISSING_FIELDS', 400);
        }
        $userId = \Utils\Session::user('id');
        try {
            $this->Friend->delete($this->filterXSS([
                'userId' => $userId,
                'friendId' => $friendId,
                'friendId' => $userId,
                'userId' => $friendId,
            ]));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException($e, 500); //code
        }
        $this->response("SUCCESS", 200);
    }

    /**
     * The list of aproved friend of a user
     * @param  int $userId the user we want to see the friends list
     */
    public function listFriend ($userId) {
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('USER_NOT_LOGGED', 401);
        }
        if(is_array($userId)){
            if($userId['url'] === 'users/me/friends'){
                $userId = \Utils\Session::user('id');
            }
        }
        $this->filterXSS($userId);
        $result = $this->Friend->find([
            'fields'=> ['user.planetId','friend.friendId','username', 'imagePath', 'avatar.altText','title.honorificTitle'],
            'leftJoin'=> [
              [
                'table' => 'user',
        				'alias' => 'user',
        				'from' => 'id',
        				'to' => 'friendId',
              ],
              [
                'table' => 'user_avatar',
        				'alias' => 'userAvatar',
        				'from' => 'userId',
        				'to' => 'friendId',
                        'JoinTable' => 'friend',
              ],
              [
                'table' => 'avatar',
        				'alias' => 'avatar',
        				'from' => 'id',
        				'to' => 'avatarId',
                        'JoinTable' =>  'userAvatar',
              ],
              [
                'table' => 'user_title',
        				'alias' => 'userTitle',
        				'from' => 'userId',
        				'to' => 'friendId',
                        'JoinTable' =>  'friend',
              ],
              [
                'table' => 'title',
        				'alias' => 'title',
        				'from' => 'id',
        				'to' => 'titleId',
                        'JoinTable' => 'userTitle',
              ],
          ],
            'orderBy' => [
              'key' => 'user.planetId',
      				'order' => 'ASC',
            ],
            'conditions' => [
                'friend.userId' => $userId,
                'friend.status' => 1,
                'userAvatar.currentAvatar' => 1,
                'userTitle.current' => 1,
            ],
        ]);
        $this->response($result, 200);
    }

    /**
     * get all of the people who are willing to become the current user friend
     * @return json list of the users
     */
    public function invitationList () {
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
        $userId = \Utils\Session::user('id');
        $result = $this->Friend->find([
            'fields'=> ['friend.friendId','username', 'imagePath', 'avatar.altText'],
            'leftJoin'=> [
              [
                'table' => 'user',
        				'alias' => 'user',
        				'from' => 'id',
        				'to' => 'friendId',
              ],
              [
                'table' => 'user_avatar',
        				'alias' => 'userAvatar',
        				'from' => 'userId',
        				'to' => 'friendId',
                        'JoinTable' => 'friend',
              ],
              [
                'table' => 'avatar',
        				'alias' => 'avatar',
        				'from' => 'id',
        				'to' => 'avatarId',
                        'JoinTable' =>  'userAvatar',
              ],
          ],
            'orderBy' => [
              'key' => 'user.planetId',
      				'order' => 'ASC',
            ],
            'conditions' => [
                'friend.userId' => $userId,
                'friend.status' => 0,
                'friend.seeker' => 0,
                'userAvatar.currentAvatar' => 1,
            ],
        ]);
        $this->response($result, 200);
    }
}
