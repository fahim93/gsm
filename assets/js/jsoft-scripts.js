if(typeof jQuery === 'undefined') throw new Error('RES requires jQuery');
if(typeof jsoftData === "undefined" || $.type(jsoftData) !== "object") jsoftData = {};
if(typeof jsoftData.system === "undefined") jsoftData.system = {};

var resPreviousHASH = "";
var resUniqueC = parseInt(new Date().getTime() / 1000);
var dtHelper = new datatableHelper();
var pageHash = new hashPage();

function jsoftCheckPermission(permission) {
  return (typeof jsoftData.userPermissions[permission] !== "undefined")? jsoftData.userPermissions[permission] : false;
}

function jsoftFormatCurrency(amount) {
    if(!amount) amount = 0;
    var cDecimals = (typeof jsoftData.system.currency_decimals !== "undefined")? jsoftData.system.currency_decimals : 2;
    var cPrefix = (typeof jsoftData.system.currency_prefix !== "undefined")? jsoftData.system.currency_prefix : '';
    var cSuffix = (typeof jsoftData.system.currency_suffix !== "undefined")? jsoftData.system.currency_suffix : '';
    return cPrefix + parseFloat(amount).toFixed(cDecimals) + cSuffix;
}

function doRequestJson(postData,is_silent) {
    var requestOP = $.post({'async':false, 'url': jsoftData.system.userapi + '?a=jsonp', 'data': postData}).done(function(response) {
      return response;
    }).responseText;
    try {
      postResponse = $.parseJSON(requestOP);
    } catch(err) {
      postResponse = false;
    }
    if(!is_silent) alertPostResponse(postResponse);
 return postResponse;
}

function alertPostResponse(postResponse) {
  if(postResponse && typeof postResponse.msg !== "undefined" && typeof postResponse.type !== "undefined")
      return c_alert(postResponse.msg,postResponse.type);
  return c_alert(false,'error');
}

function modalResetActions(pmodal) {
  $(pmodal).find('.ready-hbs-content').remove();
  $(pmodal).find('select.select2').each(function() {
    if(typeof $(this).data('select2') !== "undefined") {
      if(typeof $(this).data('spurl') !== "undefined") $(this).html('<option></option>').trigger('change');
      else $(this).val('').trigger('change');
      $(this).select2('destroy');
    }
    $(this).val('');
  });
  $(pmodal).find('.tags-input').each(function() {
	  if($(this).data('tagsinput') !== "undefined" && $(this).data('tagsinput'))
	  $(this).tagsinput('removeAll');
  });
  $(pmodal).find('form').each(function() {
    $(this)[0].reset();
    if(typeof $.validator !== "undefined") $(this).validate().resetForm();
    onResetForm(this);
  });
  $(pmodal).find('table.dt_modal_table').each(function() {
    if($.fn.DataTable.isDataTable(this)) $(this).DataTable().destroy(true);
  });
  return true;
}

function getRowData(element) {
    var DTable_closest = $(element).closest('table.dataTable');
    if(!DTable_closest.length) return false;
    var DTable = DTable_closest.DataTable();
    var rowdata = DTable.row($(element).closest('tr')).data();
      if(typeof rowdata === 'undefined') {
            var tr = $(element).parents('tr');
            if ($(tr).hasClass("child")) rowdata = DTable.row( $(element).parents('tr').prev('tr') ).data();
            else rowdata = DTable.row( $(element).parents('tr') ).data();
      }
    return rowdata;
}

function getDataFromDT(dtElement) {
  var dtData = false;
  if(typeof $(dtElement).attr('modalv-extend') !== "undefined" && $(dtElement).attr('modalv-extend')
  && $($(dtElement).attr('modalv-extend')).length && typeof $($(dtElement).attr('modalv-extend')).data('readyData') !== "undefined"
  && $($(dtElement).attr('modalv-extend')).data('readyData')) {
      var rowData = $($(dtElement).attr('modalv-extend')).data('readyData');
  } else if(typeof $(dtElement).attr('modalv-form') !== "undefined" && $(dtElement).attr('modalv-form') && $($(dtElement).attr('modalv-form')).length > 0) {
      var rowData = form2Object($(dtElement).attr('modalv-form'));
  } else {
      var rowData = $(dtElement).hasClass('data-btn')? $(dtElement).data() : getRowData(dtElement);
  }
  if(typeof $(dtElement).attr('modalv-route') !== "undefined" && $(dtElement).attr('modalv-route')) {
      if(!rowData) rowData = {};
      var modalv_route = $(dtElement).attr('modalv-route').split('/');
      if(modalv_route.length >= 1) rowData.b = modalv_route[0];
      if(modalv_route.length >= 2) rowData.op = modalv_route[1];
      dtData = doRequestJson(rowData,true);
      if(!dtData) return false;
  }
  if(!dtData) dtData = rowData;
  return dtData;
}

function getReadyContent(readyElement,readyData) {
  if(!readyData) readyData = [];
  if(!$('#ready-contents').find(readyElement).length) return false;
  var readyContent = $('#ready-contents').find(readyElement).clone();
  readyContent = hbsCompile($(readyContent),readyData);
  return readyContent;
}

function renderReadyData(mainContainer,readyElement,readyData) {
  if(!readyData) return false;
  var readyConent = getReadyContent(readyElement,readyData);
  $(mainContainer).find('.ready-place').html(readyConent);
  $(mainContainer).data('readyData',readyData);
  resActions(mainContainer);
}

function onResetForm(form) {
  return resActions(form);
}

function processFormResponse(form,postResponse,postData) {
  if(!postResponse) return false;
  if(typeof postResponse.type !== "undefined" && postResponse.type == "success") {
    if(typeof $(form).data('hidemod') !== "undefined" && $(form).data('hidemod')) {
      $($(form).data('hidemod')).modal('hide');
    } else if(typeof $(form).data('resform') !== "undefined" && $(form).data('resform')) {
        $(form).find('select.select2').each(function() {
          if(typeof $(this).data('select2') !== "undefined") {
            if(typeof $(this).data('spurl') !== "undefined") $(this).html('<option></option>').trigger('change');
            else $(this).val('').trigger('change');
            $(this).select2('destroy');
          }
          $(this).val('');
        });
        $(form)[0].reset();
        if(typeof $.validator !== "undefined") $(form).validate().resetForm();
        onResetForm(form);
    }
    if(typeof $(form).data('pact') !== "undefined" && $(form).data('pact')) {
        var pactref = ($(form).data('pactref') !== "undefined")? $(form).data('pactref') : null;
        window[$(form).data('pact')](pactref,postData,postResponse);
    }
    if(typeof $(form).data('rtable') !== "undefined" && $(form).data('rtable')) {
      reloadDatatable($(form).data('rtable'));
    }
  }
  return true;
}

function formDataUpload(form) {
  var openData = $(form).find('datalist,input,number,select,radio').serialize();
  var reqURL = jsoftData.system.userapi + "?a=jsonp";
  if(openData) {
    openData += "&";
    $(form).find('input[type="checkbox"]').each(function() {
        if($(this).prop('checked') == true) {
          openData = openData.replaceAll($(this).attr('name')+'=0&','');
        }
    });
    openData = openData.slice(0,-1);
    if(openData) reqURL += "&" + openData;
  }

  if(($(form).find('.textarea-render-ckeditor').length || $(form).find('.textarea-ckeditor-instances').length) && typeof CKEDITOR !== "undefined" && typeof CKEDITOR.instances !== "undefined") {
  	for(instance in CKEDITOR.instances) {
  		CKEDITOR.instances[instance].updateElement();
  	}
  }

  if(($(form).find('.mce-tinymce').length|| $(form).find('.textarea-tinymce-instances').length) && typeof tinymce !== "undefined")
	tinymce.triggerSave();

  var postData = new FormData();
  $.each($(form).find('input[type="file"]'),function() {
    if(this.files !=="undefined" && this.files[0])
      postData.append($(this).attr('name'),this.files[0]);
  });

  $.each($(form).find('textarea'),function() {
    postData.append($(this).attr('name'),$(this).val());
  });

  var xhr = new XMLHttpRequest();
  var uploadStatus = xhr.upload;

  $('#upload-bar-modal').find('.upload-cancel-button').off('click').on('click',function(e) {
      xhr.abort();
      $('#upload-bar-modal').modal('hide');
  });
  $('#upload-bar-modal').find('.upload-progress-percent').html('0%');
  $('#upload-bar-modal').find('.progress .progress-bar').attr('aria-valuenow',0);
  $('#upload-bar-modal').find('.progress .progress-bar').css('width','0%');

  xhr.open("POST",reqURL,true);

  xhr.onloadstart = function(event) {
    $('#upload-bar-modal').modalZindex();
    $('#upload-bar-modal').modal('show');
  };

  xhr.upload.onprogress = function(event) {
      if(!event.lengthComputable) return true;
      var completed = (event.loaded / event.total) * 100;
      $('#upload-bar-modal').find('.upload-progress-percent').html(parseFloat(completed).toFixed(2) + '%');
      $('#upload-bar-modal').find('.progress .progress-bar').attr('aria-valuenow',parseInt(completed));
      $('#upload-bar-modal').find('.progress .progress-bar').css('width',parseFloat(completed).toFixed(2) + '%');
  };

  xhr.onerror = function(event) {
      $('#upload-bar-modal').modal('hide');
      c_alert(false,'error');
  };

  xhr.onabort = function(event) {
      $('#upload-bar-modal').modal('hide');
  };

  xhr.onload = function() {
    $('#upload-bar-modal').modal('hide');
  };

  xhr.onreadystatechange = function() {
    if(xhr.readyState === 4) {
      var postResponse = false;
      try {
        postResponse = $.parseJSON(xhr.responseText);
      } catch(err) {
        postResponse = false;
      }
      if(xhr.status === 200) {
        $('#upload-bar-modal').modal('hide');
        processFormResponse(form,postResponse,postData);
      }
      return alertPostResponse(postResponse);
    }
  };

  xhr.send(postData);
}

function nfieldappend(readyElement,container) {
  if(!$('#ready-contents').find(readyElement).length || !$(container).length) return false;
  var nClone = $('#ready-contents').find(readyElement).clone();
  var uvalue = (typeof $(container).data('uvalue') !== "undefined" && $(container).data('uvalue'))?
                parseInt($(container).data('uvalue')) : 0;
  nClone.html(nClone.html().replaceAll('xoxox',uvalue + 1));
  var NewField = $(nClone.html()).appendTo(container);
  resActions(NewField);
  $(container).data('uvalue',uvalue + 1);
}


function renderSelect2(controller = document) {

	$(controller).find('select.select2').each(function() {
      if(typeof $(this).data('spurl') !== "undefined" && $(this).data('spurl')) {
        var spurl = jsoftData.system.userapi + '?a=select2&b=' + $(this).data('spurl');
        var allowclear = (typeof $(this).data('allowclear') !== "undefined" && $(this).data('allowclear'))? true : false;
          $(this).select2({
            allowClear: allowclear,
            dropdownParent: $(controller).hasClass('modal')? $(controller).find('.modal-dialog').first() : null,
            ajax: {
              url: spurl,
              dataType: 'json',
              cache: true,
              delay: 100,
              data: function (params) {
                var preturns = {
                    q: params.term,
                    page: params.page
                  };
                return preturns;
              },
              processResults: function (data) {
                return {
                  results: $.map(data, function (item) {
                                      return {
                                          text: item.text,
                                          id: item.id,
                                          cv: item.cv,
                                      }
                                  })
                };
              }
            },
          });
        } else $(this).select2({
          dropdownParent: $(controller).hasClass('modal')? $(controller).find('.modal-dialog').first() : null,
        });

      if($(this).data('sp-single') !== "undefined" && $(this).data('sp-single')) $(this).on('select2:opening', function (evt) {
        	$(this).val('');
      });

  });

return true;
}

function resActions(controller) {
  if(!controller) controller = document;

  $(controller).find('form').each(function() {
    if(typeof $.validator !== "undefined") $(this).validate();
    $(this)[0].reset();
  });

	$(controller).find('form.form-jsonp').unbind('submit').submit(function(e){
		e.preventDefault();
    var self = this;
    if(!doFormValidate(self)) return false;
    if(typeof $(self).attr('enctype') !== "undefined" && $(self).attr('enctype') == "multipart/form-data") {
      return formDataUpload(self);
    } else {
      var postData = form2Object(self);
      var postResponse = doRequestJson(postData);
      return processFormResponse(self,postResponse,postData);
    }
  });

  $(controller).find('form.form-custom-submit').unbind('submit').submit(function(e){
    e.preventDefault();
    var self = this;
    if(!doFormValidate(self)) return false;
    if(typeof $(self).data('customc') !== "undefined" && $(self).data('customc'))
      window[$(self).data('customc')](e,self);
    return true;
  });

  $(controller).find('form.form-no-submit').unbind('submit').submit(function(e){
    e.preventDefault();
    var self = this;
    if(!doFormValidate(self)) return false;
    return true;
  });

  $(controller).find('.dt-filter-form').off('change').on('change','.dt-filter-toggle',function(e){
    var self = $(this).parents('.dt-filter-form').first();
    if(!self.data('tabdt') || !self.data('tabbase') || !$(self.data('tabdt')).length) {
      e.preventDefault();
      return false;
    };
    var baseURL = jsoftData.system.userapi + '?a=datatables&b='+self.data('tabbase');
    self.find('.dt-filter-toggle').each(function() {
        if($(this).val() == '' || $(this).val() == null) return true;
        baseURL += '&opp_filter['+$(this).attr('name')+']='+$(this).val();
    });
    $(self.data('tabdt')).DataTable().ajax.url(baseURL).load();
    return true;
  });

  $(controller).find('img[def-src]').each(function() {
    $(this).attr('src',$(this).attr('def-src'));
  });

  $(controller).find('input[bind-urp]').off('change').on('change',function() {
    var target = $(this).attr('bind-urp');
    if(!target.length) return true;
    imageDataURL(this,target);
  });

  $(controller).find('select[bind-sel]').not('[bind-stitle]').each(function() {
    $(this).val($(this).attr('bind-sel'));
  });

  $(controller).find('input[type="checkbox"][data-iclass]').each(function() {
    var dataclass = $(this).data('iclass');
    $(this).iCheck({
      checkboxClass: dataclass
    });
  });

  $(controller).find('input[type="radio"][data-iclass]').each(function() {
    var dataclass = $(this).data('iclass');
    $(this).iCheck({
      radioClass   : dataclass
    });
  });

  $(controller).find('input[data-iclass][onchange]').off('ifToggled').on('ifToggled', function(event){
    return $(this).trigger("change");
  });

  $(controller).find('button[modalv],a[modalv],input[type="hidden"][role="button"]').off('click').on('click',function() {

      if(!$(this).hasClass('btn-dt') && (typeof $(this).attr('modalv-route') === "undefined" || !$(this).attr('modalv-route'))
        && (typeof $(this).attr('modalv-form') === "undefined" || (typeof $(this).attr('type') === "undefined" || $(this).attr('type') !== "submit")))
        $($(this).attr('modalv')).modalShowUP();

      if(typeof $(this).attr('modalv-form') !== "undefined" && typeof $(this).attr('type') !== "undefined" && $(this).attr('type') == "submit") {
          if(!doFormValidate($(this).attr('modalv-form'))) return false;
      }

      var modal_v = $(this).attr('modalv');
      var readyData = getDataFromDT(this);
      if(!readyData && typeof $(this).attr('modalv-route') !== "undefined" && $(this).attr('modalv-route')) {
        return false;
      } else if(!readyData) readyData = [];
      if(typeof $(this).attr('modalv-ready') !== "undefined" && $(this).attr('modalv-ready')) {
        var modal_v_ready = $(this).attr('modalv-ready');
        renderReadyData(modal_v,modal_v_ready,readyData);
      } else resActions(modal_v);
      $(modal_v).modalShowUP();
      return true;
  });

  $(controller).find('textarea,.typo-textarea').each(function() {
    $(this).text($(this).text().replace(/(?:\\[rn]|[\r\n]+)+/g, '\n').replace(/\\(.)/mg, "$1"));
  });

  $(controller).find('div.tab-content').find('div.tab-pane.active').removeClass('active');
  $(controller).find('ul.nav.nav-tabs').find('li.active').removeClass('active');
  $(controller).find('ul.nav.nav-tabs').find('li:first').addClass('active');
  $(controller).find('div.tab-content').find('div.tab-pane:first').addClass('active');

  $(controller).find('.balance-view-text,.price-view-text').each(function() {
    $(this).html(jsoftFormatCurrency($(this).html()));
    $(this).removeClass('balance-view-text');
  });

  $(controller).find('.size-view-text').each(function() {
    $(this).html(bytes2Size($(this).html()));
    $(this).removeClass('size-view-text');
  });

  $(controller).find('.html-view-text').each(function() {
    $(this).html($.parseHTML($(this).text()));
  });

  $(controller).find('.percent-view-text').each(function() {
    if($(this).html().indexOf('/') <= 0) return true;
    var eq_values = $(this).html().split('/');
    if(!eq_values) eq_values = ['0','0'];
    var percentage = eq_values[0] / eq_values[1] * 100;
    percentage = percentage? parseFloat(percentage).toFixed(2) + '%' : '0%';
    $(this).html(percentage);
    $(this).removeClass('percent-view-text');
  });

  $(controller).find('.progress-bar[set-width]').each(function() {
    if($(this).attr('set-width').indexOf('/') <= 0) return true;
    var eq_values = $(this).attr('set-width').split('/');
    if(!eq_values) eq_values = ['0','0'];
    var percentage = eq_values[0] / eq_values[1] * 100;
    percentage = percentage? parseFloat(percentage).toFixed(2) + '%' : '0%';
    $(this).css("width",percentage);
    $(this).removeAttr('percent-view-text');
  });

  $(controller).find('.textarea-ckeditor-instances').each(function() {
      if(typeof $(this).attr('id') === "undefined") return true;
      CKEDITOR.instances[$(this).attr('id')].setData('');
  });

  $(controller).find('.textarea-render-ckeditor').each(function() {
      var nUniqueName = 'ckunique_id_' + parseInt(resUniqueC);
      $(this).attr('id',nUniqueName);
      $(this).addClass('textarea-ckeditor-instances');
      $(this).removeClass('textarea-render-ckeditor');
      if($(this).hasClass('full-ckeditor')) {
        CKEDITOR.replace(nUniqueName, {
          removeButtons: 'About,Anchor'
        });
      } else {
        CKEDITOR.replace(nUniqueName,{
          toolbarGroups: [
                    {"name":"basicstyles","groups":["basicstyles"]},
                    {"name":"links","groups":["links"]},
                    {"name":"paragraph","groups":["list","blocks"]},
                    {"name":"document","groups":["mode"]},
          ],
          removeButtons: 'Anchor'
        });
      }
      resUniqueC = resUniqueC + 1;
  });

  $(controller).find('.textarea-render-tinymce').each(function() {
      var nUniqueName = 'tmunique_id_' + parseInt(resUniqueC);
      $(this).attr('id',nUniqueName);
      $(this).addClass('textarea-tinymce-instances');
      $(this).removeClass('textarea-render-tinymce');

      var eHeight = null;
      if($(this).attr('rows') !== 'undefined' && parseInt($(this).attr('rows'))) {
        eHeight = parseInt($(this).attr('rows')) * 50;
        eHeight += 'px';
      }

      var eNoptag = 'p';
      if(typeof $(this).attr('noptag') !== "undefined")
        eNoptag = "";

      if($(this).hasClass('full-tinymce')) {
        tinymce.init({
          selector: '#' + nUniqueName,
          theme: 'modern',
          plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking',
            'save table contextmenu directionality emoticons template paste textcolor'
          ],
          toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons',
          height: eHeight,
          forced_root_block: eNoptag,
          branding: false
        });
      } else {
        tinymce.init({
          selector: '#' + nUniqueName,
          menubar: false,
          plugins: [
            'advlist autolink lists link image charmap print preview anchor textcolor',
            'searchreplace visualblocks code',
            'insertdatetime media table contextmenu paste code help wordcount'
          ],
          toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
          height: eHeight,
          forced_root_block: eNoptag,
          branding: false
        });
      }
      resUniqueC = resUniqueC + 1;
  });


  if($(controller).find('.tags-input').length)
  	$(controller).find('.tags-input').each(function(e) {
      var tagsURL = jsoftData.system.userapi + '?a=tags';
      if(typeof $(this).data('utype') !== "undefined" && $(this).data('utype'))
        tagsURL += '&b=' + $(this).data('utype');
        var tagSuggestions = new Bloodhound({
              datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
              queryTokenizer: Bloodhound.tokenizers.whitespace,
              remote: {
                url: tagsURL + '&q=%QUERY',
                wildcard: '%QUERY'
              },
        });

        $(this).tagsinput({
          typeaheadjs: {
            source: tagSuggestions.ttAdapter()
          }
        });
    });

  if($(controller).find('.twitter-typeahead').length)
	$(".twitter-typeahead").css('display', 'inline');

  if($(controller).find('.tt-input').length)
	$(controller).find('.tt-input').keypress(function(e){
		if(e.which == 13) { e.preventDefault(); return true; }
	});

  if(typeof $().datepicker !== "undefined" && $(controller).find('.input-datepicker').length)
    $(controller).find('.input-datepicker').datepicker({
        autoclose: true
    });
  $(controller).find('.default-hidden').hide();
  $(controller).find('.default-shown').show();
  $(controller).find('.default-empty').html(null);
  $(controller).find('.container-data-uvalue').data('uvalue',0);

  renderSelect2(controller);

  $(controller).find('select[bind-sel][bind-stitle]').each(function() {
    var bindSval = $(this).attr('bind-sel');
    var bindStitle = $(this).attr('bind-stitle');
      $(this).append($("<option></option>").attr("value",bindSval).attr("selected",true).text(bindStitle));
  });

}

function applyUserPermissions(element,container,arrayindex) {
  if($(element).val() === "undefined" || !$(element).val()) return true;
  var soption = $(element).find('option:selected').first();
  if(typeof soption === "undefined" || !soption || typeof soption.data('data') === "undefined") return true;
  var soption_data = soption.data('data');
  if(typeof soption_data['cv'] === "undefined") return true;
  var spermissions = JSON.parse(soption_data['cv']);

  if(!spermissions) return true;
  $(container).find('input[name][type="checkbox"][data-pfill]').each(function() {
    if(typeof spermissions[$(this).data('pfill')] === "undefined" || !spermissions[$(this).data('pfill')] || parseInt(spermissions[$(this).data('pfill')]) !== 1)
      $(this).prop('checked',false).iCheck('update');
    else $(this).prop('checked',true).iCheck('update');
  });
  return true;
}

$(function() {
  $('.modal').on('hidden.bs.modal', function () {
    if(typeof $(this).data('readyData') !== "undefined") $(this).data('readyData',null);
    if(typeof $(this).find('.ready-data') !== "undefined") $(this).find('.ready-data').html(null);
    modalResetActions(this);
    resActions(this);
    $('div.modal-backdrop').not('.modal').first().remove();
    if(!$('.modal.in').length) {
      if($('body').hasClass('modal-open')) $('body').removeClass('modal-open');
    } else {
      if(!$('body').hasClass('modal-open'))
        $('body').addClass('modal-open');
    }
    return true;
  });
  resActions();
});
