<h2>Настройка спальных мест</h2>
<style>
    .slideThreeOnOff:after {
	content: 'Off';
	color: #000;
    }

    .slideThreeOnOff:before {
        content: 'On';
        color: green;
    }
</style>
<div class="params-forms-container row-fluid">
    <div class="create-form span6">
        <h3>Новая кровать</h3>
        <?php echo $this->form; ?>
    </div>
    <div class="edit-icon span6">
        <h4>Редактирование иконки</h4>
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
    $('#CreateBed').submit(function(){
        processUserForm(
            'beds', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#CreateBed',
            [['updateWindow']]
        );
        return false;
    });
    

</script>

<h3>Кровати</h3>
<?php if (!empty($this->list)) : ?>
    <table class="table table-striped" id="params-container">
        <thead>
            <th>Иконка</th>
            <th>Название</th>
            <th>Вместимость</th>
            <th>Видна на сайте</th>
            <th>Удалить</th>
        </thead>
    <?php foreach ($this->list as $item) : ?>
        <tr rel="<?php echo $item['z_flats_beds_id']; ?>">
            <td>
                <?php if(empty($item['icon'])) : ?>
                    <a rel="<?php echo $item['z_flats_beds_id']; ?>" class="btn btn-warning change-icon-param">
                        <i class="icon-plus icon-white"></i>
                    </a>
                <?php else : ?>
                    <?php $icon = str_replace('/beds-icons/', '/beds-icons/thumbnail-24-24/', $item['icon']); ?>
                    <img src="<?php echo $icon; ?>" />
                    <br /><br />
                    <a rel="<?php echo $item['z_flats_beds_id']; ?>" class="change-icon-param">
                        <i class="icon-pencil"></i>
                    </a>

                    <a rel="<?php echo $item['z_flats_beds_id']; ?>" class="delete-icon-param">
                        <i class="icon-remove"></i>
                    </a>
                <?php endif; ?>
            </td>
            <td><input type="text" name="title" placeholder="название" value="<?php echo $item['title']; ?>"></td>
            <td><input type="text" name="guests" placeholder="вместимость" value="<?php echo $item['guests']; ?>"></td>
            <td>
                <div class="slideThreeOnOff">
                    <?php if($item['avaliable'] == 'NO') : ?>
                        <input type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_beds_id']; ?>" name="avaliable" />
                        <label for="slideThreeOnOff_<?php echo $item['z_flats_beds_id']; ?>"></label>
                    <?php else : ?>
                        <input checked type="checkbox" value="ON" id="slideThreeOnOff_<?php echo $item['z_flats_beds_id']; ?>" name="avaliable" />
                        <label for="slideThreeOnOff_<?php echo $item['z_flats_beds_id']; ?>"></label>
                    <?php endif; ?>
                </div>
            </td>
            <td>
                <a rel="<?php echo $item['z_flats_beds_id']; ?>" class="btn btn-danger delete-bed">
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


<div id="remove-bed-dialog-confirm" title="Подумай трижды">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
        Если нажмешь да, то в мире резко сократится кол-во спальных мест. 
        Все владельцы квартир, купившие такую кровать, тебя проклянут!
    </p>
</div>

<script>



$(document).ready(function(){
    
    $('#remove-bed-dialog-confirm').hide();
    
    $('.delete-bed').each(function(){
       $(this).click(function(){
           var rel = $(this).attr('rel');
           
            $( "#remove-bed-dialog-confirm" ).dialog({
                resizable: false,
                height:280,
                modal: true,
                buttons: {
                    "Я уверен!": function() {
                    megaOverlayShow();
                    $.ajax({
                        url: '<?php echo $this->url(array(), 'remove-bed'); ?>',
                        data: {bedId: rel},
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
        
        
    $('#save-greed').click(function(){
        var post_data = [];
        var greed = $('#params-container li');
        
        $(greed).each(function(){
            
            var id = $(this).attr('rel');
            var title = $(this).find('.title input').val();
            var descr = $(this).find('.guests input').val();
            
            
            var aval = $(this).find('.avaliable input');
            
            var c_aval = 'NO';
            if ($(aval).is(':checked')) {
                c_aval = 'YES';
            }
            
            var tcell = [id, title, descr, c_aval];
            
            post_data.push(tcell);
        });
        console.log(post_data);
        
        if (post_data.length > 0) {
            megaOverlayShow();
            $.ajax({
                url: '<?php echo $this->url(array(), 'save-beds-greed'); ?>',
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
                url: '<?php echo $this->url(array(), 'set-bed-icon'); ?>',
                data: {bedId: $(this).attr('rel')},
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
    var url = '/js/jquery/jQuery-File-Upload-master/server/php-bed-icon/',
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
                url: '<?php echo $this->url(array(), 'set-bed-icon'); ?>',
                data: {file: res, bedId: $('#images-container').attr('rel')},
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
