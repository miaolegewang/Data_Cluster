<?php
function find($a, $array){
	for($i = 0; $i < count($array) - 1; $i++){
		if(str_replace($a, "", $array[$i]) != $a)
			return $array[$i + 1];
	}
}
?>