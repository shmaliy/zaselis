

<div class="new-value-form-container cf">
    <h5>Добавление нового значения</h5>
    <?php echo $this->form;?>
</div>

<?php if (!empty($this->list)) : ?>
<div class="exiting-values-container">
    Управление параметрами
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
                <a rel="<?php echo $item['z_flats_params_id']; ?>" class="btn btn-danger delete-param">
                    <i class="icon-minus icon-white"></i>
                </a>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    
</div>
<?php endif; ?>

<script>
$('#ParamsValuesList').sortable({
    placeholder: "ui-state-highlight"
});    
    
$('#ParamsValues').submit(function(){
        processUserForm(
            'add-param-value', 
            {'lang': globalLang, 'currencie': globalCurr},
            '#ParamsValues',
            []
        );
            return false;
});
</script>