<!DOCTYPE html>
<html>
<head>
	<title>Step 2</title>
<style>
	input[readonly]{
		/*background-color: #DDDDDD;*/
	}
</style><link rel="stylesheet" type="text/css" href="../css/metro-bootstrap.css"><script src="../js/jquery/jquery.min.js"></script><script src="../js/jquery/jquery.widget.min.js"></script><script src="../js/metro/metro.min.js"></script>
<script>
/* protein clustering menu */
var ProClust = "Specifies the distance measure for protein clustering:" +
			"<div class = 'input-control radio'>" +
			"<label><input type = 'radio' value = '0' name = 'g' checked><span class = 'check'></span>No clustering</label>" +
			"<label><input type = 'radio' value = '1' name = 'g'><span class = 'check'></span>Uncentered correlation</label>" +
			"<label><input type = 'radio' value = '2' name = 'g'><span class = 'check'></span>Pearson correlation</label>" +
			"<label><input type = 'radio' value = '3' name = 'g'><span class = 'check'></span>Uncentered correlation, absolute value</label>" +
			"<label><input type = 'radio' value = '4' name = 'g'><span class = 'check'></span>Pearson correlation, absolute value</label>" +
			"<label><input type = 'radio' value = '5' name = 'g'><span class = 'check'></span>Spearman's rank correlation</label>" +
			"<label><input type = 'radio' value = '6' name = 'g'><span class = 'check'></span>Kendall's tau</label>" +
			"<label><input type = 'radio' value = '7' name = 'g'><span class = 'check'></span>Euclidean distance</label>" +
			"<label><input type = 'radio' value = '8' name = 'g'><span class = 'check'></span>City-block distance</label>" +
			"</div>";

/* microarray clustering */
var Micro = "Specifies the distance measure for microarray clustering:" +
 			"<div class = 'input-control radio'>" +
			"<label><input type = 'radio' value = '0' name = 'e' checked><span class = 'check'></span>No clustering</label>" +
			"<label><input type = 'radio' value = '1' name = 'e'><span class = 'check'></span>Uncentered correlation</label>" +
			"<label><input type = 'radio' value = '2' name = 'e'><span class = 'check'></span>Pearson correlation</label>" +
			"<label><input type = 'radio' value = '3' name = 'e'><span class = 'check'></span>Uncentered correlation, absolute value</label>" +
			"<label><input type = 'radio' value = '4' name = 'e'><span class = 'check'></span>Pearson correlation, absolute value</label>" +
			"<label><input type = 'radio' value = '5' name = 'e'><span class = 'check'></span>Spearman's rank correlation</label>" +
			"<label><input type = 'radio' value = '6' name = 'e'><span class = 'check'></span>Kendall's tau</label>" +
			"<lable><input type = 'radio' value = '7' name = 'e'><span class = 'check'></span>Euclidean distance</label>" +
			"<lable><input type = 'radio' value = '8' name = 'e'>City-block distance</label></div>";
/* hierarchical method  */
var Hmethod = "Specifies which hierarchical clustering method to use:" +
			"<div class = 'input-control radio'>" +
			"<label><input type = 'radio' name = 'm' value = 'm' checked><span class = 'check'></span>Pairwise complete-linkage</label>" +
			"<label><input type = 'radio' name = 'm' value = 's'><span class = 'check'></span>Pairwise single-linkage</label>" +
			"<label><input type = 'radio' name = 'm' value = 'c'><span class = 'check'></span>Pairwise centroid-linkage</label>" +
			"<label><input type = 'radio' name = 'm' value = 'a'><span class = 'check'></span>Pairwise average-linkage</label></div>";

/*	parting line	*/
var partLine = "<br>------------------------------------------<br>"

var KMeans = "<br>Specifies whether to run k-means clustering instead of hierarchical clustering, and the number of clusters k to use:<br>"
KMeans += "<br>the number of clusters (k):<input type = 'number' name = 'k'><br>"
var NumRun = "<br>For k-means clustering, the number of times the k-means clustering algorithm is run:"
NumRun += "<br><br>the number of trials:<input type = 'number' name = 'r'><br>"
var x = "<br>Specifies the horizontal dimension of the SOM grid:<br>"
x += "<br><input type = 'number' name = 'x'><br>"
var y = "<br>Specifies the vertical dimension of the SOM grid<br>"
y += "<br><input type = 'number' name = 'y'><br>"
var pg = "<br>Specifies to apply Principal Component Analysis to genes instead of clustering"
pg += "<br><br><input type = 'radio' value = '0' name = 'pg'>Apply PCA        <input type = 'radio' value = '1' name = 'pg'>Apply clustering<br>"
var pa = "<br>Specifies to apply Principal Component Analysis to arrays instead of clustering"
pa += "<br><br><input type = 'radio' value = '0' name = 'pa'>Apply PCA        <input type = 'radio' value = '1' name = 'pa'>Apply clustering<br>"
var submit = "<input type = 'submit' value = '>>next' name = 'miooo'><br>"
function show(choice){
	if(choice == 1)
		document.getElementById("content").innerHTML = ProClust + partLine + Micro + partLine + Hmethod + partLine + submit
	else if(choice == 2)
		document.getElementById("content").innerHTML = ProClust + partLine + Micro + partLine + KMeans + partLine + NumRun + partLine + submit
	else if(choice == 3)
		document.getElementById("content").innerHTML = ProClust + partLine + Micro + partLine + x + partLine + y + partLine + submit
}
</script>
</head>
<body class = 'metro'>
<?php
	if(isset($_POST['miooo'])){
		$json_v = json_decode($_POST['json'], true);
		$json_v['cluster_v2']['value']['g'] = $_POST['g'];
		$json_v['cluster_v2']['value']['e'] = $_POST['e'];
		$json_v['cluster_v2']['value']['m'] = $_POST['m'];
		$json_v['cluster_v2']['value']['cluster'] = $_POST['cluster'];
?>
	<form action = '../work.php' method = 'POST' target = '_parent' id = 'output'>
		<input type = 'hidden' name = 'OUTPUT' value = '<?php echo json_encode($json_v); ?>'>
	</form>
	<script>
		document.getElementById('output').submit();
	</script>
<?php 
	}
	if(isset($_POST['INPUT'])){
		$json = json_decode($_POST['INPUT'], true);
		$l;
		$cg;
		$ng;
		$ca;
		$na;
		if($json['cluster_v2']['input']['ifman'] == 1){
			$l = "None";
			$cg = "None";
			$ng = "None";
			$ca = "None";
			$na = "None";
		} else if($json['cluster_v2']['input']['ifman'] == 0){
			$l = ($json['cluster_v2']['input']['l'] == 0)? "Yes" : "No";
			$cg = ($json['cluster_v2']['input']['cg'] == 'a')? "mean" : "median";
			$ng = ($json['cluster_v2']['input']['ng'] == 0)? "Yes" : "No";
			$ca = ($json['cluster_v2']['input']['ca'] == 'a')? "mean" : "median";
			$na = ($json['cluster_v2']['input']['na'] == 0)? "Yes" : "No";
		}
		$json['step'] = 'cluster_v2';
		$json['cluster_v2']['value']['id'] = $json['cluster_v2']['input']['id'];
		$json['cluster_v2']['value']['l'] = $l;
		$json['cluster_v2']['value']['cg'] = $cg;
		$json['cluster_v2']['value']['ng'] = $ng;
		$json['cluster_v2']['value']['ca'] = $ca;
		$json['cluster_v2']['value']['na'] = $na;
?>
<form action = 'cluster_step2.php' method = 'post' target = '_self'>
	<div border = '1' style = 'width:800px; height: 900px;'>
		<div id = 'head' style = 'width: 800px;text-align:center;font-size:40;'>TreeView Cluster</div>
		<div id = 'head' style = 'width: 800px;text-align:center;font-size:30;'><b>Step 2: Choose a method to do clustering</b><br></div>
		<div id = 'menu' style = 'width: 300px;float:left;height:300px;'>
			<div class="input-control textarea">Protein ID:
			<textarea id = 'readonly' name = 'ID' rows = '10' cols = '30' readonly disabled><?php echo $json['cluster_v2']['input']['id']; ?></textarea>			</div>
			<br>-----------------------------<br>Choose a Cluster Method:<br><br>			<div class = 'input-control radio'>
				<label>
					<input type = 'radio' name = 'cluster' value = '1' onclick = 'show(1)'>
					<span class="check"></span>
					Hierarchical
				</label>
			</div>
			<br>-----------------------------<br>
	<div class="input-control text">Log-transform: <input type = 'text' disabled readonly name = 'l' value ='<?php echo $l; ?>'></div>
	<div class="input-control text">Subtract from each row:<input type = 'text' disabled readonly name = 'cg' value = '<?php echo $cg; ?>'></div>
	<div class="input-control text">Normalize each row:<input type = 'text' disabled readonly name = 'ng' value = '<?php echo $ng; ?>'></div>
	<div class="input-control text">Subtract from each column:<input disabled type = 'text' readonly name = 'ca' value = '<?php echo $ca; ?>'></div>
	<div class="input-control text">Normalize each column:<input disabled type = 'text' readonly name = 'na' value = '<?php echo $na; ?>'> </div>
	<input type = 'hidden' name = 'json' value = '<?php echo json_encode($json); ?>'>
		</div>
		<div id = 'content' style = 'width: 500px;text-align:left;float:left;'><div>
	</div>
</form>
<?php
	}
?>
</body>
</html>