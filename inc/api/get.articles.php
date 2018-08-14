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
			'page' => null,
			'byid' => null,
			'bytag' => null
		),
		'limit' => null,
		'page' => null,
		'byid' => null,
		'bytag' => null,
		'offset' => null,
		'total' => null,
		'messages' => array()
	),
	'articles' => array()
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
		if ( (isset($_GET['limit'])&&!empty($_GET['limit'])&&is_numeric($_GET['limit']))||(isset($_POST['limit'])&&!empty($_POST['limit'])&&is_numeric($_POST['limit'])) ){

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

		if ( (isset($_GET['page'])&&!empty($_GET['page'])&&is_numeric($_GET['page']))||(isset($_POST['page'])&&!empty($_POST['page'])&&is_numeric($_POST['limit'])) ){

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


		if ( (isset($_GET['byid'])&&!empty($_GET['byid'])&&is_numeric($_GET['byid']))||(isset($_POST['byid'])&&!empty($_POST['byid'])&&is_numeric($_POST['byid'])) ){

			$data['info']['is_set']['byid'] = true;
			if (isset($_POST['byid'])){
				$data['info']['byid'] = $_POST['byid'];
			} elseif (isset($_GET['byid'])){
				$data['info']['byid'] = $_GET['byid'];
			}

		} else {
			$data['info']['is_set']['byid'] = false;
			$data['info']['byid'] = null;
		}

		if ( ( isset($_GET['bytag']) && !empty($_GET['bytag']) ) || ( isset($_POST['bytag']) && !empty($_POST['bytag']) ) ){

			$data['info']['is_set']['bytag'] = true;
			if (isset($_POST['bytag'])){
				$data['info']['bytag'] = $_POST['bytag'];
			} elseif (isset($_GET['bytag'])){
				$data['info']['bytag'] = $_GET['bytag'];
			}

		} else {
			$data['info']['is_set']['bytag'] = false;
			$data['info']['bytag'] = null;
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
	if ($data['info']['is_set']['byid'] === true && $data['info']['is_set']['bytag'] === false){

		if ( $stmt = $conn->prepare("SELECT `article_id`, `article_publisher_id`, `article_title`, `article_content`, `article_reactions`, `article_time`, `article_tags` FROM `articles` WHERE article_id=? LIMIT 1") ){

			$stmt->bind_param("i", $data['info']['byid']);
			$stmt->execute();
			$stmt->store_result();

			$data['info']['success']['query'] = true;

			if ($stmt->num_rows >= 1){
				$stmt->bind_result($art_id, $art_publisher_id, $art_title, $art_content, $art_reactions, $art_time, $art_tags);
				while ( $stmt->fetch() ){
					$data['info']['success']['fetch'] = true;
					$tags = json_decode($art_tags, true);
					$reactions = json_decode($art_reactions, true);
					array_push($data['articles'],
						array(
							'id' => $art_id,
							'publisher_id' => $art_publisher_id,
							'title' => $art_title,
							'content' => $art_content,
							'reactions' => $reactions,
							'time' => $art_time,
							'tags' => $tags
						)
					);
				}

			} else {
				array_push($data['info']['messages'], 'We could not find an article with that id!');
				$data['info']['success']['fetch'] = false;
			}
		} else {
			array_push($data['info']['messages'], 'Prepared statement failed @ byId section!');
			$data['info']['success']['fetch'] = false;
			$data['info']['success']['query'] = false;
		}

	} elseif ($data['info']['is_set']['byid'] === false && $data['info']['is_set']['bytag'] === true) {
		if ( $stmt = $conn->prepare('SELECT `article_id`, `article_publisher_id`, `article_title`, `article_content`, `article_reactions`, `article_time`, `article_tags` FROM `articles` WHERE json_contains( article_tags, ?) ORDER BY `article_id` DESC LIMIT ? OFFSET ?;') ){

			$temp1 = '["' . $data['info']['bytag'] . '"]';
			$temp2 = $data['info']['limit'];
			$temp3 = ($data['info']['limit'] * ($data['info']['page'] - 1) );

			$data['info']['offset'] = $temp2;

			$stmt->bind_param("sii", $temp1, $temp2, $temp3);
			$stmt->execute();
			$stmt->store_result();

			$data['info']['success']['query'] = true;

			if ($stmt->num_rows >= 1){
				$stmt->bind_result($art_id, $art_publisher_id, $art_title, $art_content, $art_reactions, $art_time, $art_tags);
				while ( $stmt->fetch() ){
					$data['info']['success']['fetch'] = true;
					$tags = json_decode($art_tags, true);
					$reactions = json_decode($art_reactions, true);
					array_push($data['articles'],
						array(
							'id' => $art_id,
							'publisher_id' => $art_publisher_id,
							'title' => $art_title,
							'content' => $art_content,
							'reactions' => $reactions,
							'time' => $art_time,
							'tags' => $tags
						)
					);
				}

			} else {
				$data['info']['success']['fetch'] = false;
				$data['info']['success']['query'] = false;
			}
			if ( $stmt = $stmt = $conn->prepare("SELECT `article_id` FROM `articles`  ORDER BY `article_id`;") ){

				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows == 1){

					$stmt->bind_result($t_name, $t_engine, $t_version, $t_format, $t_rows, $t_avg_length, $t_dat_length, $t_max_dat_length, $t_index_length, $t_dat_free, $t_ai, $t_create_time, $t_update_time, $t_check_time, $t_collation, $t_checksum, $t_options, $t_comment);
					while ( $stmt->fetch() ){
						$data['info']['total'] = $t_rows;
					}

				}
			}
		} else {
			$data['info']['success']['query'] = false;
		}

	} elseif ($data['info']['is_set']['byid'] === false && $data['info']['is_set']['bytag'] === false) {

		if ( $stmt = $conn->prepare("SELECT `article_id`, `article_publisher_id`, `article_title`, `article_content`, `article_reactions`, `article_time`, `article_tags` FROM `articles`  ORDER BY `article_id` DESC LIMIT ? OFFSET ?;") ){

			$temp1 = $data['info']['limit'];
			$temp2 = ($data['info']['limit'] * ($data['info']['page'] - 1) );

			$data['info']['offset'] = $temp2;

			$stmt->bind_param("ii", $temp1, $temp2);
			$stmt->execute();
			$stmt->store_result();

			$data['info']['success']['query'] = true;

			if ($stmt->num_rows >= 1){
				$stmt->bind_result($art_id, $art_publisher_id, $art_title, $art_content, $art_reactions, $art_time, $art_tags);
				while ( $stmt->fetch() ){
					$data['info']['success']['fetch'] = true;
					$tags = json_decode($art_tags, true);
					$reactions = json_decode($art_reactions, true);
					array_push($data['articles'],
						array(
							'id' => $art_id,
							'publisher_id' => $art_publisher_id,
							'title' => $art_title,
							'content' => $art_content,
							'reactions' => $reactions,
							'time' => $art_time,
							'tags' => $tags
						)
					);
				}

			} else {
				$data['info']['success']['fetch'] = false;
				$data['info']['success']['query'] = false;
			}
			if ( $stmt = $conn->prepare("SHOW TABLE STATUS WHERE name=?;") ){

				$temp1 = 'articles';
				$stmt->bind_param("s", $temp1);
				$stmt->execute();
				$stmt->store_result();

				if ($stmt->num_rows == 1){

					$stmt->bind_result($t_name, $t_engine, $t_version, $t_format, $t_rows, $t_avg_length, $t_dat_length, $t_max_dat_length, $t_index_length, $t_dat_free, $t_ai, $t_create_time, $t_update_time, $t_check_time, $t_collation, $t_checksum, $t_options, $t_comment);
					while ( $stmt->fetch() ){
						$data['info']['total'] = $t_rows;
					}

				}
			}
		} else {
			$data['info']['success']['query'] = false;
		}

	} else {
		array_push($data['info']['messages'], '/!\ Client error! Provided data is not valid.');
	}
	$conn->close();
}


$statusData['data'] = $data;
