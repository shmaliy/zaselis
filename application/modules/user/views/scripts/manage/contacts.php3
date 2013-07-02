<h1>Редактирование контактной информации</h1>
<a id="morePhones">Добавить телефон</a>

<div id="formSource">
    <div class="input-prepend">
        <div class="btn-group cf">
            <label class="control-label" for="inputInfo">Введите страну</label>
            <input class="span2 input-large" type="text">
            <label class="control-label" for="inputInfo">Введите телефон</label>
            <span class="add-on"></span>
            <input name="phone[]" class="span3 input-xlarge" type="text">
        </div>
    </div>
</div>

<div id="panel" class="cf">
    <form id="PhonesEdit" class="main-form cf" action="" method="post" enctype="application/x-www-form-urlencoded">
        <?php if (!empty($this->phones)) : ?>
        
        <?php else : ?>
        
        <?php endif; ?>
    </form>
</div>
<div id="map-canvas"></div>
<script>
    $('#PhonesEdit').submit(function(){
        processUserForm(
            'user-contacts', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#PhonesEdit',
            [['testCallback', '656465645'], ['testCallback', 'jdjhdfkhdfkf']]
        );
        return false;
    });
    
    $('#PhonesEdit .control-label:first').css({marginLeft: 0});
    $('#formSource .control-label:first').css({marginLeft: 0});
    
    
    
    
    function addPhone()
    {
        $('#formSource .input-prepend').clone().show().appendTo('#PhonesEdit');
    }
    
    $('#morePhones').click(function(){
        addPhone();
    });
</script>