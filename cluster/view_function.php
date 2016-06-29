<?php
//include_once "../draw_graph/mypass.conf";
include_once "../draw_graph/graph_functions.php";
include_once "../search_protein/buid_json.php";

function cut_for_cluster($string){
	$return = "";
	for($i = 0; $i < strlen($string); $i++)
		if($string[$i + 1] == 'N' || $string[$i + 1] == 'G')	return $return;
		else $return .= $string[$i];
}

function write_file($proID, $tb){
	$con = mysql_connect(constant("HOST"),constant("USER"),constant("PASS")) or die("Error : Cannot Connect to ".mysql_error());
	mysql_select_db("p3db_test",$con);
	$get_protein = explode(',', $proID);
	$get_protein = array_unique($get_protein);	
	$data = array();
	$result = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$tb."'");
	$columName = array();
	while($column = mysql_fetch_array($result))
		$columName[] = $column[0];
	$num = 0;
	
	for($i = 0; $i < count($get_protein); $i++){
		$command = "SELECT * FROM ".$tb." WHERE ".$columName[0]." = '".$get_protein[$i]."'";
		$result = mysql_query($command, $con);
		if(mysql_num_rows($result) == 0) continue;
		$row = mysql_fetch_array($result);
		$data[] = array();
		$cc = 1;
		$data[$num][0] = $row[$columName[0]];
		for($j = 1; $j < count($columName); $j++)	// 10 is the number of values, count() cannot be used here because of certain reasons
			$data[$num][$cc++] = $row[$columName[$j]];
		$num++;
	}
	mysql_close($con);
	/*		Get data from database end		*/
	/****		Write data into textfile		***/
	$fileName = "temporaryFile/~temp".time();
	$FileFormat = $fileName.".txt";
	$file = fopen($FileFormat, "w") or die("Cannot open the file\n");
	$head = "";
	for($i = 0; $i < count($columName); $i++){
		$head .= $columName[$i];
		if($i != count($columName) - 1)	$head .= "\t";
	}
	$head .= "\n";
	fwrite($file, $head);

	for($i = 0; $i < count($data); $i++){	
		$dataLine = $data[$i][0]."\t".$data[$i][1]."\t".$data[$i][2]."\t".$data[$i][3]."\t".$data[$i][4]."\t"
				.$data[$i][5]."\t".$data[$i][6]."\t".$data[$i][7]."\t".$data[$i][8]."\t".$data[$i][9]."\t".$data[$i][10]."\n";
		fwrite($file, $dataLine);
	}

	fclose($file);
	
	return $fileName;
}


function command($post, $file){
	$method = $post['cluster'];
	$command = "/usr/local/bin/cluster -f $file.txt -u $file";
	/* data manipulate */
	if($post['l'] != "None"){
		$command .= ($post['l'] == 'Yes')? " -l " : "";
		$command .= ($post['cg'] == 'mean')? " -cg a " : " -cg m ";
		$command .= ($post['ng'] == "Yes")? " -ng " : "";
		$command .= ($post['ca'] == 'mean')? " -ca a " : " -ca m ";
		$command .= ($post['na'] == 'Yes')? " -na " : "";
	}

	$command .= " -g ".$post['g']." -e ".$post['e'];
	switch($method){
		case 1:
			$command .= /*" -g ".$post['g']." -e ".$post['e'].*/" -m ".$post['m'];
			break;
		case 2:
			$command .= " -k ".$post['k']." -r ".$post['r'];
			$fileName .= "_K_G".$post['k']."_A".$post['k'];
			break;
	}
	system($command);
	//unlink($file.".txt");
}

function command_line($post, $file){
	$method = $post['cluster'];
	$command = "/usr/local/bin/cluster -f $file.txt -u $file";
	/* data manipulate */
	if($post['ifman'] == 0){
		$command .= ($post['l'] == 0)? " -l " : "";
		$command .= ($post['ng'] == 0)? " -ng " : "";
		$command .= ($post['na'] == 0)? " -na " : "";
		$command .= ($post['cg'] != 'None')? " -cg ". $post['cg'] : "";
		$command .= ($post['ca'] != 'None')? " -ca ". $post['ca'] : "";
	}
	
	$command .= " -g ".$post['g']." -e ".$post['e'];
	switch($method){
		case 1:
			$command .= " -m ".$post['m'];
			break;
		case 2:
			$command .= " -k ".$post['k']." -r ".$post['r'];
			$fileName .= "_K_G".$post['k']."_A".$post['k'];
			break;
	}
	system($command);
	unlink($file.".txt");
}

//
//	Build Json
//
function node_set($fn){
	$file = fopen($fn.'.gtr', 'r');
	$nodes = array();
	$count = 0;
	while($row = fgets($file)){
		$i = 0;
		$j = 0;
		$nodes[] = array();
		$nodes[$count][0] = "";
		$nodes[$count][1] = "";
		$nodes[$count][2] = "";
		while($j < strlen($row)){
			if($i == 3) 
				break;
			$nodes[$count][$i] .= $row[$j];
			if($row[$j] == 'X'){
				$j++;
				$i++;
			}
			$j++;
		}
		/*$i = 0;
		$nodes[] = array();
		for($j = 0; $j < strlen($row); $j++){
			if($i == 3) break;
			$nodes[$count][$i] .= $row[$j];
			if($row[$j] == 'X'){
				$j++;
				$i++;
			}
		}*/
		$count++;
	}
	fclose($file);
	return $nodes;
}

function find_index($n, $node){
	for($i = 0; $i < count($n); $i++)
		if($n[$i][0] == $node){
			return $i;
		}
}

function id_match($fn, $gene){
	$file = fopen($fn.".cdt", 'r') or die("Cannot open file");
	$count = 0;
	$id_gene = array();
	while( $line = fgets($file) ){
		$count++;
		if($count <= 3) continue;
		$temp = explode("\t", $line);
		$id_gene[$count - 4]['gene'] = $temp[0];
		$id_gene[$count - 4]['id'] = $temp[1];
	}
	$result = array();
	for($i = 0; $i < count($gene); $i++)
		for($j = 0; $j < count($id_gene); $j++)
			if($id_gene[$j]['gene'] == $gene[$i])
				$result[] = $id_gene[$j]['id'];
	fclose($file);
	return $result;
}

function find_ID($fn, $node){ 	// only applicable for gtr and atr file
	$nodes = node_set($fn);
	$queue = array();
	$protein = array();
	$index = find_index($nodes, $node);
	array_push($queue, trim($nodes[$index][0]));
	while( count($queue) > 0 ){
		$temp = array_shift($queue);
		$index = find_index($nodes, $temp);
		if($nodes[$index][1][0] == "N")
			array_push($queue, trim($nodes[$index][1]));
		else array_push($protein, trim($nodes[$index][1]));
		if($nodes[$index][2][0] == "N")
			array_push($queue, trim($nodes[$index][2]));
		else array_push($protein, trim($nodes[$index][2]));
	}
	return str_replace(" ", "", implode(",", id_match($fn, $protein)));
}

function buildJson_from_cluster($fn, $nodes){
	$arrayOfNodes = array();
	for($i = 0; $i < count($nodes); $i++){
		$arrayOfNodes[] = find_ID($fn, $nodes[$i]);
	}
	$json = build_json($arrayOfNodes, "temp_protein_expression");
	for($i = 0; $i < count($nodes); $i++)
		$json[$i]['title'] = $nodes[$i];
	return $json;
}
?>
