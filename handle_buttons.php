<?php  
	if (isset($_SESSION['user'])) {
		$userButton = '';
	} else {
		$userButton = 'style="display: none;"';
	}
	if (isset($_SESSION['admin'])) {
		$adminButton = '';
	} else {
		$adminButton = 'style="display: none;"';
	}
?>