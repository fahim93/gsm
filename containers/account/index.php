<?php include('../../layout/header.php'); ?>
<?php
if(!is_logged_in()){
    header("Location: ". BASE_URL);
}
?>
<?php
include(ROOT_PATH.'classes/Customer.php');
include(ROOT_PATH.'classes/CustomerAccount.php');

$customer_id = $_SESSION['customer_id'];

$customer_obj = new Customer($conn);
$customer_obj->id = $customer_id;
$customer_info = $customer_obj->get_customer_by_id();
if($customer_info->num_rows > 0){
    $cust = $customer_info->fetch_assoc();
    $name = $cust['name'];
    $username = $cust['username'];
    $email = $cust['email'];
    $created_at = $cust['created_at'];
    $login_at = $cust['login_at'];
    $ip = $cust['ip'];
}

$acc_obj = new CustomerAccount($conn);
$acc_obj->customer = $customer_id;
$acc_data = $acc_obj->get_by_customer();
if(!empty($acc_data)){
    $current_balance = $acc_data['current_balance'];
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
                        <li class="active">
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
                </div>;
            </div>

        </div>
        <div id="account_content">
            <div class="col-md-6 col-sm-12 col-xs-12">

                <div class="panel panel-default">
                    <div class="panel-heading bg-gray">
                        <h3 class="panel-title"><i class="fa fa-user fw-r10"></i><?=isset($username) ? $username : ''?>
                            |
                            Dahsboard</h3>
                    </div>
                    <div class="panel-body form-horizontal">
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Name</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="font-15"><?=isset($name) ? $name : ''?></p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="font-15"><?=isset($email) ? $email : ''?></p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Join</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="font-15">
                                    <?=isset($created_at) ? $created_at : ''?>
                                </p>
                            </div>
                        </div>


                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Last Login</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="font-15"><?=isset($login_at) ? $login_at : ''?></p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">IP Address</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p class="font-15"><?=isset($ip) ? $ip : ''?></p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-3 col-sm-12 col-xs-12 no-padding">
                <div class="panel panel-default">
                    <div class="panel-heading bg-primary">
                        <h3 class="panel-title"><i class="fa fa-dollar fw-r10"></i>Balance</h3>
                    </div>
                    <div class="panel-body">
                        <h2 class="text-secondary text-center text-bold"><span class="user-balance">
                                <?=isset($current_balance) ? number_format((float)$current_balance, 2, '.', '') : 0.00 ?>

                                USD</span></h2>
                    </div>
                    <div class="panel-footer">
                        <button class="btn btn-block btn-primary" data-toggle="modal"
                            data-target="#balance_recharge_modal"><i class="fa fa-repeat fw-r10"></i>Recharge
                            Balance</button>
                        <button class="btn btn-block btn-secondary" data-toggle="modal"
                            data-target="#balance_transfer_modal"><i class="fa fa-exchange fw-r10"></i>Transfer
                            Balance</button>

                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="balance_recharge_modal" class="modal fade modal-dialog-form in" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header pad-10 bg-primary">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-repeat fw-r10"></i>Balance Recharge</h5>
            </div>
            <form class="form-horizontal" id="balance_recharge_form" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Amount</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="topup" type="number" class="form-control" placeholder="0.00" min="1" max="999"
                                step="any" required="">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary btn-lg pull-left"><i
                            class="fa fa-check fw-r10"></i>Confirm</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
                            class="fa fa-caret-down fw-r5"></i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="balance_transfer_modal" class="modal fade modal-dialog-form in" role="dialog" aria-hidden="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header pad-10 bg-secondary">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-exchange fw-r10"></i>Balance Transfer</h5>
            </div>
            <form class="form-horizontal" method="post" id="blance_transfer_form">
                <div class="modal-body">
                    <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12 control-label lable-required">Receiver Email</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="email" id="email" type="email" class="form-control" value=""
                                onchange="validation(id)" onkeyup="validation(id)" placeholder="Receiver Email">
                            <span id="email_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12 control-label lable-required">Amount</label>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                            <input name="amount" id="amount" type="number" class="form-control" placeholder="0.00"
                                min="0.01" step="any" onchange="validation(id)" onkeyup="validation(id)" value="">
                            <span id="amount_error" class="text-danger"></span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4 col-sm-4 col-xs-12 control-label">Notes</label>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <input name="note" id="note" type="text" placeholder="Additional Notes" class="form-control"
                                onchange="validation(id)" onkeyup="validation(id)" value="">
                            <span id="note_error" class="text-danger"></span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="op" value="do_transfer">
                    <button type="button" id="blance_submit" class="btn btn-secondary btn-lg pull-left"><i
                            class="fa fa-check fw-r10"></i>Confirm</button>
                    <button type="button" class="btn btn-default pull-right" data-dismiss="modal"><i
                            class="fa fa-caret-down fw-r5"></i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>

</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>