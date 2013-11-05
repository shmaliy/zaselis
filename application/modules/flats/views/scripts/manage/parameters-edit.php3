<h2>Добавление/редактирование удобств квартиры</h2>
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
<div class="params-forms-container row-fluid cf">
    <div class="create-form span6">
        <form id="CreateParameter"  action="" method="post" enctype="application/x-www-form-urlencoded">
            <div class="param-container cf">
                <h3>Новый параметр</h3>
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
                    <a class="btn btn-success" onclick="$('#CreateParameter').submit();">
                        <i class="icon-plus icon-white"></i>
                        <span>Добавить</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="edit-icon span6">
        <h3>Редактирование иконки</h3>
        <div id="param-title-legend"></div>
        <div class="container" rel="none" id="images-container">
            <!-- The fileinput-button span is used to style the file input field as button -->
            <span class="btn btn-success fileinput-button">
                <i class="icon-plus icon-white"></i>
                <span>Выбрать файл...</span>
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

<?php if (!empty($this->list)) : ?>
    <h3>Параметры</h3>
    <table id="params-container" class="table table-striped admin-params-table">
        <thead>
            <th>Иконка</th>
            <th>Название</th>
            <th>Описание</th>
            <th>Тип</th>
            <th>Виден на сайте</th>
            <th>Удалить</th>
        </thead>
    <?php foreach ($this->list as $item) : ?>
        <tr rel="<?php echo $item['z_flats_params_id']; ?>" class="greed-row">
            <td>
                <?php if(empty($item['icon'])) : ?>
                    <a rel="<?php echo $item['z_flats_params_id']; ?>" class="btn btn-warning change-icon-param">
                        <i class="icon-plus icon-white"></i>
                    </a>
                <?php else : ?>
                    <?php $icon = str_replace('/parameters-icons/', '/parameters-icons/thumbnail-16-16/', $item['icon']); ?>
                    <img class="param-icon" src="<?php echo $icon; ?>" />

                    <a rel="<?php echo $item['z_flats_params_id']; ?>" class="change-icon-param">
                        <i class="icon-pencil"></i>
                    </a>

                    <a rel="<?php echo $item['z_flats_params_id']; ?>" class="delete-icon-param">
                        <i class="icon-remove"></i>
                    </a>
                <?php endif; ?>
            </td>
            <td><input class="span12" type="text" name="title" placeholder="название" value="<?php echo $item['title']; ?>"></td>
            <td><textarea class="descr" name="description"><?php echo $item['description']; ?></textarea></td>
            <td class="type">
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
                    <a rel="<?php echo $item['z_flats_params_id']; ?>" class="edit-parameters-values">Список значений</a>
                <?php endif; ?>
            </td>
            <td class="avaliable">
                <div class="slideThreeOnOff">
                    <?php if($item['avaliable'] == 'NO') : ?>
                        <input type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                        <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                    <?php else : ?>
                        <input checked type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>" name="avaliable" />
                        <label for="slideThreeOnOff_<?php echo $item['z_flats_params_id']; ?>"></label>
                    <?php endif; ?>
                </div>
            </td>
            <td>
                <a rel="<?php echo $item['z_flats_params_id']; ?>" class="btn btn-danger delete-param">
                    <i class="icon-minus icon-white"></i>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>



<a class="btn btn-success" id="save-greed">
    <i class="icon-star icon-white"></i>
    <span>Сохранить изменения</span>
</a>

<div id="edit-values-list" title="Редактирование значений параметра">
    <p>
        
    </p>
</div>

<div id="remove-param-dialog-confirm" title="Подумай трижды">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
        Если нажмешь да, то параметр и все его значения, если они есть, полетят к черту. 
        Все владельцы квартир, использующие этот параметр, тебя проклянут!
    </p>
</div>

<script>



$(document).ready(function(){
    
    $('#remove-param-dialog-confirm').hide();
    
    $('.delete-param').each(function(){
       $(this).click(function(){
           var rel = $(this).attr('rel');
           
            $( "#remove-param-dialog-confirm" ).dialog({
                resizable: false,
                height:280,
                modal: true,
                buttons: {
                    "Я уверен!": function() {
                    megaOverlayShow();
                    $.ajax({
                        url: '<?php echo $this->url(array(), 'remove-param'); ?>',
                        data: {paramId: rel},
                        type: 'POST',
                        error: function(jqXHR, textStatus, errorThrown) {},
                        success: function(data, textStatus, jqXHR) {
                            updateWindow();
                        },
                        complete: function(jqXHR, textStatus) {}
                     });    
                },
                'Да ну на!': function() {
                        $( this ).dialog( "close" );
                    }
                }
            });
       
            
       });
    });
        
    $('#edit-values-list').hide();
    
    $('.edit-parameters-values').each(function(){
        $(this).click(function(){
            
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'get-parameter-values-list'); ?>',
                data: {paramId: $(this).attr('rel')},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    var result = jqXHR.responseText;
                    $('#edit-values-list p').html(result);
                    megaOverlayHide();
                    $('#edit-values-list').dialog({modal: true, resizable: true, width: 600});
                },
                complete: function(jqXHR, textStatus) {}
             });
        });
    });

    $('#params-container').sortable();
        
    $('#save-greed').click(function(){
        var post_data = [];
        var greed = $('.greed-row');
        
        $(greed).each(function(){
            
            var id = $(this).attr('rel');
            var title = $(this).find('input.span12').val();
            var descr = $(this).find('textarea.descr').val();
            var type = $(this).find('.type input');
            
            var c_type = 'BOOLEAN';
            if ($(type).is(':checked')) {
                c_type = 'TEXT';
            }
            
            var aval = $(this).find('.avaliable input');
            
            var c_aval = 'NO';
            if ($(aval).is(':checked')) {
                c_aval = 'YES';
            }
            
            var tcell = [id, title, descr, c_type, c_aval];
            
            post_data.push(tcell);
        });
        console.log(post_data);
        
        if (post_data.length > 0) {
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'parameters-edit'); ?>',
                data: {greed: post_data},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow();
                    
                },
                complete: function(jqXHR, textStatus) {}
             });
        }
    
    });

    $('#progress').hide();
    $('.edit-icon').hide();
    $( "#params-container" ).sortable({
        placeholder: "ui-state-highlight"
    });
//    $( "#params-container" ).disableSelection();
    
    $(".change-icon-param").each(function(){
        $(this).click(function(){
            var row = $(this).closest('.param');
            
            $('#param-title-legend').html('').append($(row).find('.title input').val());
            $('#images-container').attr('rel', $(this).attr('rel'));
            $('.edit-icon').show();
        });
    });
    
    $(".delete-icon-param").each(function(){
        $(this).click(function(){
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'set-parameter-icon'); ?>',
                data: {paramId: $(this).attr('rel')},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow(); 
                },
                complete: function(jqXHR, textStatus) {}
             });
        });
    });
});

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
        if ($('#images-container').attr('rel') != 'none') {
        
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'set-parameter-icon'); ?>',
                data: {file: res, paramId: $('#images-container').attr('rel')},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow();
                },
                complete: function(jqXHR, textStatus) {}
             });
         
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
