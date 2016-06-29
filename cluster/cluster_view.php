<!DOCTYPE html>
<html>
<head>
	<title>view</title>
	<script src='../draw_graph/js/javascript.js'></script>
	<script src='../draw_graph/js/highcharts.js'></script>
	<script src='../draw_graph/js/exporting.js'></script>
	<script src = '../draw_graph/js/graph_function.js'></script>
	<link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.css">
	<script src="../js/jquery/jquery.min.js"></script>
    <script src="../js/jquery/jquery.widget.min.js"></script>
    <script src="../js/metro/metro.min.js"></script>
</head>
<body>
	<?php
		if(isset($_POST['draw'])){
			include_once "view_function.php";
			$data = find_ID($_POST['file'], $_POST['node']);
			$json = json_decode($_POST['json'], true);
			$json['step'] = 'cluster_view';
			$json['cluster_view']['value'] = $data;	
	?>
			<form action = '../work.php' method = 'post' id = 'findId' target = '_parent'>
				<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($json); ?>'>
			</form>
			<script>
				document.getElementById("findId").submit();
			</script>
	<?php		
		}
		if(isset($_POST['INPUT'])){
			$json = $_POST['INPUT'];
			$data = json_decode($_POST['INPUT'], true);
			$data['step'] = 'cluster_view';
			$tb = "temp_protein_expression";
			include_once "view_function.php";
			$file = write_file($data['cluster_view']['input']['id'], $tb);
			command($data['cluster_view']['input'], $file);
	?>
	<div id = 'head' style = 'context-align:center; font-size:40px;'>TreeView Cluster</div>
	<div id = 'head' style = 'context-align:center; font-size:30px;'><b>Step 3: View the data in treeview</b></div>
	<p>Click the button to view the data in tree view<br>
	<applet archive="TreeView/TreeViewApplet.jar,TreeView/nanoxml-2.2.2.jar,TreeView/plugins/Dendrogram.jar"
			code = "edu/stanford/genetics/treeview/applet/ButtonApplet.class"
			alt="Your browser understands the &lt;APPLET&gt; tag but isn't running the applet, for some reason."
			width = 150	 height = 50>
			<param name = "cdtFile" value = "<?php echo $file.".cdt"; ?>">
			<param name = "cdtName"	value = "Click to Run">
			<param name = "plugins" value = "edu.stanford.genetics.treeview.plugin.dendroview.DendrogramFactory">
	</applet>
	</p>
	<br>*********************************************<br>
	<br>Want to run again? Click the button!<button type = 'button' onclick = 'returnTo()'>Run Again</button>
	<hr>
	<b>Select Node to Draw</b>
	<?php	
		$fi = fopen($file.".gtr", 'r');
		$node = array();
		while($line = fgets($fi)){
			$node[] = cut_for_cluster($line);
		}
		fclose($fi);
	?>
	<form action = 'cluster_view.php' method = 'POST' target = '_self'>
		<input type = 'text' name = 'File1' value = '$file' hidden>
		<div class = 'input-control select'>
			<select name = 'node'>
	<?php
		for($i = 0; $i < count($node); $i++){
	?>	
				<option value = '<?= $node[$i]; ?>'><?= $node[$i]; ?></option>
	<?php
		}
	?>
			</select>
		</div>
		<input type = 'hidden' name = 'file' value = '<?= $file; ?>'>
		<input type = 'hidden' name = 'json' value = '<?= json_encode($json); ?>'>
		<input type = 'submit' name = 'draw' value = 'Draw~!'>
	</form>
	<form action = '../work.php' method = 'post' target = '_parent'>
		<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($json);?>'>
		<input type = 'submit' name = 'back' value = 'back'>
	</form>
	<?php
	}
	?>
</body>
</html>
