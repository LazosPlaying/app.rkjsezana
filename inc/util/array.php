<?php
class arrayTool{

	public function arrayToString($a){
		return serialize($a);
	}

	public function stringToArray($a){
		return unserialize($a);
	}

	public function arrayToJson($array = "not given"){
	    if ($array == "not given"){
	        $array = array(
	            "status" => "error",
	            "error" => "The given value is missing"
	        );
	    } elseif (!is_array($array)) {
	        $array = array(
	            "status" => "error",
	            "error" => "The processed value is not an data array"
	        );
	    }

	    return json_encode($array, JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
	}

}
