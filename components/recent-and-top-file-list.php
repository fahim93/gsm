        <div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
            <div class="widget downloads-footer-widget footer-widget footer-widget">
                <h2 class="widget-head"><i class="fa fa-flash fw-r10"></i>Top Files</h2>
                <div class="body text-center">
                    <ul class="dfiles-footer-list">
                        <?php
                    if(isset($recent_files) && $recent_files->num_rows > 0){
                        foreach($recent_files as $rf){ ?>
                        <li>
                            <a href="<?=FILE_DETAILS_URL.$rf['id']?>"><?=$rf['title']?></a>
                        </li>
                        <?php
                        }
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-4 col-xs-12 no-margin-left">
            <div class="widget downloads-footer-widget footer-widget">
                <h2 class="widget-head"><i class="fa fa-tags fw-r10"></i>Recent Files</h2>
                <div class="body text-center">
                    <ul class="dfiles-footer-list">
                        <?php
                    if(isset($top_downloads) && $top_downloads->num_rows > 0){
                        foreach($top_downloads as $td){ ?>
                        <li>
                            <a href="<?=FILE_DETAILS_URL.$td['id']?>"><?=$td['title']?></a>
                        </li>
                        <?php
                        }
                    }
                    ?>
                    </ul>
                </div>
            </div>
        </div>