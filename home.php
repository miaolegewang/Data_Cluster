<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="description" content="P3DB: Plant Protein Phosphorylation DataBase">
	<meta name="keywords" content="P3DB, Plant, Protein, Phosphorylation, DataBase">
	<title>P3DB - Plant Protein Phosphorylation DataBase</title>

	<!-- jquery Library -->
	<script src="js/jquery-1.8.2.js"></script>
	<script src="js/jquery-ui-1.9.1.custom.min.js"></script>
	<!-- end jquery Library -->

	<!-- steps -->
	<link href="css/steps.css" rel="stylesheet" type="text/css">
	<script src="js/kissy-min.js"  type="text/javascript"></script>
	<script src="js/steps.js" type="text/javascript"></script>
	<script src = 'js/workflow.js' type = 'text/javascript'></script>
	<!-- End steps -->

	<!--  Metroui  -->
	<script src = 'js/jquery.widget.min.js'></script>
	<script src = 'min/metro.min.js'></script>
	<link rel = 'stylesheet' type = 'text/css' href = 'css/metro-bootstrap.css'>
	<!--  Metroui End  -->
	<style>
		#iframe {
			height: 600px; 
			width: 1220px;
			margin: 10px auto;
		}
		
		body{
			margin: 0 auto;
		}
		
		#main {
			margin: 0 auto;
			width: 95%;
		}
	
	</style>
</head>
<body class = "metro">
<?php
if (isset($_REQUEST["OUTPUT"]))
	$data = json_decode($_REQUEST["OUTPUT"], true);
?>
	<div id = 'main'>
		<div id="steps">
			<ol id="workflow1-steps" class = 'ks-steps blue' style = 'width: 1220px;'>
				<li><b>Search Protein</b></li>
				<li><b>Draw graph</b></li>
				<li><b>Setup cluster</b></li>
				<li><b>View cluster</b></li>
				<li><b>Specific Nodes Graph</b></li>
			</ol>
			<?php
			$step = array (
				"search_protein/search.php",
				"draw_graph/graph.php",
				"cluster/cluster_setup.php",
				"cluster/cluster.php",
				"draw_graph/graph.php"
			);
			$stepName = array (
				"search",
				"draw_graph",
				"cluster_setup",
				"cluster_view",
				"draw_graph"
			);
			
			function find_step($data, $stepName){
				if(isset($data['step'])){
					if($data['step'] == 'draw_graph'){
						if($data['draw_graph']['data'] == 0){
							return 2;
						}
					}
				}
				for($i = 0; $i < count($stepName); $i++)
					if($stepName[$i] == $data)
						return $i + 1;
			}
			 
			function find_step_back($data, $stepName){
				for($i = 1; $i < count($stepName); $i++)
					if($stepName[$i] == $data)
						return $i - 1;	
			}
			
			if(isset($_POST['back'])){
				if(isset($data['step']) && $data['step'] == 'draw_graph'){
					if($data['draw_graph']['data'] == 0){
						$count = 0;	
						$current_step = $step[$count];
					}
					else if($data['draw_graph']['data'] == 1){
						$count = 3;
						$current_step = $step[$count];
					}
				} else {
					$count = find_step_back($data['step'], $stepName);
					$current_step = $step[$count];
				}
			}
			else {
				$count = isset($data["step"]) ? find_step($data["step"], $stepName) : 0;
				$current_step = $step[$count];
			}
			
			function currentPageURL() {
				$pageURL = 'http';
				if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
					$pageURL .= "://";
				if ($_SERVER["SERVER_PORT"] != "80") {
					$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
				} else {
					$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
				}
				return $pageURL;
			}
			$data["draw_graph"]["overall"] = 1;
			switch ($count){
				case 0:
					break;
				case 1: 
					$data["draw_graph"][0]["input"] = $data["search"]["value"];
					$data["draw_graph"]['data'] = 0;
					break;
				case 2:
					$data['cluster_setup']['input'] = $data['draw_graph'][0]['value'];
					break;
				case 3:
					$data["cluster_view"]['input'] = $data['cluster_setup']['value'];
					break;
				case 4: $data["draw_graph"][1]['input'] = $data['cluster_view']['value'];
					$data['draw_graph']['data'] = 1;
					break;
			}
			echo '<script type="text/javascript">';
	
			echo 'var  S = KISSY, DOM = S.DOM, Event = S.Event, step;';
				
			echo 'var current_step ="' .$step[$count]. '";';
				
			echo 'step = new S.Steps("#workflow1-steps");';
			echo 'step.render();';
			echo 'step.set( "act",' .($count + 1). ');';
			echo 'S.log( step.get("act") );';
			echo '</script>';
			?>
		</div>
	
		<iframe id="iframe" name="iframe" src="<?php echo ($current_step);?>"></iframe>
		<form action = 'home.php' method = 'post' target = '_self' id = 'start_over'>
		</form>
		<div class = 'button_bfd'>
			<div class = 'back'>
				<button class = 'button large bg-green' onclick = "form_submit('start_over');">Start Over</button>
			</div>
		</div>	
		<form id = 'passdata' action = '<?php echo $current_step; ?>' target = "iframe" method = "POST">
			<input type = 'hidden' name = "INPUT" value = '<?php echo json_encode($data); ?>'>
		</form>
		<script>
			document.getElementById("passdata").submit();
		</script>
	</div>
</body>
</html>
