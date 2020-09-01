<?php include '../../layout/header.php'; ?>
<?php include '../../layout/top-navbar.php'; ?>
<?php include '../../layout/left-sidebar.php'; ?>
<?php include('../../conf/dbConfig.php'); ?>
<?php
  $qry_get_all_users = "SELECT u.*, ur.role_name FROM users AS u, user_roles AS ur WHERE ur.id = u.user_role";
  $rs_get_all_users = $conn->query($qry_get_all_users);
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><i class="fa fa-caret-right"></i> Users</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Users</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title"></h3>
              <div class="btn-group btn-group-md float-right">
                <button id="btn-new-user" class="btn btn-success"><i class="fa fa-plus"></i> New User</button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                      <label class="label label-success"><?=$user['user_status']?></label>
                    </td>
                    <td><?=$user['created_at']?></td>
                    <td>
                      <div class="btn-group">
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
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
    </div><!-- /.container-fluid -->
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
        <h5 class="modal-title" id="newUserModalLabel"><i class="fa fa-plus"></i> New User</h5>
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
        <button type="button" class="btn btn-success">Create User</button>
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