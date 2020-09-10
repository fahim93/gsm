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

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" type="text/javascript"></script>



<script>
  $('[data-toggle="tooltip"]').tooltip();
  function AgentToggle(element,country) {
    $('.agent-header-box.active').removeClass('active');
    if($('.agent-info-box[title=' + country + ']').is(":visible")) {
      $('.agent-info-box').hide();
    }
    $(element).find('.agent-header-box').first().addClass('active');
    $('.agent-info-box').hide();
    $('.agent-info-box[title=' + country + ']').show();
  }

  $('.agent-header-box[title]').on('click',function() {
    return AgentToggle(this,$(this).attr('title'));
  });
</script>