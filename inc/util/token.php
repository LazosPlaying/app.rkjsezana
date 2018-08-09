<?php

class token{
	public function create($user_id, $type){
		require_once __DIR__ . '/database.php';
		require_once __DIR__ . '/tool.php';
		$dbConn = new dbConn();
		$dbUtil = new dbManipulate();
		$toolUtil = new tool();

		$token = $toolUtil->rndString(30);
		$statusArr=array(
			'is_success' => false,
			'token' => $token,
			'message' => "Something went wrong when inserting data into the database"
		);


		if (preg_match('/confirm_email/', $type)){
			$tempArr = array(
				'token_user_id' => $user_id,
				'token_token' => $token,
				'token_type' => $type,
				'token_expiration' => (time() + 86400) // NOW + 24 HOURS
			);
			$temp1 = $dbUtil->insert($tempArr, 'users_tokens');
			if ($temp1['is_success']===true){
				$statusArr['is_success']=true;
				$statusArr['message']="Successfully inserted the token into the database.";
			}
		} else {
			$statusArr['message'] = 'Passed token type is not supported. Please check the utilDocs.';
		}


		return $statusArr;
	}
	public function get($user_id){

	}
	public function check($token){
		require_once __DIR__ . '/database.php';
		require_once __DIR__ . '/tool.php';
		$dbConn = new dbConn();
		$dbUtil = new dbManipulate();
		$toolUtil = new tool();

		$conn = $dbConn->oopmysqli();

		$statusArr=array(
			'is_success' => false,
			'is_existing' => false,
			'token' => array(
				'id' => null,
				'user_id' => null,
				'token' => $token,
				'type' => null,
				'expiration' => null,
			),
			'message' => "Something went wrong when querying data from the database"
		);

		if ( $stmt = $conn->prepare("SELECT `token_id`, `token_user_id`, `token_token`, `token_type`, `token_expiration` FROM `users_tokens` WHERE token_token = ?") ){

			$stmt->bind_param("s", $token);
			$stmt->execute();
			$stmt->store_result();
			if ($stmt->num_rows == 1){
				$stmt->bind_result($statusArr['token']['id'], $statusArr['token']['user_id'], $statusArr['token']['token'], $statusArr['token']['type'], $statusArr['token']['expiration']);
				$stmt->fetch();
				$statusArr['is_success'] = true;
				$statusArr['is_token'] = true;
				$statusArr['message'] = 'Successfully queried token data';
			} else {
				$statusArr['is_success'] = true;
				$statusArr['is_token'] = false;
				$statusArr['message'] = 'Token does not exist';
			}
		} else {
			$statusArr['is_success'] = false;
			$statusArr['is_token'] = false;
			$statusArr['message'] = 'Prepared statement failed at util/token.php -> check()';
		}
 		return $statusArr;
	}
	public function confirm(){

	}
}
