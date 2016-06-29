<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="../css/metro-bootstrap.css">
	<script src = "http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="../js/jquery.widget.min.js"></script>
	<script src="../min/metro.min.js"></script>
	<link rel="stylesheet" href="../css/workflow.css">
	<script src = '../js/workflow.js'></script>
	<script src = '../js/metro-treevew.js'></script>
	<script src = '../js/metro-button-set.js'></script>
	<script>
		function check(){
			return true;
		}
	</script>
</head>
<body class = 'metro'>
<?php
	if(isset($_POST['_submit'])){
		include_once "view_function.php"; 
		$whole_json = json_decode($_POST['json'], true);
		$fileName = $whole_json['cluster_view']['input'];
		$json = buildJson_from_cluster($fileName, $_POST['node']);
		$whole_json['cluster_view']['value'] = $json;
?>
	<form action = '../home.php' method = 'POST' id = 'draw' target = '_parent'>
		<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($whole_json); ?>'>
	</form>
	<script>
		document.getElementById('draw').submit();
	</script>
<?php
	}
	// Here insert if(isset($_POST[]))
	if(isset($_POST["INPUT"])){
		include_once "view_function.php";
		$receive_json = json_decode($_POST["INPUT"], true);
		$receive_json['step'] = "cluster_view";
		$fileName = $receive_json["cluster_view"]["input"];
		$node = node_set($fileName);
?>
<div class = 'container'>
	<div class = '_contain_box_model'>
		<div class = 'header'>
			<h2 style = 'text-align: center; width: 100%;'>View Data In TreeView</h3>
		</div>
		<div class = 'applet'>
			<applet class = 'java_applet' archive="TreeView/TreeViewApplet.jar,TreeView/nanoxml-2.2.2.jar,TreeView/plugins/Dendrogram.jar"
				code = "edu/stanford/genetics/treeview/applet/ButtonApplet.class"
				alt="Your browser understands the &lt;APPLET&gt; tag but isn't running the applet, for some reason."
				width = 150	 height = 50>
				<param name = "cdtFile" value = "<?= $fileName.".cdt"; ?>">
				<param name = "cdtName" value = "Click to Run">
				<param name = "plugins" value = "edu.stanford.genetics.treeview.plugin.dendroview.DendrogramFactory">
			</applet>
		</div>
	</div>
	<div class = '_contain_box_model'>
		<form action = 'cluster.php' method = 'POST' id = 'cluster_node' onclick = "return check();" target = '_self'>
			<div class = 'input-control select'>
				<select id = 'select' name = 'node[]' multiple>
	<?php 
			for($i = 0; $i < count($node); $i++){
	?>	
					<option value = '<?= $node[$i][0]; ?>'><?= $node[$i][0]; ?></option>
	<?php
			}
	?>
				</select>
			</div>
			<input type = 'hidden' name = 'json' value = '<?= json_encode($receive_json); ?>'>
			<input type = 'hidden' name = '_submit' value = '_submit'>
		</form>
	</div>
	<form action = '../home.php' method = 'POST' id = 'backwards' target = '_parent'>
		<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($receive_json); ?>'>
		<input type = 'hidden' name = 'back' value = 'back'>
	</form>
	<div class = 'button_bfd'>
		<div class = 'back'>
			<button type = 'button' class = 'button_bf button large bg-green' onclick = "form_submit('backwards');">&lt;&lt;</button>
		</div>
		<div class = 'proceed'>
			<button type = 'button' class = 'button_bf button large bg-green' onclick = "form_submit('cluster_node');">&gt;&gt;</button>
		</div>
	</div>
</div>
<?php
	}
?>
</body>
</html>
