<?php
$data = array(
	'info' => array(
		'success' => array(
			'query' => null,
			'fetch' => null
		),
		'is_set' => array(
			'post' => null,
			'get' => null,
			'limit' => null,
			'page' => null
		),
		'limit' => null,
		'page' => null,
		'offset' => null,
		'messages' => array()
	),
	'updates' => array()
);
{
	if (isset($_GET)&&!empty($_GET)){
		$data['info']['is_set']['get'] = true;
	} else {
		$data['info']['is_set']['get'] = false;
	}

	if (isset($_POST)&&!empty($_POST)){
		$data['info']['is_set']['post'] = true;
	} else {
		$data['info']['is_set']['post'] = false;
	}
}
{
	if ( (isset($_GET['limit'])&&!empty($_GET['limit']))||(isset($_POST['limit'])&&!empty($_POST['limit'])) ){

		$data['info']['is_set']['limit'] = true;
		if (isset($_POST['limit'])){
			$data['info']['limit'] = $_POST['limit'];
		} elseif(isset($_GET['limit'])){
			$data['info']['limit'] = $_GET['limit'];
		}

	} else {
		$data['info']['is_set']['limit'] = false;
		$data['info']['limit'] = 20;
	}

	if ( (isset($_GET['page'])&&!empty($_GET['page']))||(isset($_POST['page'])&&!empty($_POST['page'])) ){

		$data['info']['is_set']['page'] = true;
		if (isset($_POST['page'])){
			$data['info']['page'] = $_POST['page'];
		} elseif(isset($_GET['page'])){
			$data['info']['page'] = $_GET['page'];
		}

	} else {
		$data['info']['is_set']['page'] = false;
		$data['info']['page'] = 1;
	}
}
{
	if ($data['info']['limit'] > 50){
		$data['info']['limit'] = 20;
	}
	if ($data['info']['page'] > 200){
		$data['info']['page'] = 1;
	}
}
{
	if ( $stmt = $conn->prepare("SELECT `update_id`, `update_time`, `update_title`, `update_content`, `update_findoutmore`, `update_type`, `update_tags` FROM `updates`  ORDER BY `update_id` DESC LIMIT ? OFFSET ?;") ){

		$temp1 = $data['info']['limit'];
		$temp2 = ($data['info']['limit'] * ($data['info']['page'] - 1) );

		$data['info']['offset'] = $temp2;

		$stmt->bind_param("ii", $temp1, $temp2);
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows >= 1){
			$data['info']['success']['query'] = true;
			$stmt->bind_result($upd_id, $upd_time, $upd_title, $upd_content, $upd_findoutmore, $upd_type, $upd_tags);
			while ( $stmt->fetch() ){
				$data['info']['success']['fetch'] = true;
				$tags = json_decode($upd_tags, true);
				array_push($data['updates'],
					array(
						'id' => $upd_id,
						'time' => $upd_time,
						'title' => $upd_title,
						'content' => $upd_content,
						'findoutmore' => $upd_findoutmore,
						'type' => $upd_type,
						'tags' => $tags
					)
				);
			}

		} else {
			$data['info']['success']['fetch'] = false;
			$data['info']['success']['query'] = false;
		}
	} else {
		$data['info']['success']['query'] = false;
	}
	$conn->close();
}


$statusData['data'] = $data;
