<?php
$formData = '
<form method="post" action="index.php">
	<label for="name">Name: (only your name, no domain)</label>
	<input type="text" id="name" name="name" />
	<label for="ip">Ip:</label>
	<input type="text" id="ip" name="ip" />
	<label for="port">Port:</label>
	<input type="text" id="port" name="port" />
	<input type="submit" name="create" value="Create" />
	</form>';
	
echo $formData;