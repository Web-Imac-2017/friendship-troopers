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
        $userModel = new \Models\User();
        $friendPlanetId = $userModel->findFirst([
            'fields' => ['planetId'],
            'conditions' => [
                'id' => $this->filterXSS($friendId),
            ],
        ]);
        //the one asking for a friend
        try {
            $this->Friend->save($this->filterXSS([
                'userId' => $userId,
                'friendId' => $friendId,
                'friendPlanetId'=> $friendPlanetId['planetId'],
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
                'friendPlanetId'=> $userPlanetId,
                'status' => 0,
                'seeker' => 0,
            ]));
        } catch (\PDOException $e) {
            throw new \Utils\RequestException('something went wrong', 400); //code
        }
    }

    /**
     * The user gladly accept to be friend with a user (who wanna be friend tho)
     * @param  int $friendId the id of the friend the current user is aproving
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
//SELECT planetId, User.id, username FROM friend AS friend
//     LEFT JOIN user AS User ON friend.userId = User.id
//     LEFT JOIN user_avatar AS userAvatar ON friend.userId = userAvatar.userId
//     LEFT JOIN avatar AS Avatar ON userAvatar.avatarId = Avatar.id
//     LEFT JOIN user_title AS userTitle ON friend.userId = userTitle.UserId
//     LEFT JOIN title AS Title ON userTitle.titleId = Title.id
// WHERE friend.status=1
// ORDER BY planetId ASC
        $result = $this->Friend->find([
            'fields'=> ['planetId','User.id','username', 'imagePath', 'avatar.description', 'title.label'],
            'conditions'=>['status'=>1],
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
              [ //friend.userId = userTitle.UserId
                'table' => 'user_title',
        				'alias' => 'userTitle',
        				'from' => 'userId',
        				'to' => 'userId',
                        'JoinTable' =>  'friend',
              ],
              [
                'table' => 'title',
        				'alias' => 'title',
        				'from' => 'id',
        				'to' => 'userId',
                        'JoinTable' => 'userTitle',
              ],
          ],
            'orderBy' => [
              'key' => 'planetId',
      				'order' => 'ASC',
            ],
            'conditions' => ['friend.userId' => $userId,],
        ]);
        $this->response($result, 200);
    }

    public function inviationList(){

    }
}
