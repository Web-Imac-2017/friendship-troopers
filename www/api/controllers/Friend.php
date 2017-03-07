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
        //the one asking for a friend
        try {
            $this->Friend->save($this->filterXSS([
                'userId' => $userId,
                'friendId' => $friendId,
                'status' => 0,
                'seeker' => 1,
            ]));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('something went wrong', 400); //code
        }
        // the one being asked
        try {
            $this->Friend->save($this->filterXSS([
                'userId' => $friendId,
                'friendId' => $userId,
                'status' => 0,
                'seeker' => 0,
            ]));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('something went wrong', 400); //code
        }
    }

    /**
     * The user gladly accept to be friend with a user (who wanna be friend tho)
     * @param  int $friendId The id of the friend the current user is aproving
     */
    public function confirmFriend($friendId){
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
    }

    /**
     * The user refuse to be friend with a user (who wanna be friend tho)
     * @param  int $friendId The id of someone who will never be the current user friend.
     */
    public function refuseFriend($friendId){
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
    }

    /**
     * The list of aproved friend of a user
     * @param  int $userId the user we want to see the friends list
     */
    public function viewListFriend($userId){
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
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

    public function invitationList(){
        if (\Utils\Session::isLoggedIn() == NULL) {
            throw new \Utils\RequestException('Vous n\'êtes pas connecté', 401);
        }
        $userId = \Utils\Session::user('id');
        $result = $this->Friend->find('');
    }
}
