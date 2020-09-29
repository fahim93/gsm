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

                        <li class="active">
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
        <?php
        if(isset($_GET['oid']) && $_GET['oid'] != ''){
            $customer_id = $_SESSION['customer_id'];
            $order_id = $_GET['oid'];

            $order_obj = new Order($conn);
            $order_obj->order_by = $customer_id;
            $order_obj->id = $order_id;
            $order_data = $order_obj->get_by_id_and_customer();
            if(!empty($order_data)){
                $order_id = $order_data['id'];
                $order_no = $order_data['order_no'];
                $date = $order_data['created_at'];
                $status = $order_data['status'];
                $is_paid = $order_data['is_paid'];
                $bill_amount = $order_data['bill_amount'];
                $bill_unit = $order_data['bill_unit'];

            
            ?>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Order #<?=$order_no?> </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <?php
                    if($is_paid == 0){ ?>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="alert bg-gray text-center">
                                <p class="pad-b-20">This order requires payment, choose action to proceed</p>
                                <div class="btn-group btn-group-md">
                                    <a class="btn btn-success" href="<?=ACC_INVOICE_DETAILS_URL?><?=$order_id?>"><i
                                            class="fa fa-check fw-r5"></i>View and Pay invoice</a>
                                    <label class="btn btn-danger" role="button">
                                        <a href="javascript:void(0)" class="order_cancel_btn"
                                            data-order-id="<?=$order_id?>"><i class="fa fa-minus fw-r5"></i>Cancel this
                                            order</a>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <?php }
                    ?>
                    <div class="row form-horizontal">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group form-group-view">
                                <label class="col-md-4 col-sm-4 col-xs-5 control-label label-xs-right">Date</label>
                                <div class="col-md-7 col-sm-7 col-xs-6">
                                    <p class="font-14"><?=$date?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group form-group-view">
                                <label class="col-md-4 col-sm-4 col-xs-5 control-label label-xs-right">Status</label>
                                <div class="col-md-8 col-sm-8 col-xs-7">
                                    <p class="font-14">
                                        <?php
                                        if($status == 'Pending'){ ?>
                                        <span class="label label-info font-13"><?=$status?></span>
                                        <?php
                                        }else{ ?>
                                        <span class="label label-success font-13"><?=$status?></span>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if($is_paid == 1){ ?>
                                        <span class="label label-success font-13">Paid</span>
                                        <?php
                                        }else{ ?>
                                        <span class="label label-danger font-13">Unpaid</span>
                                        <?php
                                        }
                                        ?>

                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-group-view">
                                    <label class="col-md-4 col-sm-4 col-xs-5 control-label label-xs-right">Total</label>
                                    <div class="col-md-7 col-sm-7 col-xs-6">
                                        <p class="font-14"><?=number_format((float)$bill_amount, 2, '.', '')?>
                                            <?=$bill_unit?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group form-group-view">
                                    <label
                                        class="col-md-4 col-sm-4 col-xs-5 control-label label-xs-right">Invoice</label>
                                    <div class="col-md-8 col-sm-8 col-xs-7">
                                        <p class="font-14"><a
                                                href="<?=ACC_INVOICE_DETAILS_URL.$order_id?>">#<?=$order_no?></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-default border-none">
                                <div class="panel-heading">
                                    <h3 class="panel-title text-gray">Items</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table order-view-table">
                                        <thead>
                                            <tr>
                                                <th>Item</th>
                                                <th>Quantity</th>
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
                                                    $quantity = $ofd['quantity'];
                                                ?>
                                            <tr>
                                                <td>
                                                    <span class="item-title text-bold">
                                                        <a class="data-btn" id="view_order" data-oid="1054"
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#item-view-modal"><?=$title?></a>
                                                    </span>
                                                </td>
                                                <td><span class="item-quantity"><?=$quantity?></span></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            if(!empty($order_package_data)){
                                                foreach($order_package_data as $opd){
                                                    $title = $opd['package_title'];
                                                    $quantity = $opd['quantity'];
                                                ?>
                                            <tr>
                                                <td>
                                                    <span class="item-title text-bold">
                                                        <a class="data-btn" id="view_order" data-oid="1054"
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#item-view-modal"><?=$title?></a>
                                                    </span>
                                                </td>
                                                <td><span class="item-quantity"><?=$quantity?></span></td>
                                            </tr>
                                            <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <h3 class="panel-title">New Message</h3>
                                </div>
                                <div class="panel-heading">
                                    <form class="form-inline" method="post"
                                        action="https://gsmtechmaster.com/my-order-message">
                                        <input type="hidden" name="_token"
                                            value="HQGhUbB2DsjKfjPOyR3LH2E4RA0Us9JTDt7JAeIn">
                                        <div class="input-group">
                                            <input name="message" class="form-control"
                                                placeholder="Type your message..." pattern=".{1,500}" required="">
                                            <div class="input-group-btn">
                                                <input type="hidden" name="orderId" value="1054">
                                                <button type="submit" class="btn btn-success"><i
                                                        class="fa fa-plus"></i></button>
                                            </div>
                                        </div>
                                    </form>
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
                                                <table class="dt_order_updates table table-hover  no-footer dtr-inline"
                                                    id="datatables" role="grid" style="width: 816px;">
                                                    <thead>
                                                        <tr role="row">
                                                            <th class="sorting_disabled" rowspan="1" colspan="1"
                                                                style="width: 800px;">Messages</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <tr class="odd">
                                                            <td colspan="2" class="dataTables_empty" valign="top">No
                                                                data available in table</td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot></tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
        }
        }else{ ?>
        <div class="col-md-9 col-sm-12 col-xs-12 no-padding no-margin">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12">
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>Orders </h2>
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
                                <th>Status</th>
                                <th>Payment</th>
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
                                        if($d['status'] == 'Pending'){ ?>
                                    <label class="label label-info"><?=$d['status']?></label>
                                    <?php
                                        }else{ ?>
                                    <label class="label label-success"><?=$d['status']?></label>
                                    <?php } ?>
                                </td>
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
                                        <a href="<?=ACC_ORDER_DETAILS_URL?><?=$d['id']?>"
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
                                <th>Status</th>
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

</div>

<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $(document).ready(function () {
        $('#datatables').DataTable();
    });
</script>
<script>
    $('.order_cancel_btn').click(function () {
        let order_id = $(this).attr('data-order-id');
        $.ajax({
                url: "<?=BASE_URL?>/api/order.php",
                method: 'POST',
                data: {
                    "action": "cancel-order",
                    "order_id": order_id
                },
                dataType: 'JSON'
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 2000,
                        onHidden: function () {
                            location.replace("<?=ACC_ORDERS_URL?>");
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
                });
            });
    });
</script>

<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>