<h3>Управление файлами</h3>
<div class="container manage-photos-container">
    <div class="manage-photos-container-description">
        <p>Чтобы загрузить файл нажмите &laquo;Добавить файлы...&raquo; 
        или перетащите один или несколько файлов в зеленую рамку.</p>
    </div>
    <!-- The fileinput-button span is used to style the file input field as button -->
    <span class="btn btn-success fileinput-button">
        <i class="icon-plus icon-white"></i>
        <span>Добавить файлы...</span>
        <!-- The file input field used as target for the file upload widget -->
        <input id="fileupload" type="file" name="files[]" multiple>
    </span>
    <br>
    <br>
    <!-- The global progress bar -->
    <div id="progress" class="progress progress-success progress-striped">
        <div class="bar"></div>
    </div>
    <!-- The container for the uploaded files -->
    <div id="files"></div>
</div>

<div class="files-manipulator cf" id="files-manipulator">

    <div class="uploaded">
        <h4>Загруженные файлы</h4>
        <div class="uploaded-description">
            <p>Чтобы установить порядок отображения файлов перетаскивайте их мышкой и нажмите &laquo;Сохранить&raquo;.</p>
            <p>Первый файл будет отображаться как иконка квартиры в списке.</p>
        </div>
        <ul class="upload-result cf" id="upload-results">
           <?php if (!empty($this->exist) && is_array($this->exist)) : ?>
                <?php foreach ($this->exist as $item) : ?>
                    <?php if (is_file(ltrim($item, '/'))) : ?>
                        <?php $thumb = str_replace('/flats/', '/flats/thumbnail-100-100/', $item); ?>
                        <li class="ui-state-default" rel="<?php echo $item; ?>">
                            <img src="<?php echo $thumb; ?>" />

                        </li>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </ul>
    </div>

    <div class="to-trash">
        <h4>Корзина</h4>
        <div class="to-trash-description">
            <p>Чтобы удалить файл из списка &laquo;Загруженные файлы&raquo; перетащите файл мышкой на красное поле.</p>
            <p>Если вы передумали удалять файл — перетащите его обратно в &laquo;Загруженные файлы&raquo;</p>
            <p><strong>Внимание!</strong> Файлы удаляются безвозвратно. После формирования списка на удаление нажмите &laquo;Сохранить&raquo;</p>
        </div>
        <ul class="upload-result cf" id="trash"></ul>
    </div>
</div>

<?php if (!empty($this->exist) && is_array($this->exist)) : ?>
<script>
    $(document).ready(function(){
        $('#upload-results, #trash').sortable({
            connectWith: ".upload-result"
        });
        
        $('#upload-results, #trash').disableSelection();
//        $('#upload-results li a').each(function(){
//            $(this).click(function(){
//                removeFile($(this).attr('rel'));
//                $(this).closest('li').remove();
//                megaOverlayHide();
//            });
//        });
        $('#SavePhotos').show();
    });
</script>
<?php endif; ?>

<a class="btn btn-success" id="SavePhotos">
    <i class="icon-star icon-white"></i>
    <span>Сохранить изменения</span>
</a>



<script>
/*jslint unparam: true */
/*global window, $ */

var timer = 0;
$(document).ready(function(){
    <?php if (empty($this->exist) || !is_array($this->exist)) : ?>
        $('#SavePhotos').hide();
    <?php endif; ?>
    
    $('#SavePhotos').click(function(){
        saveList();
    });
});

function saveList()
{
    var list = [];
    var trash = [];
    $('#upload-results li').each(function(){
        list.push($(this).attr('rel'));
    });

    $('#trash li').each(function(){
        trash.push($(this).attr('rel'));
    });

    megaOverlayShow();
    $.ajax({
        url: '<?php echo $this->url(array(), 'edit-photos'); ?>',
        data: {flatId: <?php echo $this->id; ?>, list: list, remove: trash},
        type: 'POST',
        error: function(jqXHR, textStatus, errorThrown) {},
        success: function(data, textStatus, jqXHR) {
            var result = jQuery.parseJSON(jqXHR.responseText);

            if (result['redirect']) {
                window.location.href = result['redirect'];
            }
        },
        complete: function(jqXHR, textStatus) {}
     });  
}

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var addedCount = 0;
    var uploadedCount = 0;
    var url = '/js/jquery/jQuery-File-Upload-master/server/php-multi/',
        uploadButton = $('<button/>')
            .addClass('btn')
            .prop('disabled', true)
            .text('Обработка...')
            .on('click', function () {
                var $this = $(this),
                    data = $this.data();
                $this
                    .off('click')
                    .text('Отменить')
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
            var node = $('<p/>');
                    //.append($('<span/>').text(file.name));
            if (!index) {
                node
                    .append('<br>')
                    .append(uploadButton.clone(true).data(data));
            }
            node.appendTo(data.context);
            
        });
        addedCount++;
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
            $(data.context.children()[index])
                .wrap(link);
            res = file['url'];
            
            $('#upload-results').append('<li class="ui-state-default" rel="' + 
                                     file['url'] + 
                                     '" ><img src="' +
                                     file['thumbnail-100-100_url'] + 
                                     '" /></li>');
            $('#upload-results').sortable();
            $('#upload-results').disableSelection();
            $('#SavePhotos').show();
        });
        uploadedCount++;
        if (uploadedCount == addedCount) {
            saveList();
        }
        
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
