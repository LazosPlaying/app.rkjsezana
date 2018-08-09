<?php
class sessionCheck {
	private function getSession(){
		return $_SESSION;
	}
	public function amiloged(){
		if ( isset($_SESSION['u_id']) && !empty($_SESSION['u_id']) && is_numeric($_SESSION['u_id']) ){
			return true;
		} else {
			return false;
		}
	}
}
