<?php

class user {
	public function __construct(){
		require_once __DIR__ . '/database.php';
		require_once __DIR__ . '/array.php';
		$dbUtil = new dbManipulate();
		$connUtil = new dbconn();
		$arrUtil = new arrayTool();
	}

	public function amiloged(){
		if ( isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) && is_numeric($_SESSION['u_id']) ){
			return true;
		} else {
			return false;
		}
	}
	public function getSessionStatus(){
		global $dbUtil;
		global $connUtil;
		global $arrUtil;

		if (isset($_SESSION) && !empty($_SESSION)){
			if ( isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) && is_numeric($_SESSION['u_id']) ){
				if ( isset($_SESSION['locked']) && !empty($_SESSION['locked']) && ( $_SESSION['locked'] == 'true' || $_SESSION['locked'] == true ) ){
					return 'locked';
				} else {
					return 'valid';
				}
			} else {
				return 'dead';
			}
		} else {
 			return 'nosession';
		}
	}
	public function userDataById($id = 'fallback'){
		global $dbUtil;
		global $connUtil;
		global $arrUtil;

		if ($id === 'fallback'){
			die('<script>alert("Error; unsupported function call util.users.php -> id not provided! Prosimo obvestite administratorja.");</script>');
		}
		$conn = $connUtil->oopmysqli();
		if ( $stmt = $conn->prepare("SELECT `user_id`, `user_first`, `user_last`, `user_uid`, `user_groups`, `user_email`, `user_personaldata`, `user_signup_date`, `user_signup_ip` FROM `users` WHERE user_id = ?;") ){
			$stmt->bind_param("s", $id);
			$stmt->execute();
			$stmt->store_result();
			if ( $stmt->num_rows == 1 ){
				$returndata = array('exists' => true, 'data' => null);
				$stmt->bind_result($user['id'], $user['first'], $user['last'], $user['uid'], $groups, $user['email'], $personaldata, $user['signup_date'], $user['user_signup_ip']);
				$stmt->fetch();
				$user['groups'] = json_decode($groups);
				$user['personaldata'] = json_decode($personaldata);
				$user['exists']=true;

				$returndata['data'] = $user;
				return $returndata;

			} else {
				return array('exists' => false, 'data' => null);
			}
		} else {
			die('<script>alert("Error; prepared statement failed at util.users.php -> userDataById() -> statement->prepare ! Prosimo obvestite administratorja.");</script>');
		}
	}
}
class getUserIp{
	/**
	* Whether to use proxy addresses or not.
	*
	* As default this setting is disabled - IP address is mostly needed to increase
	* security. HTTP_* are not reliable since can easily be spoofed. It can be enabled
	* just for more flexibility, but if user uses proxy to connect to trusted services
	* it's his/her own risk, only reliable field for IP address is $_SERVER['REMOTE_ADDR'].
	*
	* @var bool
	*/
	protected $useProxy = false;

	/**
	 * List of trusted proxy IP addresses
	 *
	 * @var array
	 */
	protected $trustedProxies = array();

	/**
	* HTTP header to introspect for proxies
	*
	* @var string
	*/
	protected $proxyHeader = 'HTTP_X_FORWARDED_FOR';

	// [...]

	/**
	* Returns client IP address.
	*
	* @return string IP address.
	*/
	public function getIpAddress()
	{
		$ip = $this->getIpAddressFromProxy();
		if ($ip) {
			return $ip;
		}

		// direct IP address
		if (isset($_SERVER['REMOTE_ADDR'])) {
			return $_SERVER['REMOTE_ADDR'];
		}

		return '';
	}

	/**
	 * Attempt to get the IP address for a proxied client
	 *
	 * @see http://tools.ietf.org/html/draft-ietf-appsawg-http-forwarded-10#section-5.2
	 * @return false|string
	 */
	protected function getIpAddressFromProxy()
	{
		if (!$this->useProxy
			|| (isset($_SERVER['REMOTE_ADDR']) && !in_array($_SERVER['REMOTE_ADDR'], $this->trustedProxies))
		) {
			return false;
		}

		$header = $this->proxyHeader;
		if (!isset($_SERVER[$header]) || empty($_SERVER[$header])) {
			return false;
		}

		// Extract IPs
		$ips = explode(',', $_SERVER[$header]);
		// trim, so we can compare against trusted proxies properly
		$ips = array_map('trim', $ips);
		// remove trusted proxy IPs
		$ips = array_diff($ips, $this->trustedProxies);

		// Any left?
		if (empty($ips)) {
			return false;
		}

		// Since we've removed any known, trusted proxy servers, the right-most
		// address represents the first IP we do not know about -- i.e., we do
		// not know if it is a proxy server, or a client. As such, we treat it
		// as the originating IP.
		// @see http://en.wikipedia.org/wiki/X-Forwarded-For
		$ip = array_pop($ips);
		return $ip;
	}
}
