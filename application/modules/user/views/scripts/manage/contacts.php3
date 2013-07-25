<h2>Редактирование контактной информации</h2>
<a id="morePhones" class="add-more-phones"><span>Добавить телефон</span></a>

<div id="formSource">
    <div class="input-prepend">
        <div class="btn-group cf">
            <label class="control-label" for="inputInfo">Выберите страну</label>
            <select name="country[]">
                <option value="0" rel="0">Выбрать</option>
                <?php foreach ($this->codes as $code) : ?>
                <option rel="<?php echo $code['code']; ?>" 
                        value="<?php echo $code['z_phone_codes_id']; ?>"
                        <?php echo ($code['z_countries_id'] == $this->country) ? ' selected' : ''; ?>>
                    <?php echo $code['z_countries_title']; ?>
                </option>
                <?php endforeach; ?>
            </select>
            <label class="control-label" for="inputInfo">Введите телефон</label>
            <span class="add-on">+
                <?php foreach ($this->codes as $c) : ?>
                    <?php 
                        if ($c['z_countries_id'] == $this->country) {
                            echo $c['code'];
                            break;
                        }
                    ?>
                <?php endforeach; ?>
            </span>
            <input name="phone[]" class="span3 input-xlarge" type="text">
        </div>
    </div>
</div>
<style>
    .slideThree:after {
	content: 'Неактивен';
	color: #000;
    }

    .slideThree:before {
        content: 'Активирован';
        color: green;
    }
</style>
<div id="panel" class="cf">
    <form id="PhonesEdit" class="main-form cf" action="" method="post" enctype="application/x-www-form-urlencoded">
        <div id="NewPhones"></div> 
        <input type="submit" value="Сохранить" class="form-save-button" id="savePhones">
        <?php if (!empty($this->phones)) : ?>
        <div class="phones-exist">Ваши телефоны</div>
            <?php foreach ($this->phones as $num=>$phone) : ?>
            <div class="phone cf">
                <div class="number">
                    <span class="code">+<?php echo $phone['code']; ?></span>
                    <span class="num"><?php echo $phone['number']; ?></span>
                </div>
                <div class="status">
                    <div class="slideThree">
                    <?php if (!empty($phone['activate'])) : ?>
                        <input type="checkbox" value="None" id="slideThree_<?php echo $num; ?>" name="check" />
                        <label class="confirm-label" rel="<?php echo $num; ?>" onclick="" for="slideThree_<?php echo $num; ?>"></label>
                    <?php else :  ?>
                        <input type="checkbox" value="None" id="slideThree_<?php echo $num; ?>" name="check" checked disabled />
                        <label for="slideThree_<?php echo $num; ?>"></label>
                    <?php endif; ?>
                    </div>
                </div>
                <div class="delete"><a class="delete-link" rel="<?php echo $num; ?>">удалить</a></div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        
    </form>
</div>
<div id="map-canvas"></div>
<div id="phoneRemoveDialog" title="Подтверждение удаления">
    <p>
        <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>
        Вы действительно хотите удалить номер телефона?
    </p>
</div>

<div id="phoneConfirmDialog" title="Активация номера">
    В течении нескольких минут на ваш номер придет СМС с кодом подтверждения. 
    <?php echo $this->actForm; ?>
</div>


<script>
    $('#phoneConfirmDialog').hide();
    $(document).ready( function (){
       $('.status .slideThree .confirm-label').each(function(){
           $(this).click(function(){
               $('#PhoneConfirm .line-number').val($(this).attr('rel'));
               $( "#phoneConfirmDialog" ).dialog ();
           });
       }); 
    });
    
    $('#PhoneConfirm').submit(function(){
        processUserForm(
            'ajax-phone-activate', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#PhoneConfirm',
            [['updateWindow']]
        );
        return false;
    });
    
    
    
    $('#phoneRemoveDialog').hide();
    $(document).ready( function (){
        
        $('.phone .delete-link').each(function () {
            $(this).click(function () {
                var rel = $(this).attr('rel');
                $( "#phoneRemoveDialog" ).dialog ({
                    resizable: false,
                    height:190,
                    modal: true,
                    buttons: {
                        "Удалить": function() { 
                            megaOverlayShow();
                            $.ajax({
                                url: '<?php echo $this->url(array(), 'ajax-remove-single-phone'); ?>',
                                data: {id: rel},
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
        });
    });
    
    $('#PhonesEdit').submit(function(){
        processUserForm(
            'user-contacts', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#PhonesEdit',
            [['updateWindow']]
        );
        return false;
    });
    
    
    
    $('#PhonesEdit .control-label:first').css({marginLeft: 0});
    $('#formSource .control-label:first').css({marginLeft: 0});
    
    function addPhone()
    {
        $('#formSource .input-prepend').clone().show().appendTo('#NewPhones');
        $('#savePhones').show();
    }
    
    function addEvent()
    {
        $('#PhonesEdit select option').click(function(){
            var code = $(this).attr('rel');
            var wrapper = $(this).closest('div');
            if (code == 0) {code = '';}
            $(wrapper).children('.add-on').html('').html(code);
        });
    }
    
    
    $('#morePhones').click(function(){
        addPhone();
        addEvent();
    });
</script>