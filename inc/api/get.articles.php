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
		if (!empty($_POST)){
			$data['info']['is_set']['post'] = true;
		} else {
			$data['info']['is_set']['post'] = false;
		}

		if (!empty($_GET)){
			$data['info']['is_set']['get'] = true;
		} else {
			$data['info']['is_set']['get'] = false;
		}

}
{
		if ( !empty($_GET['limit']) && is_numeric($_GET['limit']) ){

			$data['info']['is_set']['limit'] = true;
			$data['info']['limit'] = ($_GET['limit'] <= 50) ? $_GET['limit'] : 20;
		} else {
			$data['info']['is_set']['limit'] = false;
			$data['info']['limit'] = 20;
		}

		if ( !empty($_GET['page']) && is_numeric($_GET['page']) ){

			$data['info']['is_set']['page'] = true;
			$data['info']['page'] = ($_GET['page'] <= 999) ? $_GET['page'] : 1;

		} else {
			$data['info']['is_set']['page'] = false;
			$data['info']['page'] = 1;
		}


		if ( !empty($_GET['byid']) && is_numeric($_GET['byid']) ){

			$data['info']['is_set']['byid'] = true;
			$data['info']['byid'] = $_GET['byid'];

		} else {
			$data['info']['is_set']['byid'] = false;
			$data['info']['byid'] = null;
		}

		if ( !empty($_GET['bytag']) ){

			$data['info']['is_set']['bytag'] = true;
			$data['info']['bytag'] = $_GET['bytag'];

		} else {
			$data['info']['is_set']['bytag'] = false;
			$data['info']['bytag'] = null;
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
			$data['info']['success']['fetch'] = false;
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
			$data['info']['success']['fetch'] = false;
			$data['info']['success']['query'] = false;
		}

	} else {
		array_push($data['info']['messages'], '/!\ Client error! Provided data is not valid.');
	}
	$conn->close();
}


$statusData['data'] = $data;
