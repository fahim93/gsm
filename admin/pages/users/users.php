<?php include '../../layout/header.php'; ?>
<?php include '../../layout/top-navbar.php'; ?>
<?php include '../../layout/left-sidebar.php'; ?>
<?php include('../../conf/dbConfig.php'); ?>
<?php
  $qry_get_all_users = "SELECT u.*, ur.role_name FROM users AS u, user_roles AS ur WHERE ur.id = u.user_role";
  $rs_get_all_users = $conn->query($qry_get_all_users);

  $qry_get_all_roles = "SELECT * FROM user_roles";
  $rs_get_all_roles = $conn->query($qry_get_all_roles);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1><i class="fa fa-caret-right"></i> Users</h1>
    <ol class="breadcrumb">
      <li class="active"><a href="<?=BASE_URL?>"><i class="fa fa-home"></i> Home</a></li>
      <li>Users</li>
    </ol>
  </section>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Table With Full Features</h3>
            <button id="btn-new-user" class="btn btn-success pull-right"><i class="fa fa-plus"></i> New User</button>
          </div><!-- /.box-header -->
          <div class="box-body">
            <table id="example1" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Email</th>
                  <th>Phone Number</th>
                  <th>Status</th>
                  <th>Join</th>
                  <th>Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                  foreach ($rs_get_all_users as $user)
                  {
                  ?>
                <tr>
                  <td><?=$user['id']?></td>
                  <td><?=$user['user_full_name']?></td>
                  <td><?=$user['user_username']?></td>
                  <td><?=$user['role_name']?></td>
                  <td><?=$user['user_email']?></td>
                  <td><?=$user['user_phone']?></td>
                  <td>
                    <label
                      class="label <?=($user['user_status']=='Inactive')?'label-danger':'label-success'?>"><?=$user['user_status']?></label>
                  </td>
                  <td><?=$user['created_at']?></td>
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
                  <th>Role</th>
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
<div class="modal fade" id="newUserModal" tabindex="-1" role="dialog" aria-labelledby="newUserModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <p class="modal-title" id="newUserModalLabel"><i class="fa fa-plus"></i> Add New User</p>
      </div>
      <form action="" method="" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="form-group row">
            <label for="username" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Username</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="username" id="username" value="" class="form-control uniqueCheck" data-check="1" type="text"
                placeholder="Username" required aria-required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="fullName" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Full Name</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="fullName" id="fullName" value="" class="form-control" data-check="1" type="text"
                placeholder="Full Name" required aria-required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="email" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Email</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="email" id="email" value="" class="form-control" data-check="1" type="email"
                placeholder="Email" required aria-required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="phone" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Phone</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="phone" id="phone" value="" class="form-control" data-check="1" type="text"
                placeholder="Phone Number" required aria-required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="password" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Password</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="password" id="password" value="" class="form-control" data-check="1" type="password"
                placeholder="Password" required aria-required="true">
            </div>
          </div>
          <div class="form-group row">
            <label for="status" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Status</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="status" id="status" class="form-control">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="role" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Role</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select name="role" id="role" class="form-control">
                <?php
                foreach($rs_get_all_roles as $role)
                { ?>
                <option value="<?=$role['id']?>"><?=$role['role_name']?></option>
                <?php
                } ?>
              </select>
            </div>
          </div>
          <div class="form-group row">
            <label for="image" class="col-md-3 col-sm-3 col-xs-12 control-label label-required">Image</label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input name="image" id="image" value="" class="form-control uniqueCheck" data-check="1" type="file"
                required="" aria-required="true">
            </div>
          </div>
        </div>
      </form>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success">Create</button>
      </div>
    </div>
  </div>
</div>

<?php include '../../layout/footer.php'; ?>
<?php include '../../layout/scripts.php'; ?>
<?php include '../../layout/foot-scripts.php'; ?>

<script>
  $("#btn-new-user").click(function () {
    $('#newUserModal').modal('show');
  });
</script>