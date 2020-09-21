<?php include('../../layout/header.php'); ?>
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
                            <a href="https://gsmtechmaster.com/dashboard">
                                <i class="fa fa-angle-right fw-r10"></i>Dashboard
                            </a>
                        </li>
                        <li class="">
                            <a href="https://gsmtechmaster.com/profile">
                                <i class="fa fa-angle-right fw-r10"></i>Profile
                            </a>
                        </li>


                        <li class="">
                            <a href="https://gsmtechmaster.com/my-package">
                                <i class="fa fa-angle-right fw-r10"></i>Packages
                            </a>

                        </li>
                        <li class="">
                            <a href="https://gsmtechmaster.com/my-files">
                                <i class="fa fa-angle-right fw-r10"></i>Files
                            </a>
                        </li>

                        <li class="">
                            <a href="https://gsmtechmaster.com/my-orders">
                                <i class="fa fa-angle-right fw-r10"></i>Orders
                            </a>
                        </li>
                        <li class="">
                            <a href="https://gsmtechmaster.com/my-invoice">
                                <i class="fa fa-angle-right fw-r10"></i>Invoices
                            </a>
                        </li>
                        <li class="">
                            <a href="https://gsmtechmaster.com/my-transaction">
                                <i class="fa fa-angle-right fw-r10"></i>Transactions
                            </a>
                        </li>
                        <li class="">
                            <a href="https://gsmtechmaster.com/my-transfers">
                                <i class="fa fa-angle-right fw-r10"></i>Transfers
                            </a>
                        </li>

                        <li class="">
                            <a href="https://gsmtechmaster.com/my-downloads">
                                <i class="fa fa-angle-right fw-r10"></i>Downloads
                            </a>
                        </li>

                    </ul>
                </div>;
            </div>

        </div>
        <div class="col-md-6 col-sm-12 col-xs-12">

            <div class="panel panel-default">
                <div class="panel-heading bg-gray">
                    <h3 class="panel-title"><i class="fa fa-user fw-r10"></i>fahim | Dahsboard</h3>
                </div>
                <div class="panel-body form-horizontal">
                    <div class="form-group form-group-view">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Username</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p class="font-15">Fahimul Islam</p>
                        </div>
                    </div>
                    <div class="form-group form-group-view">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p class="font-15">fahimulislam93@gmail.com</p>
                        </div>
                    </div>
                    <div class="form-group form-group-view">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Join</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p class="font-15">
                                20 September,2020
                            </p>
                        </div>
                    </div>


                    <div class="form-group form-group-view">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">Last Login</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p class="font-15">21 September,2020 at 02:34:17 pm</p>
                        </div>
                    </div>
                    <div class="form-group form-group-view">
                        <label class="col-md-3 col-sm-3 col-xs-12 control-label">IP Address</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                            <p class="font-15">182.48.76.186</p>
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
                            0.00

                            USD</span></h2>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-block btn-primary" data-toggle="modal"
                        data-target="#balance-recharge-modal"><i class="fa fa-repeat fw-r10"></i>Recharge
                        Balance</button>
                    <button class="btn btn-block btn-secondary" data-toggle="modal"
                        data-target="#balance-transfer-modal"><i class="fa fa-exchange fw-r10"></i>Transfer
                        Balance</button>

                </div>
            </div>
        </div>
    </div>

</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $.fn.serializeObject = function () {

        var o = {};
        var a = this.serializeArray();
        $.each(a, function () {
            if (o[this.name] !== undefined) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || '');
            } else {
                o[this.name] = this.value || '';
            }
        });
        return o;
    };
    $('#login_form').submit(function (event) {
        event.preventDefault();
        let login_form = $(this);
        let form_data = JSON.stringify(login_form.serializeObject());
        // let form_data = new FormData(this);
        $.ajax({
                url: '<?=BASE_URL?>api/login.php',
                method: 'POST',
                contentType: 'application/json',
                data: form_data
            })
            .done(function (data) {
                if (data.status == 1) {
                    toastr.success('', data.message, {
                        timeOut: 3000,
                        onHidden: function () {

                        }
                    });
                } else {
                    toastr.error('', data.message, {
                        timeOut: 5000,
                    });
                }
            })
            .fail(function (data) {
                toastr.error('', 'Some Problem Occured. Please Try Again.', {
                    timeOut: 5000,
                });
            });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>