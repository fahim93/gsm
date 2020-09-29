<?php include('../../../layout/header.php'); ?>
<?php
if(!is_logged_in()){
    header("Location: ". BASE_URL);
}
?>
<?php
    $customer_id = $_SESSION['customer_id'];
    $order_obj = new Order($conn);
    $order_obj->order_by = $customer_id;
    $data = $order_obj->get_all_by_customer();
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
            $order_data = $order_obj->get_invoice();
            if(!empty($order_data)){
                $order_id = $order_data['id'];
                $order_no = $order_data['order_no'];
                $date = $order_data['created_at'];
                $status = $order_data['status'];
                $is_paid = $order_data['is_paid'];
                $bill_amount = $order_data['bill_amount'];
                $bill_unit = $order_data['bill_unit'];
                $order_sub_total = $order_data['sub_total'];
                $order_discount = $order_data['discount'];
                $order_tax = $order_data['tax'];
                //Customer Info
                $name = $order_data['name'];
                $country = $order_data['country'];
                $city = $order_data['city'];
                $address = $order_data['address'];
                $zip_code = $order_data['zip_code'];
        ?>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Invoice #<?=$order_no?> </h2>
                </div>
            </div>
            <div class="row" id="invoice">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-4 col-sm-12 col-xs-12 text-left">
                                <img class="invoice-logo-view" src="<?=BASE_URL.$site_logo?>" alt="">
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12">
                                <h5>Bill To</h5>
                                <p class="">
                                    <?=$name?><br><?=$address?>, <?=$city?>,
                                    <?=$zip_code?><br><?=json_decode(file_get_contents(BASE_URL."api/country-names.json"), true)[$country]?>
                                </p>
                            </div>
                            <div class="col-md-4 col-sm-6 col-xs-12 text-center">
                                <p class="invoice-label">
                                    <?php
                                    if($is_paid == 1){ ?>
                                    <span class="label-text text-green">Paid</span>
                                    <?php }else{ ?>
                                    <span class="label-text text-red">Unpaid</span>
                                    <?php }
                                    ?>
                                    <span class="label-date"><?=$date?></span>
                                    <?php
                                    if($is_paid == 0){ ?>
                                    <span class="label-order no-print">
                                        <a href="">Order
                                            #<?=$order_no?></a>
                                    </span>
                                    <?php }
                                    ?>
                                </p>
                                <?php
                                if($is_paid == 0){ ?>
                                <p class="no-margin no-padding no-print">
                                    <a href="<?=ACC_INVOICE_PAYMENT_URL?><?=$order_id?>"
                                        class="btn btn-success btn-lg"><i class="fa fa-check fw-r5"></i>Pay Now</a>
                                </p>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <hr>

                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table invoice-view-table cart-view-table">
                                            <thead>
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Price</th>
                                                    <th>Q</th>
                                                    <th>Subtotal</th>
                                                    <th>Discount</th>
                                                    <th>Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                            $order_file_obj = new OrderFile($conn);
                                            $order_file_obj->order_id = $order_id;
                                            $order_file_data = $order_file_obj->get_all_by_order();

                                            $order_package_obj = new OrderPackage($conn);
                                            $order_package_obj->order_id = $order_id;
                                            $order_package_data = $order_package_obj->get_all_by_order();

                                            if(!empty($order_file_data)){
                                                foreach($order_file_data as $ofd){
                                                    $title = $ofd['file_title'];
                                                    $price = $ofd['price'];
                                                    $quantity = $ofd['quantity'];
                                                    $sub_total = $ofd['sub_total'];
                                                    $discount = $ofd['discount'];
                                                    $total = $ofd['total'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="item-title text-bold">
                                                            <a class="data-btn"
                                                                href="javascript:void(0)"><?=$title?></a>
                                                        </span>
                                                    </td>
                                                    <td><span
                                                            class="item-price"><?=number_format((float)$title, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span class="item-quantity"><?=$quantity?></span>
                                                    </td>
                                                    <td><span
                                                            class="item-subtotal"><?=number_format((float)$sub_total, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span
                                                            class="item-discount"><?=number_format((float)$discount, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span
                                                            class="item-total"><?=number_format((float)$total, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            if(!empty($order_package_data)){
                                                foreach($order_package_data as $opd){
                                                    $title = $opd['package_title'];
                                                    $price = $opd['price'];
                                                    $quantity = $opd['quantity'];
                                                    $sub_total = $opd['sub_total'];
                                                    $discount = $opd['discount'];
                                                    $total = $opd['total'];
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="item-title text-bold">
                                                            <a class="data-btn"
                                                                href="javascript:void(0)"><?=$title?></a>
                                                        </span>
                                                    </td>
                                                    <td><span
                                                            class="item-price"><?=number_format((float)$title, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span class="item-quantity"><?=$quantity?></span>
                                                    </td>
                                                    <td><span
                                                            class="item-subtotal"><?=number_format((float)$sub_total, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span
                                                            class="item-discount"><?=number_format((float)$discount, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                    <td><span
                                                            class="item-total"><?=number_format((float)$total, 2, '.', '')?>
                                                            USD</span>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <th colspan="5" class="text-right">Subtotal</th>
                                                    <th colspan="1"><span
                                                            class="invoice-subtotal"><?=number_format((float)$order_sub_total, 2, '.', '')?>
                                                            USD</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" class="text-right">Discount</th>
                                                    <th colspan="1"><span
                                                            class="invoice-discount"><?=number_format((float)$order_discount, 2, '.', '')?>
                                                            USD</span>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" class="text-right">Taxes</th>
                                                    <th colspan="1"><span
                                                            class="invoice-taxes"><?=number_format((float)$order_tax, 2, '.', '')?>
                                                            USD</span></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" class="text-right">Total</th>
                                                    <th colspan="1"><span
                                                            class="invoice-total"><?=number_format((float)$bill_amount, 2, '.', '')?>
                                                            <?=$bill_unit?></span></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" class="text-right">Credit</th>
                                                    <th colspan="1"><span class="invoice-credit">0.00 USD</span></th>
                                                </tr>
                                                <?php
                                                if($is_paid == 1){ ?>
                                                <tr>
                                                    <th colspan="5" class="text-right">Paid</th>
                                                    <th colspan="1"><span
                                                            class="invoice-due text-red"><?=number_format((float)$bill_amount, 2, '.', '')?>
                                                            <?=$bill_unit?></span></th>
                                                </tr>
                                                <tr>
                                                    <th colspan="5" class="text-right">Due</th>
                                                    <th colspan="1"><span class="invoice-due text-green">0.00 USD</span>
                                                    </th>
                                                </tr>
                                                <?php
                                                }else{ ?>
                                                <tr>
                                                    <th colspan="5" class="text-right">Due</th>
                                                    <th colspan="1"><span
                                                            class="invoice-due
                                                                text-red"><?=number_format((float)$bill_amount, 2, '.', '')?>
                                                            <?=$bill_unit?></span>
                                                    </th>
                                                </tr>
                                                <?php
                                                }
                                                ?>

                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            if($is_paid == 1){ ?>
            <div class="row no-print">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Transactions</h3>
                        </div>
                        <div class="panel-body">
                            <div id="DataTables_Table_0_wrapper"
                                class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6"></div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table
                                            class="dt_invoice_transactions table table-bordered table-hover dataTable no-footer dtr-inline"
                                            id="DataTables_Table_0" role="grid" style="width: 816px;">
                                            <thead>
                                                <tr role="row">
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1" style="width: 158px;"
                                                        aria-label="Gateway: activate to sort column ascending">
                                                        Gateway</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1" style="width: 207px;"
                                                        aria-label="Transaction: activate to sort column ascending">
                                                        Transaction</th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1" style="width: 124;"
                                                        aria-label="Amount: activate to sort column ascending">
                                                        Amount</th>
                                                    <th class="sorting_desc" tabindex="0"
                                                        aria-controls="DataTables_Table_0" rowspan="1" colspan="1"
                                                        style="width: 130;" aria-sort="descending"
                                                        aria-label="Date: activate to sort column ascending">
                                                        Date
                                                    </th>
                                                    <th class="sorting" tabindex="0" aria-controls="DataTables_Table_0"
                                                        rowspan="1" colspan="1" style="width: 100px;"
                                                        aria-label="Status: activate to sort column ascending">
                                                        Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    include(ROOT_PATH.'classes/Transaction.php');
                                                    $transaction = new Transaction($conn);
                                                    $transaction->invoice = $order_no;
                                                    $transaction_data = $transaction->get_by_invoice();
                                                    if(!empty($transaction_data)){ ?>
                                                <tr class="odd">
                                                    <td><?=ucwords($transaction_data['gateway'])?></td>
                                                    <td><?=$transaction_data['gateway_identity']?></td>
                                                    <td><?=number_format((float)$transaction_data['amount'], 2, '.', '')?>
                                                        USD</td>
                                                    <td><?=$transaction_data['created_at']?></td>
                                                    <td>
                                                        <?php
                                                                if($transaction_data['status'] == 1){ ?>
                                                        <label class="label label-success">Complete</label>
                                                        <?php                                                        
                                                                }
                                                                ?>
                                                    </td>
                                                </tr>
                                                <?php }
                                                    ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5"></div>
                                    <div class="col-sm-7"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php }
            ?>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12 no-print">
                    <button class="btn btn-md btn-info btn-block invoice-print-btn" id="basic"><i
                            class="fa fa-print fw-r10"></i>Print Invoice</button>
                </div>
            </div>
        </div>
        <?php
        }
        }else{ ?>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Invoices History</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="datatables" class="display table table-responsive">
                        <thead>
                            <tr>
                                <th>Order</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Bill Amount</th>
                                <th>Paid</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($data)){
                                foreach($data as $d){ ?>
                            <tr>
                                <td><?=$d['order_no']?></td>
                                <td><?=$d['order_no']?></td>
                                <td><?=$d['created_at']?></td>
                                <td><?=number_format((float)$d['bill_amount'], 2, '.', '')?> <?=$d['bill_unit']?></td>
                                <td>
                                    <?php
                                        if($d['is_paid'] == 1){ ?>
                                    <label class="label label-success">Paid</label>
                                    <?php
                                        }else{ ?>
                                    <label class="label label-danger">Unpaid</label>
                                    <?php } ?>
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="<?=ACC_INVOICE_DETAILS_URL?><?=$d['id']?>"
                                            class="btn btn-sm btn-info btn-dt"><i class="fa fa-eye fw-r5"></i>View</a>
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
                                <th>Order</th>
                                <th>Invoice</th>
                                <th>Date</th>
                                <th>Bill Amount</th>
                                <th>Payment</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
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
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>