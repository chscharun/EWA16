<?php header ("Content-type: text/html"); ?>
<!DOCTYPE html>
<html lang="de">	
<head>
    <meta charset="UTF-8" />
        <title>Umgebungsvariablen</title>
    </head>
    <body>
		<h2>Umgebungsvariablen</h2>
	    	<pre>
<?php
			 foreach($_ENV as $key => $value) {
				echo "$key=$value\n";
			 }
?>
		</pre>
	</body>
	</html>