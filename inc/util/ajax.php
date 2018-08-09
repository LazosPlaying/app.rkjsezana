<?php

class ajax {

    public function arrayToJson($data, $code = 200){
    	Header('Content-type: application/json');
    	// http_response_code($code);

    	$json = json_encode($array, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    	return $json;
    }

    public function apiPrint($data, $code = 200){
    	Header('Content-type: application/json');
    	http_response_code($code);

    	$array = array(
			'code' => $code,
			'timestamp' => ( time() * 1000),
			'data' => $data
		);

    	echo json_encode($array, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
    }
}
