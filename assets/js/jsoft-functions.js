if(typeof jQuery === 'undefined') throw new Error('RES requires jQuery');
if(typeof jsoftData === "undefined" || $.type(jsoftData) !== "object") jsoftData = {};
if(typeof jsoftData.system === "undefined") jsoftData.system = {};

if(typeof Handlebars !== "undefined") {
  Handlebars.registerHelper('ifpositive', function(conditional, options) {
    if(conditional && parseInt(conditional) > 0)
      return options.fn(this);
    else return options.inverse(this);
  });

  Handlebars.registerHelper("switch", function(value, options) {
    this._switch_value_ = value;
    var html = options.fn(this);
    delete this._switch_value_;
    return html;
  });

  Handlebars.registerHelper('ifadv', function(v1, v2, comp, options) {
    switch(comp) {
      case 'yes':
        return (v1 && v2)? options.fn(this) : options.inverse(this);
      break;
      case 'not':
        return (!v1 && !v2)? options.fn(this) : options.inverse(this);
      break;
      case 'or':
        return (v1 || v2)? options.fn(this) : options.inverse(this);
      break;
      case 'orNot':
        return (v1 || !v2)? options.fn(this) : options.inverse(this);
      break;
    }
  });

  Handlebars.registerHelper("case", function(value, options) {
    if(value == this._switch_value_)
      return options.fn(this);
  });

  Handlebars.registerHelper('ifcondition', function(v1, v2, comp, options) {
    if((comp === "strict" && v1 === v2) || (comp === "normal" && v1 == v2))
      return options.fn(this);
    return options.inverse(this);
  });

  function hbsCompile(controller,data) {
    return Handlebars.compile($(controller).html())({'DATA': data,'JSOFT': jsoftData});
  }

}

if(typeof $.validator !== "undefined")
  $.validator.prototype.subset = function(container) {
  	var ok = true,
        self = this;
  	$(container).find(':input').each(function() {
  		if (!self.element($(this))) ok = false;
  	});
  	return ok;
  };

if(typeof $.fn.select2 !== "undefined")
  $.fn.select2.defaults.set("width","100%");

$.fn.extend({
  modalZindex: function() {
    return this.each(function() {
        var hzindex = 1050;
        $('.modal.in').not(this).each(function() {
            if($(this).css('z-index') >= hzindex)
              hzindex = $(this).css('z-index');
        });
        $(this).css({'z-index': parseInt(hzindex)+10});
    });
  },
  modalShowUP: function() {
    return this.each(function() {
        if($(this).hasClass('in')) {
            modalResetActions(this);
            resActions(this);
            $(this).trigger('shown');
        } else {
          $(this).modal('show');
        }
        $(this).modalZindex();
    });
  }
});

function generatePassword(length) {
    if(!length) length = 12;
    var charset = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789",
        retVal = "";
    for (var i = 0, n = charset.length; i < length; ++i) {
        retVal += charset.charAt(Math.floor(Math.random() * n));
    }
    return retVal;
}

function c_alert(msg,type) {
	if(!msg) msg = false;
	if(!type) type = 'error';
	if(!msg) msg = (type == 'error')? 'Unable to process requested action' : 'Action Processed';
	$.notify(msg, { className: type, position: "bottom right" });
return true;
}

function form2Object(form){
	var array = $(form).serializeArray(),
		obj = {};
	$.each(array, function() {
		obj[this.name] = this.value || '';
	});

	if($(form).find('textarea').length) {
		  if(($(form).find('.textarea-render-ckeditor').length || $(form).find('.textarea-ckeditor-instances').length) && typeof CKEDITOR !== "undefined" && typeof CKEDITOR.instances !== "undefined") {
			for(instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}
		  }

		  if(($(form).find('.mce-tinymce').length|| $(form).find('.textarea-tinymce-instances').length) && typeof tinymce !== "undefined")
			tinymce.triggerSave();

		  $(form).find('textarea[name]').each(function() {
			obj[$(this).attr('name')] = $(this).val();
		  });
	}

	return obj;
}

function bytes2Size(bytes,decimals) {
   if(typeof decimals === "undefined") decimals = 2;
   if(bytes == 0) return '0 Bytes';
   var k = 1024,
	   dm = decimals || 2,
	   sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
	   i = Math.floor(Math.log(bytes) / Math.log(k));
   return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

function bytes2Table(bytes,decimals) {
  if(typeof decimals === "undefined") decimals = 2;
  if (bytes == 0) return [0,'b'];
  var k = 1024,
	  dm = decimals || 2,
	  sizes = ['b', 'k', 'm', 'g', 't', 'p', 'e', 'z', 'y'],
	  i = Math.floor(Math.log(bytes) / Math.log(k));
  var nsize = parseFloat((bytes / Math.pow(k, i)).toFixed(dm)),
	  nunit = sizes[i];
  return [nsize,nunit];
}

function nonefunc() {
	return true;
}

function imageDataURL(input,target) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    reader.onload = function(e) {
      $(target).attr('src', e.target.result);
    }
    reader.readAsDataURL(input.files[0]);
  }
}

function doFormValidate(form) {
  $(form).validate();
  if($(form).valid() !== true) return false;
  return true;
}

function datatableHelper() {
  this.drawLink = function(text,attr) {
    if(!attr) attr = '';
      return '<a '+attr+'>'+text+'</a>';
  };
  this.drawBtn = function(text,type,size,icon,attr) {
    if(!text) text = '';
    if(!type) type = 'default';
    if(!size) size = 'xs';
    if(!attr) attr = '';
      return '<button '+attr+' class="btn btn-'+size+' btn-'+type+' btn-dt">'+(icon? '<i class="fa fa-'+icon+' '+(text? 'fw-r5' : '')+'"></i>' : '')+text+'</button>';
  };
  this.drawLabel = function(text,type) {
      return '<span class="label label-'+type+' label-dt">'+text+'</span>';
  };
}

function hashPage() {
  this.get = function() {
      return window.location.hash.replace('#!/','');
  };
  this.parse = function() {
      return window.location.hash.split('/').slice(1);
  };
  this.route = function() {
      var hashParse = this.parse();
      var routeRES = [];
      $.each(hashParse,function(k,v) {
        if(typeof v === "undefined" || v == "" || v.indexOf('::') > -1) return true;
        routeRES.push(v);
      });
      return routeRES;
  };
  this.change = function(hash,err) {
	if(!err) err = false;
    resPreviousHASH = this.get();
    if(hash == resPreviousHASH) return true;
    window.location.hash = "#!/" + hash;
    if(err) throw new Error(err);
    return false;
  };
  this.params = function() {
    var pageHash = this.parse();
    var parameters = {};
    var parser = /(?:^|&)([^&=]*)=?([^&]*)/g
      $.each(pageHash,function(k,v) {
          if(v.indexOf('::') == -1) return true;
          var kv = v.split(/::(.+)/);
          var paramKey = kv[0],
              paramVal = kv[1];
          parameters[paramKey] = {};
          paramVal.replace(parser, function ($0, $1, $2) {
            if($1) parameters[paramKey][$1] = $2;
          });
      });
    return parameters;
  };
}

function reloadDatatable(controller,callback) {
  if(!controller) controller = document;
  if(typeof callback === "undefined") callback = null;
  $(controller).each(function() {
    if($(this).hasClass('dataTable') && $.fn.DataTable.isDataTable(this)) {
  		$(this).DataTable().ajax.reload(callback,false);
  		return true;
  	}
    if(!$(this).find('table.dataTable:visible').length) return false;
    $(this).find('table.dataTable:visible').each(function() {
  			if($.fn.DataTable.isDataTable(this)) $(this).DataTable().ajax.reload(callback,false);
  	});
  });
return true;
}

function reloadPpage(postReference,postData,postResponse) {
  if(!postReference || postReference < 0) postReference = 0;
  setTimeout(function(){ window.location.reload(); }, postReference);
  return true;
}

Object.size = function(obj) {
    var size = 0, key;
    for (key in obj) {
        if (obj.hasOwnProperty(key)) size++;
    }
    return size;
};

String.prototype.replaceAll = function(search, replacement) {
  var target = this;
  return target.replace(new RegExp(search, 'g'), replacement);
};
