<div id="ValuesListDialogContainer">

    <div class="new-value-form-container cf">
        <h5>Добавление нового значения</h5>
        <?php echo $this->form;?>
    </div>

    <?php if (!empty($this->list)) : ?>
    <div class="exiting-values-container">
        <h5>Управление значениями</h5>
        <ul id="ParamsValuesList">
            <?php foreach ($this->list as $item) : ?>
            <li class="ui-state-default cf" rel="<?php echo $item['z_flats_params_values_id']; ?>">
                <div><input type="text" value="<?php echo $item['text_value']; ?>"></div>
                <div>
                    <?php if($item['avaliable'] == 'NO') : ?>
                        <input type="checkbox" value="YES" name="avaliable" />
                    <?php else : ?>
                        <input checked type="checkbox" value="YES" name="avaliable" />
                    <?php endif; ?>
                </div>
                <div>
                    <a alt="<?php echo $item['z_flats_params_id']; ?>" rel="<?php echo $item['z_flats_params_values_id']; ?>"  class="btn btn-danger delete-param-value">
                        <i class="icon-minus icon-white"></i>
                    </a>
                </div>
            </li>
            <?php endforeach; ?>
        </ul>

    </div>
    <a class="btn btn-success" id="save-params-values-greed">
        <i class="icon-star icon-white"></i>
        <span>Сохранить изменения</span>
    </a>
    <?php endif; ?>
</div>

<div id="remove-param-value-dialog-confirm" title="Подумай трижды">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
        Если нажмешь да, то значение параметра полетит к черту. 
        Все владельцы квартир, использующие это значение, тебя проклянут!
    </p>
</div>

<script>
$(document).ready(function(){   
    
    $('#remove-param-value-dialog-confirm').hide();
    
    $('#save-params-values-greed').click(function(){
       var greed = [];
       var list = $('#ParamsValuesList li');
       
       $(list).each(function(){
           var text_value = $(this).find('input:text').val();
           var id = $(this).attr('rel');
           var avaliable = 'NO';
           if ($(this).find('input:checkbox').is(':checked')) {
               var avaliable = 'YES';
           }
           var row = [id, text_value, avaliable];
           greed.push(row);
       });
       
       
       if (greed.length > 0) {
           
            var alt = $('#z_flats_params_id').val();
            megaOverlayShow();
            
            $.ajax({
                url: '<?php echo $this->url(array(), 'save-parameters-values'); ?>',
                data: {greed: greed},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    reloadDialog(alt);
                },
                complete: function(jqXHR, textStatus) {}
             });
       }
    });
 
    $('.delete-param-value').each(function(){
       $(this).click(function(){
           
           var alt = $(this).attr('alt');
           var rel = $(this).attr('rel');
           
           $( "#remove-param-value-dialog-confirm" ).dialog({
                resizable: false,
                height:280,
                modal: true,
                buttons: {
                    "Я уверен!": function() {
                    $(this).dialog( "close" );
                    megaOverlayShow();
                    $.ajax({
                        url: '<?php echo $this->url(array(), 'remove-parameters-value'); ?>',
                        data: {paramId: rel},
                        type: 'POST',
                        error: function(jqXHR, textStatus, errorThrown) {},
                        success: function(data, textStatus, jqXHR) {
                            reloadDialog(alt);
                            
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
    
    function reloadDialog(paramId)
    {
        $.ajax({
            url: '<?php echo $this->url(array(), 'get-parameter-values-list'); ?>',
            data: {paramId: paramId},
            type: 'POST',
            error: function(jqXHR, textStatus, errorThrown) {},
            success: function(data, textStatus, jqXHR) {
                var result = jqXHR.responseText;
                $('#edit-values-list p').html(result);
                megaOverlayHide();
            },
            complete: function(jqXHR, textStatus) {}
         });
    }
    
    
    $('#ParamsValuesList').sortable({
        placeholder: "ui-state-highlight"
    });    

    $('#ParamsValues').submit(function(){
        processUserForm(
            'add-param-value', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#ParamsValues',
            [['reloadParamsValuesDialog', $('#z_flats_params_id').val(), '<?php echo $this->url(array(), 'get-parameter-values-list'); ?>']]
        );
        return false;
    });
});
</script>