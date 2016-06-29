<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/metro-bootstrap.css">
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="../js/jquery.widget.min.js"></script>
	<script src="../min/metro.min.js"></script>
	<script src = '../js/metro-tab-control.js'></script>
	<script src = '../js/metro-accordion.js'></script>
	<link rel="stylesheet" href="../css/workflow.css">
	<script src = '../js/workflow.js'></script>
</head>
<body>
	<?php
		if(isset($_POST['_submit'])){
			include_once "view_function.php";
			$whole_json = json_decode($_POST['json'], true);
			$miao = array();
			$file = write_file($whole_json['cluster_setup']['input'], "temp_protein_expression");
			command_line($_POST, $file);
			$whole_json["cluster_setup"]["value"] = $file;
	?>
	<form action = '../home.php' method = 'POST' target = '_parent' id = 'setup'>
		<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($whole_json); ?>'>
	</form>
	<script>
		document.getElementById("setup").submit();
	</script>
	<?php
		}
	?>
	<?php
		if(isset($_POST['INPUT'])){
			$receive_json = json_decode($_POST['INPUT'], true);
			$receive_json['step'] = "cluster_setup";
			$id = $receive_json["cluster_setup"]["input"];
			include_once "cluster_setup_view.php";
		}
	?>
</body>
</html>