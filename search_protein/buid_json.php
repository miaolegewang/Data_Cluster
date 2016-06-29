<?php
include_once "mypass.conf";

function build_json($miao, $table_name){
	$jsonPro = array();
	$con = mysql_connect(constant("HOST"),constant("USER"),constant("PASS")) or die("Error : Cannot Connect to ".mysql_error());
	mysql_select_db("p3db_test",$con);
	$result = mysql_query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME='".$table_name."'") or die("Cannot execute");
	$category = array();
	while( $row = mysql_fetch_array($result) ){
		$category[] = $row[0];
	}
	$title = "";
	$subtitle = "";
	$unitName = "";
	$className = '_draw_graph_content';
	$constraint = array_shift($category);
	for($j = 0; $j < count($miao); $j++){
		$receive = explode(',', $miao[$j]);
		$receive = array_unique($receive);
		$temp = array();
		for($i = 0; $i < count($receive); $i++){
			$query = "SELECT * FROM $table_name WHERE ".$constraint." = '$receive[$i]'";
			$result = mysql_query($query) or die("Cannot execute");
			$row = mysql_fetch_array($result);
			$temp[$i] = array();
			for($k = 0; $k < count($category); $k++){
				$temp[$i][] = $row[$category[$k]];
			}
		}
	
		// Build objects
		$proteinBar = array();
		$proteinCol = array();
		for($i = 0; $i < count($receive); $i++){
			$proteinBar[$i] = array();
			$proteinBar[$i]["type"] = "column";
			$proteinBar[$i]["name"] = $receive[$i];
			$proteinBar[$i]["data"] = $temp[$i];
			$proteinCol[$i] = array();
			$proteinCol[$i]["type"] = "spline";
			$proteinCol[$i]["name"] = $receive[$i];
			$proteinCol[$i]["data"] = $temp[$i];
		}
		$proteinData = array_merge($proteinBar, $proteinCol);
		$ka = array();
		$ka["title"] = $title;
		$ka["subtitle"] = $subtitle;
		$ka["unitName"] = $unitName;
		$ka["category"] = $category;
		$ka["series"] = $proteinData;
		$ka["render"] = $className. "_". $j;
		$jsonPro[] = $ka;
	}
	mysql_close($con);
	return $jsonPro;
}
?>