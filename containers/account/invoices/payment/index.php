<?php include('../../../../layout/header.php'); ?>
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
                        <li class="active">
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
        <?php
            if(isset($_GET['oid']) && $_GET['oid'] != ''){
                $customer_id = $_SESSION['customer_id'];
                $order_id = $_GET['oid'];

                $order_obj = new Order($conn);
                $order_obj->order_by = $customer_id;
                $order_obj->id = $order_id;
                $order_data = $order_obj->get_by_id_and_customer();
        ?>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Payment</h2>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <p class="font-16 text-bold text-center">
                    Amount to pay <span class="text-red"><span>
                            <?=number_format((float)$order_data['bill_amount'], 2, '.', '')?>
                            <?=$order_data['bill_unit']?>
                        </span> </span>
                </p>
                <p class="font-16 text-center">
                    Please choose your preferred payment method
                </p>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form method="post" id="payment_method_choose_form">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" value="bank">
                                        <img class="payment-gateway-icon" title="Bank Deposit"
                                            src="<?=BASE_URL?>uploads/pay/bank_deposit.png">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" value="cash">
                                        <img class="payment-gateway-icon"
                                            src="<?=BASE_URL?>uploads/pay/cash_payment.png">
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" value="paypal">

                                        <img class="payment-gateway-icon" title="PayPal Express Checkout"
                                            src="<?=BASE_URL?>uploads/pay/paypal_express.png">

                                    </label>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gateway" value="balance">
                                        <img class="payment-gateway-icon" title="Account Blance"
                                            src="<?=BASE_URL?>uploads/pay/balance.jpg">
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <input type="hidden" name="order_id" value="<?=$order_id?>">
                            <button type="submit" class="btn btn-lg btn-success btn-block"><i
                                    class="fa fa-check"></i> Pay Now </button>
                            <a href="<?=ACC_INVOICE_DETAILS_URL.$order_data['id']?>"
                                class="btn btn-md btn-danger btn-block"><i class="fa fa-caret-left"></i> Back to
                                Invoice</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <?php
            }
        ?>
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
    $('.invoice-print-btn').click(function () {
        let divToPrint = document.getElementById("invoice");
        newWin = window.open("");
        newWin.document.write(divToPrint.innerHTML);
        newWin.print();
        newWin.close();
    });
</script>
<script>
    $('#payment_method_choose_form').submit(function (e) {
        e.preventDefault();
        let form_data = new FormData(this);
        let payment_method = form_data.get('gateway');
        let order_id = form_data.get('order_id');
        let customer_id = "<?=$_SESSION['customer_id']?>";
        if (payment_method == null) {
            return toastr.error("", "Please Select a payment method.", {
                timeOut: 5000
            });
        }
        if (payment_method == 'balance') {
            $.ajax({
                    url: "<?=BASE_URL?>/api/payment.php",
                    method: "POST",
                    data: {
                        "action": "create-payment",
                        "payment_method": payment_method,
                        "order_id": order_id,
                        "customer_id": customer_id
                    },
                    dataType: "JSON"
                })
                .done(function (data) {
                    if (data.status == 1) {
                        toastr.success('', data.message, {
                            timeOut: 2000,
                            onHidden: function () {
                                location.replace("<?=ACC_INVOICE_DETAILS_URL.$order_id?>")
                            }
                        });
                    } else {
                        toastr.error('', data.message, {
                            timeOut: 5000
                        });
                    }
                })
                .fail(function (data) {
                    toastr.error('', 'Some Problem Occurred. Please Try Again Later.', {
                        timeOut: 5000
                    })
                });
        }
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>