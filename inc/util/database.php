<?php
require_once __DIR__ . '/settings.nogit.php';
class dbconn extends settingsMySql {

	// MySql credentials are imported from settings.nogit.php

	public function mysqli(){
		$conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (mysqli_connect_errno()){
		    die("Failed to connect to database: ".mysqli_connect_error()."<br/> Inform the administrator");
		}
		mysqli_query($conn, "SET NAMES utf8");
		mysqli_set_charset($conn,"utf8");
		return $conn;
	}

	public function pdo(){
		$dsn = "mysql:dbname=$this->dbname;host=$this->dbhost;charset=utf8";
		try {
		    $pdo = new PDO($dsn, $this->dbuser, $this->dbpass);
		    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
		    die("Failed to connect to the database: ".$e."<br/> Inform an administrator");
		    exit();
		}
		return $pdo;
	}

	public function oopmysqli(){
		$conn = new mysqli($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
		if (mysqli_connect_errno()){
		    die("Failed to connect to database: ".mysqli_connect_error()."<br/> Inform the administrator");
		}
		$conn->query("SET NAMES utf8");
		$conn->set_charset("utf8");
		return $conn;
	}
}

class dbManipulate{
	private function refValues($arr){
		if (strnatcmp(phpversion(),'5.3') >= 0)
		{
			$refs = array();
			foreach($arr as $key => $value)
				$refs[$key] = &$arr[$key];
			return $refs;
		}
		return $arr;
	}
	public function insert($dataarray='fallback',$table='fallback'){
		if ( $dataarray === 'fallback' || gettype($dataarray)!='array' || empty($dataarray) || $table === 'fallback' ){
			return array(
				'is_success' => false,
				'message' => 'One or more parameters are incorrectly provided at util.database.php -> dbManipulate -> insert ! Please inform an administrator.'
			);
		} else {
			$data = array('key'=>array(),'dat'=>array(),'type'=>array());
			foreach ($dataarray as $key => $dat) {
				array_push($data['key'], $key);
				array_push($data['dat'], $dat);
				switch (gettype($dat)) {
					case 'boolean':
						array_push($data['type'], 's');
						break;
					case 'integer':
						array_push($data['type'], 'i');
						break;
					case 'double':
						array_push($data['type'], 'd');
						break;
					case 'string':
						array_push($data['type'], 's');
						break;
					default:
						return array(
							'is_success' => false,
							'message' => 'Something went wrong at util.database.php -> dbManipulate -> insert -> getDataType (`'.gettype($dat).'`)! <br>Please inform an administrator.'
						);
				}
			}


			if (count($data['key'])) {
				$dbconn = new dbconn();
			    $sql = 'INSERT INTO '.$table.' (';

				foreach ($data['key'] as $temp1 => $temp2) {
			        $sql .= ' '.$temp2.',';
			    }
				$sql = substr($sql, 0, -1);
				$sql .= ') VALUES (';
				foreach ($data['dat'] as $temp1 => $temp2) {
			        $sql .= '?,';
			    }
				$sql = substr($sql, 0, -1);
			    $sql .= ');';

				$conn = $dbconn->oopmysqli();
				/* create a prepared statement */
				if ($stmt = $conn->prepare($sql)) {
					/* bind parameters for markers */
				    $params = array_merge(array(str_repeat('s', count($data['key']))), array_values($data['dat']));
				    call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));
				    /* execute query */
				    $stmt->execute();
				    /* close statement */
				    $stmt->close();
					return array(
						'is_success' => true,
						'message' => 'Database manipulation successful.'
					);
				} else {
					return array(
						'status' => false,
						'message' => 'Error; prepared statement failed at util.database.php -> dbManipulate -> insert -> statement->prepare ! Please inform an administrator.'
					);
					return false;
				}
				/* close connection */
				$conn->close();

			}
		}
	}
	public function select($tabela='fallback',$pogoji='fallback'){
		if ($tabela=='fallback'||empty($tabela)||$pogoji=='fallback'||empty($pogoji)){
			die('<script>alert("Error: one or more parameters were not provided or were empty when calling the function at: util.database.php -> select -> mainCheck ! Please inform an administrator.");</script>');
		} else {

		}
	}
}
