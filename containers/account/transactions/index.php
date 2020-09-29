<?php include('../../../layout/header.php'); ?>
<?php
if(!is_logged_in()){
    header("Location: ". BASE_URL);
}
?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>
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


                        <li class="">
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
                        <li class="active">
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
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Transactions </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="datatables" class="display table table-responsive">
                        <thead>
                            <tr>
                                <th>Gateway</th>
                                <th>Amount</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $customer_id = $_SESSION['customer_id'];
                            include(ROOT_PATH.'classes/Transaction.php');
                            $transaction = new Transaction($conn);
                            $transaction->customer = $customer_id;
                            $transaction_data = $transaction->get_all_by_customer();
                            if(!empty($transaction_data)){
                                foreach($transaction_data as $t){ ?>
                            <tr>
                                <td><?=ucwords($t['gateway'])?></td>
                                <td><?=number_format((float)$t['amount'], 2, '.', '')?></td>
                                <td><?=$t['invoice']?></td>
                                <td><?=$t['created_at']?></td>
                                <td>
                                    <?php
                                    if($t['status'] == 1){ ?>
                                    <label class="label label-success">Complete</label>
                                    <?php
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0)" class="btn btn-sm btn-info btn-dt"><i
                                                class="fa fa-eye fw-r5"></i>View</a>
                                    </div>
                                </td>
                            </tr>
                            <?php
                                }
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Gateway</th>
                                <th>Amount</th>
                                <th>Invoice</th>
                                <th>Date</th>
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
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>