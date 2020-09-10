var viewRoute = 'browse';
var viewParams = {};
var viewResults = {
    'elements': 0,
    'folders': 0,
    'files': 0
};
var viewPathRef = null;
var storageHelper = window.sessionStorage;
var tempObject = {};


// function updateCloudRoute() {
//     page_hash_params = pageHash.params();
//     if (!page_hash_params || Object.size(page_hash_params) <= 0) {
//         viewRoute = 'browse';
//         viewParams = {
//             'folder_id': 0
//         };
//         return {
//             'route': viewRoute,
//             'params': viewParams
//         };
//     }
//     $.each(page_hash_params, function (k, v) {
//         viewRoute = k;
//         viewParams = v;
//         return false;
//     });
//     viewPathRef = null;
//     viewResults = {
//         'elements': 0,
//         'folders': 0,
//         'files': 0
//     };
//     return {
//         'route': viewRoute,
//         'params': viewParams
//     };
// }

function cToolBox() {
    this.back = function () {
        $('.mouse-menu').hide();
        pageHash.change(resPreviousHASH);
        return true;
    };
    this.up = function () {
        var path_up_id = 0;
        if (viewPathRef && typeof viewPathRef.parent_id !== "undefined")
            path_up_id = viewPathRef["parent_id"];
        $('.mouse-menu').hide();
        pageHash.change("browse::folder_id=" + path_up_id);
        return true;
    };
    this.search = function () {
        $('.mouse-menu').hide();
        $('#file-search-modal').modalShowUP();
    }
    this.newFolder = function () {
        if (!viewPathRef || typeof viewPathRef.folder_id === "undefined") return true;
        $('#folder-new-modal').find('input[name="parent_id"]').val(viewPathRef.folder_id);
        $('.mouse-menu').hide();
        $('#folder-new-modal').modalShowUP();
    };
    this.newBulkFolder = function () {
        if (!viewPathRef || typeof viewPathRef.folder_id === "undefined") return true;
        $('#bulk-folder-new-modal').find('input[name="parent_id"]').val(viewPathRef.folder_id);
        $('.mouse-menu').hide();
        $('#bulk-folder-new-modal').modalShowUP();
    };
    this.newFile = function () {
        if (!viewPathRef || typeof viewPathRef.folder_id === "undefined") return true;
        $('#file-new-modal').find('input[name="folder_id"]').val(viewPathRef.folder_id);
        $('.mouse-menu').hide();
        $('#file-new-modal').modalShowUP();
    };
    this.confirmDelete = function () {
        var deleteData = tempObject.res_delete;
        if (!deleteData) return c_alert('No item/s to delete', 'info');
        postResponse = doRequestJson({
            'b': 'files_folders',
            'op': 'delete',
            'data': deleteData
        });
        if (postResponse && postResponse.type === "success") {
            $('#element-delete-modal').modal('hide');
            return renderFileManager();
        }
        return true;
    };
    this.confirmBadges = function () {
        var optionsData = tempObject.res_badges;
        var badges = form2Object('#elements_options_form');
        if (!optionsData) return c_alert('No item/s to set options', 'info');
        postResponse = doRequestJson({
            'b': 'files_folders',
            'op': 'badges',
            'data': optionsData,
            'badges': badges
        });
        if (postResponse && postResponse.type === "success") {
            $('#element-options-modal').modal('hide');
            return renderFileManager();
        }
        return true;
    };
}

var viewToolBox = new cToolBox();

function res_action_tools() {
    this.elementType = function (element, event) {
        if (!element || !$(element).data("res_type")) return false;
        return $(element).data("res_type");
    };

    this.open = function (element, event) {
        var element_type = this.elementType(element);
        if (!element_type) return false;
        switch (element_type) {
            case "folder":
                if (event.ctrlKey) {
                    window.open(jsoftData.system.baseurl + "/index.php?a=files#!/browse::folder_id=" + $(element).data("res_set")["folder_id"], '_blank');
                } else {
                    pageHash.change("browse::folder_id=" + $(element).data("res_set")["folder_id"]);
                }
                break;
            case "file":
                return this.renderModalInfo(element, event, '-view-modal', '-view-modal-content');
                break;
        }
    };

    this.renderModalInfo = function (element, event, modalsuffix, modalcontentsuffix) {
        $('.mouse-menu').hide();
        var element_type = this.elementType(element);
        if (!element_type) return false;
        var pModal = $('#' + element_type + modalsuffix);
        var eleData = $(element).data('res_set');
        if (!eleData || !pModal.length) return false;
        switch (element_type) {
            case "file":
                var readyData = doRequestJson({
                    'a': 'jsonp',
                    'b': 'get_single',
                    'op': 'file_by_id',
                    'file_id': eleData.file_id
                }, true);
                break;
            case "folder":
                var readyData = doRequestJson({
                    'a': 'jsonp',
                    'b': 'get_single',
                    'op': 'folder_by_id',
                    'folder_id': eleData.folder_id
                }, true);
                break;
        }
        if (!readyData) return c_alert(null, 'error');
        renderReadyData(pModal, '#' + element_type + modalcontentsuffix, readyData);
        pModal.modalShowUP();
    };

    this.info = function (element, event) {
        return this.renderModalInfo(element, event, '-info-modal', '-info-modal-content');
    };

    this.edit = function (element, event) {
        return this.renderModalInfo(element, event, '-update-modal', '-update-modal-content');
    };

    this.translate = function (element, event) {
        $('.mouse-menu').hide();
        var element_type = this.elementType(element);
        if (!element_type) return false;
        var eleData = $(element).data('res_set');
        if (!eleData || !$('#translations-update-modal').length) return false;
        switch (element_type) {
            case "file":
                var eleRefID = eleData.file_id;
                break;
            case "folder":
                var eleRefID = eleData.folder_id;
                break;
        }
        var readyData = doRequestJson({
            'a': 'jsonp',
            'b': 'get_single',
            'op': 'translations',
            'ref_type': element_type,
            'ref_id': eleRefID,
            'bypass': {
                'pact': 'renderFileManager'
            }
        }, true);
        if (!readyData) return c_alert(null, 'error');
        renderReadyData('#translations-update-modal', '#translations-update-modal-content', readyData);
        $('#translations-update-modal').modalShowUP();
    };

    this.cut = function (elements, event) {
        var actionHelper = this;
        var cutData = {
            'files': [],
            'folders': [],
            'files_shortcuts': [],
            'folders_shortcuts': []
        };
        $.each(elements, function () {
            var element_type = actionHelper.elementType(this);
            switch (element_type) {
                case "folder":
                    if (Math.round($(this).data('shortcut_id')) <= 0)
                        cutData.folders.push("folder_" + $(this).data('res_set')['folder_id']);
                    else cutData.folders_shortcuts.push("folder_shortcut_" + $(this).data('shortcut_id'));
                    break;
                case "file":
                    if (Math.round($(this).data('shortcut_id')) <= 0)
                        cutData.files.push("file_" + $(this).data('res_set')['file_id']);
                    else cutData.files_shortcuts.push("file_shortcut_" + $(this).data('shortcut_id'));
                    break;
            }
        });
        storageHelper.setItem('res_cut', JSON.stringify(cutData));
        storageHelper.removeItem('res_copy');
        return c_alert(elements.length + ' item/s cut', 'info');
    };

    this.copy = function (elements, event) {
        var actionHelper = this;
        var copyData = {
            'files': [],
            'folders': []
        };
        $.each(elements, function () {
            var element_type = actionHelper.elementType(this);
            switch (element_type) {
                case "folder":
                    copyData.folders.push("folder_" + $(this).data('res_set')['folder_id']);
                    break;
                case "file":
                    copyData.files.push("file_" + $(this).data('res_set')['file_id']);
                    break;
            }
        });
        storageHelper.setItem('res_copy', JSON.stringify(copyData));
        storageHelper.removeItem('res_cut');
        return c_alert(elements.length + ' item/s copy', 'info');
    };

    this.paste = function () {
        var pasteData = storageHelper.getItem('res_cut');
        var pasteOp = 'cut';
        if (!pasteData) {
            pasteData = storageHelper.getItem('res_copy');
            pasteOp = 'copy';
        }
        if (!pasteData) return c_alert('No item/s to paste', 'info');
        if (!viewPathRef || typeof viewPathRef.folder_id === "undefined")
            return c_alert('Cannot paste here', 'info');
        pasteData = JSON.parse(pasteData);
        postResponse = doRequestJson({
            'b': 'files_folders',
            'op': pasteOp,
            'parent_id': viewPathRef.folder_id,
            'data': pasteData
        });
        if (postResponse && postResponse.type === "success") {
            if (pasteOp === 'cut') storageHelper.removeItem('res_cut');
            return renderFileManager();
        }
        return true;
    };


    this.delete = function (elements, event) {
        var actionHelper = this;
        var deleteData = {
            'files': [],
            'folders': [],
            'files_shortcuts': [],
            'folders_shortcuts': []
        };
        $.each(elements, function () {
            var element_type = actionHelper.elementType(this);
            switch (element_type) {
                case "folder":
                    if (Math.round($(this).data('shortcut_id')) <= 0)
                        deleteData.folders.push("folder_" + $(this).data('res_set')['folder_id']);
                    else deleteData.folders_shortcuts.push("folder_shortcut_" + $(this).data('shortcut_id'));
                    break;
                case "file":
                    if (Math.round($(this).data('shortcut_id')) <= 0)
                        deleteData.files.push("file_" + $(this).data('res_set')['file_id']);
                    else deleteData.files_shortcuts.push("file_shortcut_" + $(this).data('shortcut_id'));
                    break;
            }
        });
        tempObject.res_delete = deleteData;
        $('#element-delete-modal').modalShowUP();
    };

    this.options = function (elements, event) {
        var actionHelper = this;
        var optionsData = {
            'files': [],
            'folders': []
        };
        $.each(elements, function () {
            var element_type = actionHelper.elementType(this);
            switch (element_type) {
                case "folder":
                    optionsData.folders.push("folder_" + $(this).data('res_set')['folder_id']);
                    break;
                case "file":
                    optionsData.files.push("file_" + $(this).data('res_set')['file_id']);
                    break;
            }
        });
        tempObject.res_badges = optionsData;
        $('#element-options-modal').modalShowUP();
    };

    this.refresh = function () {
        return renderFileManager();
    };

    this.select_all = function () {
        $('#directory-box .directory-element').not('.selected').addClass('selected');
    };

}

var res_do_action = new res_action_tools();

function bindDirectoryElementAction(target) {
    if (target.hasClass('directory-element'))
        var controller = $(target);
    else if ($(target).find('.directory-element').length)
        var controller = $(target).find('.directory-element');
    else return true;

    controller.find('.price-view-text').each(function () {
        $(this).html(jsoftFormatCurrency($(this).html()));
        $(this).removeClass('balance-view-text');
    });

    controller.find('.size-view-text').each(function () {
        $(this).html(bytes2Size($(this).html()));
        $(this).removeClass('size-view-text');
    });

    controller.unbind("contextmenu").bind("contextmenu", function (event) {
        event.preventDefault();
        $('.mouse-menu').hide();

        if (event.ctrlKey) {
            $(this).toggleClass('selected');
            return true;
        }

        if (!$(this).hasClass('selected')) {
            $('.directory-element').removeClass('selected');
            $(this).addClass('selected');
        }

        var element_menu = '#mouse-multi-menu';
        if ($('.directory-element.selected').length <= 1)
            element_menu = $(this).hasClass('directory-folder') ? '#mouse-folder-menu' : '#mouse-file-menu';

        $(element_menu).finish().toggle(100).css({
            'top': event.pageY + "px",
            'left': event.pageX + "px"
        });

        return true;
    });

    controller.unbind("click").bind("click", function (event) {
        res_do_action.open(this, event);
        return true;
    });

    return true;
}

$('#directory-box').unbind("click").bind("click", function (event) {
    if ($(event.target).parents('.mouse-menu').length ||
        $(event.target).parents('.directory-element').length)
        return true;
    $('.mouse-menu').hide(100);
    $('.directory-element').removeClass('selected');
    return true;
});

$('#directory-box').unbind("contextmenu").bind("contextmenu", function (event) {
    if ($(event.target).parents('.directory-element').length) return true;
    event.preventDefault();
    $('.mouse-menu').hide();
    var selected_len = $('.directory-element.selected').length;
    if (selected_len === 1) {
        $('.directory-element').removeClass('selected');
        selected_len = 0;
    }
    var element_menu = '#mouse-multi-menu';
    if (!selected_len) {
        var element_menu = '#mouse-space-menu';
        $('#mouse-space-menu li').show();
        if (!viewResults.elements) $('#mouse-space-menu .select-all-mi').hide();
        if (!viewPathRef) $('#mouse-space-menu .paste-mi').hide();
    }
    $(element_menu).finish().toggle(100).css({
        'top': event.pageY + "px",
        'left': event.pageX + "px"
    });
    return true;
});

$('.mouse-menu li').off('click').on('click', function (event) {
    var action = $(this).data('action');
    if (typeof action === "undefined") return true;
    switch ($(this).parents('.mouse-menu').first().attr('id')) {
        case "mouse-folder-menu":
        case "mouse-file-menu":
        case "mouse-multi-menu":
            var element = $('#directory-box').find('.directory-element.selected');
            if (!element.length) return true;
            res_do_action[action](element, event);
            $('.mouse-menu').hide();
            break;
        case "mouse-space-menu":
            res_do_action[action]();
            $('.mouse-menu').hide();
            break;
    }
    return true;
});



function processFmResults(results) {
    $('#directory-box').find('.overlay').hide();
    var refHTML = '<a class="path-dir-folder" href="#!/browse::folder_id=0">File Manager</a>';
    $('#directory-path').html(refHTML);
    if (!results || typeof results.type === "undefined" || results.type !== "success") {
        if (!results) results = {
            'type': 'error',
            'msg': {}
        };
        else if (typeof results.msg === "undefined" || !results.msg) results.msg = {};
        var alert_div = getReadyContent('#file-directory-message', results.msg);
        alert_div = $(alert_div).appendTo('#directory-box');
        resActions(alert_div);
        return true;
    } else results = results.msg;

    if (typeof results.header_msg !== "undefined" && results.header_msg) {
        $('#directory-header-message').html(results.header_msg);
        $('#directory-header-message').show();
    }

    if (typeof results.folders !== "undefined" && results.folders.length) {
        viewResults.folders = results.folders.length;
        $.each(results.folders, function (k, v) {
            var folder_li = getReadyContent('#folder-directory-element', v);
            folder_li = $(folder_li).appendTo('#directory-list');
            $(folder_li).data('res_set', v);
            $(folder_li).data('res_type', "folder");
            var shortcut_id = (typeof v.shortcut_id !== "undefined" && Math.round(v.shortcut_id) > 0) ? Math.round(v.shortcut_id) : 0;
            $(folder_li).data('shortcut_id', shortcut_id);
            bindDirectoryElementAction(folder_li);
        });
    }

    if (typeof results.files !== "undefined" && results.files.length) {
        viewResults.files = results.files.length;
        $.each(results.files, function (k, v) {
            var file_li = getReadyContent('#file-directory-element', v);
            file_li = $(file_li).appendTo('#directory-list');
            $(file_li).data('res_set', v);
            $(file_li).data('res_type', "file");
            var shortcut_id = (typeof v.shortcut_id !== "undefined" && Math.round(v.shortcut_id) > 0) ? Math.round(v.shortcut_id) : 0;
            $(file_li).data('shortcut_id', shortcut_id);
            bindDirectoryElementAction(file_li);
        });
    }

    if (typeof results.path !== "undefined" && results.path) {
        viewPathRef = results.path;
        if (typeof viewPathRef.path_directory !== "undefined" && $.type(viewPathRef.path_directory) === "array" && viewPathRef.path_directory.length) {
            viewPathRef.path_directory.reverse();
            $.each(viewPathRef.path_directory, function (k, v) {
                if (typeof v.folder_id !== "undefined" && typeof v.title !== "undefined")
                    refHTML += '<a class="path-dir-folder" href="#!/browse::folder_id=' + v.folder_id + '">' + v.title + '</a>';
            });
            $('#directory-path').first().html(refHTML);
        }
    }
    viewResults.elements = viewResults.files + viewResults.folders;
    return true;
}

$(document).find('form.hash-form[bind-hash]').unbind('submit').submit(function (e) {
    e.preventDefault();
    $(this).validate();
    if ($(this).valid() !== true) return false;
    var base_hash = $(this).attr('bind-hash') + '::';
    base_hash += $.param(form2Object(this));
    if (typeof $(this).data('hidemod') !== "undefined" && $(this).data('hidemod'))
        $($(this).data('hidemod')).modal('hide');
    return pageHash.change(base_hash);
});

$('#element-delete-modal').off('hide.bs.modal').on('hide.bs.modal', function () {
    tempObject.res_delete = null;
    return true;
});

$('#element-options-modal').off('hide.bs.modal').on('hide.bs.modal', function () {
    tempObject.res_badges = null;
    return true;
});

// function renderFileManager() {
//     $('.mouse-menu').hide();
//     $('#directory-header-message').hide();
//     $('#directory-box').find('.overlay').show();
//     updateCloudRoute();
//     $('#directory-box').find('#directory-box-alert').remove();
//     $('#directory-box').find('#directory-list').html(null);
//     var results = doRequestJson({
//         'b': 'filemanager',
//         'op': viewRoute,
//         'data': viewParams
//     }, true);
//     return processFmResults(results);
// }

// $(function () {
//     renderFileManager();
//     $(window).on('hashchange', function () {
//         renderFileManager();
//     });
// });