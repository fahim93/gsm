  <nav class="top-bar animate-dropdown">
      <div class="container">
          <div class="col-md-4 col-sm-4 no-margin hidden-xs">
              <ul class="mar-t-5">
                  <li>
                      <a target="_blank" href="https://web.facebook.com/GSM-Tech-Master-559794727858656/"
                          class="fa fa-lg fa-facebook bg-white"></a>
                  </li>
                  <li>
                      <a target="_blank" href="https://www.youtube.com/channel/UCa9n8C9KcNcB_oHFAvfIvLg"
                          class="fa fa-lg fa-youtube bg-white"></a>
                  </li>
                  <li>
                      <a target="_blank" href="https://twitter.com/gsmshanto" class="fa fa-lg fa-twitter bg-white"></a>
                  </li>
              </ul>
          </div>
          <div class="col-md-8 col-sm-8 col-xs-12 no-margin">
              <ul class="right">
                  <li>
                      <a href="<?=LOGIN_URL?>"><i class="fa fa-lock fw-r5"></i>Login</a>
                  </li>
                  <li>
                      <a href="<?=SIGN_UP_URL?>"><i class="fa fa-book fw-r5"></i>Register</a>
                  </li>

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
                      <img src="<?=BASE_URL?>uploads/system/l1574162894.png" alt="Download Server" />
                  </a>
              </div>
          </div>
          <div class="col-md-6 hidden-sm hidden-xs top-search-holder no-margin">
              <div class="search-area-top">
                  <p class="text-white">Contact Us / Whatsapp <i class="fa fa-phone fw-r10"></i> <strong>+8801875134862
                          (Only
                          SMS)</strong></p>
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
          <!-- cart start -->
          <div class="col-md-3 col-sm-6 col-xs-12 top-cart-row no-margin">
              <div class="top-cart-row-container">
                  <div class="top-cart-holder dropdown animate-dropdown">

                      <div class="basket">
                          <a class="dropdown-toggle link-secondary" data-toggle="dropdown" href="#">
                              <div class="basket-item-count">
                                  <span class="count">0</span>
                                  <img src="<?=BASE_URL?>assets/images/icon-cart.png" alt="" />
                              </div>

                              <div class="total-price-basket">
                                  <span class="lbl">Your Cart:</span>
                                  <span class="total-price">
                                      0 USD
                                  </span>
                              </div>
                          </a>
                          <ul class="dropdown-menu">
                              <li class="checkout">
                                  <div class="basket-item">
                                      <p class="alert text-center text-black font-16">Shopping cart is empty !</p>
                                  </div>
                              </li>
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