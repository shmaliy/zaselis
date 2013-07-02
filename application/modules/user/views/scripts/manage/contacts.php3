<h1>Редактирование контактной информации</h1>
<a id="morePhones">Добавить телефон</a>

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
            <span class="add-on">
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

<div id="panel" class="cf">
    <form id="PhonesEdit" class="main-form cf" action="" method="post" enctype="application/x-www-form-urlencoded">
        <div id="NewPhones"></div> 
        <?php if (!empty($this->phones)) : ?>
            <?php foreach ($this->phones as $num=>$phone) : ?>
            <div class="phone cf">
                <div class="number"><?php echo $phone->z_countries_id; ?> <?php echo $phone->number; ?></div>
                <div class="status">
                    <?php if (!empty($phone->activate)) : ?>
                        <a class="inactive" rel="<?php echo $num; ?>">подтвердить</a>
                    <?php else : ?>
                        <div class="active">подтвержден</div>
                    <?php endif; ?>
                </div>
                <div class="delete"><a class="delete-link" rel="<?php echo $num; ?>">удалить</a></div>
            </div>
            <?php endforeach; ?>
        <?php endif; ?>
        <input type="submit" value="Сохранить">
    </form>
</div>
<div id="map-canvas"></div>
<script>
    function updateWindow()
    {
        setTimeout(function(){window.location = window.location.href;}, 500);
    }
    
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