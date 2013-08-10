<h2>Удобства и кровати</h2>
<style>
    .slideThreeOnOff:after {
	content: 'Нет';
	color: #000;
    }

    .slideThreeOnOff:before {
        content: 'Да';
        color: green;
    }
</style>

<div class="params-container">
    <h4>Удобства квартиры</h4>
    <ul id="ParamsGreed">
        <?php foreach ($this->params as $param) : ?>
        <li class="cf" rel ="<?php echo $param['param_id']; ?>" alt ="<?php echo $param['rel_id']; ?>">
            <div class="param-icon">
                <?php if(!empty($param['param_icon'])) : ?>
                    <?php $icon = str_replace('/parameters-icons/', '/parameters-icons/thumbnail-16-16/', $param['param_icon']); ?>
                    <img src="<?php echo $icon; ?>" />
                <?php endif; ?>
            </div>
            <div class="param-title"><?php echo $param['param_title']; ?></div>
            <div class="param-value">
                <?php if ($param['param_type'] == 'BOOLEAN') : ?>
                    <div class="slideThreeOnOff">
                        <?php if($param['rel_boolean'] == 'NO' || is_null($param['rel_boolean'])) : ?>
                            <input type="checkbox" value="YES" id="slideThreeOnOff_<?php echo $param['rel_id']; ?>" name="avaliable" />
                            <label for="slideThreeOnOff_<?php echo $param['rel_id']; ?>"></label>
                        <?php else : ?>
                            <input checked type="checkbox" value="YES" id="slideThreeOnOff_<?php echo $param['rel_id']; ?>" name="avaliable" />
                            <label for="slideThreeOnOff_<?php echo $param['rel_id']; ?>"></label>
                        <?php endif; ?>
                    </div>  
                <?php else : ?>
                <select name="value">
                    <option value="NULL">Выберите значение</option>
                    <?php foreach ($this->params_values as $value): ?>
                    <?php if ($value['z_flats_params_id'] == $param['param_id']) : ?>
                        <?php 
                            $ch = '';
                            if ($param['rel_value_id'] == $value['z_flats_params_values_id']) {
                                $ch = 'selected';
                            }
                        ?>
                    
                        <option <?php echo $ch; ?> value="<?php echo $value['z_flats_params_values_id']; ?>"><?php echo $value['text_value']; ?></option>
                    <?php endif; ?>
                    <?php endforeach; ?>
                </select>
                <?php endif; ?>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <a class="btn btn-success" id="save-flats-params-greed">
        <i class="icon-star icon-white"></i>
        <span>Сохранить удобства</span>
    </a>
</div>

<script>



$(document).ready(function(){
    $('#save-flats-params-greed').click(function(){
        var greed = $('#ParamsGreed li');
        var post_data = [];
        
        $(greed).each(function(){
            var param_id = $(this).attr('rel');
            var rel_id = $(this).attr('alt') || 'new';
            var value_bool = $(this).find('input:checkbox').is(':checked') || 'NO';
            
            if (value_bool == true) {
                value_bool = 'YES';
            }
            
            var value_text = $(this).find('select').val() || 'NULL';
            
            var row = [param_id, rel_id, value_bool, value_text];
            post_data.push(row);
        });
        console.log(post_data);
        
        if (post_data.length > 0) {
            megaOverlayShow();
            
            $.ajax({
                url: '<?php echo $this->url(array('id' => $this->id), 'save-flats-params-greed'); ?>',
                data: {greed: post_data},
                type: 'POST',
                error: function(jqXHR, textStatus, errorThrown) {},
                success: function(data, textStatus, jqXHR) {
                    updateWindow();
//                    megaOverlayHide();
                },
                complete: function(jqXHR, textStatus) {}
             });
        }
    });
});
    

</script>
