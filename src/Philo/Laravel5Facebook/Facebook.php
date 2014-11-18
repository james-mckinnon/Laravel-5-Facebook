<?php  namespace Philo\Laravel5Facebook;

use Facebook\FacebookRequest;
use Facebook\FacebookRequestException;
use Facebook\FacebookSession;
use Facebook\GraphAlbum;
use Facebook\GraphLocation;
use Facebook\GraphSessionInfo;
use Facebook\GraphUser;
use Facebook\Entities\SignedRequest;

/**
 * Class Facebook
 * @package Philo\Laravel5Facebook
 */
class Facebook {

	/**
	 * @var \Facebook\FacebookSession
	 */
	private $session;

	/**
	 * @param $app
	 */
	function __construct($app)
	{
		FacebookSession::setDefaultApplication($app['config']->get('services.facebook.client_id'), $app['config']->get('services.facebook.client_secret'));
	}

	/**
	 * @param $token
	 * @param \Facebook\Entities\SignedRequest $signedRequest
	 *
	 * @return $this
	 */
	public function createSession($token, SignedRequest $signedRequest = null)
	{
		$this->session = new FacebookSession($token, $signedRequest);

		return $this;
	}

	/**
	 * Create new Facebook request.
	 *
	 * @param string $path
	 * @param string $method
	 * @param null $parameters
	 * @param null $version
	 * @param null $etag
	 *
	 * @return $this
	 * @throws \Facebook\FacebookRequestException
	 */
	public function request($path = '/me', $method = 'GET', $parameters = null, $version = null, $etag = null)
	{
		return (new FacebookRequest($this->session, $method, $path, $parameters = null, $version = null, $etag = null))->execute();
	}

	/**
	 * Return FacebookSession instance
	 *
	 * @return Facebook\FacebookSession
	 */
	public function getSession()
	{
		return $this->session;
	}

	/**
	 * Return user
	 *
	 * @param string $id
	 *
	 * @return \Facebook\GraphUser
	 */
	public function user($id = '/me')
	{
		return $this->request('/' . $id)
			->getGraphObject(GraphUser::className());
	}

	/**
	 * Return location
	 *
	 * @param string $id
	 *
	 * @return \Facebook\GraphLocation
	 */
	public function location($id = '/me')
	{
		return $this->request('/' . $id)
			->getGraphObject(GraphLocation::className());
	}

	/**
	 * @param string $path
	 *
	 * @return array
	 */
	public function albums($path = '/me/albums')
	{
		return $this->request($path)
			->getGraphObjectList();
	}

	/**
	 * @param $id
	 *
	 * @return \Facebook\GraphAlbum
	 */
	public function album($id)
	{
		return $this->request('/' . $id)->getGraphObject(GraphAlbum::className());
	}

}