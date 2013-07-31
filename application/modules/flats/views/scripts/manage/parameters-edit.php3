<h2>Добавление/редактирование параметров квартиры</h2>
<style>
    .slideThreeType:after {
	content: 'Да / Нет';
	color: #000;
    }

    .slideThreeType:before {
        content: 'Список';
        color: green;
    }
    
    .slideThreeOnOff:after {
	content: 'Off';
	color: #000;
    }

    .slideThreeOnOff:before {
        content: 'On';
        color: green;
    }
</style>
<div class="params-forms-container cf">
    <div class="create-form">
        <form id="CreateParameter"  action="" method="post" enctype="application/x-www-form-urlencoded">
            <div class="param-container cf">
                <div class="legend">Новый параметр</div>
                <div class="text">Редактирование иконки, а так же списка значений будет доступно после сохранения.</div>
                <div class="title"><input type="text" name="title" placeholder="название"></div>
                <div class="description">
                    <textarea name="description" placeholder="описание"></textarea>
                </div>
                <div class="type-legend">Тип параметра</div>
                <div class="type">
                    <div class="slideThreeType">	
                        <input type="checkbox" value="None" id="slideThree" name="type" />
                        <label for="slideThree"></label>
                    </div>            
                </div>
                <div class="save">
                    <input type="submit" class="form-save-button" value="Сохранить">
                </div>
            </div>
        </form>
    </div>
    <div class="edit-icon">
        <div class="container" rel="none">
    
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="icon-new-new btn btn-success fileinput-button">
                <i class="icon-share-alt icon-white"></i>
                <span>Изменить...</span>
                <!-- The file input field used as target for the file upload widget -->
                <input id="fileupload" type="file" name="files[]" multiple>
            </span>
            <br>
            <br>
            <!-- The global progress bar -->
            <div id="progress" class="icon-progress progress progress-success progress-striped">
                <div class="bar"></div>
            </div>
            <!-- The container for the uploaded files -->
            <div id="files"></div>
        </div>
    </div>
</div>
<script>
    $('#CreateParameter').submit(function(){
        processUserForm(
            'create-parameter', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#CreateParameter',
            [['updateWindow']]
        );
        return false;
    });
    

</script>

<form id="EditParameters" action="" method="post" enctype="application/x-www-form-urlencoded">
    <ul id="params-container" class="params-edit-table">
        <li class="param-header cf">
            <div class="icon">Иконка</div>
            <div class="title">Название</div>
            <div class="description">Описание</div>
            <div class="type">Тип</div>
            <div class="avaliable">Виден на сайте</div>
            <div class="del">Удалить</div>
        </li>
        <?php if (!empty($this->list)) : ?>
        
            <?php foreach ($this->list as $item) : ?>
                <li class="param cf" rel="<?php echo $item['z_flats_params_id']; ?>">
                    <div class="icon"></div>
                    <div class="title"><input type="text" name="title" placeholder="название" value="<?php echo $item['title']; ?>"></div>
                    <div class="description">
                        <textarea name="description"><?php echo $item['description']; ?></textarea>
                    </div>
                    <div class="type">
                        <div class="slideThreeType">
                            <?php if($item['type'] == 'BOOLEAN') : ?>
                                <input type="checkbox" value="None" id="slideThree_<?php echo $item['z_flats_params_id']; ?>" name="type" />
                                <label for="slideThree_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php else : ?>
                                <input checked type="checkbox" value="None" id="slideThree_<?php echo $item['z_flats_params_id']; ?>" name="type" />
                                <label for="slideThree_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php endif; ?>
                        </div>  
                        <?php if($item['type'] !== 'BOOLEAN') : ?>
                        <a href="#">Список значений</a>
                        <?php endif; ?>
                    </div>
                    <div class="avaliable">
                        <div class="slideThreeOnOff">
                            <?php if($item['avaliable'] == 'NO') : ?>
                                <input type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                                <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php else : ?>
                                <input checked type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                                <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                            <?php endif; ?>
                        </div>  
                    </div>
                    <div class="del"></div>
                </li>
            <?php endforeach; ?>
        
        <?php endif; ?>
    </ul>
    
</form>

<script>

$('#progress').hide();

$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = '/js/jquery/jQuery-File-Upload-master/server/php-parameter-icon/',
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
