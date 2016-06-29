<!DOCTYPE html>
<html>
<head>
	<script src='js/javascript.js'></script>
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src='js/highcharts.js'></script>
	<script src='js/exporting.js'></script>
	<script src = 'js/graph_function.js'></script>
    <script src="../js/jquery.widget.min.js"></script>
    <script src="../min/metro.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.css">
	<script>
		function Faction(target, varable){
			document.forms[target].elements['OUTPUT'].value = varable;
			document.getElementById(target).submit();
		}
	</script>
	<style>
		div.proceed {
			float: right;
		}
		
		div.back {
			float: left;
		}
	</style>
</head>
<body class = 'metro'>
<?php	
	if(isset($_POST['submit'])){
		$section = $_POST['section'];
		$receive_json = json_decode($_POST['ID'], true);
		$graph_json = $receive_json['draw_graph'][$section]['input'];
		$data_in_graph = $graph_json[0]["series"];
		$data = array();
		for($i = 0; $i < count($data_in_graph); $i += 2){
			$data[] = $data_in_graph[$i]["name"];
		}
		$id = implode(",", $data);
		$receive_json["draw_graph"][$section]["value"] = $id;
?>	
		<form action = '../home.php' method = "POST" target = "_parent" id  = 'form'>
			<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($receive_json); ?>'>
		</form>
		<script>
			document.getElementById('form').submit();
		</script>
<?php
	}
?>
<div>
<?php
	// Initial part
	include_once "graph_functions.php";
	if(isset($_POST['INPUT'])){
		$json = json_decode($_POST['INPUT'], true);
		$json['step'] = "draw_graph";
		$section = $json['draw_graph']['data'];
		$data = $json['draw_graph'][$section]['input'];
		graph_by_javascript($data);
		// form to submit the textarea to other page
?>
</div>
	<div class = 'button_bfd'>
	<div class = 'back'>
		<form action = '../home.php' method = 'POST' target = '_parent'>
			<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($json); ?>'>
			<input class = 'button large bg-green' type = 'submit' name = 'back' value = '&lt;&lt;'>
		</form>
	</div>
	<div class = 'proceed'>	
		<form action = 'graph.php' method = 'POST' target = '_self'>
			<input type = "hidden" name = 'ID' value = '<?php echo json_encode($json); ?>'>
			<input type = 'hidden' name = 'section' value = '<?= $section; ?>'>
			<input  id = 'miao' class = 'button large bg-green' type = 'submit' name = 'submit' value = '&gt;&gt;'>
		</form>
	</div>
	</div>
<?php
		if($section == $json["draw_graph"]["overall"]){
?>
		<script>
			document.getElementById("miao").disabled = true;
		</script>
<?php
		}
	}
?>
	
</body>
</html>
