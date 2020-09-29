<?php include('../../layout/header.php'); ?>
<?php
if(!isset($_SESSION['shopping_cart']) || empty($_SESSION['shopping_cart'])){
    header('Location:'.BASE_URL);
}
?>
<?php include(ROOT_PATH.'layout/navbar.php'); ?>

<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="animate-dropdown">
    <div id="breadcrumb-alt" class="mar5">
        <div class="container">
            <div class="breadcrumb-nav-holder minimal">
                <ul>
                    <li class="breadcrumb-item"><a href="<?=BASE_URL?>">Home</a></li>
                    <li class="breadcrumb-item current"><a href="">Shopping Cart</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">

    <div class="inline-width">
        <div class="container">
            <h2 class="section-title"><i class="fa fa-shopping-cart fw-r10"></i>Shopping Cart</h2>
        </div>
    </div>

    <div id="cart-page">
        <div class="container">
            <style>
                .crose {
                    text-decoration: line-through;
                    font-weight: bold;
                    color: red;
                }
            </style>
            <div class="col-md-3 col-sm-12 col-xs-12 narrow sidebar no-margin">
                <div class="widget cart-summary">
                    <h2 class="border">Summary</h2>
                    <div class="body">
                        <ul class="tabled-data no-border inverse-bold">
                            <li>
                                <label>Subtotal</label>
                                <div class="value pull-right"><?=isset($grand_sub_total) ? number_format((float)$grand_sub_total, 2, '.', '') : 0.00 ?> USD</div>
                            </li>
                            <li>
                                <label>Discount</label>
                                <div class="value pull-right"><?=isset($discount) ? number_format((float)$discount, 2, '.', '') : 0.00 ?> USD</div>
                            </li>
                            <li>
                                <label>Taxes</label>
                                <div class="value pull-right"><?=isset($tax) ? number_format((float)$tax, 2, '.', '') : 0 ?> USD</div>
                            </li>
                        </ul>
                        <ul id="total-price" class="tabled-data inverse-bold no-border">
                            <li>
                                <label>Total</label>
                                <div class="value pull-right">
                                    <span class="totl"><?=isset($grand_total) ? number_format((float)$grand_total,2, '.', '') : 0.00 ?></span>
                                    <span class="text-info text-bold cupontotal"></span>

                                    USD
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div id="cupon-widget" class="widget">
                    <h2 class="border">Coupon</h2>
                    <div class="body">
                        <form method="get" action="#">
                            <div class="inline-input">
                                <input name="coupon" id="cuponcode" class="input-lfont" placeholder="Coupon Code"
                                    value="">
                                <span id="rcbutton"><button class="le-button" type="button" id="cupponbutton"
                                        onclick="checkCupon()" title="" data-toggle="tooltip"
                                        data-original-title="Check Cupon"><i class="fa fa-check"></i></button></span>
                                <span class="text-danger text-bold" id="cuppon_error"></span>
                                <span class="text-info text-bold" id="cuppon_value"></span>
                            </div>
                        </form>
                    </div>
                </div>
                <script>
                    function checkCupon() {
                        let check = $('#cuponcode').val();
                        let rcu =
                            '<a href="https://gsmtechmaster.com/remove-cupon"><button class="le-button" type="button"><i class="fa fa-remove"></i></button></a>';
                        if (check != '') {
                            $.ajax({
                                url: "https://gsmtechmaster.com/check-cupon",
                                type: 'POST',
                                data: {
                                    check: check
                                },
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function (data) {
                                    if (data == 'error') {
                                        $('#cuppon_error').html('Invalid Cupon');
                                        $('#cuppon_value').html('');
                                        setTimeout(function () {
                                            $('#cuppon_error').fadeOut('slow');
                                        }, 3000);
                                    } else {
                                        if (data > 0) {
                                            let bill = parseFloat($('.subto').text());
                                            $('.totl').addClass('crose');
                                            let fbil = parseFloat(bill) - parseFloat(data);
                                            $('.cupontotal').text(fbil);
                                            $('#cuppon_value').html('Cupon Value : ' + data + ' ' + 'USD');
                                            $('#rcbutton').html(
                                                '<a href="https://gsmtechmaster.com/remove-cupon" title="Remove Cupon" data-toggle="tooltip"><button class="le-button" type="button"><i class="fa fa-remove"></i></button></a>'
                                            );
                                            $('#cuponcode').attr('readonly', 'true')
                                        }
                                    }
                                }
                            });


                        }
                    }
                </script>
            </div>

            <div class="col-md-9 col-sm-12 col-xs-12 items-holder">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="box pad-10 no-margin">
                        <?php
                        if(isset($_SESSION['shopping_cart']) && (!empty($_SESSION['shopping_cart']['file']) || !empty($_SESSION['shopping_cart']['package']))){ ?>
                        <table class="table invoice-view-table cart-view-table">
                            <thead>
                                <tr>
                                    <th>Item</th>
                                    <th>Price</th>
                                    <th>Q</th>
                                    <th>Subtotal</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if(isset($_SESSION['shopping_cart']['package']) && !empty($_SESSION['shopping_cart']['package'])){
                                    foreach($_SESSION['shopping_cart']['package'] as $item){ ?>
                                        <tr>
                                            <td>
                                                <a class="item-title-link" href="<?=PACKAGE_URL?>"><?=$item['title']?></a>
                                            </td>
                                            <td><span class="item-price"> <span class="subto"><?=number_format((float)$item['price'],2, '.', '')?></span> <?=$item['price_unit']?></span></td>
                                            <td><span class="item-quantity"><?=$item['quantity']?></span></td>
                                            <td><span class="item-subtotal"><?=number_format((float)$item['sub_total'],2, '.', '')?> <?=$item['price_unit']?></span></td>
                                            <td><span class="item-discount"><?=number_format((float)$item['discount'],2, '.', '')?> USD</span></td>
                                            <td><span class="item-total"><?=number_format((float)$item['total'],2, '.', '')?> <?=$item['price_unit']?></span></td>
                                            <td><button data-package-id="<?=$item['package_id']?>"
                                                    class="btn btn-xs btn-danger remove_package_btn"><i class="fa fa-minus"></i></button></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                if(isset($_SESSION['shopping_cart']['file']) && !empty($_SESSION['shopping_cart']['file'])){
                                    foreach($_SESSION['shopping_cart']['file'] as $item){ ?>
                                        <tr>
                                            <td>
                                                <a class="item-title-link" href="<?=FILE_URL?><?=$item['file_id']?>"><?=$item['title']?></a>
                                            </td>
                                            <td><span class="item-price"> <span class="subto"><?=number_format((float)$item['price'],2, '.', '')?></span> <?=$item['price_unit']?></span></td>
                                            <td><span class="item-quantity"><?=$item['quantity']?></span></td>
                                            <td><span class="item-subtotal"><?=number_format((float)$item['sub_total'],2, '.', '')?> <?=$item['price_unit']?></span></td>
                                            <td><span class="item-discount"><?=number_format((float)$item['discount'],2, '.', '')?> USD</span></td>
                                            <td><span class="item-total"><?=number_format((float)$item['total'],2, '.', '')?> <?=$item['price_unit']?></span></td>
                                            <td><button data-file-id="<?=$item['file_id']?>"
                                                    class="btn btn-xs btn-danger remove_file_btn"><i class="fa fa-minus"></i></button></td>
                                        </tr>
                                    <?php
                                    }
                                }
                                ?>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="5" class="text-right">Subtotal</th>
                                    <th colspan="2"><span class="invoice-subtotal"><?=isset($grand_sub_total) ? number_format((float)$grand_sub_total, 2, '.', '') : 0.00 ?> USD</span></th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-right">Discount</th>
                                    <th colspan="2"><span class="invoice-discount"><?=isset($discount) ? number_format((float)$discount, 2, '.', '') : 0.00 ?> USD</span></th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-right">Taxes</th>
                                    <th colspan="2"><span class="invoice-taxes"><?=isset($tax) ? number_format((float)$tax, 2, '.', '') : 0.00 ?> USD</span></th>
                                </tr>
                                <tr>
                                    <th colspan="5" class="text-right">Total</th>
                                    <th colspan="2">
                                        <span class="invoice-total">
                                            <span class="totl"><?=isset($grand_total) ? number_format((float)$grand_total, 2, '.', '') : 0.00 ?></span>
                                            <span class="cupontotal"></span>

                                            USD</span>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                        <?php
                        } ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="text-right pad-10">
                        <button class="btn btn-primary clear_cart_btn">EMPTY SHOPPING CART</button>
                    </div>
                </div>
                <form method="post" id="confirm_order_btn">
                    <input type="hidden" name="pack_id" value="2">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group">
                            <label>Do you have any notes about this order?</label>
                            <input name="notes" class="form-control" type="text" placeholder="Notes"
                                pattern=".{1,1000}">
                        </div>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="text-center mar-t-20">
                            <?php
                            if(is_logged_in()){ ?>
                            <button type="submit" class="btn btn-lg btn-block btn-success"><i class="fa fa-check fw-r10"></i>
                     Confirm Order</button>
                            <?php
                            }else{ ?>
                            <a href="<?=LOGIN_URL?>"><button type="button"
                                    class="btn btn-lg btn-block btn-info"><i class="fa fa-check fw-r10"></i>Login
                                    First</button></a>
                            <?php
                            }
                            ?>

                            <a href="<?=BASE_URL?>" class="btn btn-md btn-block btn-default"><i
                                    class="fa fa-caret-left fw-r10"></i>Go Back</a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<?php include(ROOT_PATH.'layout/footer.php'); ?>
<?php include(ROOT_PATH.'layout/scripts.php'); ?>
<script>
    $('.clear_cart_btn').click(function () {
    $.ajax({
        url: '<?=BASE_URL?>api/cart.php',
        method: 'POST',
        data: {
          "action": "clear"
        },
        dataType: 'JSON'
      })
      .done(function (data) {
        if (data.status == 1) {
          toastr.success('', data.message, {
            timeOut: 2000,
            onHidden: function () {
              location.reload();
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
<script>
    $('#confirm_order_btn').submit(function(event){
        event.preventDefault();
        let form_data = new FormData(this);
        form_data.append('action', 'create-order');
        $.ajax({
            url: "<?=BASE_URL?>api/order.php",
            method: 'POST',
            data: form_data,
            dataType: 'JSON',
            contentType: false,
            processData: false
        })
        .done(function(data){
            if(data.status == 1){
                toastr.success('', data.message, {
                    timeOut: 2000,
                    onHidden: function(){
                        location.reload();
                    }
                });
            }else{
                toastr.error('', data.message, {
                    timeOut: 5000
                });
            }
        })
        .fail(function(data){
            toastr.error('', 'Some Problem Occurred. Please Try Again Later.', {
                timeOut: 5000
            });
        });
    });
</script>
<?php include(ROOT_PATH.'layout/foot-scripts.php'); ?>