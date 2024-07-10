<?php 

	function msg($msg, $color) {
		$onclick = "this.parentElement.style.display='none'";
		$content = "<p class='msg $color'>$msg <span class='msgdismiss' onclick=$onclick>&#10006;</span></p>";
		return $content;
	}

 ?>