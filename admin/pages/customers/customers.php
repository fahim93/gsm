<?php include '../../layout/header.php'; ?>
<?php include '../../layout/top-navbar.php'; ?>
<?php include '../../layout/left-sidebar.php'; ?>
<?php include('../../conf/dbConfig.php'); ?>
<?php
  $qry_get_all_customers = "SELECT * FROM customers";
  $rs_get_all_customers = $conn->query($qry_get_all_customers);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-caret-right"></i> Users</h1>
    <ol class="breadcrumb">
      <li class="active"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i> Home</a></li>
      <li>Customers</li>
    </ol>
  </section>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Customer List</h3>
            <button id="btn-new-customer" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New Customer</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Join</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($rs_get_all_customers as $customer)
                  {
                  ?>
                <tr>
                  <td><?=$customer['id']?></td>
                  <td><?=$customer['customer_full_name']?></td>
                  <td><?=$customer['customer_username']?></td>
                  <td><?=$customer['customer_email']?></td>
                  <td><?=$customer['customer_phone']?></td>
                  <td>
                    <label
                      class="label <?=($customer['customer_status']=='Inactive')?'label-danger':'label-success'?>"><?=$customer['customer_status']?></label>
                  </td>
                  <td><?=$customer['created_at']?></td>
                  <td>
                    <div class=" btn-group">
                      <button class="btn btn-xs btn-primary"><i class="fa fa-eye"></i> View</button>
                      <button class="btn btn-xs btn-info"><i class="fa fa-pencil-alt"></i> Update</button>
                      <button class="btn btn-xs btn-danger"><i class="fa fa-minus"></i> Delete</button>
                    </div>
                  </td>
                </tr>
                <?php
                  }
                  ?>
              </tbody>
              <tfoot>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Join</th>
                  <th>Actions</th>
                </tr>
              </tfoot>
            </table>
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      </div>
      <!-- Col -->
    </div>
    <!-- Row -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- New User Modal -->
<div class="modal fade" id="newCustomerModal" tabindex="-1" role="dialog" aria-labelledby="newCustomerModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newCustomerModalLabel"><i class="fa fa-plus"></i> New Customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form>
          <nav>
            <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
              <a class="nav-item nav-link active" id="nav-info-tab" data-toggle="tab" href="#nav-info" role="tab"
                aria-controls="nav-home" aria-selected="true"><i class="fa fa-info"></i> Info</a>
              <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                aria-controls="nav-profile" aria-selected="false"><i class="fa fa-user"></i> Profile</a>
              <a class="nav-item nav-link" id="nav-permissions-tab" data-toggle="tab" href="#nav-permissions" role="tab"
                aria-controls="nav-contact" aria-selected="false"><i class="fa fa-lock"></i> Permissions</a>
            </div>
          </nav>
          <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-info" role="tabpanel" aria-labelledby="nav-info-tab">
              <div class="form-group row">
                <label for="newUserName" class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserName" placeholder="Username">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserPassword" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="newUserPassword" placeholder="Password">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserEmail" class="col-sm-4 col-form-label">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="newUserEmail" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserStatus" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-8">
                  <select id="newUserStatus" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="2">Inactive</option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserGroup" class="col-sm-4 col-form-label">User Group</label>
                <div class="col-sm-8">
                  <select id="newUserGroup" class="form-control">
                    <option selected>Select Here</option>
                    <option></option>
                  </select>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
              <div class="form-group row">
                <label for="newUserFullName" class="col-sm-4 col-form-label">Full Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserFullName" placeholder="Full Name">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserPhoto" class="col-sm-4 col-form-label">Photo</label>
                <div class="col-sm-8">
                  <label role="button">
                    <img id="nuser_photo_src" class="image-form-control"
                      src="<?=BASE_URL?>media/img/users/default-user.png"
                      def-src="<?=BASE_URL?>media/img/users/default-user.png">
                    <input class="hidden" bind-urp="#nuser_photo_src" type="file" accept="image/*" name="photo">
                  </label>
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserPhone" class="col-sm-4 col-form-label">Phone</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserPhone" placeholder="Phone Number">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserCountry" class="col-sm-4 col-form-label">Country</label>
                <div class="col-sm-8">
                  <select id="newUserCountry" class="form-control">
                    <option selected>Select Here</option>
                    <option></option>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserCity" class="col-sm-4 col-form-label">City</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserCity" placeholder="City">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserAddress" class="col-sm-4 col-form-label">Address</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserAddress" placeholder="Address">
                </div>
              </div>
              <div class="form-group row">
                <label for="newUserZip" class="col-sm-4 col-form-label">Zip</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="newUserZip" placeholder="Zip Code">
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="nav-permissions" role="tabpanel" aria-labelledby="nav-permissions-tab">...
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-success pull-left">Create User</button>
      </div>
    </div>
  </div>
</div>

<?php include '../../layout/footer.php'; ?>
<?php include '../../layout/scripts.php'; ?>
<?php include '../../layout/foot-scripts.php'; ?>

<script>
  $("#btn-new-customer").click(function () {
    $('#newCustomerModal').modal('show');
  });
</script>