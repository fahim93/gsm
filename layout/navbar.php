  <nav class="top-bar animate-dropdown">
      <div class="container">
          <div class="col-md-4 col-sm-4 no-margin hidden-xs">
              <ul class="mar-t-5">
                  <li>
                      <a target="_blank" href="<?=isset($facebook_url) ? $facebook_url : ''?>"
                          class="fa fa-lg fa-facebook bg-white"></a>
                  </li>
                  <li>
                      <a target="_blank" href="<?=isset($youtube_url) ? $youtube_url : ''?>"
                          class="fa fa-lg fa-youtube bg-white"></a>
                  </li>
                  <li>
                      <a target="_blank" href="<?=isset($twitter_url) ? $twitter_url : ''?>"
                          class="fa fa-lg fa-twitter bg-white"></a>
                  </li>
              </ul>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-12 no-margin">
              <ul class="right">
                  <?php
                  if(is_logged_in()){ ?>
                  <li id="account">
                      <a href="<?=ACCOUNT_URL?>"><i class="fa fa-user fw-r5"></i>Account</a>
                  </li>
                  <li id="logout">
                      <a class="btn btn-link" id="logout_button"><i class="fa fa-lock fw-r5"></i>Logout</a>
                  </li>
                  <?php }else{ ?>
                  <li id="login">
                      <a href="<?=LOGIN_URL?>"><i class="fa fa-lock fw-r5"></i>Login</a>
                  </li>
                  <li id="sign_up">
                      <a href="<?=SIGN_UP_URL?>"><i class="fa fa-book fw-r5"></i>Register</a>
                  </li>
                  <?php }
                  ?>
                  <li class="hidden-xs">
                      <form id="change_language_form" class="form-inline" method="get" action="#">
                          <input type="hidden" name="a" value="language">
                          <select class="form-control le-select" name="language" bind-sel="en"
                              onchange="$('#change_language_form').submit();">

                              <option value="en">English</option>

                              <option value="pt">Português</option>

                              <option value="tr">Türk</option>

                              <option value="ar">العربية</option>

                          </select>
                      </form>
                  </li>
              </ul>
          </div>
      </div>
  </nav>
  <header class="no-padding-bottom header-alt">
      <div class="container no-padding">
          <div class="col-md-3 col-sm-6 col-xs-12 logo-holder">
              <div class="logo">
                  <a href="<?=BASE_URL?>">
                      <img src="<?=isset($site_logo) ? BASE_URL.$site_logo : ''?>" alt="Download Server" />
                  </a>
              </div>
          </div>
          <div class="col-md-6 hidden-sm hidden-xs top-search-holder no-margin">
              <div class="search-area-top">
                  <p class="text-white"><?=isset($header_contact) ? $header_contact : ''?></p>
              </div>
              <div class="search-area">
                  <form id="header_search_form" method="get" action="http://gsmtechmaster.com/search">
                      <div class="control-group">
                          <input class="search-field" name="keyword" placeholder="Search for ..." required>
                          <input class="search-field" name="searchfor" id="header_search_for" value="downloads" required
                              type="hidden">
                          <ul class="categories-filter animate-dropdown">
                              <li class="dropdown">
                                  <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)"><span
                                          id="header_search_cat">Downloads</span></a>
                                  <ul class="dropdown-menu" role="menu">
                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                              onclick="$('#header_search_cat').text('Website');$('#header_search_for').val('website');">Website</a>
                                      </li>

                                      <li role="presentation"><a role="menuitem" tabindex="-1" href="javascript:void(0)"
                                              onclick="$('#header_search_cat').text('Downloads');$('#header_search_for').val('downloads');">Downloads</a>
                                      </li>

                                  </ul>
                              </li>
                          </ul>
                          <button role="button" type="submit" class="btn search-button"></button>
                      </div>
                  </form>
              </div>
          </div>
          <!-- cart start  -->
          <div class="col-md-3 col-sm-6 col-xs-12 top-cart-row no-margin">
              <div class="top-cart-row-container">
                  <div class="top-cart-holder dropdown animate-dropdown">
                      <div class="basket">
                          <a class="dropdown-toggle link-secondary" data-toggle="dropdown" href="#">
                              <div class="basket-item-count">
                                  <span class="count"><?=isset($cart_item_count) ? $cart_item_count : 0 ?></span>
                                  <img src="<?=BASE_URL?>assets/images/icon-cart.png" alt="">
                              </div>

                              <div class="total-price-basket">
                                  <span class="lbl">Your Cart:</span>
                                  <span class="total-price">
                                      <?=isset($grand_total) ? number_format((float)$grand_total, 2, '.', '') : 0.00 ?>
                                      USD
                                  </span>
                              </div>
                          </a>
                          <?php
                          if(is_logged_in()){
                              $customer = $_SESSION['customer_id'];
                              $order = new Order($conn);
                              $order->order_by = $customer;
                              $unpaid_orders = $order->get_customer_order_by_payment_status();
                              if(count($unpaid_orders) > 0){ ?>
                          <a class="btn btn-block btn-danger btn-sm mar-5" href="<?=ACC_INVOICES_URL?>">
                              <b><?=count($unpaid_orders)?></b> Unpaid Invoices
                          </a>
                          <?php
                          }
                          }
                          ?>
                          <ul class="dropdown-menu">
                              <?php
                              if(isset($_SESSION['shopping_cart']) && (!empty($_SESSION['shopping_cart']['file']) || !empty($_SESSION['shopping_cart']['package']))){
                                if(!empty($_SESSION['shopping_cart']['package'])){
                                    foreach($_SESSION['shopping_cart']['package'] as $item){ ?>
                              <li>
                                  <div class="basket-item">
                                      <div class="row">
                                          <div class="col-md-8 col-sm-8 col-xs-8 no-margin">
                                              <div class="title"><?=$item['title']?></div>
                                              <div class=""><small> <?=$item['quantity']?> Pieces </small>
                                                  <span
                                                      class="price"><?=number_format((float)$item['total'], 2, '.', '')?>
                                                      <?=$item['price_unit']?></span></div>
                                          </div>
                                      </div>
                                      <button data-package-id="<?=$item['package_id']?>"
                                          class="btn close-btn remove_package_btn"></button>
                                  </div>
                              </li>
                              <?php
                                    }
                                }
                                if(!empty($_SESSION['shopping_cart']['file'])){
                                    foreach($_SESSION['shopping_cart']['file'] as $item){ ?>
                              <li>
                                  <div class="basket-item">
                                      <div class="row">
                                          <div class="col-md-8 col-sm-8 col-xs-8 no-margin">
                                              <div class="title"><?=$item['title']?></div>
                                              <div class=""><small> <?=$item['quantity']?> Pieces </small>
                                                  <span
                                                      class="price"><?=number_format((float)$item['total'], 2, '.', '')?>
                                                      <?=$item['price_unit']?></span></div>
                                          </div>
                                      </div>
                                      <button data-file-id="<?=$item['file_id']?>"
                                          class="btn close-btn remove_file_btn"></button>
                                  </div>
                              </li>
                              <?php
                                    }
                                }
                                ?>
                              <li class="checkout">
                                  <div class="basket-item">
                                      <div class="row">
                                          <div class="col-md-12 col-sm-12 col-xs-12">
                                              <a href="<?=CART_URL?>" class="le-button"><i
                                                      class="fa fa-shopping-cart fw-r5"></i>Checkout</a>
                                          </div>
                                      </div>
                                  </div>
                              </li>
                              <?php
                              }else{ ?>
                              <li class="checkout">
                                  <div class="basket-item">
                                      <p class="alert text-center text-black font-16">Shopping cart is empty !</p>
                                  </div>
                              </li>
                              <?php
                              }
                              ?>
                          </ul>
                      </div>
                  </div>
              </div>
          </div>
          <!--     cart end -->
      </div>

      <nav id="top-megamenu-nav" class="megamenu-vertical animate-dropdown">
          <div class="container">
              <div class="yamm navbar">
                  <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse"
                          data-target="#mc-horizontal-menu-collapse">
                          <span class="sr-only">Main Menu</span>
                          <span class=""><i class="fa fa-list fw-r10"></i>Main Menu</span>
                      </button>
                  </div>
                  <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
                      <ul class="nav navbar-nav">
                          <li><a href="<?=BASE_URL?>"><i class="fa fa-home fw-r10"></i>Home</a></li>
                          <li><a href="<?=RECENT_FILE_URL?>"><i class="fa fa-clock-o fw-r10"></i>Last 100</a></li>
                          <li><a href="<?=PACKAGE_URL?>"><i class="fa fa-dollar fw-r10"></i>Packages &amp; Pricing</a>
                          </li>
                          <li><a href="<?=REQUEST_FILE_URL?>"><i class="fa fa-send fw-r10"></i>Request File</a></li>
                          <li><a href="<?=BLOG_URL?>"><i class="fa fa-file-text fw-r10"></i>Blog</a></li>
                          <li><a href="<?=ANNOUNCEMENT_URL?>"><i class="fa fa-microphone fw-r10"></i>Announcements</a>
                          </li>
                          <li><a href="<?=CONTACT_US_URL?>"><i class="fa fa-envelope fw-r10"></i>Contact us</a></li>

                      </ul>
                  </div>
              </div>
          </div>
      </nav>
  </header> <!-- ============================================================== -->