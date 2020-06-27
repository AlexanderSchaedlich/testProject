<?php  
	function escapeCharacters($string) {
		return htmlentities($string, ENT_QUOTES, "UTF-8");
	}
?>