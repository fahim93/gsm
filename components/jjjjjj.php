<?php
              foreach($file_list as $file){ 
                if(isset($view) && $view == 'list'){ ?>
              <div class="file-list-item">
                  <div class="image">
                      <a href="<?=FILE_DETAILS_URL.$file['id']?>">
                          <img src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
                              class="img-responsive">
                      </a>
                  </div>
                  <div class="body">
                      <div class="title">
                          <a href="<?=FILE_DETAILS_URL.$file['id']?>"><?=$file['title']?></a>
                      </div>
                      <div class="file-labels">
                          <?php
                if($file['is_featured'] == 'Yes'){ ?>
                          <span class="label label-info">Featured</span>
                          <?php  
                }
                if($file['is_paid'] == 'Yes'){ ?>
                          <span class="label label-warning">Paid</span><span class="label label-success"><?=$file['price']?> <?=$file['price_unit']?></span>
                          <?php
                }else{ ?>
                          <span class="label label-success">Free</span>
                          <?php } ?>
                      </div>
                      <p class="description"></p>
                      <div class="content-controls">
                          <span class="file-folder text-bold"><a href="<?=BASE_URL?>" target="_blank">Root Folder</a></span>
                          <span class="seprator text-muted">&ensp;|&ensp;</span>
                          <span class="file-date">Date: </span>
                          <span class="seprator text-muted">&ensp;|&ensp;</span><span class="file-date">Size: </span>
                      </div>
                  </div>
                  <div class="content-buttons">
                      <?php
              if($file['is_paid'] == 'Yes'){ ?>
                      <a class="btn btn-primary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                              class="fa fa-shopping-cart fw-r5"></i>Buy</a>
                      <?php
              }else{ ?>
                      <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                              class="fa fa-download fw-r5"></i>Download</a>
                      <?php
              } ?>
                  </div>
              </div>
              <?php
                }
                else{ ?>
              <div class="col-md-3 col-sm-4 col-xs-12">
                  <div class="file-grid-item">

                      <div class="content-top">
                          <div class="image">
                              <a href="<?=FILE_DETAILS_URL.$file['id']?>">
                                  <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
                                  <div class="ribbon green"><span><?=$file['price']?> <?=$file['price_unit']?></span>
                                  </div>
                                  <?php } ?>
                                  <img src="<?=(isset($file['thumbnail']) && $file['thumbnail'] != '') ? DEFAULT_FILE_ICON_PATH . $file['thumbnail'] : DEFAULT_FILE_ICON_SRC ?>"
                                      class="img-responsive">
                              </a>
                          </div>
                          <div class="body">
                              <div class="title">
                                  <a href="<?=FILE_DETAILS_URL.$file['id']?>"><?=$file['title']?></a>
                              </div>
                          </div>
                      </div>
                      <div class="content-bottom">
                          <div class="content-controls">
                              <span class="file-date"> <?=date('d M Y', strtotime($file['created_at']))?></span>
                              <span class="seprator text-muted">&ensp;|&ensp;</span><span
                                  class="file-date"><?=$file['file_size']?>
                                  <?=$file['file_size_unit']?></span>
                          </div>
                          <?php if(isset($file['is_paid']) && $file['is_paid'] == 'Yes'){ ?>
                          <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                                  class="fa fa-money fw-r5"></i>Buy</a>
                          <?php }else{ ?>
                          <a class="btn btn-secondary content-btn" href="<?=FILE_DETAILS_URL.$file['id']?>"><i
                                  class="fa fa-download fw-r5"></i>Download</a>
                          <?php } ?>
                      </div>
                  </div>
              </div>

              <?php 
      }
              }
          ?>