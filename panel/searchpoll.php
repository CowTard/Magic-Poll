<?php
	require 'dashboard_header.php';

?>


<div class="icon"></div>
	<h1 class="title">Search for a poll</h1>
	
	<div class="col-md-2 col-md-offset-4">
		<input id="search" type="text" />
		
		<ul id="results" class="dropdown-menu" role="menu"></ul>
	</div>

<?php
	require 'dashboard_footer.php';
?>