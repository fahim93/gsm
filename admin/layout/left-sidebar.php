<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?=BASE_URL?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p>
        <!-- Status -->
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <ul class="sidebar-menu">
      <li>
        <a href="<?=BASE_URL?>">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="<?=CLIENT_BASE_URL?>">
          <i class="fa fa-eye"></i> <span>Live Site</span>
        </a>
      </li>
      <li>
        <a href="<?=USERS_URL?>">
          <i class="fa fa-users"></i>
          <span>
            Users
          </span>
        </a>
      </li>
      <li>
        <a href="<?=CUSTOMERS_URL?>">
          <i class="fa fa-users"></i>
          <span>
            Customers
          </span>
        </a>
      </li>
      <li>
        <a href="<?=PRODUCTS_URL?>">
          <i class="fa fa-shopping-cart"></i>
          <span>
            Products
          </span>
        </a>
      </li>
      <li>
        <a href="<?=PRESTOCK_URL?>">
          <i class="fa fa-credit-card"></i>
          <span>
            Prestock
          </span>
        </a>
      </li>
      <li>
        <a href="<?=FILES_URL?>">
          <i class="fa fa-folder-open"></i>
          <span>
            Files
          </span>
        </a>
      </li>
      <li>
        <a href="<?=PAGES_URL?>">
          <i class="fa fa-edit"></i>
          <span>
            Pages
          </span>
        </a>
      </li>
      <li>
        <a href="<?=ARTICLES_URL?>">
          <i class="fa fa-briefcase"></i>
          <span>
            Articles
          </span>
        </a>
      </li>
      <li>
        <a href="<?=ANNOUNCEMENTS_URL?>">
          <i class="fa fa-bullhorn"></i>
          <span>
            Announcements
          </span>
        </a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-credit-card"></i>
          <span>Billing<i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?=BILLING_ORDERS_URL?>">
              <span>Orders</span>
            </a>
          </li>
          <li>
            <a href="<?=BILLING_INVOICES_URL?>">
              <span>Invoices</span>
            </a>
          </li>
          <li>
            <a href="<?=BILLING_TRANSACTIONS_URL?>">
              <span>Transactions</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-table"></i>
          <span>
            DataTables
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?=DT_BILL_ITEMS_URL?>">
              <span>Bill Items</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_TRANSFERS_URL?>">
              <span>Transfers</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_PRODUCTS_URL?>">
              <span>Products</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_FILES_URL?>">
              <span>Files</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_ARTICLES_URL?>">
              <span>Articles</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_REVIEWS_URL?>">
              <span>Reviews</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_USERS_PACKAGES_URL?>">
              <span>Users Packages</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_USERS_DOWNLOADS_URL?>">
              <span>Users Downloads</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_DOWNLOAD_VISITORS_URL?>">
              <span>Download Visitors</span>
            </a>
          </li>
          <li>
            <a href="<?=DT_STAFF_ACTIVITY_URL?>">
              <span>Staff Activity</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-tasks"></i>
          <span>
            System
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?=SYS_PAYMENT_GATEWAYS_URL?>">
              <span>Payment Gateways</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_COUPONS_URL?>">
              <span>Coupons</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_MAIL_TEMPLATES_URL?>">
              <span>Mail Templates</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_PERMISSIONS_TEMPLATES_URL?>">
              <span>Permissions Templates</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_DOWNLOAD_PACKAGES_URL?>">
              <span>Download Packages</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_IP_BLACKLIST_URL?>">
              <span>IP Blacklists</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_CRON_TASKS_URL?>">
              <span>Cron Tasks</span>
            </a>
          </li>
          <li>
            <a href="<?=SYS_SOFTWARE_LICENSE_URL?>">
              <span>Software License</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-cogs"></i>
          <span>
            Options
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="<?=OPT_SYSTEM_OPTION_URL?>">
              <span>System Option</span>
            </a>
          </li>
          <li>
            <a href="<?=OPT_INTERFACE_TEMPLATE_URL?>">
              <span>Interface Template</span>
            </a>
          </li>
          <li>
            <a href="<?=OPT_DOWNLOAD_URL?>">
              <span>Download</span>
            </a>
          </li>
          <li>
            <a href="<?=OPT_CRON_TASK_URL?>">
              <span>Cron Task</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-paper-plane"></i>
          <span>
            Tools
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li>
            <a href="">
              <span>ChartJS</span>
            </a>
          </li>
        </ul>
      </li>
      <li class="nav-item">
        <a href="#">
          <i class="fa fa-caret-left"></i>
          <span>
            Members Area
          </span>
        </a>
      </li>
    </ul><!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>