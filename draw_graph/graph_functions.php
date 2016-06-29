<?php

function graph_by_javascript($json){
	for($i = 0; $i < count($json); $i++){
		echo "
			<div class = 'header graph_title' style = 'text-align: center;'>
				<h3>Graph ". ($i + 1). "</h3>
			</div>
			<div id = '".$json[$i]["render"]."' class = 'shadow'>
			</div>
			<script>
				var json = ". json_encode($json[$i]). ";
				json.series = makeNum(json.series);
				draw_a_graph(json);
			</script>";
	}
}
?>
