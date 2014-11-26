<?php
	function security($variavel){
		$variavel = trim($variavel);
		$variavel = stripslashes($variavel);
		$variavel = htmlspecialchars($variavel);

		return $variavel;
	}
?>
