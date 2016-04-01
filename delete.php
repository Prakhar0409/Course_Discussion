<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<?php
	foreach (getallheaders() as $name => $value) {
		echo "$name: $value <br/>";
	}
	?>

</body>
</html>