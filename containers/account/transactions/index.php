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
                                        <a href="javascript:void(0)" data-id="<?=$t['id']?>"
                                            class="btn btn-sm btn-info btn-dt transaction_details_view"><i
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
<div id="transaction_details_view_modal" class="modal fade modal-dialog-form in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pad-10 primary-bg">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-shopping-cart fw-r10"></i>Transaction</h5>
            </div>
            <div class="ready-place" id="show_data">
                <div class="modal-body form-horizontal pad-10">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-group-view">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Gateway</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p id="transaction_details_view_gateway" class="font-14 text-bold break-word">

                                    </p>
                                </div>
                            </div>
                            <div class="form-group form-group-view">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">Amount</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p id="transaction_details_view_amount" class="font-14 text-bold break-word">
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p id="transaction_details_view_date" class="font-14 text-bold break-word">
                                </p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-6 control-label">Invoice</label>
                            <div class="col-md-9 col-sm-9 col-xs-6">
                                <p class="font-13">
                                    <a id="transaction_details_view_invoice" href="javascript:void(0)"></a>
                                </p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-6 control-label">Status</label>
                            <div class="col-md-9 col-sm-9 col-xs-6">
                                <p class="font-13">
                                    <span id="transaction_details_view_status"
                                        class="label label-success font-13"></span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                    </div>
                </div>
            </div>
            <div class="modal-footer pad-5">
                <button type="button" class="btn btn-block btn-info" data-dismiss="modal"><i
                        class="fa fa-caret-down fw-r10"></i>Close</button>
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
    $('.transaction_details_view').click(function () {
        let id = $(this).attr("data-id");
        $.ajax({
            url: "<?=BASE_URL?>api/transaction.php",
            method: "POST",
            data: {
                "id": id,
                "action": "get-details"
            },
            dataType: "JSON"
        }).done(function (data) {
            if (data.status == 1) {
                let d = data.data;
                $("#transaction_details_view_gateway").text(d.gateway);
                $("#transaction_details_view_gateway").css("text-transform", "capitalize");
                $("#transaction_details_view_amount").text(d.amount.toFixed(2) + " USD");
                $("#transaction_details_view_date").text(d.created_at);
                $("#transaction_details_view_invoice").text("#" + d.invoice);
                if (d.status == 1) {
                    $("#transaction_details_view_status").text("Complete");
                }
                $('#transaction_details_view_modal').modal();
            }
        }).fail(function (data) {});
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>