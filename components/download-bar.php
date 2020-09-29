<?php
$original_size = get_daily_downloaded_size_per_user($conn, $ip=getIPAddress(), $user_id=$customer_id);
$max_limit = size_humanize($size_in_bytes);
$percentage_of_max_limit = ($original_size * 100) / $max_limit['SIZE'];
?>
<div class="downloads-visitor-usage row">
  <div class="container pad-t-10 pad-b-10">
    <div class="col-md-2 col-sm-3 col-xs-2 text-right">
      <i class="fa fa-download fw-r10"></i><span class="hidden-xs font-14 text-bold">Downloads</span>
    </div>
    <div class="col-md-8 col-sm-7 col-xs-10">
      <div class="progress">
        <div class="progress-bar" role="progressbar"
          aria-valuenow="<?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>" aria-valuemin="0"
          aria-valuemax="100" style="width:<?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>%">
          <span class="sr-only"><?=isset($percentage_of_max_limit) ? $percentage_of_max_limit : 0?>%</span>
        </div>
      </div>
    </div>
    <div class="col-md-2 col-sm-3 hidden-xs text-left">
      <span class="font-14"><?=size_humanize($original_size)['SAU']?> / <?=$max_limit['SAU']?></span>
    </div>
  </div>
</div>