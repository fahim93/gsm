<script src="<?=BASE_URL?>assets/components/jquery/dist/jquery.min.js"></script>
<script src="<?=BASE_URL?>assets/components/fancybox/jquery.fancybox.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/bootstrap.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/bootstrap-hover-dropdown.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/owl.carousel.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/css_browser_selector.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/echo.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/jquery.easing-1.3.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/bootstrap-slider.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/jquery.raty.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/jquery.prettyPhoto.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/jquery.customSelect.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/wow.min.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/scripts.js"></script>
<script src="<?=BASE_URL?>assets/js/theme/buttons.js"></script>
<script src="<?=BASE_URL?>assets/js/jsoft-functions.js"></script>
<script src="<?=BASE_URL?>assets/js/jsoft-scripts.js"></script>
<script src="<?=BASE_URL?>assets/js/jsoft-custom.js"></script>

<!-- simple-list-grid -->
<script src="<?=BASE_URL?>assets/js/simple-list-grid/simple-list-grid.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>
<!-- Form Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"
  type="text/javascript"></script>
<!-- Bootstrap SELECT -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js"
  type="text/javascript"></script>

<script src="<?=BASE_URL?>plugins/bootstrap-select-country-4.2.0/js/bootstrap-select-country.min.js"
  type="text/javascript"></script>

<!-- common js  -->
<script src="<?=BASE_URL?>js/common.js"></script>


<!-- <script>
  $(document).ready(function () {
    // validate jwt to verify access
    let jwt = getCookie('jwt');
    $.post('<?=BASE_URL?>api/validate_token.php', JSON.stringify({
      jwt: jwt
    })).done(function (data) {
      if (data.status == 1) {
        showLoggedInMenu();
      } else {
        showLoggedOutMenu();
      }
    }).fail(function (data) {
      showLoggedOutMenu();
    });
  });
</script> -->

<script>
  $('#logout_button').click(function () {
    let customer_id = "<?=$customer_id?>";
    $.ajax({
        url: '<?=BASE_URL?>api/logout.php',
        method: 'POST',
        data: {
          "customer_id": customer_id
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
            timeOut: 3000,
            onHidden: function () {

            }
          });
        }
      })
      .fail(function (data) {
        toastr.error('', "Some Problem Occured. Please Try Again Later.", {
          timeOut: 5000,
        });
      });
  });
</script>


<script>
  $('[data-toggle="tooltip"]').tooltip();

  function AgentToggle(element, country) {
    $('.agent-header-box.active').removeClass('active');
    if ($('.agent-info-box[title=' + country + ']').is(":visible")) {
      $('.agent-info-box').hide();
    }
    $(element).find('.agent-header-box').first().addClass('active');
    $('.agent-info-box').hide();
    $('.agent-info-box[title=' + country + ']').show();
  }

  $('.agent-header-box[title]').on('click', function () {
    return AgentToggle(this, $(this).attr('title'));
  });
</script>