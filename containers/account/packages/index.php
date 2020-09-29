<?php include('../../../layout/header.php'); ?>
<?php
if(!is_logged_in()){
    header("Location: ". BASE_URL);
}
?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>

<?php
    include(ROOT_PATH.'classes/CustomerPackage.php');
    $customer_id = $_SESSION['customer_id'];
    $obj = new CustomerPackage($conn);
    $obj->customer = $customer_id;
    $packages = $obj->get_by_customer();
?>
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="wrapper">
    <div class="container outer-bottom-sm mar-t-20">
        <div class="col-md-3 col-sm-12 col-xs-12">
            <div class="panel panel-default account-sidemenu">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-user text-gray fw-r10"></i>Account</h3>
                </div>
                <div class="panel-body no-padding no-margin">
                    <ul class="nav nav-pills nav-stacked menu-links-stack">
                        <li class="">
                            <a href="<?=ACCOUNT_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Dashboard
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_PROFILE_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Profile
                            </a>
                        </li>


                        <li class="active">
                            <a href="<?=ACC_PACKAGES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Packages
                            </a>

                        </li>
                        <li class="">
                            <a href="<?=ACC_FILES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Files
                            </a>
                        </li>

                        <li class="">
                            <a href="<?=ACC_ORDERS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Orders
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_INVOICES_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Invoices
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_TRANSACTIONS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Transactions
                            </a>
                        </li>
                        <li class="">
                            <a href="<?=ACC_TRANSFERS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Transfers
                            </a>
                        </li>

                        <li class="">
                            <a href="<?=ACC_DOWNLOADS_URL?>">
                                <i class="fa fa-angle-right fw-r10"></i>Downloads
                            </a>
                        </li>

                    </ul>
                </div>
            </div>

        </div>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Packages </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="datatables" class="display table table-responsive">
                        <thead>
                            <tr>
                                <th>Package</th>
                                <th>Start</th>
                                <th>Expire on</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(!empty($packages)){
                                foreach($packages as $p){ ?>
                            <tr>
                                <td><?=$p['title']?></td>
                                <td><?=$p['created_at']?></td>
                                <td><?=$p['expire_on']?></td>
                                <td>
                                    <?php
                                        if($p['is_active'] == 1){ ?>
                                    <span><label class="label label-success">Active</label><label
                                            class="label label-info">Current</label></span>
                                    <?php
                                        }else{ ?>
                                    <span><label class="label label-danger">Inactive</label></span>
                                    <?php
                                        }
                                        ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0)" onclick="return showpackege(898)"
                                            class="btn btn-xs btn-warning btn-dt"><i
                                                class="fa fa-eye fw-r5"></i>Control</a>
                                    </div>
                                    <?php
                                    if($p['is_active'] != 1){ ?>
                                    <div class="btn-group btn-group-sm">
                                        <button data-customer-package-id="<?=$p['id']?>"
                                            data-customer-id="<?=$p['customer']?>"
                                            class="btn btn-xs btn-success btn-dt make_active_btn"><i
                                                class="fa fa-check fw-r5"></i>Make Active</button>
                                    </div>
                                    <?php } ?>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Package</th>
                                <th>Start</th>
                                <th>Expire on</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $(document).ready(function () {
        $('#datatables').DataTable();
    });
</script>
<script>
    $('.make_active_btn').click(function () {
        let customer_id = $(this).attr('data-customer-id');
        let customer_package_id = $(this).attr('data-customer-package-id');
        $.ajax({
                url: '<?=BASE_URL?>api/customer-package.php',
                method: 'POST',
                data: {
                    "action": "make-active",
                    "customer_package_id": customer_package_id,
                    "customer_id": customer_id
                },
                dataType: "JSON"
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 1000,
                        onHidden: function () {
                            location.reload();
                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', 'Some problem occurred. please try again later.', {
                    timeOut: 5000
                })
            });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>