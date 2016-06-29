<!DOCTYPE html>
<html lang = "en">
<head>
	<style>
		body{
			font-family:font-file-76604;
			font-style:italic;
			font-weight:300;
		}
		
		div.container {
			width: 80%;
			margin: 0 auto;
			border: 2 solid grey;
		}
		
		form {
			border : 2 solid grey;
		}
	</style>
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="../js/jquery.widget.min.js"></script>
    <script src="../min/metro.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.css">
</head>
<body class = 'metro'>
	<?php
		if(isset($_POST['submit'])){
			include_once "buid_json.php";
			$json = build_json(array($_POST['ID']), "temp_protein_expression");
			$kaka = array();
			$kaka['step'] = "search";
			$kaka["search"]["value"] = $json;
			//echo json_encode($kaka);
	?>
		<form action = '../home.php' method = 'POST' id = 'form' target = '_parent'>
			<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($kaka); ?>'>
		</form>
		<script>
			document.getElementById('form').submit();
		</script>
	<?php
		}
	?>
<div class = 'container'>
	<form action="search.php" method="post" target = '_self'>
		<fieldset>
		<legend><label for = 'ID'><b>Please type proteins Id here:</b></label></legend>
		<div class = "input-control textarea">
			<textarea id = 'ID' name = 'ID' cols = '60' rows = '27' required placeholder = "For example: AT1G09180.1,AT5G45380.1,AT3G08710.1,AT5G24840.1,AT4G35600.1"></textarea>
		</div>
		<input class = 'bg-green button large' type = 'submit' name = 'submit' value = "Let's draw!!">
		</fieldset>
	</form>
</div>
</body>
</html>
