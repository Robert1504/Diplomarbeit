<?php
	function conn() {
		$connected_1 = @fsockopen("www.orf.at", 443);
		$connected_2 = @fsockopen("www.google.com", 443);
		
		if ($connected_1 || $connected_2) {
			$isit = true;
		}
		else {
			$isit = false;
		}
		return $isit;
	}
	
	if (conn() == 1) {
		echo "connected";
	}
	else {
		echo "not connected";
	}
?>