<?php
//   function humanize(size) {
//     var units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];
//     var ord = Math.floor(Math.log(size) / Math.log(1024));
//     ord = Math.min(Math.max(0, ord), units.length - 1);
//     var s = Math.round((size / Math.pow(1024, ord)) * 100) / 100;
//     return s + ' ' + units[ord];
//   }

// $marks = array(
//     array("id"=> 1, "name"=>"Fahim"),
//     array("id"=> 2, "name"=>"Mamun")
// ); 

// $marks[] = array("id"=> 3, "name"=>"Sujon");
// $marks = array();
// $marks["files"][] =  array("id"=> 1, "name"=>"Fahim");
// $marks["files"][] =  array("id"=> 2, "name"=>"Mamun");
// $marks["packages"][] =  array("id"=> 1, "name"=>"Gold");
// $marks["packages"][] =  array("id"=> 2, "name"=>"Premium");
// $marks["packages"][] =  array("id"=> 3, "name"=>"Bronze");
// // unset($marks['packages']);
// echo count($marks['packages']).'<br>';
// echo json_encode($marks);
echo json_decode(file_get_contents("http://country.io/names.json"), true)['BD'];
// if (in_array("3", array_column($marks, 'id'))) 
//   { 
//   echo "found"; 
//   } 
// else
//   { 
//   echo "not found"; 
//   } 
?>