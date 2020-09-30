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
                        <li class="active">
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
                    <h2 class="border mar-b-30"><i class="fa fa-caret-right fw-r10"></i>File </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <table id="datatables" class="display table table-responsive">
                        <thead>
                            <tr>
                                <th>File</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $customer = $_SESSION['customer_id'];
                            $data = json_decode(file_get_contents(BASE_URL."api/customer-file.php?customer=".$customer), true);
                            if(!empty($data)){
                                foreach($data as $d){ ?>
                            <tr>
                                <td><?=$d['file_title']?></td>
                                <td><?=$d['created_at']?></td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="javascript:void(0)"
                                            class="btn btn-sm btn-info btn-dt customer_file_details_view"
                                            data-id="<?=$d['id']?>"><i class="fa fa-eye fw-r5"></i>View</a>
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
                                <th>File</th>
                                <th>Date</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
<div id="customer_file_view_modal" class="modal fade modal-dialog-form in" role="dialog" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header pad-10 primary-bg">
                <button type="button" class="close" data-dismiss="modal">×</button>
                <h5 class="modal-title"><i class="fa fa-shopping-cart fw-r10"></i>File</h5>
            </div>
            <div class="ready-place" id="show_data">
                <div class="modal-body form-horizontal pad-10">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="form-group form-group-view">
                                <label class="col-md-3 col-sm-3 col-xs-12 control-label">File Name</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                    <p id="customer_file_details_title" class="font-14 text-bold break-word">

                                    </p>
                                </div>
                            </div>

                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-12 control-label">Date</label>
                            <div class="col-md-9 col-sm-9 col-xs-12">
                                <p id="customer_file_details_date" class="font-14 text-bold break-word">
                                </p>
                            </div>
                        </div>
                        <div class="form-group form-group-view">
                            <label class="col-md-3 col-sm-3 col-xs-6 control-label">Invoice</label>
                            <div class="col-md-9 col-sm-9 col-xs-6">
                                <p class="font-13">
                                    <a id="customer_file_details_invoice" href=""></a>
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <a id="customer_file_details_download_link" href="" class="btn btn-block btn-link"
                                target="_blnk">Download File</a>
                        </div>
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
    $('.customer_file_details_view').click(function () {
        let id = $(this).attr('data-id');
        $.ajax({
            url: "<?=BASE_URL?>api/customer-file.php",
            method: 'POST',
            data: {
                "id": id,
                "action": "get-details"
            },
            dataType: "JSON"
        }).done(function (data) {
            if (data.status == 1) {
                let d = data.data;
                $('#customer_file_details_title').text(d.file_title);
                $('#customer_file_details_date').text(d.created_at);
                $('#customer_file_details_invoice').text('#' + d.order_no);
                $('#customer_file_details_invoice').attr('href', "<?=ACC_INVOICE_DETAILS_URL?>" + d
                    .order_id);
                let file_url;
                if (d.file_method == 'upload') {
                    file_url = "<?=FILE_PATH?>" + d.file;
                } else {
                    file_url = d.direct_url;
                }
                $('#customer_file_details_download_link').attr("href", file_url);
                $('#customer_file_view_modal').modal();
            }
        }).fail(function (data) {

        });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>