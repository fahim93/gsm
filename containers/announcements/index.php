<?php include('../../layout/header.php'); ?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
<?php
if(isset($_GET['aid']) && $_GET['aid'] != ''){
  $aid = $_GET['aid'];
  $ann = get_object_by_id($conn, $table_name='announcements', $id=$aid);
}
?>

<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
  <div id="breadcrumb-alt" class="mar5">
    <div class="container">
      <div class="breadcrumb-nav-holder minimal">
        <ul>
          <li class="breadcrumb-item current"><a href="<?=ANNOUNCEMENT_URL?>">Announcements</a></li>
          <?php
          if(isset($ann) && count($ann) > 0){ ?>
          <li class="breadcrumb-item current"><a href="#"><?=$ann['title']?></a></li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
  </div>
</div>
<div class="wrapper">
  <?php
  if(isset($ann) && count($ann) > 0){ ?>
  <div class="posts container inner-bottom-xs">


    <div class="post-entry">
      <div class="post-content">

        <h2 class="post-title"><?=$ann['title']?></h2>

        <ul class="meta">

          <li><?=date('d-M-Y', strtotime($ann['published_date']))?></li>
        </ul>

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="post-body">
              <p>
                <?=$ann['body_text']?>
              </p>
            </div>
          </div>
          <div class="tags-wrap">
            <?php
              $tags = explode(",", $ann['tags']);
              foreach($tags as $t){ ?>
            <a href="#"><?=trim($t)?></a>
            <?php
              }
              ?>
          </div>
        </div>
        <div class="social-row mar-t-50">
          <span class="st_facebook_hcount"></span>
          <span class="st_twitter_hcount"></span>
          <span class="st_pinterest_hcount"></span>
        </div>
      </div>
    </div>
  </div>
  <?php
  }else{ ?>

  <div class="inline-width pad-b-10">
    <div class="container">
      <h1 class="page-title">Announcements </h1>
    </div>
  </div>
  <?php
  $announcements = get_objects($conn, $table_name='announcements', array('is_published'=>'Yes'),
  $order_by='published_date', $sorted='DESC');
  if(isset($announcements) && $announcements->num_rows > 0){
  ?>
  <div class="container">
    <div class="control-bar inline-width">
      <form class="inline pad-b-30 pull-right" method="get" action="#">
        <input type="hidden" name="_token" value="gLdAU1gEIfekAy6woZ620rVvGrheZOoPHAxoGVYe">
        <div class="le-select width-200">
          <select class="sort-by-select" name="shortBy" data-placeholder="Sort By">
            <option value="1">Title</option>
            <option value="2" selected>Date</option>

          </select>
        </div>
        <div class="le-select">
          <select class="sort-type-select" name="orderBy" data-placeholder="Sort Type">
            <option value="1" selected>Descending</option>
            <option value="2">Ascending</option>
          </select>
        </div>
        <button type="submit" class="btn-inline btn btn-sm btn-primary">Sort</button>
      </form>
    </div>
    <div class="posts sidemeta">
      <?php 
        foreach($announcements as $ann){ ?>
      <div class="post format-standard">
        <div class="date-wrapper">
          <div class="date">
            <span class="month"> <?=date('M', strtotime($ann['published_date']))?></span>
            <span class="day"> <?=date('d', strtotime($ann['published_date']))?></span>
          </div>
        </div>
        <div class="post-content">
          <!--  <a href="http://gsmtechmaster.com/anounce/2">
             -->
          <a href="<?=ANNOUNCEMENT_URL .'?aid='. $ann['id']?>">
            <h2 class="post-title"><?=$ann['title']?></h2>
          </a>
          <p class="no-padding mar-t-10">
          </p>
          <p class="post-description"><?=$ann['brief']?></p>

        </div>
      </div>
      <?php
        }
      } ?>
      <center></center>


    </div>
  </div>
  <?php
  } ?>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>