<h4>Управление вашим аватаром</h4>

<div class="avatar-field">
    <div class="avatar-field-text">
        Для загрузки или смены аватара нажмите &laquo;Сменить&raquo;
        или перетащите файл в окно редактирования.
    </div>
    <?php if (!empty($this->avatar)): ?>
        <div class="pic"><img src ="<?php echo str_replace('avatars/', 'avatars/thumbnail-180-256/', $this->avatar); ?>" /></div>

        <span class="avatar-delete btn btn-danger fileinput-button">
            <i class="icon-minus icon-white"></i>
            <span>Удалить</span>
        </span>

    <?php else : ?>
        Вы еще не загрузили свой аватар. Сделайте это прямо сейчас!
    <?php endif; ?>
</div>


<div class="container">
    
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="avatar-new btn btn-success fileinput-button">
        <i class="icon-share-alt icon-white"></i>
        <span>Изменить...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="avatar-progress progress progress-success progress-striped">
        <div class="bar"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files"></div>
</div>

<div id="avatarRemoveDialog" title="Подтверждение удаления аватарки">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
        Вы действительно хотите удалить вашу аватарку?
    </p>
</div>

<script>
$('#avatarRemoveDialog').hide();
/*jslint unparam: true */
/*global window, $ */







$('.avatar-delete').click(function () {
    
    $( "#avatarRemoveDialog" ).dialog ({
        resizable: false,
        height:190,
        modal: true,
        buttons: {
            "Удалить": function() { 
                megaOverlayShow();
                $.ajax({
            url: '<?php echo $this->url(array(), 'ajax-remove-avatar'); ?>',
            data: {},
            type: 'POST',
            error: function(jqXHR, textStatus, errorThrown) {},
            success: function(data, textStatus, jqXHR) {
                updateWindow(); 
            },
            complete: function(jqXHR, textStatus) {}
         });
            },
            "Я передумал": function() { $( this ).dialog( "close" ); }
        }
    });
    
});

var timer = 0;
$('#progress').hide();

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/js/jquery/jQuery-File-Upload-master/server/php/',
        uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .text('Обработка...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Отмена')
                    .on('click', function () {
                        $this.remove();
                        data.abort();
                    });
                data.submit().always(function () {
                    $this.remove();
                });
            });
    var i = 0;       
    var k = 0;
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        autoUpload: false,
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
        maxFileSize: 5000000, // 5 MB
        loadImageMaxFileSize: 15000000, // 15MB
        disableImageResize: false,
        previewMaxWidth: 100,
        previewMaxHeight: 100,
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').appendTo('#files');
        
        $.each(data.files, function (index, file) {
            if (i == 0) {
            var node = $('<p/>');
                    
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
            }
            i++;
        });
    }).on('fileuploadprocessalways', function (e, data) {
        var index = data.index,
            file = data.files[index],
            node = $(data.context.children()[index]);
        if (file.preview) {
            node
                .prepend('<br>')
                .prepend(file.preview);
        }
        if (file.error) {
            node
                .append('<br>')
                .append(file.error);
        }
        if (index + 1 === data.files.length) {
            data.context.find('button')
                .text('Загрузить')
                .prop('disabled', !!data.files.error);
        }
    }).on('fileuploadprogressall', function (e, data) {
        $('#progress').show();
        var progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress .bar').css(
            'width',
            progress + '%'
        );
    }).on('fileuploaddone', function (e, data) {
        
        var res = {};
        $.each(data.result.files, function (index, file) {
            var link = $('<a>')
                .attr('target', '_blank')
                .prop('href', file.url);
            $(data.context.children()[index]).remove();
//                .wrap(link);
            res = file['url'];

        });
        clearInterval(timer);
        timer = setTimeout(function(){
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'manage-avatar'); ?>',
                data: {file: res},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow(); 
                },
                complete: function(jqXHR, textStatus) {}
             });
        }, 1000);
        
        
    }).on('fileuploadfail', function (e, data) {
        $.each(data.result.files, function (index, file) {
            var error = $('<span/>').text(file.error);
            $(data.context.children()[index])
                .append('<br>')
                .append(error);
        });
    });
});
</script>
