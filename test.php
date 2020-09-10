<?php
//   function humanize(size) {
//     var units = ['bytes', 'KB', 'MB', 'GB', 'TB', 'PB'];
//     var ord = Math.floor(Math.log(size) / Math.log(1024));
//     ord = Math.min(Math.max(0, ord), units.length - 1);
//     var s = Math.round((size / Math.pow(1024, ord)) * 100) / 100;
//     return s + ' ' + units[ord];
//   }

  function size_humanize($size) {
    $units = array('bytes', 'KB', 'MB', 'GB', 'TB', 'PB');
    $ord = floor(log($size) / log(1024));
    $ord = min(max(0, $ord), count($units) - 1);
    $s = round(($size / pow(1024, $ord)) * 100) / 100;
    $u = $units[$ord];
    $sau = $s . ' ' . $u;
    // return $s .' ' . $units[$ord];
    return array("SIZE"=>$s, "UNIT"=>$u, "SAU"=>$sau);
  }
  echo size_humanize(2048)['SAU'];
?>