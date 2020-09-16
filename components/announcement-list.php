<?php
$announcement_list = get_objects($conn, $table_name='announcements', $filter_set=array('is_published'=>'Yes'), $order_by='published_date', $sorted='DESC');
?>
<div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
    <div class="widget announcements-footer-widget footer-widget">
        <h2 class="widget-head"><i class="fa fa-file-text fw-r10"></i>Announcements</h2>
        <div class="body">
            <ul class="announcements-footer-list">
                <?php
                if(isset($announcement_list) && $announcement_list->num_rows > 0){
                    foreach($announcement_list as $ann){ ?>
                <li>
                    <a href="<?=ANNOUNCEMENT_URL.'?aid='. $ann['id']?>"><?=$ann['title']?></a>
                </li>
                <?php
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>