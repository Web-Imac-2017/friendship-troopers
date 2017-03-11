<?php
/**
* ////////////////////////////
* @var CommentController
* ////////////////////////////
*/
namespace Controllers;

class Comment extends Controller {

	/**
	 * Load the main model
	 */
	public function __construct() {
		$this->loadModel('Comment');
	}

	/**
	* list comments for a publication. Show the first one, then the 5 next etc.
	* @param  int 		$planetId 			planet id passed by road
	* @param  int 		$publicationId 	publication id passed by road
	* @param  array 	$get 						associativ array passed by method get (datas)
	* @return [type] 	[] 							[description]
	*/
	public function list ($planetId, $publicationId, $get) {
		if (\Utils\Session::user('planetId') !== $planetId) {
			throw new \Utils\RequestException('vous n\'appartenez pas a cette planete !', 403);
		}

		$offset = +($get['offset'] ?? 0);
		$limit = +($get['limit'] ?? 1);
		if ($limit > 10) {
			throw new \Utils\RequestException('limit trop elevee', 416);
		}

		$request = $this->Comment->find([
			'fields' => [
				'DISTINCT comment.id', 'comment.content', 'comment.publishDate', 'comment.userId', 'comment.modified',
				'user.username', 'listAvatar.imagePath',
			],
			'leftJoin' => [
				[
					'table' => 'publication',
					'alias' => 'publication',
					'from' => 'id',
					'to' => 'publicationId',
				],
				[
					'table' => 'user',
					'alias' => 'user',
					'from' => 'id',
					'to' => 'userId',
				],
				[
					'table' => 'user_avatar',
					'alias' => 'avatar',
					'from' => 'userId',
					'to' => 'id',
					'JoinTable' => 'user',
				],
				[
					'table' => 'avatar',
					'alias' => 'listAvatar',
					'from' => 'id',
					'to' => 'avatarId',
					'JoinTable' => 'avatar',
				],
			],
			'conditions' => [
				'avatar.currentAvatar' => 1,
				'publicationId' => $publicationId,
			],
			'limit' => "$offset, $limit",
			'orderBy' => [
			'key' => 'publishDate',
			'order' => 'DESC',
			],
		]);

		$offset = $offset + $limit;
		$listUrl = \Utils\Router\Router::url('planets.posts.comments.list', [
			'planet' => $planetId,
			'publicationId' => $publicationId,
		]);
		$this->response($request, 200, [
			'Link' => "\"$listUrl?offset=$offset&limit=$limit\"; rel=\"next\", \"$listUrl?offset=$offset&limit=$limit\"; rel=\"last\"",
		]);
	}

	/**
	* Create a comment on a publication. Accessible by administrators and the "author" user only.
	* @param  int 		$planet 			planet id passed by road
	* @param  int 		$publication 	publication id passed by road
	* @param  array 	$post 				assosiativ array passed by method post (datas)
	* @return [type] 	[] 						[description]
	*/
	public function create ($planet, $publication, $post) {
		if (!\Utils\Session::isLoggedIn()) {
			throw new \Utils\RequestException('operation reservee aux membres', 401);
		}

		if (\Utils\Session::user('roleId') === 3 && $post['publicationType']) {
			throw new \Utils\RequestException('cannot update publicationType as user', 403);
		}

		$userId = \Utils\Session::user('id');
		$required = ['content'];
		if (!empty($this->checkRequired($required, $post))) {
			throw new \Utils\RequestException('champ manquant', 400);
		}
		$commentModel = new \Models\Comment();
		try {
			$id = $this->Comment->save($this->filterXSS([
				'content' => $post['content'],
				'userId' => $userId,
				'publicationId' => $publication,
			]));
		} catch (\PDOException $e) {
			$this->response([
				'error' => $e->getMessage(),
			], 500);

			$this->response([
				'commentId' => $id,
				], 201, [
					'Location' => \Utils\Router\Router::url('planets.posts.comment.view', [
					'planet' => $planet,
					'publicationId' => $publication,
					'id' => $id,
				]),
			]);
		}
	}

	/**
	* Update a comment. Accessible by administrators and the "author" user only.
	* @param  int 		$planetId 			planet id passed by road
	* @param  int 		$publicationId 	publication id passed by road
	* @param  int 		$id 						comment id passed by road
	* @param  array 	$patches 				assosiativ array passed by method patch (datas)
	* @return [type] 	[] 							[description]
	*/
	public function update ($planetId, $publicationId, $id, $patches) {
		if (!\Utils\Session::isLoggedIn()) {
			throw new \Utils\RequestException('operation reservee aux membres', 401);
		}

		$userId = \Utils\Session::user('id');
		$commentUserId = $this->Comment->findFirst([
			'fields' => 'userId',
			'conditions' => [
				'publicationId' => $publicationId,
				'id' => $id,
			],
		]);

		if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $commentUserId) {
			throw new \Utils\RequestException('action reservee aux administeurs', 403);
		}

		var_dump($patches);
		$updates = [
			'id' => $id,
			'publishDate' => Date('Y-m-d H:i:s'),
			'modified' => true
		];
		foreach ($patches as $patch) {
			switch ($patch['op']) {
				case 'replace':
					$updates[explode('/',$patch['path'])[1]] = $patch['value'];
					break;
				default:
					throw new \Utils\RequestException('bad op', 400);
			}
		}
		$this->Comment->save($this->filterXSS($updates));
	}

	/**
	* Delete a comment. Accessible by administrators and the "author" user only.
	* @param  int 		$planetId 			planet id passed by road
	* @param  int 		$publicationId 	publication id passed by road
	* @param  int 		$id 						comment id passed by road
	* @param  date 		$date 					comment id passed by road
	* @param  array 	$delete 				assosiativ array passed by method delete (datas)
	* @return [type] 	[] 							[description]
	*/
	public function delete ($planetId, $publicationId, $id, $date, $delete) {
		if (!\Utils\Session::isLoggedIn()) {
			throw new \Utils\RequestException('operation reservee aux membres', 401);
		}

		$userId = \Utils\Session::user('id');
		$commentUserId = $this->Comment->findFirst([
			'fields' => 'userId',
			'conditions' => [
				'publicationId' => $publicationId,
				'publishDate' => $date,
				'id' => $id,
			],
		]);

		if (!in_array(\Utils\Session::user('roleId'), [1, 2]) && $userId != $commentUserId) {
			throw new \Utils\RequestException('action reservee aux administeurs', 403);
		}

		$this->loadModel('Comment');

		$this->Comment->delete([
			'commentId' => $id,
		]);

		$this->Publication->delete([
			'id' => $id,
		]);

		$this->response(null, 204);
	}
}
