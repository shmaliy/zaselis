<h2 xmlns="http://www.w3.org/1999/html">Редактирование контактной информации</h2>
<a id="morePhones" class="btn btn-warning"><i class="icon icon-white icon-plus"></i></a>

<script>

    <?php
    $codesJSON = array();
    foreach ($this->codes as $code) {
        $codesJSON[] = '{ id: "' . $code['z_phone_codes_id'] . '", code: "' . $code['code'] . '"}';
    }
    ?>

    var codes = [
        <?php echo implode(', ', $codesJSON); ?>
    ];

</script>

<div id="formSource">

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
        <div class="input-prepend">
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
            <input name="phone[]" class="span9 input-xlarge" type="text">
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
    <form id="PhonesEdit" class="form-inline" action="" method="post" enctype="application/x-www-form-urlencoded">
        <div id="NewPhones"></div>
        <button class="btn btn-success" id="savePhones"><i class="icon icon-white icon-star"></i>Сохранить</button>
    </form>

    <?php if (!empty($this->phones)) : ?>
    <h3 class="top-30">Ваши телефоны</h3>
    <table class="table table-striped">
    <?php foreach ($this->phones as $num=>$phone) : ?>
        <tr>
            <td>
                <div class="input-prepend">
                    <span class="add-on">+<?php echo $phone['code']; ?></span>
                    <input name="phone[]" class="span9 " type="text" disabled value="<?php echo $phone['number']; ?>">
                </div>
            </td>
            <td>
                <div class="slideThree">
                    <?php if (!empty($phone['activate'])) : ?>
                        <input type="checkbox" value="None" id="slideThree_<?php echo $num; ?>" name="check" />
                        <label class="confirm-label" rel="<?php echo $num; ?>" onclick="" for="slideThree_<?php echo $num; ?>"></label>
                    <?php else :  ?>
                        <input type="checkbox" value="None" id="slideThree_<?php echo $num; ?>" name="check" checked disabled />
                        <label for="slideThree_<?php echo $num; ?>"></label>
                    <?php endif; ?>
                </div>
            </td>
            <td><a class="delete-link btn btn-danger" rel="<?php echo $num; ?>"><i class="icon icon-white icon-remove"></i></a</td>
        </tr>
    <?php endforeach; ?>
    </table>


    <?php endif; ?>
        

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
       $('.slideThree .confirm-label').each(function(){
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
        
        $('.delete-link').each(function () {
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
            {lang: globalLang, currencie: globalCurr},
            '#PhonesEdit',
            [['updateWindow']]
        );
        return false;
    });
    
    
    
    $('#PhonesEdit .control-label:first').css({marginLeft: 0});
    $('#formSource .control-label:first').css({marginLeft: 0});
    
    function addPhone()
    {
        $('#formSource').clone().show().appendTo('#NewPhones');
        $('#savePhones').show();
    }
    
    function addEvent()
    {
        $('#PhonesEdit select').change(function(){
            var code = $(this).attr('rel');
            var wrapper = $(this).closest('form');

            for (key in codes) {
                if ($(this).val() == codes[key]['id']) {
                    $(wrapper).find('.add-on').html('').html('+ ' + codes[key]['code']);
                }
            }
        });
    }
    
    
    $('#morePhones').click(function(){
        addPhone();
        addEvent();
    });
</script>